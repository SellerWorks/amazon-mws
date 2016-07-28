<?php

namespace SellerWorks\Amazon\Common;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;

use SellerWorks\Amazon\Credentials\Credentials;
use SellerWorks\Amazon\Credentials\CredentialsAwareInterface;
use SellerWorks\Amazon\Credentials\CredentialsAwareTrait;
use SellerWorks\Amazon\Credentials\CredentialsInterface;

/**
 * Base client class for all MWS endponints.
 */
class AbstractClient implements CredentialsAwareInterface
{
    /**
     * @property $credentials
     * @method   CredentialsInterface  getCredentials()
     * @method   self  setCredentials(CredentialsInterface $credentials)
     */
    use CredentialsAwareTrait;

    /**
     * MWS service definitions.
     */
    const MWS_PATH    = '';
    const MWS_VERSION = '';

    /**
     * @var UriInterface
     */
    protected $defaultUri;

    /**
     * @var string
     */
    protected $defaultMarketplaceId;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @var GuzzleHttp\Client
     */
    protected $guzzle;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * Configure the client defaults.
     */
    public function __construct()
    {
        $this->guzzle = new GuzzleClient;
        $this->setRegion(Enum\Region::US);
    }

    /**
     * @param  string  $region
     * @return self
     */
    public function setRegion($region)
    {
        static $regionInfo = [
            // NA region
            Enum\Region::CA => ['host' => 'mws.amazonservices.ca',     'marketplaceId' => 'A2EUQ1WTGCTBG2'],
            Enum\Region::MX => ['host' => 'mws.amazonservices.com.mx', 'marketplaceId' => 'A1AM78C64UM0Y8'],
            Enum\Region::US => ['host' => 'mws.amazonservices.com',    'marketplaceId' => 'ATVPDKIKX0DER'],

            // EU region
            Enum\Region::DE => ['host' => 'mws-eu.amazonservices.com', 'marketplaceId' => 'A1PA6795UKMFR9'],
            Enum\Region::ES => ['host' => 'mws-eu.amazonservices.com', 'marketplaceId' => 'A1RKKUPIHCS9HS'],
            Enum\Region::FR => ['host' => 'mws-eu.amazonservices.com', 'marketplaceId' => 'A13V1IB3VIYZZH'],
            Enum\Region::IN => ['host' => 'mws.amazonservices.in',     'marketplaceId' => 'A21TJRUUN4KGV'],
            Enum\Region::IT => ['host' => 'mws-eu.amazonservices.com', 'marketplaceId' => 'APJ6JRA9NG5V4'],
            Enum\Region::UK => ['host' => 'mws-eu.amazonservices.com', 'marketplaceId' => 'A1F83G8C2ARO7P'],

            // FE region
            Enum\Region::JP => ['host' => 'mws.amazonservices.jp',     'marketplaceId' => 'A1VC38T7YXB528'],

            // CN region
            Enum\Region::CN => ['host' => 'mws.amazonservices.com.cn', 'marketplaceId' => 'AAHKV2X7AFYLW'],
        ];

        $region = strtolower($region);

        if (array_key_exists($region, $regionInfo)) {
            $this->defaultUri           = $this->buildUri($regionInfo[$region]['host']);
            $this->defaultMarketplaceId = $regionInfo[$region]['marketplaceId'];
        }
        else {
            throw new InvalidArgumentException(sprintf('Invalid region: "%s"', $region));
        }

        return $this;
    }

    /**
     * @param  RequestInterface  $request
     * @return PromiseInterface
     */
    public function send(RequestInterface $request)
    {
        $headers = ['Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8', 'Expect' => ''];
        $query   = $this->buildQuery($request);

        $gzRequest = new GuzzleRequest('POST', $this->defaultUri, $headers, $query);
        $promise   = $this->guzzle->sendAsync($gzRequest)->then(
            // onFulfilled
            function (ResponseInterface $response) {
                return $response->getBody()->getContents();
            }
        );

        return $promise;
    }

    /**
     * @return UriInterface
     */
    private function buildUri($host)
    {
        return new Uri(sprintf('https://%s/%s', $host, trim(static::MWS_PATH, '/')));
    }

    /**
     * Build and return the query string.
     *
     * @param  RequestInterface  $request
     * @return string
     * @throws UnexpectedValueException
     */
    private function buildQuery(RequestInterface $request)
    {
        if ($this->credentials instanceof CredentialsInterface) {
            $credentials = $this->credentials;
        }
        else {
            throw new \UnexpectedValueException('Set credentials to use this service.');
        }

        $parameters = [];
        $parameters['Action'] = 'GetServiceStatus';

        // Credentials.
        $parameters['SellerId']       = $credentials->getSellerId();
        $parameters['AWSAccessKeyId'] = $credentials->getAccessKey();
        $parameters['MWSAuthToken']   = $credentials->getMwsAuthToken();

        // Standard parameters.
        $parameters['SignatureMethod']  = 'HmacSHA256';
        $parameters['SignatureVersion'] = 2;
        $parameters['Timestamp']        = $this->gmdate();
        $parameters['Version']          = static::MWS_VERSION;

        // Sign query.
        unset($parameters['Signature']);
        uksort($parameters, 'strcmp');
        $query = [];

        foreach ($parameters as $k => $v) {
            $query[] = sprintf('%s=%s', $k, $this->urlencode_rfc3986((string) $v));
        }

        $query  = implode('&', $query);
        $query .= '&Signature=' . $this->calculateSignature($query, $credentials->getSecretKey());

        return $query;
    }

    /**
     * Calculate the signature based on Hmac SHA256.
     *
     * @param  string  $query
     * @param  string  $secretKey
     * @return string
     */
    private function calculateSignature($query, $secretKey)
    {
        $path = trim(static::MWS_PATH, '/');
        $head = sprintf("POST\n%s\n/%s\n%s", 'mws.amazonservices.com', $path, $query);
        $sig  = hash_hmac('sha256', $head, $secretKey, true);

        return $this->urlencode_rfc3986(base64_encode($sig));
    }

    /**
     * Return RFC 3986 compliant string.
     *
     * @param  string  $value
     * @return string
     */
    private function urlencode_rfc3986($value)
    {
        return str_replace(['+', '%7E'], [' ', '~'], rawurlencode($value));
    }

    /**
     * Return UTC timestamp.
     *
     * @return string
     *
     * @codeCoverageIgnore
     */
    private function gmdate()
    {
        return gmdate(SerializerInterface::DATE_FORMAT);
    }

    /**
     * Get event dispatcher.
     *
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher()
    {
        if (null === $this->eventDispatcher) {
            $this->eventDispatcher = new EventDispatcher;
        }

        return $this->eventDispatcher;
    }

    /**
     * Set event dispatcher.
     *
     * @param  EventDispatcherInterface  $eventDispatcher
     * @return self
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;

        return $this;
    }

    /**
     * Dispatch an event.
     *
     * @param  string  $name
     * @param  Event  $event
     * @return Event
     */
    protected function dispatch($name, Event $event)
    {
        return $this->getEventDispatcher()->dispatch($name, $event);
    }
}
<?php

namespace SellerWorks\Amazon\Common;

use Exception;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Psr\Http\Message\UriInterface;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;

use SellerWorks\Amazon\Credentials\Credentials;
use SellerWorks\Amazon\Credentials\CredentialsAwareInterface;
use SellerWorks\Amazon\Credentials\CredentialsAwareTrait;
use SellerWorks\Amazon\Credentials\CredentialsInterface;
use SellerWorks\Amazon\Common\Event\RequestEvent;
use SellerWorks\Amazon\Common\Exception\ErrorException;
use SellerWorks\Amazon\Events;

/**
 * Base client class for all MWS endponints.
 */
class AbstractClient implements ClientInterface, CredentialsAwareInterface
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
     * @var GuzzleHttp\Client
     */
    protected $guzzle;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var UriInterface
     */
    protected $uri;

    /**
     * @var string
     */
    protected $defaultMarketplaceId;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * List of Amazon MWS URLs, indexed by country code.
     *
     * @var array
     */
    protected $countryInfo = [
        // NA region
        Country::CA => ['host' => 'mws.amazonservices.ca',     'marketplaceId' => 'A2EUQ1WTGCTBG2'],
        Country::MX => ['host' => 'mws.amazonservices.com.mx', 'marketplaceId' => 'A1AM78C64UM0Y8'],
        Country::US => ['host' => 'mws.amazonservices.com',    'marketplaceId' => 'ATVPDKIKX0DER'],

        // EU region
        Country::DE => ['host' => 'mws-eu.amazonservices.com', 'marketplaceId' => 'A1PA6795UKMFR9'],
        Country::ES => ['host' => 'mws-eu.amazonservices.com', 'marketplaceId' => 'A1RKKUPIHCS9HS'],
        Country::FR => ['host' => 'mws-eu.amazonservices.com', 'marketplaceId' => 'A13V1IB3VIYZZH'],
        Country::IN => ['host' => 'mws.amazonservices.in',     'marketplaceId' => 'A21TJRUUN4KGV'],
        Country::IT => ['host' => 'mws-eu.amazonservices.com', 'marketplaceId' => 'APJ6JRA9NG5V4'],
        Country::UK => ['host' => 'mws-eu.amazonservices.com', 'marketplaceId' => 'A1F83G8C2ARO7P'],

        // FE region
        Country::JP => ['host' => 'mws.amazonservices.jp',     'marketplaceId' => 'A1VC38T7YXB528'],

        // CN region
        Country::CN => ['host' => 'mws.amazonservices.com.cn', 'marketplaceId' => 'AAHKV2X7AFYLW'],
    ];

    /**
     * Configure the client defaults.
     */
    public function __construct(Credentials $credentials, $countryCode = Country::US)
    {
        $this->guzzle     = new GuzzleClient;
        $this->serializer = new Serializer\Serializer;

        $this->setCredentials($credentials);
        $this->setCountry($countryCode);
    }

    /**
     * @param  string  $countryCode
     * @return self
     */
    protected function setCountry($countryCode)
    {
        $countryCode = strtolower($countryCode);

        if (array_key_exists($countryCode, $this->countryInfo)) {
            $this->uri                  = $this->buildUri($this->countryInfo[$countryCode]['host']);
            $this->defaultMarketplaceId = $this->countryInfo[$countryCode]['marketplaceId'];
        }
        else {
            throw new InvalidArgumentException(sprintf('Unknown country code: "%s"', $countryCode));
        }

        return $this;
    }

    /**
     * @param  RequestInterface  $request
     * @param  int  $throttle
     * @return PromiseInterface
     */
    protected function send(RequestInterface $request, $throttle = 30)
    {
        $requestEvent = new RequestEvent($request);
        $this->dispatch(Events::REQUEST, $requestEvent);

        $headers = ['Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8', 'Expect' => ''];
        $query   = $this->buildQuery($request);

        $gzRequest = new GuzzleRequest('POST', $this->uri, $headers, $query);
        $promise   = $this->guzzle->sendAsync($gzRequest)->then(
            // onFulfilled
            function (PsrResponseInterface $response) {
                $contents = $response->getBody()->getContents();
                $contents = $this->serializer->unserialize($contents);

                if ($contents instanceof ResponseInterface) {
                    return $contents->getResult();
                }
                else {
                    return $contents;
                }
            },
            // onRejected
            function (Exception $e) use ($request, $throttle) {
                $contents = $e->getResponse()->getBody()->getContents();

                if (false !== preg_match_all('#<(Type|Code|Message)>(.*?)</#si', $contents, $matches)) {
                    $error = array_combine($matches[1], $matches[2]);

                    if ($error['Code'] == 'RequestThrottled') {
                        sleep($throttle);
                        return $this->send($request, $throttle);
                    }

                    throw new ErrorException($error['Message']);
                }
                else {
                    throw new ErrorException($e->getMessage());
                }
            }
        );

//         $responseEvent = new Event\ResponseEvent($promise);
//         $this->dispatch(Events::RESPONSE, $responseEvent);

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

        $parameters = $this->serializer->serialize($request);

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
    protected function getEventDispatcher()
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

<?php

namespace SellerWorks\Amazon\Common;

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
     * @var string
     */
    protected $baseUri;

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
     * @var string
     */
    protected $region;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     */
    public function __construct(CredentialsInterface $credentials = null)
    {
        $this->credentials = $credentials?: null;

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
            $this->host = $regionInfo[$region]['host'];
            $this->defaultMarketplaceId = $regionInfo[$region]['marketplaceId'];
        }
        else {
            throw new InvalidArgumentException(sprintf('Invalid region: "%s"', $region));
        }

        return $this;
    }

    /**
     * @param  RequestInterface  $request
     * @return ResponseInterface
     */
    protected function send(RequestInterface $request)
    {
        $uri = $this->buildUri();
    }

    /**
     * @param  RequestInterface  $request
     * @return PromiseInterface
     */
    protected function sendAsync(RequestInterface $request)
    {
    }

    /**
     * @param  RequestInterface  $request
     * @param  CredentialsInterface  $credentials
     * @return GuzzleHttp\Psr7\Requeste
     */
    private function buildRequest(RequestInterface $request, CredentialsInterface $credentials)
    {
        
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
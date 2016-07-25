<?php

namespace SellerWorks\Amazon\Common;

use Error;
use InvalidArgumentException;
use RuntimeException;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ResponseInterface;

use SellerWorks\Amazon\Credentials\CredentialsAwareInterface;
use SellerWorks\Amazon\Credentials\CredentialsAwareTrait;
use SellerWorks\Amazon\Credentials\CredentialsException;
use SellerWorks\Amazon\Credentials\CredentialsInterface;

/**
 * Abstract MWS client implementation.
 *
 * 
 */
class AbstractClient implements ClientInterface
{
    /**
     * MWS Service definitions.
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
     * Constructor.
     *
     * @param  CredentialsInterface  $credentials
     */
    public function __construct(CredentialsInterface $credentials = null)
    {
        $this->guzzle = new Client;
    }

    /**
     * @param  RequestInterface  $request
     * @return ResponseInterface
     */
    public function send(RequestInterface $request)
    {
        $uri   = $this->getUri();
        $query = $this->getQuery($uri, $request);
    }

    /**
     * @param  RequestInterface  $request
     * @return PromiseInterface
     */
    public function sendAsync(RequestInterface $request)
    {
    }

    /**
     * Get the Uri to which the client is configured to send requests.
     *
     * @return Uri
     */
    private function getUri()
    {
        switch ($this->region) {
            // NA region
            case Region::CA: return new Uri('https://mws.amazonservices.ca');
            case Region::MX: return new Uri('https://mws.amazonservices.com.mx');
            case Region::US: return new Uri('https://mws.amazonservices.com');

            // EU region
            case Region::DE: return new Uri('https://mws-eu.amazonservices.com');
            case Region::ES: return new Uri('https://mws-eu.amazonservices.com');
            case Region::FR: return new Uri('https://mws-eu.amazonservices.com');
            case Region::IN: return new Uri('https://mws.amazonservices.in');
            case Region::IT: return new Uri('https://mws-eu.amazonservices.com');
            case Region::UK: return new Uri('https://mws-eu.amazonservices.com');

            // FE region
            case Region::JP: return new Uri('https://mws.amazonservices.jp');

            // CN region
            case Region::CN: return new Uri('https://mws.amazonservices.com.cn');
        }

        return new Uri('https://mws.amazonservices.com');
    }

    /**
     * Get the query for which the client is to request.
     *
     * @param  RequestInterface  $request
     * @param  UriInterface  $uri
     * @return ...
     */
    private function getQuery(RequestInterface $request)
    {
        // Validate passport.
        if (!$this->passport instanceof PassportInterface) {
            throw new PassportException('Passport is Required');
        }
    }
}

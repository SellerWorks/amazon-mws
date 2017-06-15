<?php

namespace SellerWorks\Amazon\Common;

use Exception;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\UriInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Psr\Http\Message\UriInterface;

use SellerWorks\Amazon\Credentials\Credentials;
use SellerWorks\Amazon\Credentials\CredentialsInterface;
use SellerWorks\Amazon\Common\Exception\ErrorException;

/**
 * Base client class for all MWS endponints.
 */
abstract class AbstractClient implements ClientInterface
{
    /** @var CredentialsInterface */
    protected $credentials;

    /** @var string */
    protected $country;

    /** @var GuzzleHttp\Client */
    protected $guzzle;

    /** @var UriInterface */
    protected $uri;

    /** @var string */
    protected $defaultMarketplaceId;

    /**
     * Configure the client defaults.
     *
     * @param  CredentialsInterface $credentials
     * @param  string               $country
     */
    public function __construct(CredentialsInterface $credentials = null, string $country = Country::US)
    {
        $this->guzzle = new GuzzleClient;

        $this->setCredentials($credentials);
        $this->setCountry($country);
    }

    /**
     * @param  CredentialsInterface $credentials
     * @return self
     */
    public function setCredentials(?CredentialsInterface $credentials): self
    {
        $this->credentials = $credentials;

        return $this;
    }

    /**
     * @param  string $country
     * @return self
     */
    public function setCountry(?string $country): self
    {
        $country = strtolower($country);
        Country::assertExists($country);

        $this->defaultMarketplaceId = Country::getMarketplaceId($country);

        return $this;
    }

    /**
     * Get the endpoint path.
     *
     * @return string
     */
    abstract public function getPath(): string;

    /**
     * Get the endpoint version.
     *
     * @return string
     */
    abstract public function getVersion(): string;

    /**
     * @param  RequestInterface  $request
     * @param  int  $throttle
     * @return PromiseInterface
     */
    protected function send(RequestInterface $request, $throttle = 30)
    {
        $uri = $this->getUri();






        $headers = ['Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8', 'Expect' => ''];
        $query   = $this->buildQuery($request);

        $gzRequest = new GuzzleRequest('POST', $this->uri, $headers, $query);
        $promise   = $this->guzzle->sendAsync($gzRequest)->then(
            // onFulfilled
            function (PsrResponseInterface $response) {
                $contents = $response->getBody()->getContents();
                $contents = $this->serializer->unserialize($contents);

                if ($contents instanceof ResponseInterface) {
                    $result = $contents->getResult();

                    if ($result instanceof IterableResultInterface) {
                        $result->setClient($this);
                    }

                    return $result;
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

        return $promise;
    }

    /**
     * @return UriInterface
     */
    private function getUri(): UriInterface
    {
        return new Uri(sprintf('https://%s/%s', Country::getHost($this->country), trim($this->getPath(), '/')));
    }

    /**
     * Build and return the query string.
     *
     * @param  RequestInterface  $request
     * @return string
     *
     * @throws UnexpectedValueException
     */
    private function buildQuery(RequestInterface $request)
    {
        if ($this->credentials instanceof CredentialsInterface) {
            $credentials = $this->credentials;
        } else {
            throw new UnexpectedValueException('Credentials are required to use this service.');
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
}

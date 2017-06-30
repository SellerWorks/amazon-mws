<?php

namespace SellerWorks\Amazon\Common;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;
use Psr\Http\Message\UriInterface;
use UnexpectedValueException;

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

    /** @var GuzzleHttp\Client */
    protected $guzzle;

    /** @var string */
    protected $marketplace;

    /** @var SerializerInterface */
    protected $serializer;

    /**
     * Configure the client defaults.
     *
     * @param  CredentialsInterface $credentials
     * @param  string               $marketplace
     */
    public function __construct(CredentialsInterface $credentials = null, string $marketplace = Marketplace::US)
    {
        $this->guzzle     = new GuzzleClient;
        $this->serializer = $this->getSerializer();

        $this->withCredentials($credentials);
        $this->withMarketplace($marketplace);
    }

    /**
     * @param  CredentialsInterface $credentials
     * @return self
     */
    public function withCredentials(?CredentialsInterface $credentials): self
    {
        $this->credentials = $credentials;

        return $this;
    }

    /**
     * @param  string $marketplace
     * @return self
     */
    public function withMarketplace(?string $marketplace): self
    {
        $this->marketplace = $marketplace;

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
     * Get the serializer.
     *
     * @return SerializerInterface
     */
    abstract protected function getSerializer(): SerializerInterface;

    /**
     * @param  RequestInterface $request
     * @param  int              $throttle
     * @return PromiseInterface
     */
    protected function send(RequestInterface $request, $throttle = 30)
    {
        $headers = ['Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8', 'Expect' => ''];
        $query   = $this->buildQuery($request);

        $gzRequest = new GuzzleRequest('POST', $this->getUri(), $headers, $query);
        $promise   = $this->guzzle->sendAsync($gzRequest)->then(
            // onFulfilled
            function (PsrResponseInterface $response) {
                $contents     = $response->getBody()->getContents();
                $unserialized = $this->serializer->unserialize($contents);

                if ($unserialized instanceof ResponseInterface) {
                    $result = $unserialized->getResult();

                    if ($result instanceof IterableResultInterface) {
                        $result->setClient($this);
                    }

                    return $result;
                }
                else {
                    return $unserialized;
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
     * Get the MWS URI.
     *
     * @return UriInterface
     *
     * @throws UnexpectedValueException
     */
    private function getUri(): UriInterface
    {
        // Check for a valid marketplace.
        if (empty($this->marketplace) || !in_array($this->marketplace, Marketplace::values())) {
            throw new UnexpectedValueException('Marketplace must be one of: ' . implode(', ', Marketplace::values()));
        }

        $host = Marketplace::getHost($this->marketplace);
        $path = $this->getPath();
        $uri  = new Uri(sprintf('https://%s/%s', $host, $path));

        return $uri;
    }

    /**
     * Build and return the query string.
     *
     * @param  RequestInterface  $request
     * @return string
     *
     * @throws UnexpectedValueException
     */
    private function buildQuery(RequestInterface $request): string
    {
        // Check for valid credentials.
        if (!$this->credentials instanceof CredentialsInterface) {
            throw new UnexpectedValueException('Credentials are required to use this service.');
        }

        $credentials = $this->credentials;
        $parameters  = $this->serializer->serialize($request);

        // Credentials.
        $parameters['SellerId']       = $credentials->getSellerId();
        $parameters['AWSAccessKeyId'] = $credentials->getAccessKey();
        $parameters['MWSAuthToken']   = $credentials->getMwsAuthToken();

        // Standard parameters.
        $parameters['SignatureMethod']  = 'HmacSHA256';
        $parameters['SignatureVersion'] = 2;
        $parameters['Timestamp']        = $this->gmdate();
        $parameters['Version']          = $this->getVersion();

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
     * @param  string $query
     * @param  string $secretKey
     * @return string
     */
    private function calculateSignature(string $query, string $secretKey): string
    {
        $host = Marketplace::getHost($this->marketplace);
        $path = $this->getPath();
        $head = sprintf("POST\n%s\n/%s\n%s", $host, $path, $query);
        $sig  = hash_hmac('sha256', $head, $secretKey, true);

        return $this->urlencode_rfc3986(base64_encode($sig));
    }

    /**
     * Return RFC 3986 compliant string.
     *
     * @param  string $value
     * @return string
     */
    private function urlencode_rfc3986(string $value): string
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
    private function gmdate(): string
    {
        return gmdate(SerializerInterface::DATE_FORMAT);
    }
}

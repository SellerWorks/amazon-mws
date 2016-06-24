<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common;

use Error;
use InvalidArgumentException;
use RuntimeException;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

/**
 * Abstract Amazon MWS API Client
 */
abstract class AbstractClient implements ClientInterface
{
    use PassportAwareTrait;

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
     * @var string
     */
    protected $host;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * Constructor.
     *
     * @param  Passport  $passport
     * @return void
     */
    public function __construct(Passport $passport = null)
    {
        // Configure MWS.
        $this->setCountry(static::COUNTRY_US);
        $this->setPassport($passport);

        $this->guzzle = new Client;
    }

    /**
     * Set country to use.
     *
     * @param  string  $countryCode
     * @return self
     */
    public function setCountry(string $countryCode): self
    {
        $countryInfo = [
            // NA Region
            static::COUNTRY_CA => ['host' => 'mws.amazonservices.ca',     'marketplaceId' => 'A2EUQ1WTGCTBG2'],
            static::COUNTRY_MX => ['host' => 'mws.amazonservices.com.mx', 'marketplaceId' => 'ATVPDKIKX0DER'],
            static::COUNTRY_US => ['host' => 'mws.amazonservices.com',    'marketplaceId' => 'A1AM78C64UM0Y8'],

            // EU Region
            static::COUNTRY_DE => ['host' => 'mws-eu.amazonservices.com', 'marketplaceId' => 'A1PA6795UKMFR9'],
            static::COUNTRY_ES => ['host' => 'mws-eu.amazonservices.com', 'marketplaceId' => 'A1RKKUPIHCS9HS'],
            static::COUNTRY_FR => ['host' => 'mws-eu.amazonservices.com', 'marketplaceId' => 'A13V1IB3VIYZZH'],
            static::COUNTRY_IN => ['host' => 'mws.amazonservices.in',     'marketplaceId' => 'A21TJRUUN4KGV'],
            static::COUNTRY_IT => ['host' => 'mws-eu.amazonservices.com', 'marketplaceId' => 'APJ6JRA9NG5V4'],
            static::COUNTRY_UK => ['host' => 'mws-eu.amazonservices.com', 'marketplaceId' => 'A1F83G8C2ARO7P'],

            // FE Region
            static::COUNTRY_JP => ['host' => 'mws.amazonservices.jp',     'marketplaceId' => 'A1VC38T7YXB528'],

            // CN Region
            static::COUNTRY_CN => ['host' => 'mws.amazonservices.com.cn', 'marketplaceId' => 'AAHKV2X7AFYLW'],
        ];

        if (array_key_exists($countryCode, $countryInfo)) {
            $this->host = $countryInfo[$countryCode]['host'];
        }
        else {
            throw new InvalidArgumentException('Invalid country code:  ' . $countryCode);
        }

        return $this;
    }

    /**
     * @param  SerializerInterface $serializer
     * @return self
     */
    public function setSerializer(SerializerInterface $serializer): self
    {
        $this->serializer = $serializer;
        return $this;
    }

    /**
     * Send request to Amazon.
     *
     * @param  RequestInterface  $request
     * @return PromiseInterface
     */
    protected function send(RequestInterface $request): PromiseInterface
    {
        // Build request parts.
        $url     = $this->buildUrl();
        $query   = $this->buildQuery($request);
//         $body    = $this->buildBody();
        $headers = $this->buildRequestHeaders();


        // Send request.
        $postRequest = new Request('POST', $url, $headers, $query);


        // Create promise.
        $promise = $this->guzzle->sendAsync($postRequest)->then(
            // onFulfilled
            function (ResponseInterface $response) {
                $raw = $response->getBody()->getContents();
                $obj = $this->serializer->unserialize($raw);

                if ($obj instanceof ErrorResponse) {
                    return $this->throwError($response);
                }

                return $obj;
            }
        );

        return $promise;
    }

    /**
     * @return string
     */
    private function buildUrl(): string
    {
        return sprintf('https://%s/%s', $this->host, trim(static::MWS_PATH, '/'));
    }

    /**
     * @return array
     */
    private function buildRequestHeaders(): array
    {
        $headers = [
            'Content-Type'  => 'application/x-www-form-urlencoded; charset=utf-8',
            'Expect'        => '',
        ];

        return $headers;
    }

    /**
     * Return query string of request.
     *
     * @param  RequestInterface $request
     * @return string
     */
    protected function buildQuery(RequestInterface $request): string
    {
        $passport = $request->getPassport()?: $this->passport;

        if (!($passport instanceof Passport)) {
            throw new RuntimeException('A valid Passport must be provided.');
        }

        if (!($this->serializer instanceof SerializerInterface)) {
            throw new RuntimeException('Serializer must be configured.');
        }

        $parameters = $this->serializer->serialize($request);

        // Add authentication params.
        $parameters['SellerId']       = $passport->getSellerId();
        $parameters['AWSAccessKeyId'] = $passport->getAccessKey();

        if (!empty($passport->getMwsAuthToken())) {
            $parameters['MWSAuthToken'] = $passport->getMwsAuthToken();
        }

        // Add standard parameters.
        $parameters['SignatureMethod']  = 'HmacSHA256';
        $parameters['SignatureVersion'] = 2;
        $parameters['Timestamp']        = $this->gmdate();
        $parameters['Version']          = static::MWS_VERSION;

        // Build query.
        unset($parameters['Signature']);
        uksort($parameters, 'strcmp');
		$query = array();

		foreach ($parameters as $k => $v)
		{
			$query[] = sprintf('%s=%s', $k, $this->urlencode_rfc3986((string) $v));
		}

        $query  = implode('&', $query);
        $query .= '&Signature=' . $this->calculateSignature($query, $passport->getSecretKey());

        return $query;
    }

    /**
     * Calculate signature of request.
     *
     * @param  string $query
     * @param  string $secretKey
     * @return string
     */
    protected function calculateSignature(string $query, string $secretKey): string
    {
        // Calculate signature.
        $path = trim(static::MWS_PATH, '/');
        $head = sprintf("POST\n%s\n/%s\n%s", $this->host, $path, $query);
        $sig  = hash_hmac('sha256', $head, $secretKey, true);

        return $this->urlencode_rfc3986(base64_encode($sig));
    }

    /**
     * Return RFC 3986 compliant string.
     *
     * @param  string  $s
     * @return string
     */
    protected function urlencode_rfc3986(string $s): string
    {
        return str_replace(['+', '%7E'], [' ', '~'], rawurlencode($s));
    }

    /**
     * Return UTC timestamp.
     *
     * @return string
     *
     * @codeCoverageIgnore
     */
    protected function gmdate()
    {
        return gmdate(SerializerInterface::DATE_FORMAT);
    }

    /**
     * Throw Endpoint-specific error.
     *
     * @param  ErrorResponse
     * @throws Error
     */
    protected function throwError(Responses\ErrorResponse $error)
    {
        throw new Error($error->Error->Message);
    }
}
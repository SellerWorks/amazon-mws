<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common;

use RuntimeException;
use UnexpectedValueException;

/**
 * Abstract Amazon MWS API Client
 *
 * @author Steve Nebes <snebes@gmail.com>
 */
abstract class AbstractClient implements ClientInterface
{
	/**
     * @var SellerWorks\Amazon\MWS\Common\Passport
     */
    protected $passport;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var string
     */
    protected $marketplaceId;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * Constructor.
     *
     * @param  SellerWorks\Amazon\MWS\Common\Passport  $passport
     * @return void
     */
    public function __construct(Passport $passport)
    {
        // Configure MWS.
        $this->setPassport($passport);
        $this->setCountry(static::COUNTRY_US);
    }

    /**
     * Set Passport object to use.
     *
     * @param  SellerWorks\Amazon\MWS\Common\Passport  $passport
     * @return self
     */
    public function setPassport(Passport $passport): self
    {
        $this->passport = $passport;
        return $this;
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
            static::COUNTRY_CA => ['host' => 'https://mws.amazonservices.ca',     'marketplaceId' => 'A2EUQ1WTGCTBG2'],
            static::COUNTRY_MX => ['host' => 'https://mws.amazonservices.com.mx', 'marketplaceId' => 'ATVPDKIKX0DER'],
            static::COUNTRY_US => ['host' => 'https://mws.amazonservices.com',    'marketplaceId' => 'A1AM78C64UM0Y8'],

            // EU Region
            static::COUNTRY_DE => ['host' => 'https://mws-eu.amazonservices.com', 'marketplaceId' => 'A1PA6795UKMFR9'],
            static::COUNTRY_ES => ['host' => 'https://mws-eu.amazonservices.com', 'marketplaceId' => 'A1RKKUPIHCS9HS'],
            static::COUNTRY_FR => ['host' => 'https://mws-eu.amazonservices.com', 'marketplaceId' => 'A13V1IB3VIYZZH'],
            static::COUNTRY_IN => ['host' => 'https://mws.amazonservices.in',     'marketplaceId' => 'A21TJRUUN4KGV'],
            static::COUNTRY_IT => ['host' => 'https://mws-eu.amazonservices.com', 'marketplaceId' => 'APJ6JRA9NG5V4'],
            static::COUNTRY_UK => ['host' => 'https://mws-eu.amazonservices.com', 'marketplaceId' => 'A1F83G8C2ARO7P'],

            // FE Region
            static::COUNTRY_JP => ['host' => 'https://mws.amazonservices.jp',     'marketplaceId' => 'A1VC38T7YXB528'],

            // CN Region
            static::COUNTRY_CN => ['host' => 'https://mws.amazonservices.com.cn', 'marketplaceId' => 'AAHKV2X7AFYLW'],
        ];

        if (array_key_exists($countryCode, $countryInfo)) {
            $this->host = $countryInfo[$countryCode]['host'];
            $this->marketplaceId = $countryInfo[$countryCode]['marketplaceId'];
        }
        else {
            throw new UnexpectedValueException($countryCode);
        }

        return $this;
    }

    /**
     * Set the Sabre\XML\Service object.
     *
     * @param  SellerWorks\Amazon\MWS\Common\SerializerInterface $serializer
     * @return self
     */
    public function setSerializer(SerializerInterface $serializer): self
    {
        $this->serializer = $serializer;
        return $this;
    }

    /**
     * Make request to Amazon.
     *
     * @param  SellerWorks\Amazon\MWS\Common\Requests\RequestInterface  $request
     * @param  SellerWorks\Amazon\MWS\Common\Passport  $passport
     * @return ...
     */
    protected function makeRequest(Requests\RequestInterface $request, Passport $passport = null)
    {
        $usePassport = $passport?: $this->passport;

        if (!($usePassport instanceof Passport)) {
            throw new RuntimeException('A valid Passport must be provided.');
        }

        $response = $this->post($request, $usePassport);




        print_r($this->serializer->unserialize($response));
        die;
    }

    /**
     * Post request to Amazon.
     *
     * @param  SellerWorks\Amazon\MWS\Common\Requests\RequestInterface  $request
     * @param  SellerWorks\Amazon\MWS\Common\Passport  $passport
     * @return string
     */
    protected function post(Requests\RequestInterface $request, Passport $passport): string
    {
        $url = sprintf('%s/%s', $this->host, trim(static::MWS_PATH, '/'));
        $qs  = $this->buildQuery($request, $passport);

        $headers = [
            'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
            'Expect: ',
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL             => $url,
            CURLOPT_PORT            => 443,
            CURLOPT_SSL_VERIFYPEER  => true,
            CURLOPT_SSL_VERIFYHOST  => 2,
            CURLOPT_USERAGENT       => static::USER_AGENT,
            CURLOPT_POST            => true,
            CURLOPT_POSTFIELDS      => $qs,
            CURLOPT_HTTPHEADER      => $headers,
            CURLOPT_RETURNTRANSFER  => true,
        ]);

        $response = curl_exec($ch);

        return $response;
    }

    /**
     * Return dot-notation query of request.
     *
     * @param  SellerWorks\Amazon\MWS\Common\Requests\RequestInterface  $request
     * @param  SellerWorks\Amazon\MWS\Common\Passport  $passport
     * @return array
     */
    protected function buildQuery(Requests\RequestInterface $request, Passport $passport): string
    {
        if (!($this->serializer instanceof SerializerInterface)) {
            throw new RuntimeException('Serializer must be configured.');
        }

        $parameters = $this->serializer->serialize($request);

        // Add authentication params.
        $parameters['SellerId']       = $this->passport->getSellerId();
        $parameters['AWSAccessKeyId'] = $this->passport->getAccessKey();

        if (!empty($this->passport->getMwsAuthToken())) {
            $auth['MWSAuthToken'] = $this->passport->getMwsAuthToken();
        }

        // Add standard parameters.
        $parameters['SignatureMethod']  = 'HmacSHA256';
        $parameters['SignatureVersion'] = 2;
        $parameters['Timestamp']        = gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z");
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
        $query .= '&Signature=' . $this->calculateSignature($query);

        return $query;
    }

    /**
     * Calculate signature of request.
     *
     * @param  string  $query
     * @return string
     */
    protected function calculateSignature(string $query): string
    {
        // Calculate signature.
        $path = trim(static::MWS_PATH, '/');
        $head = sprintf("POST\n%s\n/%s\n%s", $this->host, $path, $query);
        $sig  = hash_hmac('sha256', $head, $this->passport->getSecretKey(), true);

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
}
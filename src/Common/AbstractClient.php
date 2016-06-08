<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common;

use RuntimeException;

/**
 * Abstract Amazon MWS API Client
 *
 * @author      Steve Nebes
 * @copyright   Copyright (c) 2016 SellerWorks (https://seller.works)
 */
abstract class AbstractClient implements ClientInterface
{
    /**
     * Service definitions.
     */
	const MWS_PATH    = '';
	const MWS_VERSION = '';

    /**
     * 
	const USER_AGENT = 'SellerWorks Amazon MWS 2016.05';

    const REGION_US     = 'us';
    const REGION_UK     = 'uk';
    const REGION_CA     = 'ca';

	/**
     * @var SellerWorks\Amazon\MWS\Common\Passport
     */
    protected $passport;
    protected $host;
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
        $this->setRegion(static::REGION_US);

        // Internal configuration.
        $this->maxRetries   = 3;
        $this->restoreRate  = 60;
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
     * Set region information.
     *
     * @param  string  $region
     * @return self
     */
    public function setRegion(string $region): self
    {
        switch ($region) {
            case 'ca':
                $this->host = 'mws.amazonservices.com';
                break;

            case 'uk':
                $this->host = 'mws.amazonservices.co.uk';
                break;

            case 'us':
                $this->host = 'mws.amazonservices.com';
                break;

            default:
                throw new \UnexpectedValueException($region);
        }

        return $this;
    }

    /**
     * Set the Sabre\XML\Service object.
     *
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
     * @param  SellerWorks\Amazon\MWS\Common\RequestInterface  $request
     * @return SellerWorks\Amazon\MWS\Common\ResponseInterface
     */
    public function makeRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->post($request);
        echo $response;
        print_r($this->serializer->unserialize($response));
        die;
    }

    /**
     * Post request to Amazon.
     *
     * @param  RequestInterface  $request
     * @return string
     */
    protected function post(RequestInterface $request): string
    {
        $url = sprintf('https://%s/%s', $this->host, trim(static::MWS_PATH, '/'));
        $qs  = $this->buildQuery($request);
        
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
     * @param  SellerWorks\Amazon\MWS\Common\RequestInterface  $request
     * @return array
     */
    protected function buildQuery(RequestInterface $request): string
    {
        if (!($this->serializer instanceof SerializerInterface)) {
            throw new RuntimeException('Serializer must be configured.');
        }

        $parameters = $this->serializer->serialize($request);
        print_r($parameters);

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
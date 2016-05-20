<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common;

/**
 * Abstract Amazon MWS API Client
 *
 * @author      Steve Nebes
 * @copyright   Copyright (c) 2016 SellerWorks (https://seller.works)
 */
abstract class AbstractClient
{
	const MWS_VERSION   = '';
	const MWS_PATH      = '';
	const USER_AGENT    = 'SellerWorks/MWS';

    const REGION_US     = 'us';
    const REGION_UK     = 'uk';
    const REGION_CA     = 'ca';

	/**
     * @var SellerWorks\Amazon\MWS\Common\Passport
     */
    protected $passport;
    protected $host;
    protected $xmlService;

    /**
     * Constructor.
     *
     * @param  SellerWorks\Amazon\MWS\Common\Passport  $passport
     * @return void
     */
    public function __construct(Passport $passport)
    {
        $this->setPassport($passport);
        $this->setRegion(static::REGION_US);

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
     * Make request to Amazon.
     *
     * @param  SellerWorks\Amazon\MWS\Common\RequestInterface  $request
     * @return SellerWorks\Amazon\MWS\Common\ResponseInterface
     */
    public function makeRequest(RequestInterface $request): ResponseInterface
    {
        if (!($this->xmlService instanceof \Sabre\Xml\Service)) {
            $className = static::XML_SERVICE;
            $this->xmlService = new $className;
        }

        $parameters = $this->buildParameters($request);
        $response   = $this->post($parameters);
        
        print_r($this->xmlService->parse($response));
        die;
    }

    /**
     * Return dot-notation hash of request.
     *
     * @param  SellerWorks\Amazon\MWS\Common\RequestInterface  $request
     * @return array
     */
    protected function buildParameters(RequestInterface $request): array
    {
        $parameters = $request->getParameters();

        // Add authentication params.
        $parameters['SellerId']       = $this->passport->getSellerId();
        $parameters['AWSAccessKeyId'] = $this->passport->getAccessKey();

        if (!empty($this->passport->getMwsAuthToken())) {
            $auth['MWSAuthToken'] = $this->passport->getMwsAuthToken();
        }

        // Add signature parameter.
        $parameters['SignatureMethod']  = 'HmacSHA256';
        $parameters['SignatureVersion'] = 2;
        $parameters['Timestamp']        = gmdate("Y-m-d\TH:i:s.\\0\\0\\0\\Z");
        $parameters['Version']          = static::MWS_VERSION;
        $parameters['Signature']        = $this->buildSignature($parameters);

        return $parameters;
    }

    /**
     * Return signature of request.
     *
     * @param  array  $parameters
     * @return string
     */
    protected function buildSignature(array $parameters): string
    {
        // Build query string.
        unset($parameters['Signature']);
        uksort($parameters, 'strcmp');
        $queryString = '';

        foreach ($parameters as $k => $v)
        {
            $queryString .= sprintf('%s=%s', $k, $this->urlencode_rfc3986((string) $v));
        }

        // Calculate signature.
        $path = trim(static::MWS_PATH, '/');
        $head = sprintf("POST\n%s\n/%s\n%s", $this->host, $path, $queryString);
        $sig  = hash_hmac('sha256', $head, $this->passport->getSecretKey(), true);
        
        return $this->urlencode_rfc3986(base64_encode($sig));
    }

    /**
     * Post request to Amazon.
     *
     * @param  array  $parameters
     * @return string
     */
    protected function post(array $parameters): string
    {
        $url = sprintf('https://%s/%s', $this->host, trim(static::MWS_PATH, '/'));
        $qs  = http_build_query($parameters);
        
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
            CURLOPT_USERAGENT      => static::USER_AGENT,
            CURLOPT_POST            => true,
            CURLOPT_POSTFIELDS      => $qs,
            CURLOPT_HTTPHEADER      => $headers,
            CURLOPT_RETURNTRANSFER  => true,
        ]);

        $response = curl_exec($ch);

        return $response;
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
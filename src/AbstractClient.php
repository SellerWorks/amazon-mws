<?php

namespace SellerWorks\Amazon\MWS;

use Psr\Logger\LoggerInterface;

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

	/**
     * @var SellerWorks\Amazon\MWS\Passport
     */
    protected $passport;
    protected $region;
    protected $marketplaceId;
    protected $maxRetries;
    protected $restoreRate;

    /**
     * Constructor
     *
     * @param  SellerWorks\Amazon\MWS\Passport    $passport
     * @return void
     */
    public function __construct(Passport $passport)
    {
        $this->passport = $passport;

        $this->maxRetries   = 3;
        $this->restoreRate  = 60;
    }

    public function makeRequest(Requests\RequestInterface $request)
    {
        $parameters = $this->buildParameters($request);
        // return $this->post($parameters);
    }
    
    protected function buildParameters(Requests\RequestInterface $request): array
    {
        $parameters = [
            'SellerId'
            'AWSAccessKeyId'
            'Version'
            ''
        ];
    }
    
    protected buildSignature(array $in): array
    {
        
    }
    
    protected function post(array $parameters)
    {
        
    }
}
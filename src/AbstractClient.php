<?php

namespace SellerWorks\Amazon\MWS;

/**
 * Abstract Amazon MWS API Client
 *
 * @author      Steve Nebes
 * @copyright   Copyright (c) 2016 SellerWorks (https://seller.works)
 */
abstract class AbstractClient
{
	const MWS_VERSION;
	const MWS_PATH;
	const USER_AGENT = 'SellerWorks/MWS';

	/**
     * @var SellerWorks\Amazon\MWS\Config
     */
    protected $config;
    protected $region;
    protected $marketplaceId;
    protected $maxRetries;
    protected $restoreRate;

    /**
     * Constructor
     *
     * @param  SellerWorks\Amazon\MWS\Config    $config
     * @return void
     */
    public function __construct(Config $config)
    {
        $this->config = $config;

        $this->maxRetries   = 3;
        $this->restoreRate  = 60;
    }

    public function makeRequest(string $method, array $params, string $requestBody = null)
    {
        
    }
}
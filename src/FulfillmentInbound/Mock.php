<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

use SellerWorks\Amazon\MWS\Common\AbstractClient;
use SellerWorks\Amazon\MWS\Common\Passport;

/**
 * Mock client for unit testing.
 */
class Mock extends AbstractClient implements FulfillmentInboundInterface
{
    const MWS_VERSION   = '2010-10-01';
    const MWS_PATH      = '/FulfillmentInboundShipment/2010-10-01/';

    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        $this->setSerializer(new Serializer);
    }

	/**
	 * {@inheritDoc}
	 */
	public function listInboundShipments(
	    Requests\ListInboundShipmentsRequest $request
	):  Responses\ListInboundShipmentsResponse
	{
    	$xml = file_get_contents(__DIR__.'/Mock/ListInboundShipmentsResponse.xml');

		return $this->serializer->unserialize($xml);
	}

	/**
	 * {@inheritDoc}
	 */
	public function getServiceStatus(): Responses\GetServiceStatusResponse
	{
    	$xml = file_get_contents(__DIR__.'/Mock/GetServiceStatusResponse.xml');

		return $this->serializer->unserialize($xml);
	}
}
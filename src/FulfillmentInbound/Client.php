<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

use SellerWorks\Amazon\MWS\Common\AbstractClient;
use SellerWorks\Amazon\MWS\Common\Passport;

/**
 */
class Client extends AbstractClient implements FulfillmentInboundInterface
{
    const MWS_VERSION   = '2010-10-01';
    const MWS_PATH      = '/FulfillmentInboundShipment/2010-10-01/';

    /**
     * {@inheritDoc}
     */
    public function __construct(Passport $passport)
    {
        parent::__construct($passport);
        $this->setSerializer(new Serializer);
    }

	/**
	 * {@inheritDoc}
	 */
	public function listInboundShipments(
	    Requests\ListInboundShipmentsRequest $request
	):  Responses\ListInboundShipmentsResponse
	{
		return $this->makeRequest($request);
	}

	/**
	 * {@inheritDoc}
	 */
	public function getServiceStatus(): Responses\GetServiceStatusResponse
	{
		return $this->makeRequest(new Requests\GetServiceStatusRequest);
	}
}
<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Result;

use SellerWorks\Amazon\Common\IterableResultInterface;
use SellerWorks\Amazon\Common\IterableResultTrait;
use SellerWorks\Amazon\FulfillmentInbound\Request\ListInboundShipmentsByNextTokenRequest;

/**
 * ListInboundShipments result object.
 */
final class ListInboundShipmentsResult implements IterableResultInterface
{
    /**
     * @property  $client
     * @method  setClient
     * @method  getIterator
     */
    use IterableResultTrait;

    /**
     * @var string
     */
    public $NextToken;

    /**
     * @var Array<InboundShipmentInfo>
     */
    public $ShipmentData;

    /**
     * IterableResultInterface::getNextMethod
     */
    public function getNextMethod()
    {
        return 'ListInboundShipmentsByNextToken';
    }

    /**
     * IterableResultInterface::getNextRequest
     */
    public function getNextRequest()
    {
        if (empty($this->NextToken)) {
            return null;
        }

        $request = new ListInboundShipmentsByNextTokenRequest;
        $request->NextToken = $this->NextToken;

        return $request;
    }

    /**
     * IterableResultInterface::getRecords
     */
    public function getRecords()
    {
        return $this->ShipmentData?: [];
    }
}

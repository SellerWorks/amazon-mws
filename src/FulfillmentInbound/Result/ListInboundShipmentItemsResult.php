<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Result;

use SellerWorks\Amazon\Common\IterableResultInterface;
use SellerWorks\Amazon\Common\IterableResultTrait;
use SellerWorks\Amazon\Common\RecordIterator;
use SellerWorks\Amazon\FulfillmentInbound\Request\ListInboundShipmentItemsByNextTokenRequest;

/**
 * ListInboundShipmentItems result object.
 */
final class ListInboundShipmentItemsResult implements IterableResultInterface
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
     * @var Array<InboundShipmentItem>
     */
    public $ItemData;

    /**
     * IterableResultInterface::getNextMethod
     */
    public function getNextMethod()
    {
        return 'ListInboundShipmentItemsByNextToken';
    }

    /**
     * IterableResultInterface::getNextRequest
     */
    public function getNextRequest()
    {
        if (empty($this->NextToken)) {
            return null;
        }

        $request = new ListInboundShipmentItemsByNextTokenRequest;
        $request->NextToken = $this->NextToken;

        return $request;
    }

    /**
     * IterableResultInterface::getRecords
     */
    public function getRecords()
    {
        return $this->ItemData?: [];
    }
}

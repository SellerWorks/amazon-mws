<?php

namespace SellerWorks\Amazon\Orders\Result;

use SellerWorks\Amazon\Common\IterableResultInterface;
use SellerWorks\Amazon\Common\IterableResultTrait;
use SellerWorks\Amazon\Common\RecordIterator;
use SellerWorks\Amazon\Orders\Request\ListOrderItemsByNextTokenRequest;

/**
 * ListOrderItems result object.
 */
final class ListOrderItemsResult implements IterableResultInterface
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
     * @var string
     */
    public $AmazonOrderId;

    /**
     * @var Array<OrderItem>
     */
    public $OrderItems;

    /**
     * IterableResultInterface::getNextMethod
     */
    public function getNextMethod()
    {
        return 'ListOrderItemsByNextToken';
    }

    /**
     * IterableResultInterface::getNextRequest
     */
    public function getNextRequest()
    {
        if (empty($this->NextToken)) {
            return null;
        }

        $request = new ListOrderItemsByNextTokenRequest;
        $request->NextToken = $this->NextToken;

        return $request;
    }

    /**
     * IterableResultInterface::getRecords
     */
    public function getRecords()
    {
        return $this->OrderItems?: [];
    }
}

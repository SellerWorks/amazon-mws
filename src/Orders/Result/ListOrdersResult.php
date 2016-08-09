<?php

namespace SellerWorks\Amazon\Orders\Result;

use SellerWorks\Amazon\Common\IterableResultInterface;
use SellerWorks\Amazon\Common\IterableResultTrait;
use SellerWorks\Amazon\Common\RecordIterator;
use SellerWorks\Amazon\Orders\Request\ListOrdersByNextTokenRequest;

/**
 * ListOrders result object.
 */
final class ListOrdersResult implements IterableResultInterface
{
    use IterableResultTrait;

    /**
     * @var string
     */
    public $NextToken;

    /**
     * @var string
     */
    public $LastUpdatedBefore;

    /**
     * @var string
     */
    public $CreatedBefore;

    /**
     * @var Collection<Order>
     */
    public $Orders;

    /**
     * IterableResultInterface::getNextMethod
     */
    public function getNextMethod()
    {
        return 'ListOrdersByNextToken';
    }

    /**
     * IterableResultInterface::getNextRequest
     */
    public function getNextRequest()
    {
        if (empty($this->NextToken)) {
            return null;
        }

        $request = new ListOrdersByNextTokenRequest;
        $request->NextToken = $this->NextToken;

        return $request;
    }

    /**
     * IterableResultInterface::getRecords
     */
    public function getRecords()
    {
        return $this->Orders?: [];
    }
}

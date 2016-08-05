<?php

namespace SellerWorks\Amazon\Orders\Result;

use SellerWorks\Amazon\Common\IterableResultInterface;
use SellerWorks\Amazon\Orders\Request\ListOrdersByNextTokenRequest;

/**
 * ListOrders result object.
 */
final class ListOrdersResult implements IterableResultInterface
{
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
     * {@inheritDoc)
     */
    public function getRecords()
    {
        return $this->Orders;
    }

    /**
     * {@inheritDoc}
     */
    public function getRequestMethod()
    {
        return 'ListOrdersByNextToken';
    }

    /**
     * {@inheritDoc}
     */
    public function getNextTokenRequest($token)
    {
        $request = new ListOrdersByNextTokenRequest;
        $request->NextToken = $token;

        return $request;
    }
}

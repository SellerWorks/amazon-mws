<?php

namespace SellerWorks\Amazon\Orders\Result;

use SellerWorks\Amazon\Common\ResultInterface;

/**
 * ListOrders result object.
 */
final class ListOrdersResult implements ResultInterface
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
}

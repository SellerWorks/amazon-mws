<?php

namespace SellerWorks\Amazon\Orders\Result;

use SellerWorks\Amazon\Common\ResultInterface;

/**
 * GetOrder result object.
 */
final class GetOrderResult implements ResultInterface
{
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

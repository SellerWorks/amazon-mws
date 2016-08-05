<?php

namespace SellerWorks\Amazon\Orders\Result;

use SellerWorks\Amazon\Common\ResultInterface;

/**
 * ListOrderItems result object.
 */
final class ListOrderItemsResult implements ResultInterface
{
    /**
     * @var string
     */
    public $NextToken;

    /**
     * @var string
     */
    public $AmazonOrderId;

    /**
     * @var Collection<OrderItem>
     */
    public $OrderItems;
}

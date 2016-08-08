<?php

namespace SellerWorks\Amazon\Orders\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Returns orders based on the AmazonOrderId values that you specify.
 */
final class GetOrderRequest implements RequestInterface
{
    /**
     * @var string|array
     */
    public $AmazonOrderId;
}

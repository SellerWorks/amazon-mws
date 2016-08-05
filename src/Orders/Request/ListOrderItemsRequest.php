<?php

namespace SellerWorks\Amazon\Orders\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Returns order items based on the AmazonOrderId that you specify.
 */
class ListOrderItemsRequest implements RequestInterface
{
    /**
     * @var string
     */
    public $AmazonOrderId;
}
<?php

namespace SellerWorks\Amazon\Orders\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Returns the next page of order items using the NextToken parameter.
 */
class ListOrderItemsByNextTokenRequest implements RequestInterface
{
    /**
     * @var string
     */
    public $NextToken;
}

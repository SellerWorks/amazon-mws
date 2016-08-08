<?php

namespace SellerWorks\Amazon\Orders\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Returns the next page of orders using the NextToken parameter.
 */
final class ListOrdersByNextTokenRequest implements RequestInterface
{
    /**
     * @var string
     */
    public $NextToken;
}

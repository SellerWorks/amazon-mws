<?php

namespace SellerWorks\Amazon\Orders\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Returns order items based on the AmazonOrderId that you specify.
 */
final class ListOrderItemsRequest implements RequestInterface
{
    /**
     * @var string
     */
    public $AmazonOrderId;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'AmazonOrderId' => ['type' => 'scalar'],
        ];
    }
}

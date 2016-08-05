<?php

namespace SellerWorks\Amazon\Orders\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * Returns order items based on the AmazonOrderId that you specify.
 */
final class ListOrderItemsResponse implements ResponseInterface
{
    /**
     * @var ListOrderItemsResult
     */
    public $ListOrderItemsResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->ListOrderItemsResult;
    }
}

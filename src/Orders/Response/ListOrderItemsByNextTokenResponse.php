<?php

namespace SellerWorks\Amazon\Orders\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * Returns the next page of order items using the NextToken parameter.
 */
final class ListOrderItemsByNextTokenResponse implements ResponseInterface
{
    /**
     * @var ListOrderItemsResult
     */
    public $ListOrderItemsByNextTokenResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->ListOrderItemsByNextTokenResult;
    }
}

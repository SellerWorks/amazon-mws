<?php

namespace SellerWorks\Amazon\Orders\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * Returns the next page of orders using the NextToken parameter.
 */
final class ListOrdersByNextTokenResponse implements ResponseInterface
{
    /**
     * @var ListOrdersResult
     */
    public $ListOrdersByNextTokenResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->ListOrdersByNextTokenResult;
    }
}

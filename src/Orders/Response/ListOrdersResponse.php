<?php

namespace SellerWorks\Amazon\Orders\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * Returns orders created or updated during a time frame that you specify.
 */
final class ListOrdersResponse implements ResponseInterface
{
    /**
     * @var ListOrdersResult
     */
    public $ListOrdersResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->ListOrdersResult;
    }
}

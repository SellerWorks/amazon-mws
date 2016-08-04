<?php

namespace SellerWorks\Amazon\Orders\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * Returns the operational status of the Orders API section.
 */
class GetServiceStatusResponse implements ResponseInterface
{
    /**
     * @var GetServiceStatusResult
     */
    public $GetServiceStatusResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->GetServiceStatusResult;
    }
}

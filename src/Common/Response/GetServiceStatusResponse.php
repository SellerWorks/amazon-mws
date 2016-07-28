<?php

namespace SellerWorks\Amazon\Common\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * GetServiceStatus response object.
 */
final class GetServiceStatusResponse implements ResponseInterface
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
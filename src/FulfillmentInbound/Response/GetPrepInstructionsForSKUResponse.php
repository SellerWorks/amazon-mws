<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * GetPrepInstructionsForSKU response object.
 */
final class GetPrepInstructionsForSKUResponse implements ResponseInterface
{
    /**
     * @var GetPrepInstructionsForSKUResult
     */
    public $GetPrepInstructionsForSKUResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->GetPrepInstructionsForSKUResult;
    }
}
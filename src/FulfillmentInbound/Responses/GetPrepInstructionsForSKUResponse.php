<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use SellerWorks\Amazon\MWS\Common\ResultInterface;

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
    public function getResult(): ResultInterface
    {
        return $this->GetPrepInstructionsForSKUResult;
    }
}
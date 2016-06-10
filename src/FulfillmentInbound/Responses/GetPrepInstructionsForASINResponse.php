<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * GetPrepInstructionsForASIN response object.
 */
final class GetPrepInstructionsForASINResponse implements ResponseInterface
{
    /**
     * @var GetPrepInstructionsForASINResult
     */
    public $GetPrepInstructionsForASINResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult(): ResultInterface
    {
        return $this->GetPrepInstructionsForASINResult;
    }
}
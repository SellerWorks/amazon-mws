<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

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
    public function getResult()
    {
        return $this->GetPrepInstructionsForASINResult;
    }
}
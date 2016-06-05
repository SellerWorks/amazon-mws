<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;

/**
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
}
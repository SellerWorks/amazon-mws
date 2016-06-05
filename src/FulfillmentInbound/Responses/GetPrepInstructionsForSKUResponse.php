<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;

/**
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
}
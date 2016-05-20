<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;

/**
 */
final class ErrorResponse implements ResponseInterface
{
    /**
     */
    public $Error;

    /**
     */
    public $RequestID;
}
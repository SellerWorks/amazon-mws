<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;

/**
 * Error handler.
 */
final class ErrorResponse implements ResponseInterface
{
    /**
     * @var Error
     */
    public $Error;

    /**
     * @var string
     */
    public $RequestId;
}
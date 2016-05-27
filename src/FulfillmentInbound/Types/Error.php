<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
 * Error message.
 */
final class Error
{
    /**
     * @var string
     */
    public $Type;

    /**
     * @var string
     */
    public $Code;

    /**
     * @var string
     */
    public $Message;
}
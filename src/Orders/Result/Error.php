<?php

namespace SellerWorks\Amazon\Orders\Result;

use SellerWorks\Amazon\Common\ResultInterface;

/**
 * Error message.
 */
final class Error implements ResultInterface
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

<?php

namespace SellerWorks\Amazon\Orders\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * Returns error response.
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
    public $RequestID;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->Error;
    }
}

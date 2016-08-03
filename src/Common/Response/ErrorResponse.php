<?php

namespace SellerWorks\Amazon\Common\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * Error response object.
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
<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use SellerWorks\Amazon\MWS\Common\ResultInterface;
use SellerWorks\Amazon\MWS\Common\Results\NullResult;

/**
 * Null Response object (for PHP < 7.1)
 */
class NullResponse implements ResponseInterface
{
    /**
     * @var NullResult
     */
    public $Result;

    /**
     * {@inheritDoc}
     *
     * @codeCoverageIgnore
     */
    function getResult(): ResultInterface
    {
        return $this->Result;
    }
}
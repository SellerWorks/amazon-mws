<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common;

/**
 * Interface for all Response objects.
 */
interface ResponseInterface
{
    /**
     * Return "Result" object.
     *
     * @return ResultInterface
     */
    function getResult(): ResultInterface;
}
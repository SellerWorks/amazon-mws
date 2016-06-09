<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common;

/**
 * Interface for all Response objects.
 */
interface ResponseInterface
{
    /**
     * Return the "Result" object.
     *
     * @return ResultInterface
     */
    public function getResult(): ResultInterface;
}
<?php

namespace SellerWorks\Amazon\Common;

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
    function getResult();
}
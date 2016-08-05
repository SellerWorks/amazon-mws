<?php

namespace SellerWorks\Amazon\Common;

/**
 * Interface for all Iterable objects.
 */
interface IterableResultInterface extends ResultInterface
{
    /**
     * Return array of result objects.
     *
     * @return array
     */
    function getRecords();

    /**
     * Get method name of *ByNextToken method.
     */
    function getRequestMethod();

    /**
     * Get Request object for NextToken request.
     *
     * @param  string
     * @return RequestInterface
     */
    function getNextTokenRequest($token);
}

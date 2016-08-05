<?php

namespace SellerWorks\Amazon\Common;

/**
 * Interface for all Iterable objects.
 */
interface IterableInterface
{
    /**
     * Return array of result objects.
     *
     * @return array
     */
    function getRecords(): array;

    /**
     * Return name of "ByNextToken" method.
     *
     * @return string
     */
    function getMethod(): string;

    /**
     * Return next token string.
     *
     * @return string
     */
    function getNextToken(): string;
}

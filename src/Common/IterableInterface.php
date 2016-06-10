<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common;

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
    function getResults(): array;

    /**
     * Return next token string.
     *
     * @return string
     */
    function getNextToken(): string;
}
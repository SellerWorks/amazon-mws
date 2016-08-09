<?php

namespace SellerWorks\Amazon\Common;

use IteratorAggregate;

/**
 * Interface for all Iterable objects.
 */
interface IterableResultInterface extends ResultInterface, IteratorAggregate
{
    /**
     * Store a reference to the client within the Result.
     *
     * @param  ClientInterface  $client
     * @return self
     */
    function setClient(ClientInterface $client);

    /**
     * Get array of records.
     *
     * @return array
     */
    function getRecords();
}

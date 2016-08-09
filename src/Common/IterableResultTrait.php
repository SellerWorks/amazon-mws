<?php

namespace SellerWorks\Amazon\Common;

/**
 * Trait for all Iterable result objects.
 */
trait IterableResultTrait
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * Store a reference to the client within the Result.
     *
     * @param  ClientInterface  $client
     * @return self
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * IteratorAggregate::getIterator
     */
    public function getIterator()
    {
        return new RecordIterator($this->client, $this);
    }
}

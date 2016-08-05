<?php

namespace SellerWorks\Amazon\Common;

use Countable;
use Iterator;

/**
 * Record iterator.
 */
class RecordIterator implements ResultInterface, Countable, Iterator
{
    /**
     * @var array
     */
    protected $records = [];

    /**
     * @var int
     */
    protected $pointer = 0;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var ResultInterface
     */
    protected $result;

    /**
     * Constructor.
     *
     * @param  ClientInterface  $client
     * @param  IterableResultInterface  $result
     */
    public function __construct(
        ClientInterface $client,
        IterableResultInterface $result
    )
    {
        $this->client  = $client;
        $this->result  = $result;
        $this->records = $result->getRecords();
    }

    /**
     * Countable::count
     *
     * {@inheritDoc}
     */
    public function count()
    {
        return count($this->records);
    }

    /**
     * Iterator::current
     */
    public function current()
    {
        return $this->records[$this->pointer];
    }

    /**
     * Iterator::key
     */
    public function key()
    {
        return $this->pointer;
    }

    /**
     * Iterator::next
     */
    public function next()
    {
        $this->pointer++;
    }

    /**
     * Iterator::rewind
     */
    public function rewind()
    {
        $this->pointer = 0;
    }

    /**
     * Iterator::valid
     */
    public function valid()
    {
        // Attempt to load more records, if available.
        if ($this->pointer >= count($this->records)) {
            $this->loadNextToken();
        }

        return isset($this->records[$this->pointer]);
    }

    /**
     * Attempt to load more records "ByNextToken".
     *
     * @return bool
     */
    protected function loadNextToken()
    {
        if (empty($this->result->NextToken)) {
            return false;
        }

        $method        = $this->result->getRequestMethod();
        $request       = $this->result->getNextTokenRequest($this->result->NextToken);
        $this->result  = $this->client->$method($request);
        $this->records = array_merge($this->records, $this->result->getRecords());

        return true;
    }
}

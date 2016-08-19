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
     * @var string
     */
    protected $nextMethod;

    /**
     * @var RequestInterface
     */
    protected $nextRequest;

    /**
     * Constructor.
     *
     * @param  ClientInterface  $client
     * @param  IterableResultInterface  $result
     * @param  string  $nextTokenMethod
     */
    public function __construct(
        ClientInterface $client,
        IterableResultInterface $result
    )
    {
        $this->client      = $client;
        $this->nextMethod  = $result->getNextMethod();
        $this->nextRequest = $result->getNextRequest();
        $this->records     = $result->getRecords();
    }

    /**
     * Countable::count
     *
     * @return int
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
        if (empty($this->nextRequest)) {
            return;
        }

        $method = $this->nextMethod;
        $result = $this->client->$method($this->nextRequest);

        $this->nextRequest = $result->getNextRequest();
        $this->records     = array_merge($this->records, $result->getRecords());
    }
}

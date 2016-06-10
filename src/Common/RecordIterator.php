<?php

namespace SellerWorks\Amazon\MWS\Common;

use Countable;
use Iterator;
use SellerWorks\Amazon\MWS\Common\ClientInterface;
use SellerWorks\Amazon\MWS\Common\Passport;
use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * Record iterator.
 */
class RecordIterator implements Countable, Iterator
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Passport
     */
    protected $passport;

    /**
     * @var array
     */
    protected $records = [];

    /**
     * @var ResultInterface
     */
    protected $result;

    /**
     * @var int
     */
    protected $pointer = 0;

    /**
     * Constructor.
     *
     * @param  ClientInterface $client
     * @param  Passport $passport
     * @param  IterableInterface $result
     * @param  string $operation
     */
    public function __construct(ClientInterface $client, Passport $passport, IterableInterface $result)
    {
        $this->client   = $client;
        $this->passport = $passport;
        $this->result   = $result;
        $this->records  = $result->getRecords();
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
     *
     * {@inheritDoc}
     */
    public function current()
    {
        return $this->records[$this->pointer];
    }

    /**
     * Iterator::key
     *
     * {@inheritDoc}
     */
    public function key()
    {
        return $this->pointer;
    }

    /**
     * Iterator::next
     *
     * {@inheritDoc}
     */
    public function next()
    {
        $this->pointer++;
    }

    /**
     * Iterator::rewind
     *
     * {@inheritDoc}
     */
    public function rewind()
    {
        $this->pointer = 0;
    }

    /**
     * Iterator::valid
     *
     * {@inheritDoc}
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
        if (empty($this->result->getNextToken())) {
            return false;
        }

        $method = $this->result->getMethod();
        $result = $this->client->$method($this->result->getNextToken(), $this->passport);

        $this->result  = $result;
        $this->records = array_merge($this->records, $result->getRecords());

        return true;
    }
}
<?php

namespace SellerWorks\Amazon\MWS\Results;

use Countable;
use Iterator;
use SellerWorks\Amazon\MWS\Common\ClientInterface;
use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * Record iterator.
 */
abstract class RecordIterator implements Countable, Iterator
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var ResultInterface
     */
    protected $result;

    /**
     * var string
     */
    protected $operation;

    /**
     * @var int
     */
    protected $pointer = 0;

    /**
     * @var ...
     */
    protected $current;

    /**
     * Constructor.
     *
     * @param  ClientInterface $client
     * @param  IterableInterface $result
     */
    public function __construct(ClientInterface $client, IterableInterface $result)
    {
        $this->client = $client;
        $this->result = $result;
    }

    /**
     * Save the result set
     *
     * @param  Client $client
     * @param  ResultInterface $result
     */
    abstract protected function setResult(ResultInterface $result);

    /**
     * SeekableIterator
     *
     * {@inheritDoc}
     */
    public function seek(int $position)
    {
        
    }

    /**
     * SeekableIterator
     *
     * {@inheritDoc}
     */
    public function current()
    {
//        return $this->pointer;
    }

    /**
     * SeekableIterator
     *
     * {@inheritDoc}
     */
    public function key()
    {
        return $this->pointer;
    }

    /**
     * SeekableIterator
     *
     * {@inheritDoc}
     */
    public function next()
    {
        $this->pointer++;
    }

    /**
     * SeekableIterator
     *
     * {@inheritDoc}
     */
    public function rewind()
    {
        $this->pointer = 0;
    }

    /**
     * SeekableIterator
     *
     * {@inheritDoc}
     */
    public function valid()
    {
        
    }
}
<?php

namespace SellerWorks\Amazon\MWS\Results;

use Countable;
use SeekableIterator;

/**
 * Result iterator.
 */
class ResultIterator implements SeekableIterator, Countable
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
     * @var int
     */
    protected $pointer = 0;

    /**

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
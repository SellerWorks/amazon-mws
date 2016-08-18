<?php

namespace SellerWorks\Amazon\Tests\Common;

use SplFixedArray;

use SellerWorks\Amazon\Common\IterableResultInterface;
use SellerWorks\Amazon\Common\IterableResultTrait;

/**
 * Stub class to test IterableResultTrait
 */
class IterableResultStub implements IterableResultInterface
{
    use IterableResultTrait;

    /**
     * @var array
     */
    protected $arr;

    /**
     * Constructor.
     *
     * @param  int  $size
     */
    public function __construct($size = 0)
    {
        $this->arr = new SplFixedArray($size);
    }

    /**
     * IterableResultInterface::getNextMethod
     */
    public function getNextMethod()
    {
        return 'none';
    }

    /**
     * IterableResultInterface::getNextRequest
     */
    public function getNextRequest()
    {
        return null;
    }

    /**
     * IterableResultInterface::getRecords
     */
    public function getRecords()
    {
        return $this->arr->toArray();
    }
}

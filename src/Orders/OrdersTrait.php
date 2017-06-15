<?php

namespace SellerWorks\Amazon\Orders;

use SellerWorks\Amazon\Common\RecordIterator;

/**
 * Implements the plumbing methods of OrdersInterface.
 */
trait OrdersTrait
{
    /**
     * @return GetServiceStatusResult
     */
    public function GetServiceStatus()
    {
        return $this->GetServiceStatusAsync()->wait();
    }

    /**
     * @return PromiseInterface
     */
    public function GetServiceStatusAsync()
    {
        return $this->send(new Request\GetServiceStatusRequest);
    }
}

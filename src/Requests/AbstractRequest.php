<?php

namespace SellerWorks\AmazonMWS\Requests;

abstract class AbstractRequest implements RequestInterface
{
    public function getParameters()
    {
        return [];
    }
}
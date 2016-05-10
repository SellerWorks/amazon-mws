<?php

namespace SellerWorks\Amazon\MWS\Common;

abstract class AbstractRequest implements RequestInterface
{
    public function getParameters()
    {
        return [];
    }
}
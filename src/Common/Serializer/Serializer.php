<?php

namespace SellerWorks\Amazon\Common\Serializer;

use SellerWorks\Amazon\Common\RequestInterface;
use SellerWorks\Amazon\Common\SerializerInterface;

/**
 * Empty Request Serializer / Response Deserializer.
 */
class Serializer implements SerializerInterface
{
    /**
     * {@inheritDoc}
     */
    public function serialize(RequestInterface $request)
    {
        return $request;
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize($response)
    {
        return $response;
    }
}

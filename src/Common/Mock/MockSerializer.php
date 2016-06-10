<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common\Mock;

use SellerWorks\Amazon\MWS\Common\RequestInterface;
use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use SellerWorks\Amazon\MWS\Common\SerializerInterface;

/**
 * Mock Serializer
 */
class MockSerializer implements SerializerInterface
{
    /**
     * {@inheritDoc}
     */
    public function serialize(RequestInterface $request): array
    {
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize(string $response): ResponseInterface
    {
    }
}
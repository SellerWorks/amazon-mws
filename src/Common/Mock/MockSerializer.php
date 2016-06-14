<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common\Mock;

use SellerWorks\Amazon\MWS\Common\RequestInterface;
use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use SellerWorks\Amazon\MWS\Common\Responses\GetServiceStatusResponse;
use SellerWorks\Amazon\MWS\Common\Results\GetServiceStatusResult;
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
        return ['Action' => 'GetServiceStatus'];
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize(string $response): ResponseInterface
    {
        $response = new GetServiceStatusResponse;
        $response->GetServiceStatusResult = new GetServiceStatusResult;
        $response->GetServiceStatusResult->Status = 'GREEN';
        $response->GetServiceStatusResult->Timestamp = '1969-07-21T02:56:03Z';

        return $response;
    }
}
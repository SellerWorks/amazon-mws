<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;

/**
 * GetServiceStatus response object.
 */
final class GetServiceStatusResponse implements ResponseInterface
{
    /**
     * @var GetServiceStatusResult
     */
    public $GetServiceStatusResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;
}
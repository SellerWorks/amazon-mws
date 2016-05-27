<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;

/**
 * List of inbound shipments.
 */
final class ListInboundShipmentsResponse implements ResponseInterface
{
    /**
     * @var ListInboundShipmentsResult
     */
    public $ListInboundShipmentsResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;
}
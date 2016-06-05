<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;

/**
 */
final class ListInboundShipmentItemsResponse implements ResponseInterface
{
    /**
     * @var ListInboundShipmentItemsResult
     */
    public $ListInboundShipmentItemsResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;
}
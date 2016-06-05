<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;

/**
 * UpdateInboundShipment response object.
 */
final class UpdateInboundShipmentResponse implements ResponseInterface
{
    /**
     * @var UpdateInboundShipmentResult
     */
    public $UpdateInboundShipmentResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;
}
<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * ListInboundShipmentItems response object.
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

    /**
     * {@inheritDoc}
     */
    public function getResult(): ResultInterface
    {
        return $this->ListInboundShipmentItemsResult;
    }
}
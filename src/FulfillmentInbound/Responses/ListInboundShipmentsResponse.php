<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * ListInboundShipments response object.
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

    /**
     * {@inheritDoc}
     */
    public function getResult(): ResultInterface
    {
        return $this->ListInboundShipmentsResult;
    }
}
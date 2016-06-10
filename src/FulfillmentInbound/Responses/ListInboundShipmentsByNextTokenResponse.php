<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * ListInboundShipmentsByNextToken response object.
 */
final class ListInboundShipmentsByNextTokenResponse implements ResponseInterface
{
    /**
     * @var ListInboundShipmentsByNextTokenResult
     */
    public $ListInboundShipmentsByNextTokenResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult(): ResultInterface
    {
        return $this->ListInboundShipmentsByNextTokenResult;
    }
}
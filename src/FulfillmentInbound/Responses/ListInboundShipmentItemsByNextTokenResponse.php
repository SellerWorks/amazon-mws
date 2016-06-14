<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * ListInboundShipmentItemsByNextToken response object.
 */
final class ListInboundShipmentItemsByNextTokenResponse implements ResponseInterface
{
    /**
     * @var ListInboundShipmentItemsByNextTokenResult
     */
    public $ListInboundShipmentItemsByNextTokenResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult(): ResultInterface
    {
        return $this->ListInboundShipmentItemsByNextTokenResult;
    }
}
<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * CreateInboundShipmentPlan response object.
 */
final class CreateInboundShipmentResponse implements ResponseInterface
{
    /**
     * @var CreateInboundShipmentResult
     */
    public $CreateInboundShipmentResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult(): ResultInterface
    {
        return $this->CreateInboundShipmentResult;
    }
}
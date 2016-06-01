<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;

/**
 * CreateInboundShipmentPlan response object.
 */
final class CreateInboundShipmentPlanResponse implements ResponseInterface
{
    /**
     * @var CreateInboundShipmentPlanResult
     */
    public $CreateInboundShipmentPlanResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;
}
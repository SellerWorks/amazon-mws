<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
 * Inbound shipment information used to create an inbound shipment. Returned by the CreateInboundShipmentPlan operation.
 */
final class InboundShipmentPlan
{
    /**
     * @var string
     */
    public $ShipmentId;

    /**
     * @var string
     */
    public $DestinationFulfillmentCenterId;

    /**
     * @var Address
     */
    public $ShipToAddress;

    /**
     * @var string
     */
    public $LabelPrepType;

    /**
     * @var Collection<InboundShipmentPlanItem>
     */
    public $Items;
}
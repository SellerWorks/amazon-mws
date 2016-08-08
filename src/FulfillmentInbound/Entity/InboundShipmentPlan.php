<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Inbound shipment information used to create an inbound shipment. Returned by the CreateInboundShipmentPlan operation.
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
     * @var Array<InboundShipmentPlanItem>
     */
    public $Items;

    /**
     * @var BoxContentsFeeDetails
     */
    public $EstimatedBoxContentsFee;
}

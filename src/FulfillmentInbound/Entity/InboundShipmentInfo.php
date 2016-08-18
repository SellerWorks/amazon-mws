<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Information about your inbound shipments. Returned by the ListInboundShipments operation.
 */
final class InboundShipmentInfo
{
    /**
     * @var string
     */
    public $ShipmentId;

    /**
     * @var string
     */
    public $ShipmentName;

    /**
     * @var Address
     */
    public $ShipFromAddress;

    /**
     * @var string
     */
    public $DestinationFulfillmentCenterId;

    /**
     * @var string
     */
    public $LabelPrepType;

    /**
     * @var string
     */
    public $ShipmentStatus;

    /**
     * @var bool
     */
    public $AreCasesRequired;

    /**
     * @var string
     */
    public $ConfirmedNeedByDate;

    /**
     * @var string
     */
    public $BoxContentsSource;

    /**
     * @var BoxContentsFeeDetails
     */
    public $EstimatedBoxContentsFee;
}

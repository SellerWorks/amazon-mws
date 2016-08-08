<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * The dimension values and unit of measurement.
 */
final class InboundShipmentHeader
{
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
    public $LabelPrepPreference;

    /**
     * @var bool
     */
    public $AreCasesRequired;

    /**
     * @var string
     */
    public $ShipmentStatus;

    /**
     * @var IntendedBoxContentsSource
     */
    public $IntendedBoxContentsSource;
}

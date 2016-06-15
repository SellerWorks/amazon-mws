<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Entities;

/**
 * 
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
}
<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * The shipping Id, information about whether the shipment is by an Amazon-partnered carrier, and information about
 * whether the shipment is Small Parcel or Less Than Truckload/Full Truckload (LTL/FTL).
 */
final class TransportHeader
{
    /**
     * @var string
     */
    public $SellerId;

    /**
     * @var string
     */
    public $ShipmentId;

    /**
     * @var bool
     */
    public $IsPartnered;

    /**
     * @var string
     */
    public $ShipmentType;
}

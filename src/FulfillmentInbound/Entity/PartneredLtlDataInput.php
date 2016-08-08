<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Information that is required by an Amazon-partnered carrier to ship a Less Than Truckload/Full Truckload (LTL/FTL)
 * inbound shipment.
 */
final class PartneredLtlDataInput
{
    /**
     * @var Contact
     */
    public $Contact;

    /**
     * @var int
     */
    public $BoxCount;

    /**
     * @var string
     */
    public $SellerFreightClass;

    /**
     * @var string
     */
    public $FreightReadyDate;

    /**
     * @var Array<Pallet>
     */
    public $PalletList;

    /**
     * @var Weight
     */
    public $TotalWeight;

    /**
     * @var Amount
     */
    public $SellerDeclaredValue;
}

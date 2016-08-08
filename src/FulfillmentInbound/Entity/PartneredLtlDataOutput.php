<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Information returned by Amazon about a Less Than Truckload/Full Truckload (LTL/FTL) shipment by an Amazon-partnered
 * carrier.
 */
final class PartneredLtlDataOutput
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

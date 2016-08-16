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
     * @var date
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

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'Contact'             => ['type' => 'contact', 'subtype' => Contact::class],
            'BoxCount'            => ['type' => 'scalar'],
            'SellerFreightClass'  => ['type' => 'scalar'],
            'FreightReadyDate'    => ['type' => 'date'],
            'PalletList'          => ['type' => 'array', 'subtype' => Pallet::class, 'namespace' => 'member'],
            'TotalWeight'         => ['type' => 'contact', 'subtype' => Weight::class],
            'SellerDeclaredValue' => ['type' => 'contact', 'subtype' => Amount::class],
        ];
    }
}

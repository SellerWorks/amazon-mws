<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

use SellerWorks\Amazon\Common\Serializer\MetadataInterface;

/**
 * Information that is required by an Amazon-partnered carrier to ship a Less Than Truckload/Full Truckload (LTL/FTL)
 * inbound shipment.
 */
final class PartneredLtlDataInput implements MetadataInterface
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
            'Contact'             => ['type' => 'object', 'subtype' => Contact::class],
            'BoxCount'            => ['type' => 'scalar'],
            'SellerFreightClass'  => ['type' => 'scalar'],
            'FreightReadyDate'    => ['type' => 'date'],
            'PalletList'          => ['type' => 'array', 'subtype' => Pallet::class, 'namespace' => 'member'],
            'TotalWeight'         => ['type' => 'object', 'subtype' => Weight::class],
            'SellerDeclaredValue' => ['type' => 'object', 'subtype' => Amount::class],
        ];
    }
}

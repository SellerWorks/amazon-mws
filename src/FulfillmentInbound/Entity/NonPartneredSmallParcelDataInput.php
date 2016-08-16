<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Information that you provide to Amazon about a Small Parcel shipment shipped by a carrier that has not partnered with
 * Amazon.
 */
final class NonPartneredSmallParcelDataInput
{
    /**
     * @var string
     */
    public $CarrierName;

    /**
     * @var Array<NonPartneredSmallParcelPackageInput>
     */
    public $PackageList;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'CarrierName' => ['type' => 'scalar'],
            'PackageList' => ['type' => 'array', 'subtype' => NonPartneredSmallParcelPackageInput::class, 'namespace' => 'member'],
        ];
    }
}

<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Dimension and weight information for the package.
 */
final class PartneredSmallParcelPackageInput
{
    /**
     * @var Dimensions
     */
    public $Dimensions;

    /**
     * @var Weight
     */
    public $Weight;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'CarrierName' => ['type' => 'object', 'subtype' => Dimensions::class],
            'PackageList' => ['type' => 'object', 'subtype' => Weight::class],
        ];
    }
}

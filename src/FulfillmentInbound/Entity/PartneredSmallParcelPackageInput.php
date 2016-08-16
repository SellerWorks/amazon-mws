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
            'Dimensions' => ['type' => 'object', 'subtype' => Dimensions::class],
            'Weight'     => ['type' => 'object', 'subtype' => Weight::class],
        ];
    }
}

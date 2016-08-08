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
}

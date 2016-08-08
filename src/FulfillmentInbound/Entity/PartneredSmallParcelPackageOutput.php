<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Dimension, weight, and shipping information for the package.
 */
final class PartneredSmallParcelPackageOutput
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
     * @var string
     */
    public $TrackingId;

    /**
     * @var string
     */
    public $PackageStatus;

    /**
     * @var string
     */
    public $CarrierName;
}

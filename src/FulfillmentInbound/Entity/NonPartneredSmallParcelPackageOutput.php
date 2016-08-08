<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Carrier, tracking number, and status information for the package.
 */
final class NonPartneredSmallParcelPackageOutput
{
    /**
     * @var string
     */
    public $CarrierName;

    /**
     * @var string
     */
    public $TrackingId;

    /**
     * @var string
     */
    public $PackageStatus;
}

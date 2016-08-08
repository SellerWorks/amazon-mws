<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Information returned by Amazon about a Small Parcel shipment by an Amazon-partnered carrier.
 */
final class PartneredSmallParcelDataOutput
{
    /**
     * @var Array<PartneredSmallParcelPackageOutput>
     */
    public $PackageList;

    /**
     * @var PartneredEstimate
     */
    public $PartneredEstimate;
}

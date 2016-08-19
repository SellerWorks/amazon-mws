<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Information returned by Amazon about a Small Parcel shipment by a carrier that has not partnered with Amazon.
 */
final class NonPartneredSmallParcelDataOutput
{
    /**
     * @var Array<NonPartneredSmallParcelPackageOutput>
     */
    public $PackageList;
}

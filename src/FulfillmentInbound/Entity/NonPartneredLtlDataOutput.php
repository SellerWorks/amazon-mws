<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Information returned by Amazon about a Less Than Truckload/Full Truckload (LTL/FTL) shipment shipped by a carrier
 * that has not partnered with Amazon.
 */
final class NonPartneredLtlDataOutput
{
    /**
     * @var string
     */
    public $CarrierName;

    /**
     * @var string
     */
    public $ProNumber;
}

<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Information that you provide to Amazon about a Less Than Truckload/Full Truckload (LTL/FTL) shipment by a carrier
 * that has not partnered with Amazon.
 */
final class NonPartneredLtlDataInput
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

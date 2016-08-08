<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Contact information for the person in your organization who is responsible for a Less Than Truckload/Full Truckload
 * (LTL/FTL) shipment.
 */
final class Contact
{
    /**
     * @var string
     */
    public $Name;

    /**
     * @var string
     */
    public $Phone;

    /**
     * @var string
     */
    public $Email;

    /**
     * @var string
     */
    public $Fax;
}

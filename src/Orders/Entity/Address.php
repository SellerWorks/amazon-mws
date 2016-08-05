<?php

namespace SellerWorks\Amazon\Orders\Entity;

/**
 * The shipping address for the order.
 */
final class Address
{
    /**
     * @var string
     */
    public $Name;

    /**
     * @var string
     */
    public $AddressLine1;

    /**
     * @var string
     */
    public $AddressLine2;

    /**
     * @var string
     */
    public $AddressLine3;

    /**
     * @var string
     */
    public $City;

    /**
     * @var string
     */
    public $County;

    /**
     * @var string
     */
    public $District;

    /**
     * @var string
     */
    public $StateOrRegion;

    /**
     * @var string
     */
    public $PostalCode;

    /**
     * @var string
     */
    public $CountryCode;

    /**
     * @var string
     */
    public $Phone;
}

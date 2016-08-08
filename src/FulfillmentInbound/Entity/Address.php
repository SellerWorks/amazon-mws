<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Postal address information.
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
    public $Address1;

    /**
     * @var string
     */
    public $Address2;

    /**
     * @var string
     */
    public $City;

    /**
     * @var string
     */
    public $DistrictOrCounty;

    /**
     * @var string
     */
    public $StateOrProvinceCode;

    /**
     * @var string
     */
    public $CountryCode;

    /**
     * @var string
     */
    public $PostalCode;
}

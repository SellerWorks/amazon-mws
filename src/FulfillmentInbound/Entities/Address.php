<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
 * Postal address information.
 */
final class Address
{
    /**
     * @var string
     *
     * @JMS\SerializedName("Name")
     * @JMS\Type("string")
     */
    public $Name;

    /**
     * @var string
     *
     * @JMS\SerializedName("AddressLine1")
     * @JMS\Type("string")
     */
    public $AddressLine1;

    /**
     * @var string
     *
     * @JMS\SerializedName("AddressLine2")
     * @JMS\Type("string")
     */
    public $AddressLine2;

    /**
     * @var string
     *
     * @JMS\SerializedName("City")
     * @JMS\Type("string")
     */
    public $City;

    /**
     * @var string
     *
     * @JMS\SerializedName("DistrictOrCounty")
     * @JMS\Type("string")
     */
    public $DistrictOrCounty;

    /**
     * @var string
     *
     * @JMS\SerializedName("StateOrProvinceCode")
     * @JMS\Type("string")
     */
    public $StateOrProvinceCode;

    /**
     * @var string
     *
     * @JMS\SerializedName("CountryCode")
     * @JMS\Type("string")
     */
    public $CountryCode;

    /**
     * @var string
     *
     * @JMS\SerializedName("PostalCode")
     * @JMS\Type("string")
     */
    public $PostalCode;
}
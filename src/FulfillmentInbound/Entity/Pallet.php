<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Pallet information.
 */
final class Pallet
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
     * @var bool
     */
    public $IsStacked;
}

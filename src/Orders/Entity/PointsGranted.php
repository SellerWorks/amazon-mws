<?php

namespace SellerWorks\Amazon\Orders\Entity;

/**
 * The number and value of Amazon Points granted with the purchase of an item (available only in Japan).
 */
final class PointsGranted
{
    /**
     * @var int
     */
    public $PointsNumber;

    /**
     * @var Money
     */
    public $PointsMonetaryValue;
}

<?php

namespace SellerWorks\Amazon\Orders\Entity;

/**
 * Currency type and amount.
 */
final class Money
{
    /**
     * @var string
     */
    public $CurrencyCode;

    /**
     * @var string
     */
    public $Amount;
}

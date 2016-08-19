<?php

namespace SellerWorks\Amazon\Orders\Entity;

/**
 * Information about a sub-payment method used to pay for a COD order.
 */
final class PaymentExecutionDetailItem
{
    /**
     * @var Money
     */
    public $Payment;

    /**
     * @var string
     */
    public $PaymentMethod;
}

<?php

namespace SellerWorks\Amazon\Orders\Entity;

/**
 * Invoice information (available only in China).
 */
final class InvoiceData
{
    /**
     * @var string
     */
    public $InvoiceRequirement;

    /**
     * @var string
     */
    public $BuyerSelectedInvoiceCategory;

    /**
     * @var string
     */
    public $InvoiceTitle;

    /**
     * @var string
     */
    public $InvoiceInformation;
}

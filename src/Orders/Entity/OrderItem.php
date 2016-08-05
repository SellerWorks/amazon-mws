<?php

namespace SellerWorks\Amazon\Orders\Entity;

/**
 * OrderItem information.
 */
final class OrderItem
{
    /**
     * @var string
     */
    public $ASIN;

    /**
     * @var string
     */
    public $OrderItemId;

    /**
     * @var string
     */
    public $SellerSKU;

    /**
     * @var BuyerCustomizedInfo
     */
    public $BuyerCustomizedInfo;

    /**
     * @var string
     */
    public $Title;

    /**
     * @var int
     */
    public $QuantityOrdered;

    /**
     * @var int
     */
    public $QuantityShipped;

    /**
     * @var PointsGranted
     */
    public $PointsGranted;

    /**
     * @var Money
     */
    public $ItemPrice;

    /**
     * @var Money
     */
    public $ShippingPrice;

    /**
     * @var Money
     */
    public $GiftWrapPrice;

    /**
     * @var Money
     */
    public $ItemTax;

    /**
     * @var Money
     */
    public $ShippingTax;

    /**
     * @var Money
     */
    public $GiftWrapTax;

    /**
     * @var Money
     */
    public $ShippingDiscount;

    /**
     * @var Money
     */
    public $PromotionDiscount;

    /**
     * @var Collection<string>
     */
    public $PromotionIds;

    /**
     * @var Money
     */
    public $CODFee;

    /**
     * @var Money
     */
    public $CODFeeDiscount;

    /**
     * @var string
     */
    public $GiftMessageText;

    /**
     * @var string
     */
    public $GiftWrapLevel;

    /**
     * @var InvoiceData
     */
    public $InvoiceData;

    /**
     * @var string
     */
    public $ConditionNote;

    /**
     * @var string
     */
    public $ConditionId;

    /**
     * @var string
     */
    public $ConditionSubtypeId;

    /**
     * @var string
     */
    public $ScheduledDeliveryStartDate;

    /**
     * @var string
     */
    public $ScheduledDeliveryEndDate;

    /**
     * @var string
     */
    public $PriceDesignation;
}

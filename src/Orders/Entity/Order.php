<?php

namespace SellerWorks\Amazon\Orders\Entity;

/**
 * Order information.
 */
final class Order
{
    /**
     * @var string
     */
    public $AmazonOrderId;

    /**
     * @var string
     */
    public $SellerOrderId;

    /**
     * @var string
     */
    public $PurchaseDate;

    /**
     * @var string
     */
    public $LastUpdateDate;

    /**
     * @var string
     */
    public $OrderStatus;

    /**
     * @var string
     */
    public $FulfillmentChannel;

    /**
     * @var string
     */
    public $SalesChannel;

    /**
     * @var string
     */
    public $OrderChannel;

    /**
     * @var string
     */
    public $ShipServiceLevel;

    /**
     * @var Address
     */
    public $ShippingAddress;

    /**
     * @var string
     */
    public $OrderTotal;

    /**
     * @var string
     */
    public $NumberOfItemsShipped;

    /**
     * @var string
     */
    public $NumberOfItemsUnshipped;

    /**
     * @var string
     */
    public $PaymentExecutionDetail;

    /**
     * @var string
     */
    public $PaymentMethod;

    /**
     * @var string
     */
    public $MarketplaceId;

    /**
     * @var string
     */
    public $BuyerEmail;

    /**
     * @var string
     */
    public $BuyerName;

    /**
     * @var string
     */
    public $ShipmentServiceLevelCategory;

    /**
     * @var bool
     */
    public $ShippedByAmazonTFM;

    /**
     * @var string
     */
    public $TFMShipmentStatus;

    /**
     * @var string
     */
    public $CbaDisplayableShippingLabel;

    /**
     * @var string
     */
    public $OrderType;

    /**
     * @var string
     */
    public $EarliestShipDate;

    /**
     * @var string
     */
    public $LatestShipDate;

    /**
     * @var string
     */
    public $EarliestDeliveryDate;

    /**
     * @var string
     */
    public $LatestDeliveryDate;

    /**
     * @var bool
     */
    public $IsBusinessOrder;

    /**
     * @var string
     */
    public $PurchaseOrderNumber;

    /**
     * @var bool
     */
    public $IsPrime;

    /**
     * @var bool
     */
    public $IsPremiumOrder;
}

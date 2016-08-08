<?php

namespace SellerWorks\Amazon\Orders\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Returns orders created or updated during a time frame that you specify.
 */
final class ListOrdersRequest implements RequestInterface
{
    /**
     * @var DateTimeInterface|string
     */
    public $CreatedAfter;

    /**
     * @var DateTimeInterface|string
     */
    public $CreatedBefore;

    /**
     * @var DateTimeInterface|string
     */
    public $LastUpdatedAfter;

    /**
     * @var DateTimeInterface|string
     */
    public $LastUpdatedBefore;

    /**
     * @var string
     */
    public $OrderStatus;

    /**
     * @var string
     */
    public $MarketplaceId;

    /**
     * @var string
     */
    public $FulfillmentChannel;

    /**
     * @var string
     */
    public $PaymentMethod;

    /**
     * @var string
     */
    public $BuyerEmail;

    /**
     * @var string
     */
    public $SellerOrderId;

    /**
     * @var int
     */
    public $MaxResultsPerPage;

    /**
     * @var string
     */
    public $TFMShipmentStatus;
}

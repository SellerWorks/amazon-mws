<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Entities;

/**
 */
final class InboundShipmentItem
{
    /**
     * @var string
     */
    public $ShipmentId;

    /**
     * @var string
     */
    public $SellerSKU;

    /**
     * @var string
     */
    public $FulfillmentNetworkSKU;

    /**
     * @var int
     */
    public $QuantityShipped;

    /**
     * @var int
     */
    public $QuantityReceived;

    /**
     * @var int
     */
    public $QuantityInCase;

    /**
     * @var ArrayCollection<>
     */
    public $PrepDetailsList;

    /**
     * @var DateTimeImmutable
     */
    public $ReleaseDate;
}
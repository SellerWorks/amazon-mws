<?php

namespace SellerWorks\Amazon\Tests\Orders\Serializer;

use SellerWorks\Amazon\Common\Serializer\MetadataInterface;
use SellerWorks\Amazon\Orders\Entity;
use SellerWorks\Amazon\Orders\Request;

/**
 * Serializer tests
 */
class CheckMetadata
{
    /**
     * Test for metadata interface on objects.
     */
    public static function getMetadataClasses()
    {
        return [
            // Requests.
            Request\ListOrdersRequest::class,
            Request\ListOrdersByNextTokenRequest::class,
            Request\ListOrderItemsRequest::class,
            Request\ListOrderItemsByNextTokenRequest::class,
            Request\GetServiceStatusRequest::class,
            Request\GetOrderRequest::class,

            // Entities.
            Entity\Address::class,
            Entity\BuyerCustomizedInfo::class,
            Entity\InvoiceData::class,
            Entity\Money::class,
            Entity\Order::class,
            Entity\OrderItem::class,
            Entity\PaymentExecutionDetailItem::class,
            Entity\PointsGranted::class,
            Entity\ResponseMetadata::class,
        ];
    }
}

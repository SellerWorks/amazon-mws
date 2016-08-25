<?php

namespace SellerWorks\Amazon\Orders\Serializer;

use SellerWorks\Amazon\Common\Serializer\XmlDeserializer as BaseXmlDeserializer;
use SellerWorks\Amazon\Orders\Entity;
use SellerWorks\Amazon\Orders\Response;
use SellerWorks\Amazon\Orders\Result;

/**
 * Sabre\Xml\Service element map.
 */
final class XmlDeserializer extends BaseXmlDeserializer
{
    /**
     * @const string
     */
    const NS = 'https://mws.amazonservices.com/Orders/2013-09-01';

    /**
     * Local element map.
     *
     * @return array
     */
    public function getElementMap()
    {
        $ns = sprintf('{%s}', static::NS);

        return [
            // Response objects.
            "{$ns}ListOrdersResponse"                => $this->mapObject(Response\ListOrdersResponse::class),
            "{$ns}ListOrdersByNextTokenResponse"     => $this->mapObject(Response\ListOrdersByNextTokenResponse::class),
            "{$ns}GetOrderResponse"                  => $this->mapObject(Response\GetOrderResponse::class),
            "{$ns}ListOrderItemsResponse"            => $this->mapObject(Response\ListOrderItemsResponse::class),
            "{$ns}ListOrderItemsByNextTokenResponse" => $this->mapObject(Response\ListOrderItemsByNextTokenResponse::class),

            "{$ns}ErrorResponse"                     => $this->mapObject(Response\ErrorResponse::class),
            "{$ns}GetServiceStatusResponse"          => $this->mapObject(Response\GetServiceStatusResponse::class),


            // Result objects.
            "{$ns}ListOrdersResult"                  => $this->mapObject(Result\ListOrdersResult::class),
            "{$ns}ListOrdersByNextTokenResult"       => $this->mapObject(Result\ListOrdersResult::class),
            "{$ns}GetOrderResult"                    => $this->mapObject(Result\GetOrderResult::class),
            "{$ns}ListOrderItemsResult"              => $this->mapObject(Result\ListOrderItemsResult::class),
            "{$ns}ListOrderItemsByNextTokenResult"   => $this->mapObject(Result\ListOrderItemsResult::class),

            "{$ns}Error"                             => $this->mapObject(Result\Error::class),
            "{$ns}GetServiceStatusResult"            => $this->mapObject(Result\GetServiceStatusResult::class),


            // Collection objects.
            "{$ns}Orders"                            => $this->mapCollection("{$ns}Order", Entity\Order::class),
            "{$ns}OrderItems"                        => $this->mapCollection("{$ns}OrderItem", Entity\OrderItem::class),
            "{$ns}PaymentExecutionDetail"            => $this->mapList("{$ns}PaymentExecutionDetailItem"),
            "{$ns}PromotionIds"                      => $this->mapList("{$ns}PromotionId"),


            // Entity objects.
            "{$ns}BuyerCustomizedInfo"               => $this->mapObject(Entity\BuyerCustomizedInfo::class),
            "{$ns}InvoiceData"                       => $this->mapObject(Entity\InvoiceData::class),
            "{$ns}Order"                             => $this->mapObject(Entity\Order::class),
            "{$ns}OrderItem"                         => $this->mapObject(Entity\OrderItem::class),
            "{$ns}PaymentExecutionDetailItem"        => $this->mapObject(Entity\PaymentExecutionDetailItem::class),
            "{$ns}PointsGranted"                     => $this->mapObject(Entity\PointsGranted::class),
            "{$ns}ResponseMetadata"                  => $this->mapObject(Entity\ResponseMetadata::class),
            "{$ns}ShippingAddress"                   => $this->mapObject(Entity\Address::class),

            "{$ns}CODFee"                            => $this->mapObject(Entity\Money::class),
            "{$ns}CODFeeDiscount"                    => $this->mapObject(Entity\Money::class),
            "{$ns}GiftWrapPrice"                     => $this->mapObject(Entity\Money::class),
            "{$ns}GiftWrapTax"                       => $this->mapObject(Entity\Money::class),
            "{$ns}ItemPrice"                         => $this->mapObject(Entity\Money::class),
            "{$ns}ItemTax"                           => $this->mapObject(Entity\Money::class),
            "{$ns}OrderTotal"                        => $this->mapObject(Entity\Money::class),
            "{$ns}Payment"                           => $this->mapObject(Entity\Money::class),
            "{$ns}PointsMonetaryValue"               => $this->mapObject(Entity\Money::class),
            "{$ns}PromotionDiscount"                 => $this->mapObject(Entity\Money::class),
            "{$ns}ShippingDiscount"                  => $this->mapObject(Entity\Money::class),
            "{$ns}ShippingPrice"                     => $this->mapObject(Entity\Money::class),
            "{$ns}ShippingTax"                       => $this->mapObject(Entity\Money::class),
        ];
    }
}

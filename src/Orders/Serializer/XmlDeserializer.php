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
        $namespace = sprintf('{%s}', static::NS);

        return [
            // Response objects.
            "{$namespace}ListOrdersResponse"                => $this->mapObject(Response\ListOrdersResponse::class),
            "{$namespace}ListOrdersByNextTokenResponse"     => $this->mapObject(Response\ListOrdersByNextTokenResponse::class),
            "{$namespace}GetOrderResponse"                  => $this->mapObject(Response\GetOrderResponse::class),
            "{$namespace}ListOrderItemsResponse"            => $this->mapObject(Response\ListOrderItemsResponse::class),
            "{$namespace}ListOrderItemsByNextTokenResponse" => $this->mapObject(Response\ListOrderItemsByNextTokenResponse::class),

            "{$namespace}ErrorResponse"                     => $this->mapObject(Response\ErrorResponse::class),
            "{$namespace}GetServiceStatusResponse"          => $this->mapObject(Response\GetServiceStatusResponse::class),


            // Result objects.
            "{$namespace}ListOrdersResult"                  => $this->mapObject(Result\ListOrdersResult::class),
            "{$namespace}ListOrdersByNextTokenResult"       => $this->mapObject(Result\ListOrdersResult::class),
            "{$namespace}GetOrderResult"                    => $this->mapObject(Result\GetOrderResult::class),
            "{$namespace}ListOrderItemsResult"              => $this->mapObject(Result\ListOrderItemsResult::class),
            "{$namespace}ListOrderItemsByNextTokenResult"   => $this->mapObject(Result\ListOrderItemsResult::class),

            "{$namespace}Error"                             => $this->mapObject(Result\Error::class),
            "{$namespace}GetServiceStatusResult"            => $this->mapObject(Result\GetServiceStatusResult::class),


            // Collection objects.
            "{$namespace}Orders"                            => $this->mapCollection("{$namespace}Order", Entity\Order::class),
            "{$namespace}OrderItems"                        => $this->mapCollection("{$namespace}OrderItem", Entity\OrderItem::class),
            "{$namespace}PaymentExecutionDetail"            => $this->mapList("{$namespace}PaymentExecutionDetailItem"),
            "{$namespace}PromotionIds"                      => $this->mapList("{$namespace}PromotionId"),


            // Entity objects.
            "{$namespace}BuyerCustomizedInfo"               => $this->mapObject(Entity\BuyerCustomizedInfo::class),
            "{$namespace}InvoiceData"                       => $this->mapObject(Entity\InvoiceData::class),
            "{$namespace}Order"                             => $this->mapObject(Entity\Order::class),
            "{$namespace}OrderItem"                         => $this->mapObject(Entity\OrderItem::class),
            "{$namespace}PaymentExecutionDetailItem"        => $this->mapObject(Entity\PaymentExecutionDetailItem::class),
            "{$namespace}PointsGranted"                     => $this->mapObject(Entity\PointsGranted::class),
            "{$namespace}ResponseMetadata"                  => $this->mapObject(Entity\ResponseMetadata::class),
            "{$namespace}ShippingAddress"                   => $this->mapObject(Entity\Address::class),

            "{$namespace}CODFee"                            => $this->mapObject(Entity\Money::class),
            "{$namespace}CODFeeDiscount"                    => $this->mapObject(Entity\Money::class),
            "{$namespace}GiftWrapPrice"                     => $this->mapObject(Entity\Money::class),
            "{$namespace}GiftWrapTax"                       => $this->mapObject(Entity\Money::class),
            "{$namespace}ItemPrice"                         => $this->mapObject(Entity\Money::class),
            "{$namespace}ItemTax"                           => $this->mapObject(Entity\Money::class),
            "{$namespace}OrderTotal"                        => $this->mapObject(Entity\Money::class),
            "{$namespace}Payment"                           => $this->mapObject(Entity\Money::class),
            "{$namespace}PointsMonetaryValue"               => $this->mapObject(Entity\Money::class),
            "{$namespace}PromotionDiscount"                 => $this->mapObject(Entity\Money::class),
            "{$namespace}ShippingDiscount"                  => $this->mapObject(Entity\Money::class),
            "{$namespace}ShippingPrice"                     => $this->mapObject(Entity\Money::class),
            "{$namespace}ShippingTax"                       => $this->mapObject(Entity\Money::class),
        ];
    }
}

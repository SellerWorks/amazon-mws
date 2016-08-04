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
            "{$namespace}ListOrdersByNextTokenResult"       => $this->mapObject(Result\ListOrdersByNextTokenResult::class),
            "{$namespace}GetOrderResult"                    => $this->mapObject(Result\GetOrderResult::class),
            "{$namespace}ListOrderItemsResult"              => $this->mapObject(Result\ListOrderItemsResult::class),
            "{$namespace}ListOrderItemsByNextTokenResult"   => $this->mapObject(Result\ListOrderItemsByNextTokenResult::class),

            "{$namespace}Error"                             => $this->mapObject(Result\Error::class),
            "{$namespace}GetServiceStatusResult"            => $this->mapObject(Result\GetServiceStatusResult::class),


            // Collection objects.


            // Entity objects.
            "{$namespace}ResponseMetadata"                  => $this->mapObject(Entity\ResponseMetadata::class),


            // Lists.
        ];
    }
}

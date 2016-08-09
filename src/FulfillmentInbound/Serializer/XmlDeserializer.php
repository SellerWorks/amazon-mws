<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Serializer;

use SellerWorks\Amazon\Common\Serializer\XmlDeserializer as BaseXmlDeserializer;
use SellerWorks\Amazon\FulfillmentInbound\Entity;
use SellerWorks\Amazon\FulfillmentInbound\Response;
use SellerWorks\Amazon\FulfillmentInbound\Result;

/**
 * Sabre\Xml\Service element map.
 */
final class XmlDeserializer extends BaseXmlDeserializer
{
    /**
     * @const string
     */
    const NS = 'http://mws.amazonaws.com/FulfillmentInboundShipment/2010-10-01/';

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
            "{$ns}ErrorResponse"                     => $this->mapObject(Response\ErrorResponse::class),
            "{$ns}GetServiceStatusResponse"          => $this->mapObject(Response\GetServiceStatusResponse::class),
            "{$ns}ListInboundShipmentItemsResponse"             => $this->mapObject(Response\ListInboundShipmentItemsResponse::class),
            "{$ns}ListInboundShipmentItemsByNextTokenResponse"  => $this->mapObject(Response\ListInboundShipmentItemsByNextTokenResponse::class),
            "{$ns}ListInboundShipmentsResponse"      => $this->mapObject(Response\ListInboundShipmentsResponse::class),
            "{$ns}ListInboundShipmentsByNextTokenResponse"  => $this->mapObject(Response\ListInboundShipmentsByNextTokenResponse::class),



            // Result objects.
            "{$ns}Error"                             => $this->mapObject(Result\Error::class),
            "{$ns}GetServiceStatusResult"            => $this->mapObject(Result\GetServiceStatusResult::class),
            "{$ns}ListInboundShipmentItemsResult"           => $this->mapObject(Result\ListInboundShipmentItemsResult::class),
            "{$ns}ListInboundShipmentItemsByNextTokenResult"=> $this->mapObject(Result\ListInboundShipmentItemsResult::class),
            "{$ns}ListInboundShipmentsResult"               => $this->mapObject(Result\ListInboundShipmentsResult::class),
            "{$ns}ListInboundShipmentsByNextTokenResult"    => $this->mapObject(Result\ListInboundShipmentsResult::class),

            // Collection objects.
            "{$ns}ItemData"                 => $this->mapCollection("{$ns}member", Entity\InboundShipmentItem::class),
            "{$ns}ShipmentData"             => $this->mapCollection("{$ns}member", Entity\InboundShipmentInfo::class),

            "{$ns}PrepDetailsList" => $this->mapList("{$ns}PrepDetails"),

            // Entity objects.
            "{$ns}BoxContentsSource"        => $this->mapObject(Entity\BoxContentsSource::class),
            "{$ns}EstimatedBoxContentsFee"  => $this->mapObject(Entity\BoxContentsFeeDetails::class),
            "{$ns}PrepDetails"              => $this->mapObject(Entity\PrepDetails::class),
            "{$ns}ResponseMetadata"         => $this->mapObject(Entity\ResponseMetadata::class),
            "{$ns}ShipFromAddress"          => $this->mapObject(Entity\Address::class),

            "{$ns}FeePerUnit"               => $this->mapObject(Entity\Amount::class),
            "{$ns}TotalFee"                 => $this->mapObject(Entity\Amount::class),
        ];
    }
}

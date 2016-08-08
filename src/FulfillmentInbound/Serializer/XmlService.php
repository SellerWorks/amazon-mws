<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\FulfillmentInbound;

use SellerWorks\Amazon\Common\XmlService as BaseXmlService;

/**
 * Defines how to deserialize xml using Sabre\Xml
 */
class XmlService extends BaseXmlService
{
    /**
     * @const string
     */
    const NS = 'http://mws.amazonaws.com/FulfillmentInboundShipment/2010-10-01/';

    /**
     * Add all objects to the service.
     */
    public function __construct()
    {
        $namespace = sprintf('{%s}', static::NS);
        parent::__construct($namespace);

        $this->elementMap = array_merge($this->elementMap, [
            // Response objects.
            "{$namespace}CreateInboundShipmentPlanResponse" => $this->mapObject(Responses\CreateInboundShipmentPlanResponse::class),
            "{$namespace}CreateInboundShipmentResponse" => $this->mapObject(Responses\CreateInboundShipmentResponse::class),
            "{$namespace}GetPrepInstructionsForASINResponse" => $this->mapObject(Responses\GetPrepInstructionsForASINResponse::class),
            "{$namespace}GetPrepInstructionsForSKUResponse" => $this->mapObject(Responses\GetPrepInstructionsForSKUResponse::class),
            "{$namespace}ListInboundShipmentItemsResponse" => $this->mapObject(Responses\ListInboundShipmentItemsResponse::class),
            "{$namespace}ListInboundShipmentItemsByNextTokenResponse" => $this->mapObject(Responses\ListInboundShipmentItemsByNextTokenResponse::class),
            "{$namespace}ListInboundShipmentsResponse" => $this->mapObject(Responses\ListInboundShipmentsResponse::class),
            "{$namespace}ListInboundShipmentsByNextTokenResponse" => $this->mapObject(Responses\ListInboundShipmentsByNextTokenResponse::class),
            "{$namespace}UpdateInboundShipmentResponse" => $this->mapObject(Responses\UpdateInboundShipmentResponse::class),


            // Result objects.
            "{$namespace}CreateInboundShipmentPlanResult" => $this->mapObject(Results\CreateInboundShipmentPlanResult::class),
            "{$namespace}CreateInboundShipmentResult" => $this->mapObject(Results\CreateInboundShipmentResult::class),

            "{$namespace}GetPrepInstructionsForASINResult" => $this->mapObject(Results\GetPrepInstructionsForASINResult::class),
            "{$namespace}GetPrepInstructionsForSKUResult" => $this->mapObject(Results\GetPrepInstructionsForSKUResult::class),
            "{$namespace}ListInboundShipmentItemsResult" => $this->mapObject(Results\ListInboundShipmentItemsResult::class),
            "{$namespace}ListInboundShipmentItemsByNextTokenResult" => $this->mapObject(Results\ListInboundShipmentItemsByNextTokenResult::class),
            "{$namespace}ListInboundShipmentsResult" => $this->mapObject(Results\ListInboundShipmentsResult::class),
            "{$namespace}ListInboundShipmentsByNextTokenResult" => $this->mapObject(Results\ListInboundShipmentsByNextTokenResult::class),
            "{$namespace}UpdateInboundShipmentResult" => $this->mapObject(Results\UpdateInboundShipmentResult::class),


            // Collection objects.
            "{$namespace}ASINPrepInstructionsList" => $this->mapCollectionObject("{$namespace}ASINPrepInstructions", Entities\ASINPrepInstructions::class),
//            "{$namespace}AmazonPrepFeesDetailsList" => $this->mapCollectionObject("{$namespace}AmazonPrepFeesDetails", Entities\AmazonPrepFeesDetails::class),
            "{$namespace}ItemData" => $this->mapCollectionObject("{$namespace}member", Entities\InboundShipmentItem::class),
            "{$namespace}InboundShipmentPlans" => $this->mapCollectionObject("{$namespace}member", Entities\InboundShipmentPlan::class),
            "{$namespace}InvalidASINList" => $this->mapCollectionObject("{$namespace}InvalidASIN", Entities\InvalidASIN::class),
            "{$namespace}InvalidSKUList" => $this->mapCollectionObject("{$namespace}InvalidSKU", Entities\InvalidSKU::class),
            "{$namespace}Items" => $this->mapCollectionObject("{$namespace}member", Entities\InboundShipmentPlanItem::class),
            "{$namespace}PrepDetailsList" => $this->mapCollectionObject("{$namespace}PrepDetails", Entities\PrepDetails::class),
            "{$namespace}ShipmentData" => $this->mapCollectionObject("{$namespace}member", Entities\InboundShipmentInfo::class),
            "{$namespace}SKUPrepInstructionsList" => $this->mapCollectionObject("{$namespace}SKUPrepInstructions", Entities\SKUPrepInstructions::class),


            // Type objects.
            "{$namespace}Amount" => $this->mapObject(Entities\Amount::class),
            
            "{$namespace}ShipFromAddress" => $this->mapObject(Entities\Address::class),
            "{$namespace}ShipToAddress" => $this->mapObject(Entities\Address::class),


            // Lists.
            "{$namespace}PrepInstructionList" => function(Reader $reader) use ($namespace) {
                return \Sabre\Xml\Deserializer\repeatingElements($reader, "{$namespace}PrepInstruction");
            },
        ]);
    }
}
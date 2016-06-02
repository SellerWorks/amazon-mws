<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

use Closure;
use ReflectionProperty;
use Sabre\Xml\Reader;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
 * Defines how to deserialize xml using Sabre\Xml
 */
class XmlService extends \Sabre\Xml\Service
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

        $this->elementMap = [
            // Response objects.
            "{$namespace}GetServiceStatusResponse" => $this->mapObject(Responses\GetServiceStatusResponse::class),
            "{$namespace}ListInboundShipmentsResponse" => $this->mapObject(Responses\ListInboundShipmentsResponse::class),


            // Response objects.
            "{$namespace}GetServiceStatusResult" => $this->mapObject(Types\GetServiceStatusResult::class),
            "{$namespace}ListInboundShipmentsResult" => $this->mapObject(Types\ListInboundShipmentsResult::class),


            // Collection objects.
            "{$namespace}ShipmentData" => $this->mapCollectionObject("{$namespace}member", Types\InboundShipmentInfo::class),


            // Type objects.
            "{$namespace}ResponseMetadata" => $this->mapObject(Types\ResponseMetadata::class),
            "{$namespace}ShipFromAddress" => $this->mapObject(Types\Address::class),
        ];


/*
        // Response objects.
        $this->mapImmutableObject($namespace . 'CreateInboundShipmentPlanResponse', Responses\CreateInboundShipmentPlanResponse::class);
        $this->mapImmutableObject($namespace . 'GetServiceStatusResponse', Responses\ErrorResponse::class);
        $this->mapImmutableObject($namespace . 'ErrorResponse', Responses\ErrorResponse::class);
        $this->mapImmutableObject($namespace . 'GetServiceStatusResponse', Responses\GetServiceStatusResponse::class);
        $this->mapImmutableObject($namespace . 'ListInboundShipmentsResponse', Responses\ListInboundShipmentsResponse::class);


        // Result objects.
        $this->mapImmutableObject($namespace . 'CreateInboundShipmentPlanResult', Types\CreateInboundShipmentPlanResult::class);
        $this->mapImmutableObject($namespace . 'GetServiceStatusResult', Types\GetServiceStatusResult::class);
        $this->mapImmutableObject($namespace . 'ListInboundShipmentsResult', Types\ListInboundShipmentsResult::class);


        // Type objects.
        $this->mapImmutableObject($namespace . 'Error', Types\Error::class);
        $this->mapImmutableObject($namespace . 'ResponseMetadata', Types\ResponseMetadata::class);
        $this->mapImmutableObject($namespace . 'ShipFromAddress', Types\Address::class);
        $this->mapImmutableObject($namespace . 'PrepDetails', Types\PrepDetails::class);


        // Collection objects.
        $this->mapCollectionObject($namespace . 'InboundShipmentPlans', $namespace . 'member', Types\InboundShipmentPlan::class);
        $this->mapCollectionObject($namespace . 'PrepDetailsList', $namespace . 'PrepDetails', Types\PrepDetails::class);
        $this->mapCollectionObject($namespace . 'ShipmentData', $namespace . 'member', Types\InboundShipmentInfo::class);
*/
    }

    /**
     * Return new object by closure.
     *
     * @param  string $namespace
     * @param  string $className
     * @return Closure
     */
    protected function mapObject(string $className): Closure
    {
        $namespace = static::NS;

        return function(Reader $reader) use ($namespace, $className) {
            $object = new $className;
            $values = \Sabre\Xml\Deserializer\keyValue($reader, $namespace);

            foreach ($values as $property => $value) {
                if (property_exists($object, $property)) {
                    $reflection = new ReflectionProperty($object, $property);
                    $reflection->setAccessible(true);
                    $reflection->setValue($object, $value);
                }
            }

            return $object;
        };
    }

    /**
     * Return new collection by closure.
     *
     * @param  string $childElementName
     * @param  string $className
     * @return Closure
     */
    protected function mapCollectionObject(string $childElementName, string $className): Closure
    {
        $namespace = static::NS;

        return function(Reader $reader) use ($childElementName, $className, $namespace) {
            $elementMap = $reader->elementMap;
            $elementMap[$childElementName] = $this->mapObject($className);
            $result = [];

            foreach ($reader->parseGetElements($elementMap) as $element) {
                if ($element['name'] === $childElementName) {
                    $result[] = $element['value'];
                }
            }

            return $result;
        };
    }

    /**
     * Map an immutable object into the xml service map.
     *
     * @param  string $elementName
     * @param  string $className
     * @return void
     */
/*
    protected function mapImmutableObject($elementName, $className)
    {
        list($namespace) = self::parseClarkNotation($elementName);

        $this->elementMap[$elementName] = $this->createClosure($namespace, $className);
    }
*/
}
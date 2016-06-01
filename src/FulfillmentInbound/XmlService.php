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
     * Add all objects to the service.
     */
    public function __construct()
    {
        $namespace = '{http://mws.amazonaws.com/FulfillmentInboundShipment/2010-10-01/}';

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
    }

    /**
     * Create a closer for returning an immutable object.
     *
     * @param  string $namespace
     * @param  string $className
     * @return Closure
     */
    protected function createClosure($namespace, $className): Closure
    {
        return function(Reader $reader) use ($namespace, $className) {
            $object = new $className;
            $values = \Sabre\Xml\Deserializer\keyValue($reader, trim($namespace, '{}'));

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
     * Map an immutable object into the xml service map.
     *
     * @param  string $elementName
     * @param  string $className
     * @return void
     */
    protected function mapImmutableObject($elementName, $className)
    {
        list($namespace) = self::parseClarkNotation($elementName);

        $this->elementMap[$elementName] = $this->createClosure($namespace, $className);
    }

    /**
     * Map a collection into the xml service map.
     *
     * @param  string $elementName
     * @param  string $childElementName
     * @param  string $className
     * @return void
     */
    protected function mapCollectionObject($elementName, $childElementName, $className)
    {
        list($namespace) = self::parseClarkNotation($elementName);

        $this->elementMap[$elementName] = function(Reader $reader) use ($childElementName, $className, $namespace) {
            // Temporary element map.
            $elementMap = $reader->elementMap;
            $elementMap[$childElementName] = $this->createClosure($namespace, $className);

            // Variation of Sabre\Xml\Deserializer\repeatingElements.
            $result = [];

            foreach ($reader->parseGetElements($elementMap) as $element) {
                if ($element['name'] === $childElementName) {
                    $result[] = $element['value'];
                }
            }

            return $result;
        };
    }
}
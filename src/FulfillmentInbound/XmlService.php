<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

use ReflectionProperty;
use Sabre\Xml\Reader;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
 */
class XmlService extends \Sabre\Xml\Service
{
    /**
     */
    public function __construct()
    {
        $namespace = '{http://mws.amazonaws.com/FulfillmentInboundShipment/2010-10-01/}';

        $this->mapValueObject($namespace . 'GetServiceStatusResponse', Responses\GetServiceStatusResponse::class);
        $this->mapValueObject($namespace . 'ErrorResponse ', Responses\ErrorResponse::class);

//        $this->mapValueObject($namespace . 'Error', Types\Error::class);        
        $this->mapValueObject($namespace . 'GetServiceStatusResult', Types\GetServiceStatusResult::class);
        $this->mapValueObject($namespace . 'ResponseMetadata', Types\ResponseMetadata::class);
    }

    /**
     */
/*
    protected function mapImmutableObject($elementName, $className)
    {
        list($namespace) = self::parseClarkNotation($elementName);

        $this->elementMap[$elementName] = function(Reader $reader) use ($className, $namespace) {
            $obj = new $className;
            $values = \Sabre\Xml\Deserializer\keyValue($reader, $namespace);

            foreach ($values as $property => $value) {
                if (property_exists($obj, $property)) {
                    $reflection = new ReflectionProperty($obj, $property);
                    $reflection->setAccessible(true);
                    $reflection->setValue($obj, $value);
                }
            }

            return $obj;
        };
    }
*/
}
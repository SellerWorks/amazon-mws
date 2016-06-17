<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Orders;

use Closure;
use ReflectionProperty;
use Sabre\Xml\Reader;
use SellerWorks\Amazon\MWS\Common\Entities\ResponseMetadata;
use SellerWorks\Amazon\MWS\Common\Responses\ErrorResponse;
use SellerWorks\Amazon\MWS\Common\Responses\GetServiceStatusResponse;
use SellerWorks\Amazon\MWS\Common\Results\Error;
use SellerWorks\Amazon\MWS\Common\Results\GetServiceStatusResult;

/**
 * Defines how to deserialize xml using Sabre\Xml
 */
class XmlService extends \Sabre\Xml\Service
{
    /**
     * @const string
     */
    const NS = 'https://mws.amazonservices.com/Orders/2013-09-01';

    /**
     * Add all objects to the service.
     */
    public function __construct()
    {
        $namespace = sprintf('{%s}', static::NS);

        $this->elementMap = [
            // Common objects.
            "{$namespace}Error" => $this->mapObject(Error::class),
            "{$namespace}ErrorResponse" => $this->mapObject(ErrorResponse::class),
            "{$namespace}GetServiceStatusResponse" => $this->mapObject(GetServiceStatusResponse::class),
            "{$namespace}GetServiceStatusResult" => $this->mapObject(GetServiceStatusResult::class),


            // Response objects.


            // Result objects.


            // Collection objects.


            // Type objects.


            // Lists.
        ];
    }

    /**
     * Return new object by closure.
     *
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
}
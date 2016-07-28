<?php

namespace SellerWorks\Amazon\Common\Serializer;

use ReflectionProperty;
use Sabre\Xml\Deserializer;
use Sabre\Xml\Reader;
use Sabre\Xml\Service;

use SellerWorks\Amazon\Common\Entity\ResponseMetadata;
use SellerWorks\Amazon\Common\Response\ErrorResponse;
use SellerWorks\Amazon\Common\Response\GetServiceStatusResponse;
use SellerWorks\Amazon\Common\Result\Error;
use SellerWorks\Amazon\Common\Result\GetServiceStatusResult;

/**
 * Defines how to deserialize xml using Sabre\Xml
 */
abstract class XmlDeserializer extends Service
{
    /**
     * @const string Namespace
     */
    const NS = '';

    /**
     * Add all objects to the service.
     */
    public function __construct()
    {
        $namespace = static::NS;
        $commentElements = [
            // Common objects.
            "{$namespace}Error" => $this->mapObject(Error::class),
            "{$namespace}ErrorResponse" => $this->mapObject(ErrorResponse::class),
            "{$namespace}GetServiceStatusResponse" => $this->mapObject(GetServiceStatusResponse::class),
            "{$namespace}GetServiceStatusResult" => $this->mapObject(GetServiceStatusResult::class),

            // Types,
            "{$namespace}ResponseMetadata" => $this->mapObject(ResponseMetadata::class),
        ];

        $this->elementMap = array_merge($commentElements, $this->getElementMap());
    }

    /**
     * Local element map.
     *
     * @return array
     */
    public function getElementMap()
    {
        return [];
    }

    /**
     * Return new object by closure.
     *
     * @param  string $className
     * @return Closure
     */
    protected function mapObject($className)
    {
        $namespace = static::NS;

        return function(Reader $reader) use ($namespace, $className) {
            $object = new $className;
            $values = Deserializer\keyValue($reader, $namespace);

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
    protected function mapCollectionObject($childElementName, $className)
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
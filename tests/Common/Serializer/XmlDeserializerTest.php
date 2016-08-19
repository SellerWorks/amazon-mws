<?php

namespace SellerWorks\Amazon\Tests\Common\Serializer;

use DateTime;
use ReflectionMethod;
use StdClass;
use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\Common\Serializer\Serializer;

/**
 * XmlDeserializer tests
 */
class XmlDeserializerTest extends TestCase
{
    /**
     * Test getElementMap
     */
    public function test_getElementMap()
    {
        $serializer = new XmlDeserializerStub;
        $this->assertSame([], $serializer->getElementMap());
    }
}

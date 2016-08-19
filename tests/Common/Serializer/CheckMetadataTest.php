<?php

namespace SellerWorks\Amazon\Tests\Common\Serializer;

use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\Common\Serializer\MetadataInterface;
use SellerWorks\Amazon\Tests\FulfillmentInbound;
use SellerWorks\Amazon\Tests\Orders;

/**
 * Serializer metadata tests
 */
class CheckMetadataTest extends TestCase
{
    /**
     * Test for metadata interface on objects.
     */
    public function test_check_for_metadata_interface()
    {
        $check = array_merge(
            FulfillmentInbound\Serializer\CheckMetadata::getMetadataClasses(),
            Orders\Serializer\CheckMetadata::getMetadataClasses()
        );

        foreach ($check as $i) {
            $obj   = new $i;
            $props = get_object_vars($obj);
            $error = 'Class: '.$i;

            if (!$obj instanceof MetadataInterface) {
                // Not everything will have this.
                continue;
            }

            $this->assertTrue($obj instanceof MetadataInterface, $error);
            $this->assertTrue(is_array($obj->getMetadata()), $error);
            $this->assertEquals(array_keys($props), array_keys($obj->getMetadata()), $error);

            $valid = ['array', 'boolean', 'choice', 'date', 'datetime', 'object', 'range', 'scalar'];

            foreach ($obj->getMetadata() as $k) {
                $this->assertTrue(isset($k['type']), $error);
                $this->assertTrue(in_array($k['type'], $valid), $error);

                switch ($k['type']) {
                    case 'array':
                        $this->assertTrue(isset($k['subtype']), $error);
                        $this->assertTrue(!empty($k['subtype']), $error);
                        $this->assertTrue(class_exists($k['subtype']), $error);

                        if (isset($k['namespace'])) {
                            $this->assertTrue(!empty($k['namespace']), $error);
                        }
                        break;

                    case 'choice':
                        if (isset($k['choices'])) {
                            $this->assertTrue(is_array($k['choices']), $error);
                            $this->assertTrue(!empty($k['choices']), $error);
                        }

                        if (isset($k['multiple'])) {
                            $this->assertTrue(is_bool($k['multiple']), $error);
                        }

                        if (isset($k['namespace'])) {
                            $this->assertTrue(!empty($k['namespace']), $error);
                        }
                        break;

                    case 'object':
                        $this->assertTrue(isset($k['subtype']), $error);
                        $this->assertTrue(!empty($k['subtype']), $error);
                        $this->assertTrue(class_exists($k['subtype']), $error);
                        break;

                    default: break;
                }
            }
        }
    }
}

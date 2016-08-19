<?php

namespace SellerWorks\Amazon\Tests\Common\Serializer;

use DateTime;
use ReflectionMethod;
use StdClass;
use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\Common\Serializer\Serializer;

/**
 * Serializer metadata tests
 */
class SerializerTest extends TestCase
{
    private $reflection;
    private $serializer;

    public function setUp()
    {
        $this->serializer = new Serializer;

        $this->reflection = new ReflectionMethod($this->serializer, 'flatten');
        $this->reflection->setAccessible(true);
    }

    public function flatten($obj)
    {
        return $this->reflection->invoke($this->serializer, $obj);
    }

    /**
     * Test serialize
     */
    public function test_serialize()
    {
        $object = new SerializerStub;
        $this->assertSame($object, $this->serializer->serialize($object));
    }

    /**
     * Test unserialize
     */
    public function test_unserialize()
    {
        $text = uniqid();
        $this->assertEquals($text, $this->serializer->unserialize($text));
    }

    /**
     * Test flatten.array
     */
    public function test_serialize_array()
    {
        $object = new SerializerStub;

        $test = new SerializerStub;
        $test->_scalar = 'String';

        // Empty.
        $object->_array = [];
        $this->assertEquals([], $this->flatten($object));

        // Single.
        $object->_array = [$test];
        $this->assertEquals($this->flatten($object), [
            '_array.key.1._scalar' => 'String',
        ]);

        // Multi.
        $object->_array = [$test, $test, $test, $test];
        $this->assertEquals($this->flatten($object), [
            '_array.key.1._scalar' => 'String',
            '_array.key.2._scalar' => 'String',
            '_array.key.3._scalar' => 'String',
            '_array.key.4._scalar' => 'String',
        ]);

        // Non-array.
        $object->_array = 'non-array';
        $this->assertEquals($this->flatten($object), []);
    }

    /**
     * Test flatten.boolean
     */
    public function test_serialize_boolean()
    {
        $object = new SerializerStub;

        // (bool) true.
        $object->_boolean = true;
        $this->assertEquals($this->flatten($object), [
            '_boolean' => 'true',
        ]);

        // (bool) false.
        $object->_boolean = false;
        $this->assertEquals($this->flatten($object), [
            '_boolean' => 'false',
        ]);

        // (string) true.
        $object->_boolean = 'true';
        $this->assertEquals($this->flatten($object), [
            '_boolean' => 'true',
        ]);

        // (string) false.
        $object->_boolean = 'false';
        $this->assertEquals($this->flatten($object), [
            '_boolean' => 'false',
        ]);

        // Non-boolean value.
        $object->_boolean = 'monster';
        $this->assertEquals($this->flatten($object), []);
    }

    /**
     * Test flatten.choice
     */
    public function test_serialize_choice()
    {
        $object = new SerializerStub;

        // Empty choice.
        $object->_choice = '';
        $this->assertEquals($this->flatten($object), []);

        // Any choice.
        $object->_choice = 'valid';
        $this->assertEquals($this->flatten($object), [
            '_choice' => 'valid',
        ]);

        // Try to do a multiple choice, only take first value.
        $object->_choice = ['valid', 'valid_2'];
        $this->assertEquals($this->flatten($object), [
            '_choice' => 'valid',
        ]);

        $object->_choice = null;

        // Valid choice.
        $object->_choiceV = 'valid';
        $this->assertEquals($this->flatten($object), [
            '_choiceV' => 'valid',
        ]);

        $object->_choiceV = 'valid_2';
        $this->assertEquals($this->flatten($object), [
            '_choiceV' => 'valid_2',
        ]);

        // Invalid choice.
        $object->_choiceV = 'invalid';
        $this->assertEquals($this->flatten($object), []);

        $object->_choiceV = null;

        // Multichoice.
        $object->_choiceM = ['valid', 'valid_2'];
        $this->assertEquals($this->flatten($object), [
            '_choiceM.key.1' => 'valid',
            '_choiceM.key.2' => 'valid_2',
        ]);

        $object->_choiceM = null;

        // Multichoice and validation.
        $object->_choiceMV = ['valid', 'valid_2', 'invalid'];
        $this->assertEquals($this->flatten($object), [
            '_choiceMV.key.1' => 'valid',
            '_choiceMV.key.2' => 'valid_2',
        ]);
    }

    /**
     * Test flatten.datetime
     */
    public function test_serialize_datetime()
    {
        $object = new SerializerStub;

        // Empty choice.
        $object->_datetime = '';
        $this->assertEquals($this->flatten($object), []);

        // Object.
        $object->_datetime = new DateTime('2014-01-01T00:00:00+00:00');
        $this->assertEquals($this->flatten($object), [
            '_datetime' => '2014-01-01 00:00:00',
        ]);

        // String.
        $object->_datetime = '2013-01-01 00:00:00+00:00';
        $this->assertEquals($this->flatten($object), [
            '_datetime' => '2013-01-01 00:00:00',
        ]);

        $object->_datetime = null;

        // Empty choice.
        $object->_date = '';
        $this->assertEquals($this->flatten($object), []);

        // Object.
        $object->_date = new DateTime('2014-01-01T00:00:00+00:00');
        $this->assertEquals($this->flatten($object), [
            '_date' => '2014-01-01',
        ]);

        // String.
        $object->_date = '2013-01-01 00:00:00+00:00';
        $this->assertEquals($this->flatten($object), [
            '_date' => '2013-01-01',
        ]);
    }

    /**
     * Test flatten.object
     */
    public function test_serialize_object()
    {
        $object = new SerializerStub;

        $test = new SerializerStub;
        $test->_scalar = 'String';

        // Empty choice.
        $object->_object = '';
        $this->assertEquals($this->flatten($object), []);

        // Right choice.
        $object->_object = $test;
        $this->assertEquals($this->flatten($object), [
            '_object._scalar' => 'String',
        ]);

        // Wrong choice.
        $object->_object = new \StdClass;
        $this->assertEquals($this->flatten($object), []);
    }

    /**
     * Test flatten.range
     */
    public function test_serialize_range()
    {
        $object = new SerializerStub;

        // Empty choice.
        $object->_range = '';
        $this->assertEquals($this->flatten($object), []);

        // Valid value.
        $object->_range = '10';
        $this->assertEquals($this->flatten($object), [
            '_range' => '10',
        ]);

        // Invalid value.
        $object->_range = 100;
        $this->assertEquals($this->flatten($object), []);
    }

    /**
     * Test flatten.scalar
     */
    public function test_serialize_scalar()
    {
        $object = new SerializerStub;

        // Empty choice.
        $object->_scalar = '';
        $this->assertEquals($this->flatten($object), []);

        // Valid value.
        $object->_scalar = 'scalar';
        $this->assertEquals($this->flatten($object), [
            '_scalar' => 'scalar',
        ]);

        // Invalid value.
        $object->_scalar = new \StdClass;
        $this->assertEquals($this->flatten($object), []);
    }
}

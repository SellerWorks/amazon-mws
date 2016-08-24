<?php

namespace SellerWorks\Amazon\Tests\Reports\Serializer;

use PHPUnit\Framework\TestCase;
use SellerWorks\Amazon\Reports\Serializer\Serializer;

/**
 * Serializer tests
 */
class BadRequestSerializerTest extends TestCase
{
    /**
     * Test BadRequest.
     */
    public function test_BadRequest()
    {
        if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
            $this->expectException(\Exception::class);
        } else {
            $this->expectException(\UnexpectedValueException::class);
        }

        $serializer = new Serializer;
        $request    = new BadRequest;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'Bad',
        ];
    }
}

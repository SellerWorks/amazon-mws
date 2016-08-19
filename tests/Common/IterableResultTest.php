<?php

namespace SellerWorks\Amazon\Tests\Common;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Promise\PromiseInterface;

use ReflectionProperty;
use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\Credentials\Credentials;
use SellerWorks\Amazon\Orders;

/**
 * Serializer metadata tests
 */
class IterableResultTest extends TestCase
{
    private $stack;
    private $client;

    public function setUp()
    {
        $this->stack = new MockHandler;
        $guzzle = new GuzzleClient(['handler' => HandlerStack::create($this->stack)]);

        $this->client = new Orders\Client(new Credentials('SELLER_ID', 'ACCESS_KEY', 'SECRET_KEY'));
        $reflection = new ReflectionProperty($this->client, 'guzzle');
        $reflection->setAccessible(true);
        $reflection->setValue($this->client, $guzzle);
    }

    /**
     * Test an empty iterator.
     */
    public function test_empty_iterator()
    {
        $obj = new IterableResultStub(0);
        $obj->setClient($this->client);

        $iterator = $obj->getIterator();

        $this->assertEquals(0, $iterator->count());
        $this->assertEquals(0, $iterator->key());
        $this->assertEquals(null, $iterator->next());
        $this->assertEquals(0, $iterator->rewind());
        $this->assertFalse($iterator->valid());
    }

    /**
     * Test a hydrated iterator.
     */
    public function test_hydated_iterator()
    {
        $response1 = file_get_contents(__DIR__.'/Mock/ListOrdersResponse.xml');
        $response2 = file_get_contents(__DIR__.'/Mock/ListOrdersByNextTokenResponse.xml');
        $this->stack->append(new Response(200, [], $response1));
        $this->stack->append(new Response(200, [], $response2));

        $result   = $this->client->ListOrders(new Orders\Request\ListOrdersRequest);
        $iterator = $result->getIterator();

        $this->assertEquals(1, $iterator->count());
        $this->assertTrue($iterator->current() instanceof Orders\Entity\Order);
        $this->assertEquals(0, $iterator->key());
        $this->assertEquals(0, $iterator->rewind());
        $this->assertTrue($iterator->valid());

        foreach ($result as $order) {
            $this->assertTrue($order instanceof Orders\Entity\Order);
        }
    }
}

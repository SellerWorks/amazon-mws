<?php

namespace SellerWorks\Amazon\Tests\FulfillmentInbound;

use Faker;
use ReflectionProperty;
use PHPUnit\Framework\TestCase;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Promise\PromiseInterface;

use SellerWorks\Amazon\Credentials\Credentials;
use SellerWorks\Amazon\FulfillmentInbound\Client;
use SellerWorks\Amazon\FulfillmentInbound\Entity;
use SellerWorks\Amazon\FulfillmentInbound\Request;
use SellerWorks\Amazon\FulfillmentInbound\Result;
use SellerWorks\Amazon\FulfillmentInbound\Serializer\Serializer;

/**
 * Serializer tests
 */
class ClientPlumbingTest extends TestCase
{
    private $client;
    private $stack;

    private $faker;

    public function setUp()
    {
        $this->stack = new MockHandler;
        $guzzle = new GuzzleClient(['handler' => HandlerStack::create($this->stack)]);

        $this->client = new Client(new Credentials('SELLER_ID', 'ACCESS_KEY', 'SECRET_KEY'));
        $reflection = new ReflectionProperty($this->client, 'guzzle');
        $reflection->setAccessible(true);
        $reflection->setValue($this->client, $guzzle);

        $this->faker = Faker\Factory::create();
    }

    /**
     * Test CreateInboundShipmentPlan
     */
    public function test_CreateInboundShipmentPlanRequest()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/CreateInboundShipmentPlanResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->CreateInboundShipmentPlan(new Request\CreateInboundShipmentPlanRequest);
        $this->assertTrue($result instanceof Result\CreateInboundShipmentPlanResult);

        $expected = new Result\CreateInboundShipmentPlanResult;
        $expected->InboundShipmentPlans = [];

        $plan = new Entity\InboundShipmentPlan;
        $plan->ShipmentId = 'String';
        $plan->DestinationFulfillmentCenterId = 'String';
        $plan->ShipToAddress = new Entity\Address;
        $plan->ShipToAddress->Name = 'String';
        $plan->ShipToAddress->AddressLine1 = 'String';
        $plan->ShipToAddress->AddressLine2 = 'String';
        $plan->ShipToAddress->DistrictOrCounty = 'String';
        $plan->ShipToAddress->City = 'String';
        $plan->ShipToAddress->StateOrProvinceCode = 'String';
        $plan->ShipToAddress->CountryCode = 'String';
        $plan->ShipToAddress->PostalCode = 'String';
        $plan->LabelPrepType = 'String';
        $plan->Items = [];
//         $plan->EstimatedBoxContentsFee = new Entity\EstimatedBoxContentsFee;

        $item = new Entity\InboundShipmentPlanItem;
        $item->SellerSKU = 'String';
        $item->FulfillmentNetworkSKU = 'String';
        $item->Quantity = '1';
        $item->PrepDetailsList = [];
        
        $prep = new Entity\PrepDetails;
        $prep->PrepInstruction = 'String';
        $prep->PrepOwner = 'String';

        $item->PrepDetailsList[] = $prep;
        $plan->Items[] = $item;
        $expected->InboundShipmentPlans[] = $plan;

        $this->assertEquals($result, $expected);
    }

    /**
     * Test GetServiceStatusAsync
     */
    public function test_CreateInboundShipmentPlanRequestAsync()
    {

    }

    /**
     * Test GetServiceStatus
     */
    public function test_GetServiceStatus()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetServiceStatusResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->GetServiceStatus();
        $this->assertTrue($result instanceof Result\GetServiceStatusResult);

        $expected = new Result\GetServiceStatusResult;
        $expected->Status = 'String';
        $expected->Timestamp = '1969-07-21T02:56:03Z';
        $this->assertEquals($result, $expected);
    }

    /**
     * Test GetServiceStatusAsync
     */
    public function test_GetServiceStatusAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetServiceStatusResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->GetServiceStatusAsync();
        $this->assertTrue($promise instanceof PromiseInterface);
        
        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\GetServiceStatusResult);
    }
}

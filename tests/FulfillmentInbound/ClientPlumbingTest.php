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

use SellerWorks\Amazon\Common\IterableResultInterface;
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
    public function test_CreateInboundShipmentPlan()
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
        $plan->EstimatedBoxContentsFee = new Entity\BoxContentsFeeDetails;
        $plan->EstimatedBoxContentsFee->TotalUnits = '1';
        $plan->EstimatedBoxContentsFee->FeePerUnit = new Entity\Amount;
        $plan->EstimatedBoxContentsFee->FeePerUnit->CurrencyCode = 'String';
        $plan->EstimatedBoxContentsFee->FeePerUnit->Value = '100';
        $plan->EstimatedBoxContentsFee->TotalFee = new Entity\Amount;
        $plan->EstimatedBoxContentsFee->TotalFee->CurrencyCode = 'String';
        $plan->EstimatedBoxContentsFee->TotalFee->Value = '100';

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

        $this->assertEquals($expected, $result);
    }

    /**
     * Test CreateInboundShipmentPlanAsync
     */
    public function test_CreateInboundShipmentPlanAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/CreateInboundShipmentPlanResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->CreateInboundShipmentPlanAsync(new Request\CreateInboundShipmentPlanRequest);
        $this->assertTrue($promise instanceof PromiseInterface);
        
        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\CreateInboundShipmentPlanResult);
    }

    /**
     * Test CreateInboundShipment
     */
    public function test_CreateInboundShipment()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/CreateInboundShipmentResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->CreateInboundShipment(new Request\CreateInboundShipmentRequest);
        $this->assertTrue($result instanceof Result\CreateInboundShipmentResult);

        $expected = new Result\CreateInboundShipmentResult;
        $expected->ShipmentId = 'String';

        $this->assertEquals($expected, $result);
    }

    /**
     * Test CreateInboundShipmentAsync
     */
    public function test_CreateInboundShipmentAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/CreateInboundShipmentResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->CreateInboundShipmentAsync(new Request\CreateInboundShipmentRequest);
        $this->assertTrue($promise instanceof PromiseInterface);
        
        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\CreateInboundShipmentResult);
    }

    /**
     * Test UpdateInboundShipment
     */
    public function test_UpdateInboundShipment()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/UpdateInboundShipmentResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->UpdateInboundShipment(new Request\UpdateInboundShipmentRequest);
        $this->assertTrue($result instanceof Result\UpdateInboundShipmentResult);

        $expected = new Result\UpdateInboundShipmentResult;
        $expected->ShipmentId = 'String';

        $this->assertEquals($expected, $result);
    }

    /**
     * Test UpdateInboundShipmentAsync
     */
    public function test_UpdateInboundShipmentAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/UpdateInboundShipmentResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->UpdateInboundShipmentAsync(new Request\UpdateInboundShipmentRequest);
        $this->assertTrue($promise instanceof PromiseInterface);
        
        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\UpdateInboundShipmentResult);
    }

    /**
     * Test GetPrepInstructionsForSKU
     */
    public function test_GetPrepInstructionsForSKU()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetPrepInstructionsForSKUResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->GetPrepInstructionsForSKU(new Request\GetPrepInstructionsForSKURequest);
        $this->assertTrue($result instanceof Result\GetPrepInstructionsForSKUResult);

        $inst = new Entity\SKUPrepInstructions;
        $inst->SellerSKU = 'String';
        $inst->ASIN = 'String';
        $inst->BarcodeInstruction = 'String';
        $inst->PrepGuidance = 'String';
        $inst->PrepInstructionList = ['String'];
        $inst->AmazonPrepFeesDetailsList = [];

        $det = new Entity\AmazonPrepFeesDetails;
        $det->PrepInstruction = 'String';
        $det->FeePerUnit = new Entity\Amount;
        $det->FeePerUnit->CurrencyCode = 'String';
        $det->FeePerUnit->Value = '100';

        $inst->AmazonPrepFeesDetailsList[] = $det;

        $invalid = new Entity\InvalidSKU;
        $invalid->SellerSKU = 'String';
        $invalid->ErrorReason = 'String';

        $expected = new Result\GetPrepInstructionsForSKUResult;
        $expected->SKUPrepInstructionsList = [$inst];
        $expected->InvalidSKUList = [$invalid];

        $this->assertEquals($expected, $result);
    }

    /**
     * Test GetPrepInstructionsForSKUAsync
     */
    public function test_GetPrepInstructionsForSKUAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetPrepInstructionsForSKUResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->GetPrepInstructionsForSKUAsync(new Request\GetPrepInstructionsForSKURequest);
        $this->assertTrue($promise instanceof PromiseInterface);
        
        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\GetPrepInstructionsForSKUResult);
    }

    /**
     * Test GetPrepInstructionsForASIN
     */
    public function test_GetPrepInstructionsForASIN()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetPrepInstructionsForASINResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->GetPrepInstructionsForASIN(new Request\GetPrepInstructionsForASINRequest);
        $this->assertTrue($result instanceof Result\GetPrepInstructionsForASINResult);

        $inst = new Entity\ASINPrepInstructions;
        $inst->ASIN = 'String';
        $inst->BarcodeInstruction = 'String';
        $inst->PrepGuidance = 'String';
        $inst->PrepInstructionList = ['String'];

        $invalid = new Entity\InvalidASIN;
        $invalid->ASIN = 'String';
        $invalid->ErrorReason = 'String';

        $expected = new Result\GetPrepInstructionsForASINResult;
        $expected->ASINPrepInstructionsList = [$inst];
        $expected->InvalidASINList = [$invalid];

        $this->assertEquals($expected, $result);
    }

    /**
     * Test GetPrepInstructionsForASINAsync
     */
    public function test_GetPrepInstructionsForASINAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetPrepInstructionsForASINResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->GetPrepInstructionsForASINAsync(new Request\GetPrepInstructionsForASINRequest);
        $this->assertTrue($promise instanceof PromiseInterface);
        
        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\GetPrepInstructionsForASINResult);
    }

    /**
     * Test ListInboundShipments
     */
    public function test_ListInboundShipments()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/ListInboundShipmentsResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->ListInboundShipments(new Request\ListInboundShipmentsRequest);
        $this->assertTrue($result instanceof Result\ListInboundShipmentsResult);
        $this->assertTrue($result instanceof IterableResultInterface);

        $info = new Entity\InboundShipmentInfo;
        $info->ShipmentId = 'String';
        $info->ShipmentName = 'String';
        $info->ShipFromAddress = new Entity\Address;
        $info->ShipFromAddress->Name = 'String';
        $info->ShipFromAddress->AddressLine1 = 'String';
        $info->ShipFromAddress->AddressLine2 = 'String';
        $info->ShipFromAddress->DistrictOrCounty = 'String';
        $info->ShipFromAddress->City = 'String';
        $info->ShipFromAddress->StateOrProvinceCode = 'String';
        $info->ShipFromAddress->CountryCode = 'String';
        $info->ShipFromAddress->PostalCode = 'String';
        $info->DestinationFulfillmentCenterId = 'String';
        $info->ShipmentStatus = 'String';
        $info->LabelPrepType = 'String';
        $info->AreCasesRequired = 'true';
        $info->ConfirmedNeedByDate = 'String';
        $info->BoxContentsSource = 'String';
        $info->EstimatedBoxContentsFee = new Entity\BoxContentsFeeDetails;
        $info->EstimatedBoxContentsFee->TotalUnits = '1';
        $info->EstimatedBoxContentsFee->FeePerUnit = new Entity\Amount;
        $info->EstimatedBoxContentsFee->FeePerUnit->CurrencyCode = 'String';
        $info->EstimatedBoxContentsFee->FeePerUnit->Value = '100';
        $info->EstimatedBoxContentsFee->TotalFee = new Entity\Amount;
        $info->EstimatedBoxContentsFee->TotalFee->CurrencyCode = 'String';
        $info->EstimatedBoxContentsFee->TotalFee->Value = '100';

        $expected = new Result\ListInboundShipmentsResult;
        $expected->NextToken = 'String';
        $expected->ShipmentData = [$info];

        // Check each part separately to avoid checking extra features of IterableResultInterface.
        $this->assertEquals($expected->NextToken, $result->NextToken);
        $this->assertEquals($expected->ShipmentData, $result->ShipmentData);
    }

    /**
     * Test ListInboundShipmentsAsync
     */
    public function test_ListInboundShipmentsAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/ListInboundShipmentsResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->ListInboundShipmentsAsync(new Request\ListInboundShipmentsRequest);
        $this->assertTrue($promise instanceof PromiseInterface);
        
        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\ListInboundShipmentsResult);
    }

    /**
     * Test ListInboundShipmentsByNextToken
     */
    public function test_ListInboundShipmentsByNextToken()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/ListInboundShipmentsByNextTokenResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->ListInboundShipmentsByNextToken(new Request\ListInboundShipmentsByNextTokenRequest);
        $this->assertTrue($result instanceof Result\ListInboundShipmentsResult);
        $this->assertTrue($result instanceof IterableResultInterface);

        $info = new Entity\InboundShipmentInfo;
        $info->ShipmentId = 'String';
        $info->ShipmentName = 'String';
        $info->ShipFromAddress = new Entity\Address;
        $info->ShipFromAddress->Name = 'String';
        $info->ShipFromAddress->AddressLine1 = 'String';
        $info->ShipFromAddress->AddressLine2 = 'String';
        $info->ShipFromAddress->DistrictOrCounty = 'String';
        $info->ShipFromAddress->City = 'String';
        $info->ShipFromAddress->StateOrProvinceCode = 'String';
        $info->ShipFromAddress->CountryCode = 'String';
        $info->ShipFromAddress->PostalCode = 'String';
        $info->DestinationFulfillmentCenterId = 'String';
        $info->ShipmentStatus = 'String';
        $info->LabelPrepType = 'String';
        $info->AreCasesRequired = 'true';
        $info->ConfirmedNeedByDate = 'String';
        $info->BoxContentsSource = 'String';
        $info->EstimatedBoxContentsFee = new Entity\BoxContentsFeeDetails;
        $info->EstimatedBoxContentsFee->TotalUnits = '1';
        $info->EstimatedBoxContentsFee->FeePerUnit = new Entity\Amount;
        $info->EstimatedBoxContentsFee->FeePerUnit->CurrencyCode = 'String';
        $info->EstimatedBoxContentsFee->FeePerUnit->Value = '100';
        $info->EstimatedBoxContentsFee->TotalFee = new Entity\Amount;
        $info->EstimatedBoxContentsFee->TotalFee->CurrencyCode = 'String';
        $info->EstimatedBoxContentsFee->TotalFee->Value = '100';

        $expected = new Result\ListInboundShipmentsResult;
        $expected->NextToken = 'String';
        $expected->ShipmentData = [$info];

        // Check each part separately to avoid checking extra features of IterableResultInterface.
        $this->assertEquals($expected->NextToken, $result->NextToken);
        $this->assertEquals($expected->ShipmentData, $result->ShipmentData);
    }

    /**
     * Test ListInboundShipmentsByNextTokenAsync
     */
    public function test_ListInboundShipmentsByNextTokenAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/ListInboundShipmentsByNextTokenResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->ListInboundShipmentsByNextTokenAsync(new Request\ListInboundShipmentsByNextTokenRequest);
        $this->assertTrue($promise instanceof PromiseInterface);
        
        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\ListInboundShipmentsResult);
    }

    /**
     * Test ListInboundShipmentItems
     */
    public function test_ListInboundShipmentItems()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/ListInboundShipmentItemsResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->ListInboundShipmentItems(new Request\ListInboundShipmentItemsRequest);
        $this->assertTrue($result instanceof Result\ListInboundShipmentItemsResult);
        $this->assertTrue($result instanceof IterableResultInterface);

        $prep = new Entity\PrepDetails;
        $prep->PrepInstruction = 'String';
        $prep->PrepOwner = 'String';

        $item = new Entity\InboundShipmentItem;
        $item->ShipmentId = 'String';
        $item->SellerSKU = 'String';
        $item->FulfillmentNetworkSKU = 'String';
        $item->QuantityShipped = '1';
        $item->QuantityReceived = '1';
        $item->QuantityInCase = '1';
        $item->PrepDetailsList = [$prep];
        $item->ReleaseDate = 'String';

        $expected = new Result\ListInboundShipmentsResult;
        $expected->NextToken = 'String';
        $expected->ItemData = [$item];

        // Check each part separately to avoid checking extra features of IterableResultInterface.
        $this->assertEquals($expected->NextToken, $result->NextToken);
        $this->assertEquals($expected->ItemData, $result->ItemData);
    }

    /**
     * Test ListInboundShipmentItemsAsync
     */
    public function test_ListInboundShipmentItemsAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/ListInboundShipmentItemsResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->ListInboundShipmentItemsAsync(new Request\ListInboundShipmentItemsRequest);
        $this->assertTrue($promise instanceof PromiseInterface);
        
        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\ListInboundShipmentItemsResult);
    }

    /**
     * Test ListInboundShipmentItemsByNextToken
     */
    public function test_ListInboundShipmentItemsByNextToken()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/ListInboundShipmentItemsByNextTokenResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->ListInboundShipmentItemsByNextToken(new Request\ListInboundShipmentItemsByNextTokenRequest);
        $this->assertTrue($result instanceof Result\ListInboundShipmentItemsResult);
        $this->assertTrue($result instanceof IterableResultInterface);

        $prep = new Entity\PrepDetails;
        $prep->PrepInstruction = 'String';
        $prep->PrepOwner = 'String';

        $item = new Entity\InboundShipmentItem;
        $item->ShipmentId = 'String';
        $item->SellerSKU = 'String';
        $item->FulfillmentNetworkSKU = 'String';
        $item->QuantityShipped = '1';
        $item->QuantityReceived = '1';
        $item->QuantityInCase = '1';
        $item->PrepDetailsList = [$prep];
        $item->ReleaseDate = 'String';

        $expected = new Result\ListInboundShipmentsResult;
        $expected->NextToken = 'String';
        $expected->ItemData = [$item];

        // Check each part separately to avoid checking extra features of IterableResultInterface.
        $this->assertEquals($expected->NextToken, $result->NextToken);
        $this->assertEquals($expected->ItemData, $result->ItemData);
    }

    /**
     * Test ListInboundShipmentItemsByNextTokenAsync
     */
    public function test_ListInboundShipmentItemsByNextTokenAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/ListInboundShipmentItemsByNextTokenResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->ListInboundShipmentItemsByNextTokenAsync(new Request\ListInboundShipmentItemsByNextTokenRequest);
        $this->assertTrue($promise instanceof PromiseInterface);
        
        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\ListInboundShipmentItemsResult);
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

    /**
     * Test ErrorResponse
     */
    public function test_ErrorResponse()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/ErrorResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        // Calling any method here.
        $result = $this->client->GetServiceStatus();
        $this->assertTrue($result instanceof Result\Error);

        $expected = new Result\Error;
        $expected->Type = 'Sender';
        $expected->Code = 'string';
        $expected->Message = 'string';

        $this->assertEquals($result, $expected);
    }
}

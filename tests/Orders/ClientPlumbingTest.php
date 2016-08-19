<?php

namespace SellerWorks\Amazon\Tests\Orders;

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
use SellerWorks\Amazon\Orders\Client;
use SellerWorks\Amazon\Orders\Entity;
use SellerWorks\Amazon\Orders\Request;
use SellerWorks\Amazon\Orders\Result;
use SellerWorks\Amazon\Orders\Serializer\Serializer;

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
     * Test ListOrders
     */
    public function test_ListOrders()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/ListOrdersResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->ListOrders(new Request\ListOrdersRequest);
        $this->assertTrue($result instanceof Result\ListOrdersResult);

        $order = new Entity\Order;
        $order->AmazonOrderId = 'String';
        $order->SellerOrderId = 'String';
        $order->PurchaseDate = '1969-07-21T02:56:03Z';
        $order->LastUpdateDate = '1969-07-21T02:56:03Z';
        $order->OrderStatus = 'String';
        $order->FulfillmentChannel = 'String';
        $order->SalesChannel = 'String';
        $order->OrderChannel = 'String';
        $order->ShipServiceLevel = 'String';
        $order->NumberOfItemsShipped = '1';
        $order->NumberOfItemsUnshipped = '1';
        $order->PaymentMethod = 'String';
        $order->MarketplaceId = 'String';
        $order->BuyerEmail = 'String';
        $order->BuyerName = 'String';
        $order->ShipmentServiceLevelCategory = 'String';
        $order->ShippedByAmazonTFM = 'true';
        $order->TFMShipmentStatus = 'String';
        $order->CbaDisplayableShippingLabel = 'String';
        $order->OrderType = 'String';
        $order->EarliestShipDate = '1969-07-21T02:56:03Z';
        $order->LatestShipDate = '1969-07-21T02:56:03Z';
        $order->EarliestDeliveryDate = '1969-07-21T02:56:03Z';
        $order->LatestDeliveryDate = '1969-07-21T02:56:03Z';
        $order->IsBusinessOrder = 'true';
        $order->PurchaseOrderNumber = 'String';
        $order->IsPrime = 'true';
        $order->IsPremiumOrder = 'true';

        $order->ShippingAddress = new Entity\Address;
        $order->ShippingAddress->Name = 'String';
        $order->ShippingAddress->AddressLine1 = 'String';
        $order->ShippingAddress->AddressLine2 = 'String';
        $order->ShippingAddress->AddressLine3 = 'String';
        $order->ShippingAddress->City = 'String';
        $order->ShippingAddress->County = 'String';
        $order->ShippingAddress->District = 'String';
        $order->ShippingAddress->StateOrRegion = 'String';
        $order->ShippingAddress->PostalCode = 'String';
        $order->ShippingAddress->CountryCode = 'String';
        $order->ShippingAddress->Phone = 'String';

        $order->OrderTotal = new Entity\Money;
        $order->OrderTotal->CurrencyCode = 'String';
        $order->OrderTotal->Amount = 'String';

        $order->PaymentExecutionDetail = [];
        $order->PaymentExecutionDetail[0] = new Entity\PaymentExecutionDetailItem;
        $order->PaymentExecutionDetail[0]->Payment = new Entity\Money;
        $order->PaymentExecutionDetail[0]->Payment->CurrencyCode = 'String';
        $order->PaymentExecutionDetail[0]->Payment->Amount = 'String';
        $order->PaymentExecutionDetail[0]->PaymentMethod = 'String';

        $expected = new Result\ListOrdersResult;
        $expected->NextToken = 'String';
        $expected->LastUpdatedBefore = '1969-07-21T02:56:03Z';
        $expected->CreatedBefore = '1969-07-21T02:56:03Z';
        $expected->Orders = [$order];

        $this->assertEquals($expected->NextToken, $result->NextToken);
        $this->assertEquals($expected->LastUpdatedBefore, $result->LastUpdatedBefore);
        $this->assertEquals($expected->CreatedBefore, $result->CreatedBefore);
        $this->assertEquals($expected->Orders, $result->Orders);
    }

    /**
     * Test ListOrdersAsync
     */
    public function test_ListOrdersAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/ListOrdersResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->ListOrdersAsync(new Request\ListOrdersRequest);
        $this->assertTrue($promise instanceof PromiseInterface);
        
        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\ListOrdersResult);
    }

    /**
     * Test ListOrdersByNextToken
     */
    public function test_ListOrdersByNextToken()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/ListOrdersByNextTokenResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->ListOrdersByNextToken(new Request\ListOrdersByNextTokenRequest);
        $this->assertTrue($result instanceof Result\ListOrdersResult);

        $order = new Entity\Order;
        $order->AmazonOrderId = 'String';
        $order->SellerOrderId = 'String';
        $order->PurchaseDate = '1969-07-21T02:56:03Z';
        $order->LastUpdateDate = '1969-07-21T02:56:03Z';
        $order->OrderStatus = 'String';
        $order->FulfillmentChannel = 'String';
        $order->SalesChannel = 'String';
        $order->OrderChannel = 'String';
        $order->ShipServiceLevel = 'String';
        $order->NumberOfItemsShipped = '1';
        $order->NumberOfItemsUnshipped = '1';
        $order->PaymentMethod = 'String';
        $order->MarketplaceId = 'String';
        $order->BuyerEmail = 'String';
        $order->BuyerName = 'String';
        $order->ShipmentServiceLevelCategory = 'String';
        $order->ShippedByAmazonTFM = 'true';
        $order->TFMShipmentStatus = 'String';
        $order->CbaDisplayableShippingLabel = 'String';
        $order->OrderType = 'String';
        $order->EarliestShipDate = '1969-07-21T02:56:03Z';
        $order->LatestShipDate = '1969-07-21T02:56:03Z';
        $order->EarliestDeliveryDate = '1969-07-21T02:56:03Z';
        $order->LatestDeliveryDate = '1969-07-21T02:56:03Z';
        $order->IsBusinessOrder = 'true';
        $order->PurchaseOrderNumber = 'String';
        $order->IsPrime = 'true';
        $order->IsPremiumOrder = 'true';

        $order->ShippingAddress = new Entity\Address;
        $order->ShippingAddress->Name = 'String';
        $order->ShippingAddress->AddressLine1 = 'String';
        $order->ShippingAddress->AddressLine2 = 'String';
        $order->ShippingAddress->AddressLine3 = 'String';
        $order->ShippingAddress->City = 'String';
        $order->ShippingAddress->County = 'String';
        $order->ShippingAddress->District = 'String';
        $order->ShippingAddress->StateOrRegion = 'String';
        $order->ShippingAddress->PostalCode = 'String';
        $order->ShippingAddress->CountryCode = 'String';
        $order->ShippingAddress->Phone = 'String';

        $order->OrderTotal = new Entity\Money;
        $order->OrderTotal->CurrencyCode = 'String';
        $order->OrderTotal->Amount = 'String';

        $order->PaymentExecutionDetail = [];
        $order->PaymentExecutionDetail[0] = new Entity\PaymentExecutionDetailItem;
        $order->PaymentExecutionDetail[0]->Payment = new Entity\Money;
        $order->PaymentExecutionDetail[0]->Payment->CurrencyCode = 'String';
        $order->PaymentExecutionDetail[0]->Payment->Amount = 'String';
        $order->PaymentExecutionDetail[0]->PaymentMethod = 'String';

        $expected = new Result\ListOrdersResult;
        $expected->NextToken = 'String';
        $expected->LastUpdatedBefore = '1969-07-21T02:56:03Z';
        $expected->CreatedBefore = '1969-07-21T02:56:03Z';
        $expected->Orders = [$order];

        $this->assertEquals($expected->NextToken, $result->NextToken);
        $this->assertEquals($expected->LastUpdatedBefore, $result->LastUpdatedBefore);
        $this->assertEquals($expected->CreatedBefore, $result->CreatedBefore);
        $this->assertEquals($expected->Orders, $result->Orders);
    }

    /**
     * Test ListOrdersByNextTokenAsync
     */
    public function test_ListOrdersByNextTokenAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/ListOrdersByNextTokenResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->ListOrdersByNextTokenAsync(new Request\ListOrdersByNextTokenRequest);
        $this->assertTrue($promise instanceof PromiseInterface);
        
        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\ListOrdersResult);
    }

    /**
     * Test ListOrderItems
     */
    public function test_ListOrderItems()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/ListOrderItemsResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->ListOrderItems(new Request\ListOrderItemsRequest);
        $this->assertTrue($result instanceof Result\ListOrderItemsResult);

        $money = new Entity\Money;
        $money->CurrencyCode = 'String';
        $money->Amount = 'String';

        $item = new Entity\OrderItem;
        $item->ASIN = 'String';
        $item->SellerSKU = 'String';
        $item->OrderItemId = 'String';
        $item->Title = 'String';
        $item->QuantityOrdered = '1';
        $item->QuantityShipped = '1';

        $item->PointsGranted = new Entity\PointsGranted;
        $item->PointsGranted->PointsNumber = '1';
        $item->PointsGranted->PointsMonetaryValue = $money;

        $item->ItemPrice = $money;
        $item->ShippingPrice = $money;
        $item->GiftWrapPrice = $money;
        $item->ItemTax = $money;
        $item->ShippingTax = $money;
        $item->GiftWrapTax = $money;
        $item->ShippingDiscount = $money;
        $item->PromotionDiscount = $money;
        $item->PromotionIds = ['String'];
        $item->CODFee = $money;
        $item->CODFeeDiscount = $money;

        $item->GiftMessageText = 'String';
        $item->GiftWrapLevel = 'String';

        $item->InvoiceData = new Entity\InvoiceData;
        $item->InvoiceData->InvoiceRequirement = 'String';
        $item->InvoiceData->BuyerSelectedInvoiceCategory = 'String';
        $item->InvoiceData->InvoiceTitle = 'String';
        $item->InvoiceData->InvoiceInformation = 'String';

        $item->ConditionNote = 'String';
        $item->ConditionId = 'String';
        $item->ConditionSubtypeId = 'String';
        $item->ScheduledDeliveryStartDate = 'String';
        $item->ScheduledDeliveryEndDate = 'String';
        $item->PriceDesignation = 'String';

        $item->BuyerCustomizedInfo = new Entity\BuyerCustomizedInfo;
        $item->BuyerCustomizedInfo->CustomizedURL = 'String';

        $expected = new Result\ListOrderItemsResult;
        $expected->NextToken = 'String';
        $expected->AmazonOrderId = 'String';
        $expected->OrderItems = [$item];

        $this->assertEquals($expected->NextToken, $result->NextToken);
        $this->assertEquals($expected->AmazonOrderId, $result->AmazonOrderId);
        $this->assertEquals($expected->OrderItems, $result->OrderItems);
    }

    /**
     * Test ListOrderItemsAsync
     */
    public function test_ListOrderItemsAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/ListOrderItemsResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->ListOrderItemsAsync(new Request\ListOrderItemsRequest);
        $this->assertTrue($promise instanceof PromiseInterface);
        
        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\ListOrderItemsResult);
    }

    /**
     * Test ListOrderItemsByNextToken
     */
    public function test_ListOrderItemsByNextToken()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/ListOrderItemsByNextTokenResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->ListOrderItemsByNextToken(new Request\ListOrderItemsByNextTokenRequest);
        $this->assertTrue($result instanceof Result\ListOrderItemsResult);

        $money = new Entity\Money;
        $money->CurrencyCode = 'String';
        $money->Amount = 'String';

        $item = new Entity\OrderItem;
        $item->ASIN = 'String';
        $item->SellerSKU = 'String';
        $item->OrderItemId = 'String';
        $item->Title = 'String';
        $item->QuantityOrdered = '1';
        $item->QuantityShipped = '1';

        $item->PointsGranted = new Entity\PointsGranted;
        $item->PointsGranted->PointsNumber = '1';
        $item->PointsGranted->PointsMonetaryValue = $money;

        $item->ItemPrice = $money;
        $item->ShippingPrice = $money;
        $item->GiftWrapPrice = $money;
        $item->ItemTax = $money;
        $item->ShippingTax = $money;
        $item->GiftWrapTax = $money;
        $item->ShippingDiscount = $money;
        $item->PromotionDiscount = $money;
        $item->PromotionIds = ['String'];
        $item->CODFee = $money;
        $item->CODFeeDiscount = $money;

        $item->GiftMessageText = 'String';
        $item->GiftWrapLevel = 'String';

        $item->InvoiceData = new Entity\InvoiceData;
        $item->InvoiceData->InvoiceRequirement = 'String';
        $item->InvoiceData->BuyerSelectedInvoiceCategory = 'String';
        $item->InvoiceData->InvoiceTitle = 'String';
        $item->InvoiceData->InvoiceInformation = 'String';

        $item->ConditionNote = 'String';
        $item->ConditionId = 'String';
        $item->ConditionSubtypeId = 'String';
        $item->ScheduledDeliveryStartDate = 'String';
        $item->ScheduledDeliveryEndDate = 'String';
        $item->PriceDesignation = 'String';

        $item->BuyerCustomizedInfo = new Entity\BuyerCustomizedInfo;
        $item->BuyerCustomizedInfo->CustomizedURL = 'String';

        $expected = new Result\ListOrderItemsResult;
        $expected->NextToken = 'String';
        $expected->AmazonOrderId = 'String';
        $expected->OrderItems = [$item];

        $this->assertEquals($expected->NextToken, $result->NextToken);
        $this->assertEquals($expected->AmazonOrderId, $result->AmazonOrderId);
        $this->assertEquals($expected->OrderItems, $result->OrderItems);
    }

    /**
     * Test ListOrderItemsByNextTokenAsync
     */
    public function test_ListOrderItemsByNextTokenAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/ListOrderItemsByNextTokenResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->ListOrderItemsByNextTokenAsync(new Request\ListOrderItemsByNextTokenRequest);
        $this->assertTrue($promise instanceof PromiseInterface);
        
        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\ListOrderItemsResult);
    }

    /**
     * Test GetOrder
     */
    public function test_GetOrder()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetOrderResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->GetOrder(new Request\GetOrderRequest);
        $this->assertTrue($result instanceof Result\GetOrderResult);

        $order = new Entity\Order;
        $order->AmazonOrderId = 'String';
        $order->SellerOrderId = 'String';
        $order->PurchaseDate = '1969-07-21T02:56:03Z';
        $order->LastUpdateDate = '1969-07-21T02:56:03Z';
        $order->OrderStatus = 'String';
        $order->FulfillmentChannel = 'String';
        $order->SalesChannel = 'String';
        $order->OrderChannel = 'String';
        $order->ShipServiceLevel = 'String';
        $order->NumberOfItemsShipped = '1';
        $order->NumberOfItemsUnshipped = '1';
        $order->PaymentMethod = 'String';
        $order->MarketplaceId = 'String';
        $order->BuyerEmail = 'String';
        $order->BuyerName = 'String';
        $order->ShipmentServiceLevelCategory = 'String';
        $order->ShippedByAmazonTFM = 'true';
        $order->TFMShipmentStatus = 'String';
        $order->CbaDisplayableShippingLabel = 'String';
        $order->OrderType = 'String';
        $order->EarliestShipDate = '1969-07-21T02:56:03Z';
        $order->LatestShipDate = '1969-07-21T02:56:03Z';
        $order->EarliestDeliveryDate = '1969-07-21T02:56:03Z';
        $order->LatestDeliveryDate = '1969-07-21T02:56:03Z';
        $order->IsBusinessOrder = 'true';
        $order->PurchaseOrderNumber = 'String';
        $order->IsPrime = 'true';
        $order->IsPremiumOrder = 'true';

        $order->ShippingAddress = new Entity\Address;
        $order->ShippingAddress->Name = 'String';
        $order->ShippingAddress->AddressLine1 = 'String';
        $order->ShippingAddress->AddressLine2 = 'String';
        $order->ShippingAddress->AddressLine3 = 'String';
        $order->ShippingAddress->City = 'String';
        $order->ShippingAddress->County = 'String';
        $order->ShippingAddress->District = 'String';
        $order->ShippingAddress->StateOrRegion = 'String';
        $order->ShippingAddress->PostalCode = 'String';
        $order->ShippingAddress->CountryCode = 'String';
        $order->ShippingAddress->Phone = 'String';

        $order->OrderTotal = new Entity\Money;
        $order->OrderTotal->CurrencyCode = 'String';
        $order->OrderTotal->Amount = 'String';

        $order->PaymentExecutionDetail = [];
        $order->PaymentExecutionDetail[0] = new Entity\PaymentExecutionDetailItem;
        $order->PaymentExecutionDetail[0]->Payment = new Entity\Money;
        $order->PaymentExecutionDetail[0]->Payment->CurrencyCode = 'String';
        $order->PaymentExecutionDetail[0]->Payment->Amount = 'String';
        $order->PaymentExecutionDetail[0]->PaymentMethod = 'String';

        $expected = new Result\GetOrderResult;
        $expected->Orders = [$order];

        $this->assertEquals($expected->Orders, $result->Orders);
    }

    /**
     * Test GetOrderAsync
     */
    public function test_GetOrderAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetOrderResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->GetOrderAsync(new Request\GetOrderRequest);
        $this->assertTrue($promise instanceof PromiseInterface);
        
        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\GetOrderResult);
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

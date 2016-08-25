<?php

namespace SellerWorks\Amazon\Tests\Reports;

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
use SellerWorks\Amazon\Reports\Client;
use SellerWorks\Amazon\Reports\Entity;
use SellerWorks\Amazon\Reports\Request;
use SellerWorks\Amazon\Reports\Result;
use SellerWorks\Amazon\Reports\Serializer\Serializer;

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
     * Test RequestReport
     */
    public function test_RequestReport()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/RequestReportResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->RequestReport(new Request\RequestReportRequest);
        $this->assertTrue($result instanceof Result\RequestReportResult);

        $expected = new Result\RequestReportResult;
        $expected->ReportRequestInfo = new Entity\ReportRequestInfo;
        $expected->ReportRequestInfo->ReportRequestId = 'string';
        $expected->ReportRequestInfo->ReportType = 'string';
        $expected->ReportRequestInfo->StartDate = '2008-09-28T18:49:45';
        $expected->ReportRequestInfo->EndDate = '2014-09-18T16:18:33';
        $expected->ReportRequestInfo->Scheduled = 'false';
        $expected->ReportRequestInfo->SubmittedDate = '2006-08-19T10:27:14-07:00';
        $expected->ReportRequestInfo->ReportProcessingStatus = 'string';
        $expected->ReportRequestInfo->GeneratedReportId = 'string';
        $expected->ReportRequestInfo->StartedProcessingDate = '2008-04-22T10:44:23';
        $expected->ReportRequestInfo->CompletedDate = '2012-01-12T03:16:16';

        $this->assertEquals($expected, $result);
    }

    /**
     * Test RequestReportAsync
     */
    public function test_RequestReportAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/RequestReportResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->RequestReportAsync(new Request\RequestReportRequest);
        $this->assertTrue($promise instanceof PromiseInterface);
        
        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\RequestReportResult);
    }

    /**
     * Test GetReportRequestList
     */
    public function test_GetReportRequestList()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetReportRequestListResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->GetReportRequestList(new Request\GetReportRequestListRequest);
        $this->assertTrue($result instanceof Result\GetReportRequestListResult);

        $expected = new Result\GetReportRequestListResult;
        $expected->NextToken = 'string';
        $expected->HasNext = 'false';
        $expected->ReportRequestInfo = new Entity\ReportRequestInfo;
        $expected->ReportRequestInfo->ReportRequestId = 'string';
        $expected->ReportRequestInfo->ReportType = 'string';
        $expected->ReportRequestInfo->StartDate = '2007-10-25T23:36:28';
        $expected->ReportRequestInfo->EndDate = '2004-02-14T10:44:14';
        $expected->ReportRequestInfo->Scheduled = 'false';
        $expected->ReportRequestInfo->SubmittedDate = '2018-10-31T22:36:46-07:00';
        $expected->ReportRequestInfo->ReportProcessingStatus = 'string';
        $expected->ReportRequestInfo->GeneratedReportId = 'string';
        $expected->ReportRequestInfo->StartedProcessingDate = '2008-04-22T10:44:23';
        $expected->ReportRequestInfo->CompletedDate = '2012-01-12T03:16:16';

        $this->assertEquals($expected->NextToken, $result->NextToken);
        $this->assertEquals($expected->HasNext, $result->HasNext);
        $this->assertEquals($expected->ReportRequestInfo, $result->ReportRequestInfo);
    }

    /**
     * Test GetReportRequestListAsync
     */
    public function test_GetReportRequestListAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetReportRequestListResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->GetReportRequestListAsync(new Request\GetReportRequestListRequest);
        $this->assertTrue($promise instanceof PromiseInterface);
        
        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\GetReportRequestListResult);
    }

    /**
     * Test GetReportRequestListByNextToken
     */
    public function test_GetReportRequestListByNextToken()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetReportRequestListByNextTokenResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->GetReportRequestListByNextToken(new Request\GetReportRequestListByNextTokenRequest);
        $this->assertTrue($result instanceof Result\GetReportRequestListResult);

        $expected = new Result\GetReportRequestListResult;
        $expected->NextToken = 'string';
        $expected->HasNext = 'false';
        $expected->ReportRequestInfo = new Entity\ReportRequestInfo;
        $expected->ReportRequestInfo->ReportRequestId = 'string';
        $expected->ReportRequestInfo->ReportType = 'string';
        $expected->ReportRequestInfo->StartDate = '2007-10-25T23:36:28';
        $expected->ReportRequestInfo->EndDate = '2004-02-14T10:44:14';
        $expected->ReportRequestInfo->Scheduled = 'false';
        $expected->ReportRequestInfo->SubmittedDate = '2018-10-31T22:36:46-07:00';
        $expected->ReportRequestInfo->ReportProcessingStatus = 'string';
        $expected->ReportRequestInfo->GeneratedReportId = 'string';
        $expected->ReportRequestInfo->StartedProcessingDate = '2008-04-22T10:44:23';
        $expected->ReportRequestInfo->CompletedDate = '2012-01-12T03:16:16';

        $this->assertEquals($expected->NextToken, $result->NextToken);
        $this->assertEquals($expected->HasNext, $result->HasNext);
        $this->assertEquals($expected->ReportRequestInfo, $result->ReportRequestInfo);
    }

    /**
     * Test GetReportRequestListByNextTokenAsync
     */
    public function test_GetReportRequestListByNextTokenAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetReportRequestListByNextTokenResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->GetReportRequestListByNextTokenAsync(new Request\GetReportRequestListByNextTokenRequest);
        $this->assertTrue($promise instanceof PromiseInterface);

        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\GetReportRequestListResult);
    }

    /**
     * Test GetReportRequestCount
     */
    public function test_GetReportRequestCount()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetReportRequestCountResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->GetReportRequestCount(new Request\GetReportRequestCountRequest);
        $this->assertTrue($result instanceof Result\GetReportRequestCountResult);

        $expected = new Result\GetReportRequestCountResult;
        $expected->Count = '100';

        $this->assertEquals($expected, $result);
    }

    /**
     * Test GetReportRequestCountAsync
     */
    public function test_GetReportRequestCountAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetReportRequestCountResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->GetReportRequestCountAsync(new Request\GetReportRequestCountRequest);
        $this->assertTrue($promise instanceof PromiseInterface);

        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\GetReportRequestCountResult);
    }

    /**
     * Test CancelReportRequests
     */
    public function test_CancelReportRequests()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/CancelReportRequestsResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->CancelReportRequests(new Request\CancelReportRequestsRequest);
        $this->assertTrue($result instanceof Result\CancelReportRequestsResult);

        $expected = new Result\CancelReportRequestsResult;
        $expected->Count = '100';
        $expected->ReportRequestInfo = new Entity\ReportRequestInfo;
        $expected->ReportRequestInfo->ReportRequestId = 'string';
        $expected->ReportRequestInfo->ReportType = 'string';
        $expected->ReportRequestInfo->StartDate = '2008-09-28T18:49:45';
        $expected->ReportRequestInfo->EndDate = '2014-09-18T16:18:33';
        $expected->ReportRequestInfo->Scheduled = 'false';
        $expected->ReportRequestInfo->SubmittedDate = '2006-08-19T10:27:14-07:00';
        $expected->ReportRequestInfo->ReportProcessingStatus = 'string';
        $expected->ReportRequestInfo->GeneratedReportId = 'string';
        $expected->ReportRequestInfo->StartedProcessingDate = '2008-04-22T10:44:23';
        $expected->ReportRequestInfo->CompletedDate = '2012-01-12T03:16:16';

        $this->assertEquals($expected, $result);
    }

    /**
     * Test CancelReportRequestsAsync
     */
    public function test_CancelReportRequestsAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/CancelReportRequestsResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->CancelReportRequestsAsync(new Request\CancelReportRequestsRequest);
        $this->assertTrue($promise instanceof PromiseInterface);

        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\CancelReportRequestsResult);
    }

    /**
     * Test GetReportList
     */
    public function test_GetReportList()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetReportListResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->GetReportList(new Request\GetReportListRequest);
        $this->assertTrue($result instanceof Result\GetReportListResult);

        $expected = new Result\GetReportListResult;
        $expected->NextToken = 'string';
        $expected->HasNext = 'false';
        $expected->ReportInfo = new Entity\ReportInfo;
        $expected->ReportInfo->ReportId = 'string';
        $expected->ReportInfo->ReportType = 'string';
        $expected->ReportInfo->ReportRequestId = 'string';
        $expected->ReportInfo->AvailableDate = '2007-10-25T23:36:28';
        $expected->ReportInfo->Acknowledged = 'true';
        $expected->ReportInfo->AcknowledgedDate = '2014-06-09T08:15:04-07:00';

        $this->assertEquals($expected->NextToken, $result->NextToken);
        $this->assertEquals($expected->HasNext, $result->HasNext);
        $this->assertEquals($expected->ReportInfo, $result->ReportInfo);
    }

    /**
     * Test GetReportListAsync
     */
    public function test_GetReportListAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetReportListResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->GetReportListAsync(new Request\GetReportListRequest);
        $this->assertTrue($promise instanceof PromiseInterface);

        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\GetReportListResult);
    }

    /**
     * Test GetReportListByNextToken
     */
    public function test_GetReportListByNextToken()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetReportListByNextTokenResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->GetReportListByNextToken(new Request\GetReportListByNextTokenRequest);
        $this->assertTrue($result instanceof Result\GetReportListResult);

        $expected = new Result\GetReportListResult;
        $expected->NextToken = 'string';
        $expected->HasNext = 'false';
        $expected->ReportInfo = new Entity\ReportInfo;
        $expected->ReportInfo->ReportId = 'string';
        $expected->ReportInfo->ReportType = 'string';
        $expected->ReportInfo->ReportRequestId = 'string';
        $expected->ReportInfo->AvailableDate = '2007-10-25T23:36:28';
        $expected->ReportInfo->Acknowledged = 'true';
        $expected->ReportInfo->AcknowledgedDate = '2014-06-09T08:15:04-07:00';

        $this->assertEquals($expected->NextToken, $result->NextToken);
        $this->assertEquals($expected->HasNext, $result->HasNext);
        $this->assertEquals($expected->ReportInfo, $result->ReportInfo);
    }

    /**
     * Test GetReportListByNextTokenAsync
     */
    public function test_GetReportListByNextTokenAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetReportListByNextTokenResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->GetReportListByNextTokenAsync(new Request\GetReportListByNextTokenRequest);
        $this->assertTrue($promise instanceof PromiseInterface);

        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\GetReportListResult);
    }

    /**
     * Test GetReportCount
     */
    public function test_GetReportCount()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetReportCountResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->GetReportCount(new Request\GetReportCountRequest);
        $this->assertTrue($result instanceof Result\GetReportCountResult);

        $expected = new Result\GetReportCountResult;
        $expected->Count = '100';

        $this->assertEquals($expected, $result);
    }

    /**
     * Test GetReportCountAsync
     */
    public function test_GetReportCountAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetReportCountResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->GetReportCountAsync(new Request\GetReportCountRequest);
        $this->assertTrue($promise instanceof PromiseInterface);

        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\GetReportCountResult);
    }

    /**
     * Test GetReport
     */
    public function test_GetReport()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetReportResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $result = $this->client->GetReport(new Request\GetReportRequest);
        $this->assertTrue($result instanceof Result\GetReportResult);

        $expected = new Result\GetReportResult;

        $this->assertEquals($expected, $result);
    }

    /**
     * Test GetReportAsync
     */
    public function test_GetReportAsync()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/GetReportResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        $promise = $this->client->GetReportAsync(new Request\GetReportRequest);
        $this->assertTrue($promise instanceof PromiseInterface);

        $result = $promise->wait();
        $this->assertTrue($result instanceof Result\GetReportResult);
    }

    /**
     * Test ErrorResponse
     */
    public function test_ErrorResponse()
    {
        $responseXml = file_get_contents(__DIR__.'/Mock/ErrorResponse.xml');
        $this->stack->append(new Response(200, [], $responseXml));

        // Calling any method here.
        $result = $this->client->RequestReport(new Request\RequestReportRequest);
        $this->assertTrue($result instanceof Result\Error);

        $expected = new Result\Error;
        $expected->Type = 'Sender';
        $expected->Code = 'string';
        $expected->Message = 'string';

        $this->assertEquals($result, $expected);
    }
}

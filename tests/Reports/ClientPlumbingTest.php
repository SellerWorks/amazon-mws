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

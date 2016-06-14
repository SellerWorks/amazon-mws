<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Tests\Common;

use InvalidArgumentException;
use ReflectionMethod;
use ReflectionProperty;
use PHPUnit\Framework\TestCase;
use SellerWorks\Amazon\MWS\Common\AbstractClient;
use SellerWorks\Amazon\MWS\Common\ClientInterface;
use SellerWorks\Amazon\MWS\Common\Mock\MockClient;
use SellerWorks\Amazon\MWS\Common\Mock\MockSerializer;
use SellerWorks\Amazon\MWS\Common\Passport;
use SellerWorks\Amazon\MWS\Common\Requests;
use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use SellerWorks\Amazon\MWS\Common\Responses;
use SellerWorks\Amazon\MWS\Common\ResultInterface;
use SellerWorks\Amazon\MWS\Common\Results;

/**
 * MockClient tests.  Testing only the "abstract" parts of the AbstractClient class.
 */
class MockClientTest extends TestCase
{
    /**
     * @var Passport
     */
    protected $passport;

    /**
     * @var Passport
     */
    protected $multipass;

    /**
     * Setup generic passports.
     */
    public function setUp()
    {
        $this->passport  = new Passport('SELLER_ID', 'ACCESS_KEY', 'SECRET_KEY', 'MWS_AUTH_TOKEN');
        $this->multipass = new Passport('MULTIPASS', 'ACCESS_KEY', 'SECRET_KEY', 'MWS_AUTH_TOKEN');
    }

    /**
     * Test setCountry method for valid values.
     */
    public function test_setCountry()
    {
        $client = new MockClient($this->passport);
        $reflection = new ReflectionProperty($client, 'host');
        $reflection->setAccessible(true);

        $countryInfo = [
            // NA Region
            ClientInterface::COUNTRY_CA => 'mws.amazonservices.ca',
            ClientInterface::COUNTRY_MX => 'mws.amazonservices.com.mx',
            ClientInterface::COUNTRY_US => 'mws.amazonservices.com',

            // EU Region
            ClientInterface::COUNTRY_DE => 'mws-eu.amazonservices.com',
            ClientInterface::COUNTRY_ES => 'mws-eu.amazonservices.com',
            ClientInterface::COUNTRY_FR => 'mws-eu.amazonservices.com',
            ClientInterface::COUNTRY_IN => 'mws.amazonservices.in',
            ClientInterface::COUNTRY_IT => 'mws-eu.amazonservices.com',
            ClientInterface::COUNTRY_UK => 'mws-eu.amazonservices.com',

            // FE Region
            ClientInterface::COUNTRY_JP => 'mws.amazonservices.jp',

            // CN Region
            ClientInterface::COUNTRY_CN => 'mws.amazonservices.com.cn',
        ];

        // Check values.
        foreach ($countryInfo as $country => $host) {
            $client->setCountry($country);
            $this->assertEquals($host, $reflection->getValue($client));
        }
    }

    /**
     * Test setCountry method for invalid value.
     */
    public function test_setCountryException()
    {
        $this->expectException(InvalidArgumentException::class);

        $client = new MockClient($this->passport);
        $client->setCountry('INVALID');
    }

    /**
     * Test getPassport.
     */
    public function test_getPassport()
    {
        $client = new MockClient($this->passport);
        $this->assertSame($this->passport, $client->getPassport());
        $this->assertNotSame($this->multipass, $client->getPassport());
    }

    /**
     * Test setPassport
     */
    public function test_setPassport()
    {
        // Check for $this return.
        $stub = $this->createMock(AbstractClient::CLASS);
        $stub->method('setPassport')->will($this->returnSelf());
        $this->assertSame($stub, $stub->setPassport($this->passport));

        // Check set.
        $client = new MockClient($this->passport);
        $client->setPassport($this->multipass);
        $reflection = new ReflectionProperty($client, 'passport');
        $reflection->setAccessible(true);
        $this->assertSame($this->multipass, $reflection->getValue($client));
    }

    /**
     * Test setSerializer
     */
    public function test_setSerializer()
    {
        $serializer = new MockSerializer;

        // Check for $this return.
        $stub = $this->createMock(AbstractClient::CLASS);
        $stub->method('setSerializer')->will($this->returnSelf());
        $this->assertSame($stub, $stub->setSerializer($serializer));

        // Check set.
        $client = new MockClient($this->passport);
        $client->setSerializer($serializer);
        $reflection = new ReflectionProperty($client, 'serializer');
        $reflection->setAccessible(true);
        $this->assertSame($serializer, $reflection->getValue($client));
    }

    /**
     * Test getLastResponse
     */
    public function test_getLastResponse()
    {
        $client = new MockClient($this->passport);
        $client->setSerializer(new MockSerializer);

        // NullResponse
        $this->assertTrue($client->getLastResponse() instanceof Responses\NullResponse);

        // GetServiceStatusResponse
        $reflection = new ReflectionMethod($client, 'makeRequest');
        $reflection->setAccessible(true);
        $reflection->invoke($client, new Requests\GetServiceStatusRequest, $this->passport);

        $this->assertTrue($client->getLastResponse() instanceof ResponseInterface);
    }

    /**
     * Test getLastResult
     */
    public function test_getLastResult()
    {
        $client = new MockClient($this->passport);
        $client->setSerializer(new MockSerializer);

        // NullResponse
        $this->assertTrue($client->getLastResult() instanceof Results\NullResult);

        // GetServiceStatusResponse
        $reflection = new ReflectionMethod($client, 'makeRequest');
        $reflection->setAccessible(true);
        $reflection->invoke($client, new Requests\GetServiceStatusRequest, $this->passport);

        $this->assertTrue($client->getLastResult() instanceof ResultInterface);
    }

    /**
     * Test makeRequest
     */
    public function test_makeRequest()
    {
        $client = new MockClient();
        $client->setSerializer(new MockSerializer);

        // GetServiceStatusResponse
        $reflection = new ReflectionMethod($client, 'makeRequest');
        $reflection->setAccessible(true);
        $response = $reflection->invoke($client, new Requests\GetServiceStatusRequest, $this->passport);

        $this->assertTrue($response instanceof ResponseInterface);

        // No passport used.
        $this->expectException(\RuntimeException::class);
        $reflection->invoke($client, new Requests\GetServiceStatusRequest);
    }

    /**
     * Test post
     */
    public function test_post()
    {
        $client = new MockClient($this->passport);
        $client->setSerializer(new MockSerializer);

        // Expected response.
        $expectedXml = "
<?xml version=\"1.0\"?>
<GetServiceStatusResponse xmlns=\"http://mws.amazonaws.com/FulfillmentInboundShipment/2010-10-01/\">
  <GetServiceStatusResult>
    <Status>GREEN</Status>
    <Timestamp>2016-06-13T20:29:44.583Z</Timestamp>
  </GetServiceStatusResult>
  <ResponseMetadata>
    <RequestId>fbe5d604-978f-4ab6-bc6e-0aa38838d0dd</RequestId>
  </ResponseMetadata>
</GetServiceStatusResponse>";

        $expected = new \DomDocument();
        $expected->loadXml(trim($expectedXml));

        // Actual response.
        $reflection = new ReflectionMethod($client, 'post');
        $reflection->setAccessible(true);
        $actualXml = $reflection->invoke($client, new Requests\GetServiceStatusRequest, $this->passport);

        $actual = new \DomDocument();
        $actual->loadXml($actualXml);

        $this->assertEqualXMLStructure($expected->documentElement, $actual->documentElement);
    }

    /**
     * Test buildQuery
     */
    public function test_buildQuery()
    {
        $client = new MockClient($this->passport);
        $client->setSerializer(new MockSerializer);

        // Expected response.
        $expected = [
            'AWSAccessKeyId=ACCESS_KEY',
            'Action=GetServiceStatus',
            'MWSAuthToken=MWS_AUTH_TOKEN',
            'SellerId=SELLER_ID',
            'SignatureMethod=HmacSHA256',
            'SignatureVersion=2',
            'Timestamp=2016-06-13T20%3A29%3A44Z',
            'Version=2010-10-01',
            'Signature=5X8inVe9PDtVZWxKd%2FSxzCQyzbTxJZShT0YqGFt7AD4%3D'
        ];
        $expected = implode('&', $expected);

        // Actual response.
        $reflection = new ReflectionMethod($client, 'buildQuery');
        $reflection->setAccessible(true);
        $actual = $reflection->invoke($client, new Requests\GetServiceStatusRequest, $this->passport);

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test calculateSignature
     */
    public function test_calculateSignature()
    {
        $client = new MockClient($this->passport);
        $reflection = new ReflectionMethod($client, 'calculateSignature');
        $reflection->setAccessible(true);

        // Sample results taken from https://mws.amazonservices.com/scratchpad/index.html
        $queryString = [
            'AWSAccessKeyId=ACCESS_KEY',
            'Action=GetServiceStatus',
            'MWSAuthToken=MWS_AUTH_TOKEN',
            'SellerId=SELLER_ID',
            'SignatureMethod=HmacSHA256',
            'SignatureVersion=2',
            'Timestamp=2016-06-13T20%3A29%3A44Z',
            'Version=2010-10-01',
        ];
        $secretKey = 'SECRET_KEY';
        $expected  = '5X8inVe9PDtVZWxKd%2FSxzCQyzbTxJZShT0YqGFt7AD4%3D';

        $this->assertEquals($expected, $reflection->invoke($client, implode('&', $queryString), $secretKey));
    }

    /**
     * Test urlencode_rfc3986
     */
    public function test_urlencode_rfc3986()
    {
        $client = new MockClient($this->passport);
        $reflection = new ReflectionMethod($client, 'urlencode_rfc3986');
        $reflection->setAccessible(true);

        // Tests taken from http://wiki.oauth.net/TestCases
        $this->assertEquals('', $reflection->invoke($client, ''));
        $this->assertEquals('abcABC123', $reflection->invoke($client, 'abcABC123'));
        $this->assertEquals('-._~',      $reflection->invoke($client, '-._~'));
        $this->assertEquals('%25',       $reflection->invoke($client, '%'));
        $this->assertEquals('%2B',       $reflection->invoke($client, '+'));
        $this->assertEquals('%26%3D%2A', $reflection->invoke($client, '&=*'));
        $this->assertEquals('%0A',       $reflection->invoke($client, "\x0a"));           // U+000A (LF)
        $this->assertEquals('%0A',       $reflection->invoke($client, "\n"));
        $this->assertEquals('%20',       $reflection->invoke($client, "\x20"));           // U+0020 (space)
        $this->assertEquals('%20',       $reflection->invoke($client, ' '));
        $this->assertEquals('%7F',       $reflection->invoke($client, "\x7F"));
        $this->assertEquals('%C2%80',    $reflection->invoke($client, "\xc2\x80"));       // U+0080
        $this->assertEquals('%E3%80%81', $reflection->invoke($client, "\xe3\x80\x81"));   // U+3001
    }

    /**
     * Test throwError
     */
    public function test_throwError()
    {
        $this->expectException(\Error::class);

        $error = new Responses\ErrorResponse;
        $error->RequestID = '982a45cf-af8c-42a7-bfeb-589317e86bc1';
        $error->Error = new Results\Error;
        $error->Error->Type    = 'Sender';
        $error->Error->Code    = 'SignatureDoesNotMatch';
        $error->Error->Message = 'The request signature we calculated does not match the signature you provided.';

        $client = new MockClient($this->passport);
        $reflection = new ReflectionMethod($client, 'throwError');
        $reflection->setAccessible(true);
        $reflection->invoke($client, $error);
    }
}
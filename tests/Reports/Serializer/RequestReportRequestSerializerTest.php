<?php

namespace SellerWorks\Amazon\Tests\Reports\Serializer;

use DateTime;
use Faker;
use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\Reports\Entity;
use SellerWorks\Amazon\Reports\Request;
use SellerWorks\Amazon\Reports\Serializer\Serializer;

/**
 * Serializer tests
 */
class RequestReportRequestSerializerTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test RequestReportRequest.ReportType
     */
    public function test_RequestReportRequest_ReportType()
    {
        $serializer = new Serializer;

        $values = Entity\ReportType::getTypes();

        foreach ($values as $v) {
            $request = new Request\RequestReportRequest;
            $request->ReportType = $v;

            $serialized = $serializer->serialize($request);
            $expected   = [
                'Action'     => 'RequestReport',
                'ReportType' => $v,
            ];

            ksort($serialized);
            ksort($expected);
            $this->assertSame($serialized, $expected);
        }
    }

    /**
     * Test RequestReportRequest.{StartDate,EndDate} as DateTime objects.
     */
    public function test_RequestReportRequest_dates_as_objects()
    {
        $serializer = new Serializer;

        $request = new Request\RequestReportRequest;
        $request->StartDate = new DateTime($bttf1955 = '1955-11-12T06:38:00Z');
        $request->EndDate   = new DateTime($bttf1985 = '1985-10-26T09:00:00Z');

        $serialized = $serializer->serialize($request);
        $expected   = [
            'Action'    => 'RequestReport',
            'StartDate' => $bttf1955,
            'EndDate'   => $bttf1985,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test RequestReportRequest.{StartDate,EndDate} as strings.
     */
    public function test_RequestReportRequest_dates_as_strings()
    {
        $serializer = new Serializer;

        $request = new Request\RequestReportRequest;
        $request->StartDate = $bttf1955 = '1955-11-12T06:38:00Z';
        $request->EndDate   = $bttf1985 = '1985-10-26T09:00:00Z';

        $serialized = $serializer->serialize($request);
        $expected   = [
            'Action'    => 'RequestReport',
            'StartDate' => $bttf1955,
            'EndDate'   => $bttf1985,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test RequestReportRequest.ReportOptions
     */
    public function test_RequestReportRequest_ReportOptions()
    {
        $serializer = new Serializer;

        $request = new Request\RequestReportRequest;
        $request->ReportOptions = 'ReportOptions';

        $serialized = $serializer->serialize($request);
        $expected   = [
            'Action'        => 'RequestReport',
            'ReportOptions' => 'ReportOptions',
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test RequestReportRequest.MarketplaceIdList
     */
    public function test_RequestReportRequest_MarketplaceIdList_as_scalar()
    {
        $serializer = new Serializer;

        $request = new Request\RequestReportRequest;
        $request->MarketplaceIdList = $this->faker->uuid;

        $serialized = $serializer->serialize($request);
        $expected   = [
            'Action'                 => 'RequestReport',
            'MarketplaceIdList.Id.1' => $request->MarketplaceIdList,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test RequestReportRequest.MarketplaceIdList
     */
    public function test_RequestReportRequest_MarketplaceIdList_as_array()
    {
        $serializer = new Serializer;

        $values = [
            'MarketplaceIdList.Id.1' => $this->faker->uuid,
            'MarketplaceIdList.Id.2' => $this->faker->uuid,
            'MarketplaceIdList.Id.3' => $this->faker->uuid,
            'MarketplaceIdList.Id.4' => $this->faker->uuid,
            'MarketplaceIdList.Id.5' => $this->faker->uuid,
            'MarketplaceIdList.Id.6' => $this->faker->uuid,
            'MarketplaceIdList.Id.7' => $this->faker->uuid,
            'MarketplaceIdList.Id.8' => $this->faker->uuid,
            'MarketplaceIdList.Id.9' => $this->faker->uuid,
        ];

        $request = new Request\RequestReportRequest;
        $request->MarketplaceIdList = array_values($values);

        $serialized = $serializer->serialize($request);
        $expected   = ['Action' => 'RequestReport'] + $values;

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }
}

<?php

namespace SellerWorks\Amazon\Tests\Orders\Serializer;

use DateTime;

use Faker;
use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\Orders\Entity;
use SellerWorks\Amazon\Orders\Request;
use SellerWorks\Amazon\Orders\Serializer\Serializer;

/**
 * Serializer tests
 */
class ListOrdersRequest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test GetServiceStatusRequest.
     */
    public function test_GetServiceStatusRequest()
    {
        $serializer = new Serializer;
        $request    = new Request\GetServiceStatusRequest;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'GetServiceStatus',
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test ListOrdersRequest.{CreatedAfter,CreatedBefore,LastUpdatedAfter,LastUpdatedBefore} as DateTime objects.
     */
    public function test_ListOrdersRequest_dates_as_objects()
    {
        $serializer = new Serializer;

        $request = new Request\ListOrdersRequest;
        $request->CreatedAfter      = new DateTime($bttf1955 = '1955-11-12T06:38:00Z');
        $request->CreatedBefore     = new DateTime($bttf1985 = '1985-10-26T09:00:00Z');
        $request->LastUpdatedAfter  = new DateTime($bttf2015 = '2015-10-21T07:28:00Z');
        $request->LastUpdatedBefore = new DateTime($bttf2050 = '2050-01-01T00:00:00Z');

        $serialized = $serializer->serialize($request);
        $expected   = [
            'Action'            => 'ListOrders',
            'CreatedAfter'      => $bttf1955,
            'CreatedBefore'     => $bttf1985,
            'LastUpdatedAfter'  => $bttf2015,
            'LastUpdatedBefore' => $bttf2050,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test ListOrdersRequest.{CreatedAfter,CreatedBefore,LastUpdatedAfter,LastUpdatedBefore} as strings.
     */
    public function test_ListOrdersRequest_dates_as_strings()
    {
        $serializer = new Serializer;

        $request = new Request\ListOrdersRequest;
        $request->CreatedAfter      = $bttf1955 = '1955-11-12T06:38:00Z';
        $request->CreatedBefore     = $bttf1985 = '1985-10-26T09:00:00Z';
        $request->LastUpdatedAfter  = $bttf2015 = '2015-10-21T07:28:00Z';
        $request->LastUpdatedBefore = $bttf2050 = '2050-01-01T00:00:00Z';

        $serialized = $serializer->serialize($request);
        $expected   = [
            'Action'            => 'ListOrders',
            'CreatedAfter'      => $bttf1955,
            'CreatedBefore'     => $bttf1985,
            'LastUpdatedAfter'  => $bttf2015,
            'LastUpdatedBefore' => $bttf2050,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test ListOrdersRequest.OrderStatus as strings
     */
    public function test_ListOrdersRequest_OrderStatus_as_scalar()
    {
        $serializer = new Serializer;

        $values = [
            'All',
            'PendingAvailability',
            'Pending',
            'Unshipped',
            'PartiallyShipped',
            'Shipped',
            'InvoiceUnconfirmed',
            'Canceled',
            'Unfulfillable',
        ];

        foreach ($values as $v) {
            $request = new Request\ListOrdersRequest;
            $request->OrderStatus = $v;

            $serialized = $serializer->serialize($request);
            $expected   = [
                'Action'               => 'ListOrders',
                'OrderStatus.Status.1' => $v,
            ];

            ksort($serialized);
            ksort($expected);
            $this->assertSame($serialized, $expected);
        }
    }

    /**
     * Test ListOrdersRequest.OrderStatus as an array
     */
    public function test_ListOrdersRequest_OrderStatus_as_array()
    {
        $serializer = new Serializer;

        $values = [
            'OrderStatus.Status.1' => 'All',
            'OrderStatus.Status.2' => 'PendingAvailability',
            'OrderStatus.Status.3' => 'Pending',
            'OrderStatus.Status.4' => 'Unshipped',
            'OrderStatus.Status.5' => 'PartiallyShipped',
            'OrderStatus.Status.6' => 'Shipped',
            'OrderStatus.Status.7' => 'InvoiceUnconfirmed',
            'OrderStatus.Status.8' => 'Canceled',
            'OrderStatus.Status.9' => 'Unfulfillable',
        ];

        $request = new Request\ListOrdersRequest;
        $request->OrderStatus = array_values($values);

        $serialized = $serializer->serialize($request);
        $expected   = ['Action' => 'ListOrders'] + $values;

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test ListOrdersRequest.MarketplaceId as string
     */
    public function test_ListOrdersRequest_MarketplaceId_as_scalar()
    {
        $serializer = new Serializer;

        $values = [
            'A2EUQ1WTGCTBG2',
            'A1AM78C64UM0Y8',
            'ATVPDKIKX0DER',
            'A1PA6795UKMFR9',
            'A1RKKUPIHCS9HS',
            'A13V1IB3VIYZZH',
            'A21TJRUUN4KGV',
            'APJ6JRA9NG5V4',
            'A1F83G8C2ARO7P',
            'A1VC38T7YXB528',
            'AAHKV2X7AFYLW',
        ];

        foreach ($values as $v) {
            $request = new Request\ListOrdersRequest;
            $request->MarketplaceId = $v;

            $serialized = $serializer->serialize($request);
            $expected   = [
                'Action'             => 'ListOrders',
                'MarketplaceId.Id.1' => $v,
            ];

            ksort($serialized);
            ksort($expected);
            $this->assertSame($serialized, $expected);
        }
    }

    /**
     * Test ListOrdersRequest.MarketplaceId as array
     */
    public function test_ListOrdersRequest_MarketplaceId_as_array()
    {
        $serializer = new Serializer;

        $values = [
            'MarketplaceId.Id.1'  => 'A2EUQ1WTGCTBG2',
            'MarketplaceId.Id.2'  => 'A1AM78C64UM0Y8',
            'MarketplaceId.Id.3'  => 'ATVPDKIKX0DER',
            'MarketplaceId.Id.4'  => 'A1PA6795UKMFR9',
            'MarketplaceId.Id.5'  => 'A1RKKUPIHCS9HS',
            'MarketplaceId.Id.6'  => 'A13V1IB3VIYZZH',
            'MarketplaceId.Id.7'  => 'A21TJRUUN4KGV',
            'MarketplaceId.Id.8'  => 'APJ6JRA9NG5V4',
            'MarketplaceId.Id.9'  => 'A1F83G8C2ARO7P',
            'MarketplaceId.Id.10' => 'A1VC38T7YXB528',
            'MarketplaceId.Id.11' => 'AAHKV2X7AFYLW',
        ];

        $request = new Request\ListOrdersRequest;
        $request->MarketplaceId = array_values($values);

        $serialized = $serializer->serialize($request);
        $expected   = ['Action' => 'ListOrders'] + $values;

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test ListOrdersRequest.FulfillmentChannel as string
     */
    public function test_ListOrdersRequest_FulfillmentChannel_as_string()
    {
        $serializer = new Serializer;

        $values = [
            'All',
            'AFN',
            'MFN',
        ];

        foreach ($values as $v) {
            $request = new Request\ListOrdersRequest;
            $request->FulfillmentChannel = $v;

            $serialized = $serializer->serialize($request);
            $expected   = [
                'Action'                       => 'ListOrders',
                'FulfillmentChannel.Channel.1' => $v,
            ];

            ksort($serialized);
            ksort($expected);
            $this->assertSame($serialized, $expected);
        }
    }

    /**
     * Test ListOrdersRequest.FulfillmentChannel as array
     */
    public function test_ListOrdersRequest_FulfillmentChannel_as_array()
    {
        $serializer = new Serializer;

        $values = [
            'FulfillmentChannel.Channel.1' => 'All',
            'FulfillmentChannel.Channel.2' => 'AFN',
            'FulfillmentChannel.Channel.3' => 'MFN',
        ];

        $request = new Request\ListOrdersRequest;
        $request->FulfillmentChannel = array_values($values);

        $serialized = $serializer->serialize($request);
        $expected   = ['Action' => 'ListOrders'] + $values;

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test ListOrdersRequest.PaymentMethod as string
     */
    public function test_ListOrdersRequest_PaymentMethod_as_string()
    {
        $serializer = new Serializer;

        $values = [
            'All',
            'COD',
            'CVS',
            'Other',
        ];

        foreach ($values as $v) {
            $request = new Request\ListOrdersRequest;
            $request->PaymentMethod = $v;

            $serialized = $serializer->serialize($request);
            $expected   = [
                'Action'                       => 'ListOrders',
                'PaymentMethod.Method.1' => $v,
            ];

            ksort($serialized);
            ksort($expected);
            $this->assertSame($serialized, $expected);
        }
    }

    /**
     * Test ListOrdersRequest.PaymentMethod as array
     */
    public function test_ListOrdersRequest_PaymentMethod_as_array()
    {
        $serializer = new Serializer;

        $values = [
            'PaymentMethod.Method.1' => 'All',
            'PaymentMethod.Method.2' => 'COD',
            'PaymentMethod.Method.3' => 'CVS',
            'PaymentMethod.Method.3' => 'Other',
        ];

        $request = new Request\ListOrdersRequest;
        $request->PaymentMethod = array_values($values);

        $serialized = $serializer->serialize($request);
        $expected   = ['Action' => 'ListOrders'] + $values;

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test ListOrdersRequest.BuyerEmail
     */
    public function test_ListOrdersRequest_BuyerEmail()
    {
        $serializer = new Serializer;

        $request = new Request\ListOrdersRequest;
        $request->BuyerEmail = $this->faker->email;

        $serialized = $serializer->serialize($request);
        $expected   = [
            'Action'        => 'ListOrders',
            'BuyerEmail'    => $request->BuyerEmail,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test ListOrdersRequest.SellerOrderId
     */
    public function test_ListOrdersRequest_SellerOrderId()
    {
        $serializer = new Serializer;

        $request = new Request\ListOrdersRequest;
        $request->SellerOrderId = $this->faker->isbn13;

        $serialized = $serializer->serialize($request);
        $expected   = [
            'Action'        => 'ListOrders',
            'SellerOrderId' => $request->SellerOrderId,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test ListOrdersRequest.MaxResultsPerPage
     */
    public function test_ListOrdersRequest_MaxResultsPerPage()
    {
        $serializer = new Serializer;

        $request = new Request\ListOrdersRequest;
        $request->MaxResultsPerPage = $this->faker->numberBetween(1, 100);

        $serialized = $serializer->serialize($request);
        $expected   = [
            'Action'            => 'ListOrders',
            'MaxResultsPerPage' => $request->MaxResultsPerPage,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test ListOrdersRequest.MaxResultsPerPage out of range
     */
    public function test_ListOrdersRequest_MaxResultsPerPage_out_of_ramge()
    {
        $serializer = new Serializer;

        $request = new Request\ListOrdersRequest;
        $request->MaxResultsPerPage = 200;

        $serialized = $serializer->serialize($request);
        $expected   = [
            'Action' => 'ListOrders',
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test ListOrdersRequest.TFMShipmentStatus as string
     */
    public function test_ListOrdersRequest_TFMShipmentStatus_as_string()
    {
        $serializer = new Serializer;

        $values = [
            'All',
            'PendingPickUp',
            'LabelCanceled',
            'PickedUp',
            'AtDestinationFC',
            'Delivered',
            'RejectedByBuyer',
            'Undeliverable',
            'ReturnedToSeller',
            'Lost',
        ];

        foreach ($values as $v) {
            $request = new Request\ListOrdersRequest;
            $request->TFMShipmentStatus = $v;

            $serialized = $serializer->serialize($request);
            $expected   = [
                'Action'                     => 'ListOrders',
                'TFMShipmentStatus.Status.1' => $v,
            ];

            ksort($serialized);
            ksort($expected);
            $this->assertSame($serialized, $expected);
        }
    }

    /**
     * Test ListOrdersRequest.TFMShipmentStatus as array
     */
    public function test_ListOrdersRequest_TFMShipmentStatus_as_array()
    {
        $serializer = new Serializer;

        $values = [
            'TFMShipmentStatus.Status.1'  => 'All',
            'TFMShipmentStatus.Status.2'  => 'PendingPickUp',
            'TFMShipmentStatus.Status.3'  => 'LabelCanceled',
            'TFMShipmentStatus.Status.4'  => 'PickedUp',
            'TFMShipmentStatus.Status.5'  => 'AtDestinationFC',
            'TFMShipmentStatus.Status.6'  => 'Delivered',
            'TFMShipmentStatus.Status.7'  => 'RejectedByBuyer',
            'TFMShipmentStatus.Status.8'  => 'Undeliverable',
            'TFMShipmentStatus.Status.9'  => 'ReturnedToSeller',
            'TFMShipmentStatus.Status.10' => 'Lost',
        ];

        $request = new Request\ListOrdersRequest;
        $request->TFMShipmentStatus = array_values($values);

        $serialized = $serializer->serialize($request);
        $expected   = ['Action' => 'ListOrders'] + $values;

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }
}

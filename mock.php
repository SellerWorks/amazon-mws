<?php

require 'vendor/autoload.php';

use SellerWorks\Amazon\MWS\Common\Passport;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Mock;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

$client = new Mock();

/*
// GetServiceStatusRequest
$response = $client->getServiceStatus();
print_r($response);
*/


// ListInboundShipmentsRequest
$request = new Requests\ListInboundShipmentsRequest;
$request->ShipmentStatusList = ['CLOSED'];
$request->LastUpdatedAfter  = new \DateTime('2016-05-01');
$request->LastUpdatedBefore = new \DateTime('2016-05-10');

$response = $client->listInboundShipments($request);
print_r($response);
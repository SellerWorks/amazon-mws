<?php

require 'vendor/autoload.php';

use SellerWorks\Amazon\MWS\Common\Passport;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Mock;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

$client = new Mock();

/*
// GetServiceStatus
$response = $client->getServiceStatus();
print_r($response);
*/

/*
// ListInboundShipments
$response = $client->listInboundShipments(new Requests\ListInboundShipmentsRequest);
print_r($response);
*/

// CreateInboundShipmentPlan
$response = $client->createInboundShipmentPlan(new Requests\CreateInboundShipmentPlanRequest);
print_r($response);
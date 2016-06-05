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

/*
// CreateInboundShipmentPlan
$response = $client->createInboundShipmentPlan(new Requests\CreateInboundShipmentPlanRequest);
print_r($response);
*/

/*
// CreateInboundShipment
$response = $client->createInboundShipment(new Requests\CreateInboundShipmentRequest);
print_r($response);
*/

/*
// UpdateInboundShipment
$response = $client->updateInboundShipment(new Requests\UpdateInboundShipmentRequest);
print_r($response);
*/

/*
// GetPrepInstructionsForSKU
$response = $client->GetPrepInstructionsForSKU(new Requests\GetPrepInstructionsForSKURequest);
print_r($response);
*/

/*
// GetPrepInstructionsForASIN
$response = $client->GetPrepInstructionsForASIN(new Requests\GetPrepInstructionsForASINRequest);
print_r($response);
*/


// ListInboundShipmentItems
$response = $client->ListInboundShipmentItems(new Requests\ListInboundShipmentItemsRequest);
print_r($response);
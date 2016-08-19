<?php

require 'vendor/autoload.php';

use SellerWorks\Amazon\MWS\Common\Passport;
use SellerWorks\Amazon\MWS\FulfillmentInbound\MockClient;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

$client = new MockClient();

/*
// Error
$response = $client->Error();
print_r($response);
*/

/*
// GetServiceStatus
$response = $client->GetServiceStatus();
print_r($response);
*/

/*
// CreateInboundShipmentPlan
$response = $client->CreateInboundShipmentPlan(new Requests\CreateInboundShipmentPlanRequest);
print_r($response);
*/

/*
// CreateInboundShipment
$response = $client->CreateInboundShipment(new Requests\CreateInboundShipmentRequest);
print_r($response);
*/

/*
// UpdateInboundShipment
$response = $client->UpdateInboundShipment(new Requests\UpdateInboundShipmentRequest);
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

/*
// ListInboundShipments
$response = $client->ListInboundShipments(new Requests\ListInboundShipmentsRequest);
print_r($response);
*/

/*
// ListInboundShipmentsByNextToken
$response = $client->ListInboundShipmentsByNextToken('string');
print_r($response);
*/

/*
// ListInboundShipmentItems
$response = $client->ListInboundShipmentItems(new Requests\ListInboundShipmentItemsRequest);
print_r($response);
*/

// ListInboundShipmentItemsByNextToken
$response = $client->ListInboundShipmentItemsByNextToken('string');
print_r($response);
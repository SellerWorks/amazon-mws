## Amazon MWS Toolkit
An object oriented approach to using Amazon's [Marketplace Webservices](http://mws.amazon.com).  Currently an ALPHA release and not recommended for production use.

### Usage

The following example shows how to instantiate the client and call the FulfillmentInboundShipment service.

```php
require 'vendor/autoload.php'

use SellerWorks\Amazon\MWS\Common\Passport;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Client;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

$passport  = new Passport(AMAZON_SELLER_ID, MWS_ACCESS_KEY, MWS_SECRET_KEY, OPTIONAL_MWS_AUTH_TOKEN);
$mwsClient = new Client($passport);

// Check service status
$response = $mwsClient->GetServiceStatus();

// Check for open shipments
$request = new Requests\ListInboundShipmentsRequest;
$request->ShipmentStatusList = [
    Types\ShipmentStatus::SHIPPED,
];

$response = $mwsClient->ListInboundShipments($request);
```
The XML returned by the webservice is marshalled into PHP objects specific to the API.
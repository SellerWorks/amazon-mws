![GitHub release](https://img.shields.io/github/release/SellerWorks/amazon-mws.svg?maxAge=2592000)
![Travis](https://img.shields.io/travis/SellerWorks/amazon-mws.svg?maxAge=2592000)
![Packagist](https://img.shields.io/packagist/l/SellerWorks/amazon-mws.svg?maxAge=2592000)

# Amazon MWS Toolkit

The **Amazon MWS Toolkit** makes it easy for developers to access Amazon's [Marketplace Webservices](https://developer.amazonservices.com/index.html) in their PHP code, and build robust applications using services like *Orders*, *Fulfillment Inbound Shipment* and *Reports*. You can get started in minutes by installing the toolkit through Composer or by downloading the latest release.

Currently this project is in BETA and not recommended for production use, but you can try it anyway. (I know you will!)

## Resources

* Toolkit Docs - For details about using this toolkit
* [API Docs](https://developer.amazonservices.com/index.html) - For details about operations, parameters, and responses

## Installation

Through Composer, obviously:

```
composer require sellerworks/amazon-mws
```

You can also use Amazon MWS Toolkit without using Composer by registering an autoloader function:

```
spl_autoload_register(function($class) {
    $prefix = 'SellerWorks\\Amazon\\';

    if (!substr($class, 0, 18) === $prefix) {
        return;
    }

    $class = substr($class, strlen($prefix));
    $location = __DIR__ . 'path/to/sellerworks-amazon/src/' . str_replace('\\', '/', $class) . '.php';

    if (is_file($location)) {
        require_once($location);
    }
});
```

Now you're ready to get started.

## Example

Get the service status.

```
<?php

require 'vendor/autoload.php';

use SellerWorks\Amazon\Credentials\Credentials;
use SellerWorks\Amazon\Orders\Client;

// Create the API client.
$credentials = new Credentials('Seller Id', 'Access Key', 'Secret Key');
$client = new Client($credentials);

// Send request to the API.
$status = $client->GetServiceStatus();

// Output service level information.
printf("The current service level for the Orders Service is: %s\n", $status->Status);
```

## Project Goals

* Be well maintained.
* Be well documented.
* Be well tested.

# Enjoy!
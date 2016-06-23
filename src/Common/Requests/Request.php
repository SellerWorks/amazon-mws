<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common\Requests;

use SellerWorks\Amazon\MWS\Common\PassportAwareTrait;

/**
 * Base class for all Requests.
 */
abstract class Request
{
    use PassportAwareTrait;
}
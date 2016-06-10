<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common\Mock;

use SellerWorks\Amazon\MWS\Common\AbstractClient;
use SellerWorks\Amazon\MWS\Common\Passport;

/**
 * Mock Amazon MWS API Client
 */
class MockClient extends AbstractClient
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct(new Passport('', '', ''));
    }
}
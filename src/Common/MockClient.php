<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common;

/**
 * Mock Amazon MWS API Client
 */
class MockClient extends AbstractClient
{
    /**
     * Constructor.
     */
    public function __construct(Passport $passport)
    {
        parent::__construct(new Passport('', '', ''));
    }
}
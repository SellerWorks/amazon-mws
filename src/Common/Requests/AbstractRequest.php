<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common\Requests;

/**
 * Request interface.
 */
class AbstractRequest
{
    /**
     * @var SellerWorks\Amazon\MWS\Comment\Passport
     */
    protected $passport;

    /**
     * @var string
     */
    public $MarketplaceId;
}
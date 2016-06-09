<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common\Requests;

use SellerWorks\Amazon\MWS\Common\Passport;

/**
 * Request interface.
 */
class AbstractRequest implements RequestInterface
{
    /**
     * @var string
     */
    public $MarketplaceId;

    /**
     * @var SellerWorks\Amazon\MWS\Comment\Passport
     */
    protected $passport;

    /**
     * Set passport.
     *
     * @param  Passport $passport
     * @return self
     */
    public function setPassport(Passport $passport): self
    {
        $this->passport = $passport;

        return $this;
    }
}
<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common\Requests;

use SellerWorks\Amazon\MWS\Common\Passport;

/**
 * Base class for all Requests.
 */
abstract class Request
{
    /**
     * @var  Passport
     */
    protected $passport;

    /**
     * @return Passport|null
     */
    public function getPassport()
    {
        return $this->passport;
    }

    /**
     * @param  Passport  $passport
     * @return self
     */
    public function setPassport(Passport $passport): self
    {
        $this->passport = $passport;

        return $this;
    }
}
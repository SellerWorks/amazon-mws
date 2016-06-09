<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common;

/**
 * Trait that adds the Passport object.
 */
trait PassportTrait
{
    /**
     * @var Passport
     */
    protected $passport;

    /**
     * @return Passport
     */
    public function getPassport(): Passport
    {
        return $this->passport;
    }

    /**
     * @param  Passport
     * @return self
     */
    public function setPassport(Passport $passport = null): self
    {
        $this->passport = $passport;

        return $this;
    }
}
<?php

namespace SellerWorks\Amazon\Passport;

/**
 * Trait used in conjunction with the PassportAwareInterface.
 */
trait PassportAwareTrait
{
    /**
     * @var PassportInterface
     */
    protected $passport;

    /**
     * Return passport object.
     *
     * @return PassportInterface|null
     */
    public function getPassport()
    {
        return $this->passport;
    }

    /**
     * Store passport object.
     *
     * @param  PassportInterface  $passport
     * @return self
     */
    public function setPassport(PassportInterface $passport)
    {
        $this->passport = $passport;

        return $this;
    }
}
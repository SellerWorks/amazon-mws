<?php

namespace SellerWorks\Amazon\Common;

/**
 * Interface for all Request objects.
 */
interface EntityInterface
{
    /**
     * Return metadata about this object.
     *
     * @return array
     */
    public function getMetadata();
}

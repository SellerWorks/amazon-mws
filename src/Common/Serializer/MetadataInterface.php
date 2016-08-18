<?php

namespace SellerWorks\Amazon\Common\Serializer;

/**
 * Interface for objects that are serialized.
 */
interface MetadataInterface
{
    /**
     * Get metadata about object properties.
     */
    function getMetadata();
}
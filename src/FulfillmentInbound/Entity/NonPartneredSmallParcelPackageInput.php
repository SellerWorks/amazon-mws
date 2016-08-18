<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

use SellerWorks\Amazon\Common\Serializer\MetadataInterface;

/**
 * The tracking number of the package, provided by the carrier.
 */
final class NonPartneredSmallParcelPackageInput implements MetadataInterface
{
    /**
     * @var string
     */
    public $TrackingId;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'TrackingId' => ['type' => 'scalar'],
        ];
    }
}

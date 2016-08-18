<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

use SellerWorks\Amazon\Common\Serializer\MetadataInterface;

/**
 * Pallet information.
 */
final class Pallet implements MetadataInterface
{
    /**
     * @var Dimensions
     */
    public $Dimensions;

    /**
     * @var Weight
     */
    public $Weight;

    /**
     * @var bool
     */
    public $IsStacked;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'Dimensions' => ['type' => 'object', 'subtype' => Dimensions::class],
            'Weight'     => ['type' => 'object', 'subtype' => Weight::class],
            'IsStacked'  => ['type' => 'boolean'],
        ];
    }
}

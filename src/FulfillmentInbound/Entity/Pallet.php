<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Pallet information.
 */
final class Pallet
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

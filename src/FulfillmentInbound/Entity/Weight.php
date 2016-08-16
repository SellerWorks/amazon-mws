<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * The weight value and unit of measurement.
 */
final class Weight
{
    /**
     * @var string
     */
    public $Unit;

    /**
     * @var int
     */
    public $Value;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'Unit'  => ['type' => 'choice', 'choices' => ['pounds', 'kilograms']],
            'Value' => ['type' => 'scalar'],
        ];
    }
}

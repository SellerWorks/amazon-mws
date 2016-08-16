<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * The currency code and value.
 */
final class Amount
{
    /**
     * @var string
     */
    public $CurrencyCode;

    /**
     * @var string
     */
    public $Value;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'CurrencyCode' => ['type' => 'scalar'],
            'Value'        => ['type' => 'scalar'],
        ];
    }
}

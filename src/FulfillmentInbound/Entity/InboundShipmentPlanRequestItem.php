<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

use SellerWorks\Amazon\Common\Serializer\MetadataInterface;

/**
 * How the seller intends to provide box contents information for a shipment.
 */
final class InboundShipmentPlanRequestItem implements MetadataInterface
{
    /**
     * @var string
     */
    public $SellerSKU;

    /**
     * @var string
     */
    public $ASIN;

    /**
     * @var string
     */
    public $Condition;

    /**
     * @var int
     */
    public $Quantity;

    /**
     * @var int
     */
    public $QuantityInCase;

    /**
     * @var PrepDetailsList
     */
    public $PrepDetailsList;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'SellerSKU'         => ['type' => 'scalar'],
            'ASIN'              => ['type' => 'scalar'],
            'Condition'         => ['type' => 'choice', 'choices' => [
                'NewItem',
                'NewWithWarranty',
                'NewOEM',
                'NewOpenBox',
                'UsedLikeNew',
                'UsedVeryGood',
                'UsedGood',
                'UsedAcceptable',
                'UsedPoor',
                'UsedRefurbished',
                'CollectibleLikeNew',
                'CollectibleVeryGood',
                'CollectibleGood',
                'CollectibleAcceptable',
                'CollectiblePoor',
                'RefurbishedWithWarranty',
                'Refurbished',
                'Club',
            ]],
            'Quantity'          => ['type' => 'scalar'],
            'QuantityInCase'    => ['type' => 'scalar'],
            'PrepDetailsList'   => ['type' => 'array', 'subtype' => PrepDetails::class, 'namespace' => 'member'],
        ];
    }
}

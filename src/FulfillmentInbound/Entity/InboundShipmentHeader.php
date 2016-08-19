<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

use SellerWorks\Amazon\Common\Serializer\MetadataInterface;

/**
 * The dimension values and unit of measurement.
 */
final class InboundShipmentHeader implements MetadataInterface
{
    /**
     * @var string
     */
    public $ShipmentName;

    /**
     * @var Address
     */
    public $ShipFromAddress;

    /**
     * @var string
     */
    public $DestinationFulfillmentCenterId;

    /**
     * @var string
     */
    public $LabelPrepPreference;

    /**
     * @var bool
     */
    public $AreCasesRequired;

    /**
     * @var string
     */
    public $ShipmentStatus;

    /**
     * @var IntendedBoxContentsSource
     */
    public $IntendedBoxContentsSource;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'ShipmentName'                      => ['type' => 'scalar'],
            'ShipFromAddress'                   => ['type' => 'object', 'subtype' => Address::class],
            'DestinationFulfillmentCenterId'    => ['type' => 'scalar'],
            'LabelPrepPreference'               => ['type' => 'choice', 'choices' => [
                'SELLER_LABEL',
                'AMAZON_LABEL_ONLY',
                'AMAZON_LABEL_PREFERRED',
            ]],
            'AreCasesRequired'                  => ['type' => 'boolean'],
            'ShipmentStatus'                    => ['type' => 'choice', 'choices' => [
                'WORKING',
                'SHIPPED',
                'CANCELLED',
            ]],
            'IntendedBoxContentsSource'         => ['type' => 'choice', 'choices' => [
                'NONE',
                'FEED',
                '2D_BARCODE',
            ]],
        ];
    }
}

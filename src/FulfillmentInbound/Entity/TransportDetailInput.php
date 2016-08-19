<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

use SellerWorks\Amazon\Common\Serializer\MetadataInterface;

/**
 * Information required to create an Amazon-partnered carrier shipping estimate, or to alert the Amazon Fulfillment
 * Network to the arrival of an inbound shipment by a non-Amazon-partnered carrier.
 */
final class TransportDetailInput implements MetadataInterface
{
    /**
     * @var PartneredSmallParcelDataInput
     */
    public $PartneredSmallParcelData;

    /**
     * @var NonPartneredSmallParcelDataInput
     */
    public $NonPartneredSmallParcelData;

    /**
     * @var PartneredLtlDataInput
     */
    public $PartneredLtlData;

    /**
     * @var NonPartneredLtlDataInput
     */
    public $NonPartneredLtlData;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'PartneredSmallParcelData'    => ['type' => 'object', 'subtype' => PartneredSmallParcelDataInput::class],
            'NonPartneredSmallParcelData' => ['type' => 'object', 'subtype' => NonPartneredSmallParcelDataInput::class],
            'PartneredLtlData'            => ['type' => 'object', 'subtype' => PartneredLtlDataInput::class],
            'NonPartneredLtlData'         => ['type' => 'object', 'subtype' => NonPartneredLtlDataInput::class],
        ];
    }
}

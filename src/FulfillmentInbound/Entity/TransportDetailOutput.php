<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Inbound shipment information, including carrier details and shipment status.
 */
final class TransportDetailOutput
{
    /**
     * @var PartneredSmallParcelDataOutput
     */
    public $PartneredSmallParcelData;

    /**
     * @var NonPartneredSmallParcelDataOutput
     */
    public $NonPartneredSmallParcelData;

    /**
     * @var PartneredLtlDataOutput
     */
    public $PartneredLtlData;

    /**
     * @var NonPartneredLtlDataOutput
     */
    public $NonPartneredLtlData;
}

<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Inbound shipment information, including carrier details, shipment status, and the workflow status for a request for
 * shipment with an Amazon-partnered carrier.
 */
final class TransportContent
{
    /**
     * @var TransportHeader
     */
    public $TransportHeader;

    /**
     * @var TransportDetailOutput
     */
    public $TransportDetails;

    /**
     * @var TransportResult
     */
    public $TransportResult;
}

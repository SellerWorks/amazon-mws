<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * The PDF document data and checksum for printing package labels and bills of lading.
 */
final class TransportDocument
{
    /**
     * @var string
     */
    public $PdfDocument;

    /**
     * @var string
     */
    public $Checksum;
}

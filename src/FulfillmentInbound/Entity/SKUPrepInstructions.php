<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Labeling requirements and item preparation instructions to help you prepare items for shipment to the Amazon
 * Fulfillment Network.
 */
final class SKUPrepInstructions
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
    public $BarcodeInstruction;

    /**
     * @var string
     */
    public $PrepGuidance;

    /**
     * @var Array<PrepInstruction>
     */
    public $PrepInstructionList;
    
    /**
     * @var Array<AmazonPrepFeesDetails>
     */
    public $AmazonPrepFeesDetails;
}

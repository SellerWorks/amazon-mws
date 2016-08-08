<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Item preparation instructions to help with item sourcing decisions.
 */
final class ASINPrepInstructions
{
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
}

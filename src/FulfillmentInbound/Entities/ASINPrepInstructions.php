<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Entities;

/**
 */
final class ASINPrepInstructions
{
	public $ASIN;
	public $BarcodeInstruction;
	public $PrepGuidance;
	public $PrepInstructionList;
}
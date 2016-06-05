<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
 */
final class SKUPrepInstructions
{
	public $SellerSKU;
	public $ASIN;
	public $BarcodeInstruction;
	public $PrepGuidance;
	public $PrepInstructionList;
//	public $AmazonPrepFeesDetailsList;
}
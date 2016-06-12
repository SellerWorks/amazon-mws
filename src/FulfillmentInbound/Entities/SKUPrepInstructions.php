<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Entities;

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
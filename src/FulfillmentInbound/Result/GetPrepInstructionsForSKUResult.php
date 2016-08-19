<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Result;

use SellerWorks\Amazon\Common\ResultInterface;

/**
 * GetPrepInstructionsForSKU result object.
 */
final class GetPrepInstructionsForSKUResult implements ResultInterface
{
    /**
     * @var ArrayCollection<SKUPrepInstructionsList>
     */
    public $SKUPrepInstructionsList;

    /**
     * @var ArrayCollection<InvalidSKUList>
     */
    public $InvalidSKUList;
}

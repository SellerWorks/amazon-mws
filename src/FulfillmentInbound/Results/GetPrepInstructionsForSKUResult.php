<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Results;

use SellerWorks\Amazon\MWS\Common\ResultInterface;

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
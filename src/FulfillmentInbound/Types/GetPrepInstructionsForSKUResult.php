<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
 */
final class GetPrepInstructionsForSKUResult
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
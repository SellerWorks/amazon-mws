<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
 */
final class GetPrepInstructionsForASINResult
{
    /**
     * @var ArrayCollection<ASINPrepInstructionsList>
     */
    public $ASINPrepInstructionsList;

    /**
     * @var ArrayCollection<InvalidASINList>
     */
    public $InvalidASINList;
}
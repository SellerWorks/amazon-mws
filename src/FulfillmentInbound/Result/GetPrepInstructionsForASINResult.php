<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Result;

use SellerWorks\Amazon\Common\ResultInterface;

/**
 * GetPrepInstructionsForASIN result object.
 */
final class GetPrepInstructionsForASINResult implements ResultInterface
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

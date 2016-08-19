<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Result;

use SellerWorks\Amazon\Common\ResultInterface;

/**
 * GetPrepInstructionsForASIN result object.
 */
final class GetPrepInstructionsForASINResult implements ResultInterface
{
    /**
     * @var Array<ASINPrepInstructions>
     */
    public $ASINPrepInstructionsList;

    /**
     * @var Array<InvalidASIN>
     */
    public $InvalidASINList;
}

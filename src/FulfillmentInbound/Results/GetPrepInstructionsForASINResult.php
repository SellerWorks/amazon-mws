<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

use SellerWorks\Amazon\MWS\Common\ResultInterface;

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
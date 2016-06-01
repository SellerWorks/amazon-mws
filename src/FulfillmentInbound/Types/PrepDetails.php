<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
 * A preparation instruction, and who is reponsible for that preparation.
 */
final class PrepDetails
{
    /**
     * @var string
     */
    public $PrepInstruction;

    /**
     * @var string
     */
    public $PrepOwner;
}
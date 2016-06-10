<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * ListInboundShipmentItems result object.
 */
final class ListInboundShipmentItemsResult implements ResultInterface
{
    /**
     * @var string
     */
    public $NextToken;

    /**
     * @var ArrayCollection<InboundShipmentItem>
     */
    public $ItemData;
}
<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Result;

use SellerWorks\Amazon\Common\ResultInterface;

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
     * @var Array<InboundShipmentItem>
     */
    public $ItemData;
}

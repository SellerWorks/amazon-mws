<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Result;

use SellerWorks\Amazon\Common\ResultInterface;

/**
 * ListInboundShipmentItemsByNextToken result object.
 */
final class ListInboundShipmentItemsByNextTokenResult implements ResultInterface
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

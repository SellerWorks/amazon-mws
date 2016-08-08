<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Result;

use SellerWorks\Amazon\Common\ResultInterface;

/**
 * ListInboundShipmentsByNextToken result object.
 */
final class ListInboundShipmentsByNextTokenResult implements ResultInterface
{
    /**
     * @var string
     */
    public $NextToken;

    /**
     * @var Array<InboundShipmentInfo>
     */
    public $ShipmentData;
}

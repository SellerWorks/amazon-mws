<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
 */
final class ListInboundShipmentItemsResult
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
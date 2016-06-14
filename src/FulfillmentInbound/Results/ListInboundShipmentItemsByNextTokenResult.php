<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Results;

use SellerWorks\Amazon\MWS\Common\IterableInterface;
use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * ListInboundShipmentItemsByNextToken result object.
 */
final class ListInboundShipmentItemsByNextTokenResult implements IterableInterface, ResultInterface
{
    /**
     * @var string
     */
    public $NextToken;

    /**
     * @var Array<InboundShipmentItem>
     */
    public $ItemData;

    /**
     * {@inheritDoc}
     */
    public function getRecords(): array
    {
        return $this->ItemData;
    }

    /**
     * {@inheritDoc}
     */
    public function getMethod(): string
    {
        return 'ListInboundShipmentItems';
    }

    /**
     * {@inheritDoc}
     */
    public function getNextToken(): string
    {
        return (string) $this->NextToken;
    }
}
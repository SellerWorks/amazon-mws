<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Results;

use SellerWorks\Amazon\MWS\Common\IterableInterface;
use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * ListInboundShipmentsByNextToken result object.
 */
final class ListInboundShipmentsByNextTokenResult implements IterableInterface, ResultInterface
{
    /**
     * @var string
     */
    public $NextToken;

    /**
     * @var Array<InboundShipmentInfo>
     */
    public $ShipmentData;

    /**
     * {@inheritDoc}
     */
    public function getRecords(): array
    {
        return $this->ShipmentData;
    }

    /**
     * {@inheritDoc}
     */
    public function getMethod(): string
    {
        return 'ListInboundShipmentsByNextToken';
    }

    /**
     * {@inheritDoc}
     */
    public function getNextToken(): string
    {
        return $this->NextToken;
    }
}
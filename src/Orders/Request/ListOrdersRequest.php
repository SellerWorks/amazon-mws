<?php

namespace SellerWorks\Amazon\Orders\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Returns orders created or updated during a time frame that you specify.
 */
final class ListOrdersRequest implements RequestInterface
{
    /**
     * @var DateTimeInterface|string
     */
    public $CreatedAfter;

    /**
     * @var DateTimeInterface|string
     */
    public $CreatedBefore;

    /**
     * @var DateTimeInterface|string
     */
    public $LastUpdatedAfter;

    /**
     * @var DateTimeInterface|string
     */
    public $LastUpdatedBefore;

    /**
     * @var string
     */
    public $OrderStatus;

    /**
     * @var string
     */
    public $MarketplaceId;

    /**
     * @var string
     */
    public $FulfillmentChannel;

    /**
     * @var string
     */
    public $PaymentMethod;

    /**
     * @var string
     */
    public $BuyerEmail;

    /**
     * @var string
     */
    public $SellerOrderId;

    /**
     * @var int
     */
    public $MaxResultsPerPage;

    /**
     * @var string
     */
    public $TFMShipmentStatus;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'CreatedAfter'          => ['type' => 'datetime'],
            'CreatedBefore'         => ['type' => 'datetime'],
            'LastUpdatedAfter'      => ['type' => 'datetime'],
            'LastUpdatedBefore'     => ['type' => 'datetime'],
            'OrderStatus'           => ['type' => 'choice', 'multiple' => true, 'namespace' => 'Status', 'choices' => [
                'All',
                'PendingAvailability',
                'Pending',
                'Unshipped',
                'PartiallyShipped',
                'Shipped',
                'InvoiceUnconfirmed',
                'Canceled',
                'Unfulfillable',
            ]],
            'MarketplaceId'         => ['type' => 'choice', 'multiple' => true, 'namespace' => 'Id'],
            'FulfillmentChannel'    => ['type' => 'choice', 'multiple' => true, 'namespace' => 'Channel', 'choices' => [
                'All',
                'AFN',
                'MFN',
            ]],
            'PaymentMethod'         => ['type' => 'choice', 'multiple' => true, 'namespace' => 'Method', 'choices' => [
                'All',
                'COD',
                'CVS',
                'Other',
            ]],
            'BuyerEmail'            => ['type' => 'scalar'],
            'SellerOrderId'         => ['type' => 'scalar'],
            'MaxResultsPerPage'     => ['type' => 'range', 'min' => 1, 'max' => 100],
            'TFMShipmentStatus'     => ['type' => 'choice', 'multiple' => true, 'namespace' => 'Status', 'choices' => [
                'All',
                'PendingPickUp',
                'LabelCanceled',
                'PickedUp',
                'AtDestinationFC',
                'Delivered',
                'RejectedByBuyer',
                'Undeliverable',
                'ReturnedToSeller',
                'Lost',
            ]],
        ];
    }
}

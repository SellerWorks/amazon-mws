<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

use SellerWorks\Amazon\Common\Serializer\MetadataInterface;

/**
 * Contact information for the person in your organization who is responsible for a Less Than Truckload/Full Truckload
 * (LTL/FTL) shipment.
 */
final class Contact implements MetadataInterface
{
    /**
     * @var string
     */
    public $Name;

    /**
     * @var string
     */
    public $Phone;

    /**
     * @var string
     */
    public $Email;

    /**
     * @var string
     */
    public $Fax;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'Name'  => ['type' => 'scalar'],
            'Phone' => ['type' => 'scalar'],
            'Email' => ['type' => 'scalar'],
            'Fax'   => ['type' => 'scalar'],
        ];
    }
}

<?php

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Results;

use JMS\Serializer\Annotation as JMS;

/**
 * @JMS\XmlRoot("GetServiceStatusResult")
 */
final class GetServiceStatusResult
{
    /**
     * @JMS\SerializedName("Status")
     * @JMS\Type("string")
     */
    protected $Status;

    /**
     * @JMS\SerializedName("Timestamp")
     * @JMS\Type("DateTime<'Y-m-d\TH:i:s.u\Z'>")
     */
    protected $Timestamp;
}
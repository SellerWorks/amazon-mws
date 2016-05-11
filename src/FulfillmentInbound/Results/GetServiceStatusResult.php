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
    private $Status;

    /**
     * @JMS\SerializedName("Timestamp")
     * @JMS\Type("DateTime<'Y-m-d\Th:i:s.u\Z', 'UTC'>")
     */
    private $Timestamp;
}
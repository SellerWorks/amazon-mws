<?php

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use JMS\Serializer\Annotation as JMS;

final class GetServiceStatusResponse
{
    /**
     * @JMS\SerializedName("GetServiceStatusResult")
     * @JMS\Type("SellerWorks\Amazon\MWS\FulfillmentInbound\Results\GetServiceStatusResult")
     */
    protected $GetServiceStatusResult;

    /**
     * @JMS\SerializedName("ResponseMetadata")
     * @JMS\Type("StdClass")
     */
    protected $ResponseMetadata;
}
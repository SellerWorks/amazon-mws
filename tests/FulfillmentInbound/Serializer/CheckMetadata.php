<?php

namespace SellerWorks\Amazon\Tests\FulfillmentInbound\Serializer;

use SellerWorks\Amazon\Common\Serializer\MetadataInterface;
use SellerWorks\Amazon\FulfillmentInbound\Entity;
use SellerWorks\Amazon\FulfillmentInbound\Request;

/**
 * Serializer tests
 */
class CheckMetadata
{
    /**
     * Test for metadata interface on objects.
     */
    public static function getMetadataClasses()
    {
        return [
            // Requests.
            Request\CreateInboundShipmentPlanRequest::class,
            Request\CreateInboundShipmentRequest::class,
            Request\UpdateInboundShipmentRequest::class,
            Request\GetPrepInstructionsForSKURequest::class,
            Request\GetPrepInstructionsForASINRequest::class,
            Request\ListInboundShipmentsRequest::class,
            Request\ListInboundShipmentsByNextTokenRequest::class,
            Request\ListInboundShipmentItemsRequest::class,
            Request\ListInboundShipmentItemsByNextTokenRequest::class,
            Request\GetServiceStatusRequest::class,

            // Entities.
            Entity\Address::class,
            Entity\AmazonPrepFeesDetails::class,
            Entity\Amount::class,
            Entity\ASINPrepInstructions::class,
            Entity\BoxContentsFeeDetails::class,
            Entity\Contact::class,
            Entity\Dimensions::class,
            Entity\InboundShipmentHeader::class,
            Entity\InboundShipmentInfo::class,
            Entity\InboundShipmentItem::class,
            Entity\InboundShipmentPlan::class,
            Entity\InboundShipmentPlanItem::class,
            Entity\InboundShipmentPlanRequestItem::class,
            Entity\InvalidASIN::class,
            Entity\InvalidSKU::class,
            Entity\NonPartneredLtlDataInput::class,
            Entity\NonPartneredLtlDataOutput::class,
            Entity\NonPartneredSmallParcelDataInput::class,
            Entity\NonPartneredSmallParcelDataOutput::class,
            Entity\NonPartneredSmallParcelPackageInput::class,
            Entity\NonPartneredSmallParcelPackageOutput::class,
            Entity\Pallet::class,
            Entity\PartneredEstimate::class,
            Entity\PartneredLtlDataInput::class,
            Entity\PartneredLtlDataOutput::class,
            Entity\PartneredSmallParcelDataInput::class,
            Entity\PartneredSmallParcelDataOutput::class,
            Entity\PartneredSmallParcelPackageInput::class,
            Entity\PartneredSmallParcelPackageOutput::class,
            Entity\PrepDetails::class,
            Entity\PrepInstruction::class,
            Entity\ResponseMetadata::class,
            Entity\SKUPrepInstructions::class,
            Entity\TransportContent::class,
            Entity\TransportDetailInput::class,
            Entity\TransportDetailOutput::class,
            Entity\TransportDocument::class,
            Entity\TransportHeader::class,
            Entity\TransportResult::class,
            Entity\Weight::class,
        ];
    }
}

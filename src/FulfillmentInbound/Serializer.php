<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

use DateTimeInterface;
use ReflectionClass;
use ReflectionProperty;
use SellerWorks\Amazon\MWS\Common\RequestInterface;
use SellerWorks\Amazon\MWS\Common\Requests\GetServiceStatusRequest;
use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use SellerWorks\Amazon\MWS\Common\SerializerInterface;
use UnexpectedValueException;

/**
 * FulfillmentInboundShipment serializer.
 *
 * Premature optimization? I think not!
 */
class Serializer implements SerializerInterface
{
    /**
     * @var  Sabre\Xml\Service
     */
    protected $xmlService;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->xmlService = new XmlService;
    }

    /**
     * {@inheritDoc}
     */
    public function serialize(RequestInterface $request): array
    {
        // Validate request is valid type and set action.
        switch (true) {
            case $request instanceof Requests\CreateInboundShipmentPlanRequest;
                return $this->serializeCreateInboundShipmentPlan($request);

            case $request instanceof Requests\CreateInboundShipmentRequest;
                return $this->serializeCreateInboundShipment($request);

            case $request instanceof Requests\UpdateInboundShipmentRequest:
                return $this->serializeUpdateInboundShipment($request);

            case $request instanceof Requests\GetPrepInstructionsForSKURequest:
                return $this->serializeGetPrepInstructionsForSKU($request);

            case $request instanceof Requests\GetPrepInstructionsForASINRequest:
                return $this->serializeGetPrepInstructionsForASIN($request);

            case $request instanceof Requests\ListInboundShipmentsRequest:
                return $this->serializeListInboundShipments($request);

            case $request instanceof Requests\ListInboundShipmentsByNextTokenRequest:
                return $this->serializeListInboundShipmentsByNextToken($request);

            case $request instanceof Requests\ListInboundShipmentItemsRequest:
                return $this->serializeListInboundShipmentItems($request);

            case $request instanceof Requests\ListInboundShipmentItemsByNextTokenRequest:
                return $this->serializeListInboundShipmentItemsByNextToken($request);

            case $request instanceof GetServiceStatusRequest:
                return $this->serializeGetServiceStatus($request);

            default:
                throw new UnexpectedValueException(getType($request) . ' is not supported.');
        }
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize(string $response): ResponseInterface
    {
        $r = $this->xmlService->parse($response);

        return $r;
    }

    /**
     * Serialize CreateInboundShipmentPlan
     *
     * @param  CreateInboundShipmentPlanRequest  $request
     * @return array
     */
    protected function serializeCreateInboundShipmentPlan(Requests\CreateInboundShipmentPlanRequest $request): array
    {
        $array  = ['Action' => 'CreateInboundShipmentPlan'];
        $array += $this->parseAddress($request->ShipFromAddress, 'ShipFromAddress.');

        if (isset($request->ShipToCountryCode)) {
            $array['ShipToCountryCode'] = $request->ShipToCountryCode;
        }

        if (isset($request->ShipToCountrySubdivisionCode)) {
            $array['ShipToCountrySubdivisionCode'] = $request->ShipToCountrySubdivisionCode;
        }

        if (isset($request->LabelPrepPreference)) {
            $array['LabelPrepPreference'] = $request->LabelPrepPreference;
        }

        if (is_array($request->InboundShipmentPlanRequestItems) && !empty($request->InboundShipmentPlanRequestItems)) {
            $pos = 1;

            foreach ($request->InboundShipmentPlanRequestItems as $i) {
                $key = sprintf('InboundShipmentPlanRequestItems.member.%s.', $pos);
                $array[$key.'SellerSKU'] = $i->SellerSKU;
                $array[$key.'Quantity']  = $i->Quantity;

                if (isset($i->ASIN)) {
                    $array[$key.'ASIN'] = $i->ASIN;
                }

                if (isset($i->Condition)) {
                    $array[$key.'Condition'] = $i->Condition;
                }

                if (isset($i->QuantityInCase)) {
                    $array[$key.'QuantityInCase'] = $i->QuantityInCase;
                }

                if (is_array($i->PrepDetailsList) && !empty($i->PrepDetailsList)) {
                    $pos2 = 1;

                    foreach ($i->PrepDetailsList as $k) {
                        $key2 = sprintf('%sPrepDetailsList.PrepDetails.%s.', $key, $pos2);
                        $array[$key2.'PrepInstruction'] = $k->PrepInstruction;
                        $array[$key2.'PrepOwner']       = $k->PrepOwner;

                        ++$pos2;
                    }
                }

                ++$pos;
            }
        }

        return $array;
    }

    /**
     * Serialize CreateInboundShipmentPlan
     *
     * @param  CreateInboundShipmentRequest  $request
     * @return array
     */
    protected function serializeCreateInboundShipment(Requests\CreateInboundShipmentRequest $request): array
    {
        $header = $request->InboundShipmentHeader;
        $array  = [
            'Action'     => 'CreateInboundShipment',
            'ShipmentId' => $request->ShipmentId,

            'InboundShipmentHeader.ShipmentName'                    => $header->ShipmentName,
            'InboundShipmentHeader.DestinationFulfillmentCenterId'  => $header->DestinationFulfillmentCenterId,
            'InboundShipmentHeader.LabelPrepPreference'             => $header->LabelPrepPreference,
            'InboundShipmentHeader.ShipmentStatus'                  => $header->ShipmentStatus,
        ];
        $array += $this->parseAddress($header->ShipFromAddress, 'InboundShipmentHeader.ShipFromAddress.');

        if (isset($header->AreCasesRequired)) {
            $array['InboundShipmentHeader.AreCasesRequired'] = $header->AreCasesRequired? 'true' : 'false';
        }

        if (is_array($request->InboundShipmentItems) && !empty($request->InboundShipmentItems)) {
            $pos = 1;

            foreach ($request->InboundShipmentItems as $i) {
                $key = sprintf('InboundShipmentItems.member.%s.', $pos);
                $array[$key.'SellerSKU']       = $i->SellerSKU;
                $array[$key.'QuantityShipped'] = $i->QuantityShipped;

                if (isset($i->ShipmentId)) {
                    $array[$key.'ShipmentId'] = $i->ShipmentId;
                }

                if (isset($i->FulfillmentNetworkSKU)) {
                    $array[$key.'FulfillmentNetworkSKU'] = $i->FulfillmentNetworkSKU;
                }

                if (isset($i->QuantityReceived)) {
                    $array[$key.'QuantityReceived'] = $i->QuantityReceived;
                }

                if (isset($i->QuantityInCase)) {
                    $array[$key.'QuantityInCase'] = $i->QuantityInCase;
                }

                if (isset($i->ReleaseDate)) {
                    if ($i->ReleaseDate instanceof DateTimeInterface) {
                        $array[$key.'ReleaseDate'] = $i->ReleaseDate->format('Y-m-d');
                    }
                    else {
                        $array[$key.'ReleaseDate'] = $i->ReleaseDate;
                    }
                }

                if (is_array($i->PrepDetailsList) && !empty($i->PrepDetailsList)) {
                    $pos2 = 1;

                    foreach ($i->PrepDetailsList as $k) {
                        $key2 = sprintf('%sPrepDetailsList.PrepDetails.%s.', $key, $pos2);
                        $array[$key2.'PrepInstruction'] = $k->PrepInstruction;
                        $array[$key2.'PrepOwner']       = $k->PrepOwner;

                        ++$pos2;
                    }
                }

                ++$pos;
            }
        }

        return $array;
    }

    /**
     * Serialize UpdateInboundShipmentRequest
     *
     * @param  UpdateInboundShipmentRequest  $request
     * @return array
     */
    protected function serializeUpdateInboundShipment(Requests\UpdateInboundShipmentRequest $request): array
    {
        $fakeRequest = new Requests\CreateInboundShipmentRequest;
        $fakeRequest->ShipmentId = $request->ShipmentId;
        $fakeRequest->InboundShipmentHeader = $request->InboundShipmentHeader;
        $fakeRequest->InboundShipmentItems  = $request->InboundShipmentItems;

        $array = $this->serializeCreateInboundShipment($fakeRequest);
        $array['Action'] = 'UpdateInboundShipment';

        return $array;
    }

    /**
     * Serialize GetPrepInstructionsForSKURequest
     *
     * @param  GetPrepInstructionsForSKURequest  $request
     * @return array
     */
    protected function serializeGetPrepInstructionsForSKU(Requests\GetPrepInstructionsForSKURequest $request): array
    {
        $array = [
            'Action'            => 'GetPrepInstructionsForSKU',
            'ShipToCountryCode' => $request->ShipToCountryCode,
        ];

        if (is_array($request->SellerSKUList) && !empty($request->SellerSKUList)) {
            $pos = 1;

            foreach ($request->SellerSKUList as $i) {
                $key = sprintf('SellerSKUList.Id.%s', $pos);
                $array[$key] = $i;

                ++$pos;
            }
        }

        return $array;
    }

    /**
     * Serialize GetPrepInstructionsForASINRequest
     *
     * @param  GetPrepInstructionsForASINRequest  $request
     * @return array
     */
    protected function serializeGetPrepInstructionsForASIN(Requests\GetPrepInstructionsForASINRequest $request): array
    {
        $array = [
            'Action'            => 'GetPrepInstructionsForASIN',
            'ShipToCountryCode' => $request->ShipToCountryCode,
        ];

        if (is_array($request->SellerASINList) && !empty($request->SellerASINList)) {
            $pos = 1;

            foreach ($request->SellerASINList as $i) {
                $key = sprintf('SellerASINList.Id.%s', $pos);
                $array[$key] = $i;

                ++$pos;
            }
        }

        return $array;
    }

    /**
     * Serialize ListInboundShipmentsRequest
     *
     * @param  ListInboundShipmentsRequest  $request
     * @return array
     */
    protected function serializeListInboundShipments(Requests\ListInboundShipmentsRequest $request): array
    {
        $array = [
            'Action' => 'ListInboundShipments',
        ];

        if (is_array($request->ShipmentStatusList) && !empty($request->ShipmentStatusList)) {
            $pos = 1;

            foreach ($request->ShipmentStatusList as $i) {
                $key = sprintf('ShipmentStatusList.member.%s', $pos);
                $array[$key] = $i;

                ++$pos;
            }
        }

        if (is_array($request->ShipmentIdList) && !empty($request->ShipmentIdList)) {
            $pos = 1;

            foreach ($request->ShipmentIdList as $i) {
                $key = sprintf('ShipmentIdList.member.%s', $pos);
                $array[$key] = $i;

                ++$pos;
            }
        }

        if (isset($request->LastUpdatedAfter)) {
            if ($request->LastUpdatedAfter instanceof DateTimeInterface) {
                $array['LastUpdatedAfter'] = $request->LastUpdatedAfter->format(static::DATE_FORMAT);
            }
            else {
                $array['LastUpdatedAfter'] = $request->LastUpdatedAfter;
            }
        }

        if (isset($request->LastUpdatedBefore)) {
            if ($request->LastUpdatedBefore instanceof DateTimeInterface) {
                $array['LastUpdatedBefore'] = $request->LastUpdatedBefore->format(static::DATE_FORMAT);
            }
            else {
                $array['LastUpdatedBefore'] = $request->LastUpdatedBefore;
            }
        }

        return $array;
    }

    /**
     * Serialize ListInboundShipmentsByNextTokenRequest
     *
     * @param  ListInboundShipmentsByNextTokenRequest  $request
     * @return array
     */
    protected function serializeListInboundShipmentsByNextToken(Requests\ListInboundShipmentsByNextTokenRequest $request): array
    {
        $array = [
            'Action'    => 'ListInboundShipmentsByNextToken',
            'NextToken' => $request->NextToken,
        ];

        return $array;
    }

    /**
     * Serialize ListInboundShipmentItemsRequest
     *
     * @param  ListInboundShipmentItemsRequest  $request
     * @return array
     */
    protected function serializeListInboundShipmentItems(Requests\ListInboundShipmentItemsRequest $request): array
    {
        $array = [
            'Action'     => 'ListInboundShipmentItems',
            'ShipmentId' => $request->ShipmentId,
        ];

        if (isset($request->LastUpdatedAfter)) {
            if ($request->LastUpdatedAfter instanceof DateTimeInterface) {
                $array['LastUpdatedAfter'] = $request->LastUpdatedAfter->format(static::DATE_FORMAT);
            }
            else {
                $array['LastUpdatedAfter'] = $request->LastUpdatedAfter;
            }
        }

        if (isset($request->LastUpdatedBefore)) {
            if ($request->LastUpdatedBefore instanceof DateTimeInterface) {
                $array['LastUpdatedBefore'] = $request->LastUpdatedBefore->format(static::DATE_FORMAT);
            }
            else {
                $array['LastUpdatedBefore'] = $request->LastUpdatedBefore;
            }
        }

        return $array;
    }

    /**
     * Serialize ListInboundShipmentItemsByNextTokenRequest
     *
     * @param  ListInboundShipmentItemsByNextTokenRequest  $request
     * @return array
     */
    protected function serializeListInboundShipmentItemsByNextToken(Requests\ListInboundShipmentItemsByNextTokenRequest $request): array
    {
        $array = [
            'Action'    => 'ListInboundShipmentItemsByNextToken',
            'NextToken' => $request->NextToken,
        ];

        return $array;
    }

    /**
     * Serialize GetServiceStatus
     *
     * @param  GetServiceStatusRequest  $request
     * @return array
     */
    protected function serializeGetServiceStatus(GetServiceStatusRequest $request): array
    {
        $array = ['Action' => 'GetServiceStatus'];

        return $array;
    }

    /**
     * Parse Address object.
     *
     * @param  Address  $address
     * @param  string  $prefix
     * @return array
     */
    protected function parseAddress(Entities\Address $address, string $prefix = ''): array
    {
        $results = [
            $prefix.'Name'          => $address->Name,
            $prefix.'AddressLine1'  => $address->AddressLine1,
            $prefix.'City'          => $address->City,
            $prefix.'CountryCode'   => $address->CountryCode,
        ];

        if (isset($address->AddressLine2)) {
            $results[$prefix.'AddressLine2'] = $address->AddressLine2;
        }
        if (isset($address->DistrictOrCounty)) {
            $results[$prefix.'DistrictOrCounty'] = $address->DistrictOrCounty;
        }
        if (isset($address->StateOrProvinceCode)) {
            $results[$prefix.'StateOrProvinceCode'] = $address->StateOrProvinceCode;
        }
        if (isset($address->PostalCode)) {
            $results[$prefix.'PostalCode'] = $address->PostalCode;
        }

        return $results;
    }
}
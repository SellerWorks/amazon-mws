<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Serializer;

use DateTimeInterface;
use ReflectionClass;
use ReflectionProperty;
use UnexpectedValueException;

use SellerWorks\Amazon\Common\RequestInterface;
use SellerWorks\Amazon\Common\SerializerInterface;
use SellerWorks\Amazon\FulfillmentInbound\Request;

/**
 * Request Serializer / Response Deserializer.
 */
class Serializer implements SerializerInterface
{
    /**
     * @var Sabre\Xml\Service
     */
    private $xmlDeserializer;

    /**
     * @var array
     */
    private $validChoices = [
        'ShipmentStatusList' => [
            'WORKING',
            'SHIPPED',
            'IN_TRANSIT',
            'DELIVERED',
            'CHECKED_IN',
            'RECEIVING',
            'CLOSED',
            'CANCELLED',
            'DELETED',
            'ERROR',
        ],
    ];

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->xmlDeserializer = new XmlDeserializer;
    }

    /**
     * {@inheritDoc}
     */
    public function serialize(RequestInterface $request)
    {
        // Validate request is valid type and set action.
        switch (true) {
            case $request instanceof Request\CreateInboundShipmentPlanRequest;
                $action = 'CreateInboundShipmentPlan';
                break;

            case $request instanceof Request\CreateInboundShipmentRequest;
                $action = 'CreateInboundShipment';
                break;

            case $request instanceof Request\UpdateInboundShipmentRequest:
                $action = 'UpdateInboundShipment';
                break;

            case $request instanceof Request\GetPrepInstructionsForSKURequest:
                $action = 'GetPrepInstructionsForSKU';
                break;

            case $request instanceof Request\GetPrepInstructionsForASINRequest:
                $action = 'GetPrepInstructionsForASIN';
                break;

            case $request instanceof Request\ListInboundShipmentsRequest:
                $action = 'ListInboundShipments';
                break;

            case $request instanceof Request\ListInboundShipmentsByNextTokenRequest:
                $action = 'ListInboundShipmentsByNextToken';
                break;

            case $request instanceof Request\ListInboundShipmentItemsRequest:
                $action = 'ListInboundShipmentItems';
                break;

            case $request instanceof Request\ListInboundShipmentItemsByNextTokenRequest:
                $action = 'ListInboundShipmentItemsByNextToken';
                break;

            case $request instanceof Request\GetServiceStatusRequest:
                $action = 'GetServiceStatus';
                break;

            default:
                throw new UnexpectedValueException(getclass($request) . ' is not supported.');
        }

        return $this->serializeProperties($action, $request);
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize($response)
    {
        return $this->xmlDeserializer->parse($response);
    }

    /**
     * @param  string  $action
     * @param  RequestInterface  $request
     * @return array
     */
    protected function serializeProperties($action, RequestInterface $request)
    {
        $parameters = array_merge(['Action' => $action], $this->flatten($request));

        return $parameters;
    }

    /**
     * Flatten objects into dot-notation arrays.
     *
     * @param  mixed  $object
     * @param  string  $prefix
     * @return array
     */
    protected function flatten($object, $prefix = null, $separator = '.')
    {
        if (!is_object($object)) {
            return $object;
        }

        $flattened = [];
        $reflection = new ReflectionClass(get_class($object));
        $properties = $reflection->getProperties();

        foreach ($properties as $p) {
            $propName  = $p->getName();
            $propValue = $p->getValue($object);

        }
    }



        $parameters = [];



        foreach ($properties as $p) {
            $propName  = $p->getName();
            $propValue = $p->getValue($object);

            if (empty($propValue)) {
                continue;
            }

            switch ($propName) {
                // DateTime properties.
                case 'LastUpdatedAfter':
                case 'LastUpdatedBefore':
                    if ($propValue instanceof DateTimeInterface) {
                        $parameters[$propName] = $propValue->format(static::DATE_FORMAT);
                    }
                    elseif (is_string($propValue) && false !== ($time = strtotime($propValue))) {
                        $parameters[$propName] = gmdate(static::DATE_FORMAT, $time);
                    }
                    break;


                // Range properties.
                case '':
                    if (is_numeric($propValue) && $propValue >= 1 && $propValue <= 100) {
                        $parameters[$propName] = (int) $propValue;
                    }
                    break;


                // String properties.
                case 'NextToken':
                case 'ShipmentId':
                    $parameters[$propName] = $propValue;
                    break;


                // Choice properties.
                case 'ShipmentIdList':
                    $parameters = array_merge(
                        $parameters,
                        $this->buildChoiceList('ShipmentIdList', 'member', $propValue, false));
                    break;

                case 'ShipmentStatusList':
                    $parameters = array_merge(
                        $parameters,
                        $this->buildChoiceList('ShipmentStatusList', 'member', $propValue));
                    break;


                // Object properties.
                case 'ShipFromAddress':
                    $parameters = array_merge($properties, $this->flatten($propValue, 'ShipFromAddress.'));


                default: break;
            }
        }

        return $parameters;
    }

    /**
     * Build choice parameters.
     *
     * @param  string  $propName
     * @param  string  $listName
     * @param  array|string  $list
     * @param  bool  $validate
     * @return array
     */
    protected function buildChoiceList($propName, $listName, $list, $validate = true)
    {
        $choice = [];
        $list   = array_unique((array) $list);
        $i      = 0;

        foreach ($list as $value) {
            if ($validate && !in_array($value, $this->validChoices[$propName])) {
                continue;
            }

            $choice[sprintf('%s.%s.%s', $propName, $listName, ++$i)] = $value;
        }

        return $choice;
    }













    /**
     * Serialize CreateInboundShipmentPlan
     *
     * @param  CreateInboundShipmentPlanRequest  $request
     * @return array
     */
    protected function serializeCreateInboundShipmentPlan(Requests\CreateInboundShipmentPlanRequest $request)
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
    protected function serializeCreateInboundShipment(Requests\CreateInboundShipmentRequest $request)
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
    protected function serializeUpdateInboundShipment(Requests\UpdateInboundShipmentRequest $request)
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
    protected function serializeGetPrepInstructionsForSKU(Requests\GetPrepInstructionsForSKURequest $request)
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
    protected function serializeGetPrepInstructionsForASIN(Requests\GetPrepInstructionsForASINRequest $request)
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
    protected function serializeListInboundShipments(Requests\ListInboundShipmentsRequest $request)
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
    protected function serializeListInboundShipmentsByNextToken(Requests\ListInboundShipmentsByNextTokenRequest $request)
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
    protected function serializeListInboundShipmentItems(Requests\ListInboundShipmentItemsRequest $request)
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
    protected function serializeListInboundShipmentItemsByNextToken(Requests\ListInboundShipmentItemsByNextTokenRequest $request)
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
    protected function serializeGetServiceStatus(GetServiceStatusRequest $request)
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
    protected function parseAddress(Entities\Address $address, $prefix = '')
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

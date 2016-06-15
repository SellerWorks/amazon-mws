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
        $action = '';

        // Validate request is valid type and set action.
        switch (true) {
            case $request instanceof Requests\CreateInboundShipmentPlanRequest;
                $action = 'CreateInboundShipmentPlan';
                break;

            case $request instanceof Requests\CreateInboundShipment;
                $action = 'CreateInboundShipment';
                break;

            case $request instanceof Requests\ListInboundShipmentsRequest:
                $action = 'ListInboundShipments';
                break;

            case $request instanceof Requests\ListInboundShipmentsByNextTokenRequest:
                $action = 'ListInboundShipmentsByNextToken';
                break;

            case $request instanceof Requests\ListInboundShipmentItemsRequest:
                $action = 'ListInboundShipmentItems';
                break;

            case $request instanceof GetServiceStatusRequest:
                $action = 'GetServiceStatus';
                break;

            default:
                throw new UnexpectedValueException(getType($request) . ' is not supported.');
        }

        // Add properties.
        $returnArr = ['Action' => $action] + $this->toArray($request);

        return $returnArr;
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize(string $response): ResponseInterface
    {
        return $this->xmlService->parse($response);
    }

    /**
     * Flatten Request object with dot-notation.
     *
     * @param  RequestInterface  $request
     * @return array
     */
    protected function toArray(RequestInterface $request): array
    {
        $returnArr  = [];
        $reflection = new ReflectionClass(get_class($request));
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            $propName  = $property->getName();
            $propValue = $property->getValue($request);

            switch ($propName) {
                // Address properties.
                case 'ShipFromAddress':
                    if ($propValue instanceof Entities\Address) {
                        $returnArr += $this->parseAddress($propValue, sprintf('%s.', $propName));
                    }
                    break;


                // Array<string> properties.
                case 'ShipmentIdList':
                case 'ShipmentStatusList':
                    if (is_array($propValue) && !empty($propValue)) {
                        $pos = 1;

                        foreach ($propValue as $value) {
                            $key = sprintf('%s.member.%s', $propName, $pos);
                            $returnArr[$key] = $value;
                            ++$pos;
                        }
                    }
                    break;


                // DateTime properties.
                case 'LastUpdatedAfter':
                case 'LastUpdatedBefore':
                    if ($propValue instanceof DateTimeInterface) {
                        $returnArr[$propName] = $propValue->format(static::DATE_FORMAT);
                    }
                    break;


                // String properties.
                case 'LabelPrepPreference':
                case 'NextToken':
                case 'ShipmentId':
                case 'ShipToCountryCode':
                case 'ShipToCountrySubdivisionCode':
                    if (!empty($propValue)) {
                        $returnArr[$propName] = (string) $propValue;
                    }
                    break;


                // Unique cases.
                case 'InboundShipmentPlanRequestItems':
                    if (is_array($propValue) && !empty($propValue)) {
                        $pos = 1;

                        foreach ($propValue as $i) {
                            $key = sprintf('%s.member.%s.', $propName, $pos);
                            $returnArr[$key.'SellerSKU'] = $i->SellerSKU;
                            $returnArr[$key.'Quantity']  = $i->Quantity;

                            if (isset($i->ASIN)) {
                                $returnArr[$key.'ASIN'] = $i->ASIN;
                            }
                            if (isset($i->Condition)) {
                                $returnArr[$key.'Condition'] = $i->Condition;
                            }
                            if (isset($i->QuantityInCase)) {
                                $returnArr[$key.'QuantityInCase'] = $i->QuantityInCase;
                            }

                            if (is_array($i->PrepDetailsList) && !empty($i->PrepDetailsList)) {
                                $pos2 = 1;

                                foreach ($i->PrepDetailsList as $k) {
                                    $key2 = sprintf('%sPrepDetailsList.PrepDetails.%s.', $key, $pos2);
                                    $returnArr[$key2.'PrepInstruction'] = $k->PrepInstruction;
                                    $returnArr[$key2.'PrepOwner']       = $k->PrepOwner;

                                    ++$pos2;
                                }
                            }

                            ++$pos;
                        }
                    }
                    break;


                case 'InboundShipmentHeader':
                    $prefix = sprintf('%s.', $propName);
                    $returnArr[$prefix.'ShipmentName'] = $propValue->ShipmentName;
                    $returnArr += $this->parseAddress($propValue->ShipFromAddress, $prefix);
                    $returnArr[$prefix.'DestinationFulfillmentCenterId'] = $propValue->DestinationFulfillmentCenterId;
                    $returnArr[$prefix.'LabelPrepPreference'] = $propValue->LabelPrepPreference;
                    $returnArr[$prefix.'ShipmentStatus'] = $propValue->ShipmentStatus;

                    if (isset($propValue->AreCasesRequired)) {
                        $returnArr[$prefix.'AreCasesRequired'] = $propValue->AreCasesRequired;
                    }
                    break;


                case 'InboundShipmentItems':
                    if (is_array($propValue) && !empty($propValue)) {
                        $pos = 1;

                        foreach ($propValue as $i) {
                            $key = sprintf('%s.member.%s.', $propName, $pos);
                            $returnArr[$key.'SellerSKU'] = $i->SellerSKU;
                            $returnArr[$key.'QuantityShipped'] = $i->QuantityShipped;

                            if (isset($i->ShipmentId)) {
                                $returnArr[$key.'ShipmentId'] = $i->ShipmentId;
                            }
                            if (isset($i->FulfillmentNetworkSKU)) {
                                $returnArr[$key.'FulfillmentNetworkSKU'] = $i->FulfillmentNetworkSKU;
                            }
                            if (isset($i->QuantityReceived)) {
                                $returnArr[$key.'QuantityReceived'] = $i->QuantityReceived;
                            }
                            if (isset($i->QuantityInCase)) {
                                $returnArr[$key.'QuantityInCase'] = $i->QuantityInCase;
                            }
                            if (isset($i->ReleaseDate)) {
                                $returnArr[$key.'ReleaseDate'] = $i->ReleaseDate;
                            }
                        }
                    }
                    break;
            }
        }

        return $returnArr;
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
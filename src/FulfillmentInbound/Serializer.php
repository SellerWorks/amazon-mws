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
        $returnArr = array_merge(['Action' => $action], $this->serializeReflection($request));

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
     * Serialize objects by reflection.
     *
     * @param  RequestInterface  $request
     * @return array
     */
    protected function serializeReflection(RequestInterface $request): array
    {
        $returnArr  = [];
        $reflection = new ReflectionClass($request);
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            $propName  = $property->getName();
            $propValue = $property->getValue($request);

            switch ($propName) {
                // Address properties.
                case 'ShipFromAddress':
                    if ($propValue instanceof Entities\Address) {
                        $prefix = sprintf('%s.', $propName);
                        $returnArr[$prefix.'Name']         = $propValue->Name;
                        $returnArr[$prefix.'AddressLine1'] = $propValue->AddressLine1;
                        $returnArr[$prefix.'City']         = $propValue->City;
                        $returnArr[$prefix.'CountryCode']  = $propValue->CountryCode;

                        if (!empty($propValue->AddressLine2)) {
                            $returnArr[$prefix.'AddressLine2'] = $propValue->AddressLine2;
                        }
                        if (!empty($propValue->DistrictOrCounty)) {
                            $returnArr[$prefix.'DistrictOrCounty'] = $propValue->DistrictOrCounty;
                        }
                        if (!empty($propValue->StateOrProvinceCode)) {
                            $returnArr[$prefix.'StateOrProvinceCode'] = $propValue->StateOrProvinceCode;
                        }
                        if (!empty($propValue->PostalCode)) {
                            $returnArr[$prefix.'PostalCode'] = $propValue->PostalCode;
                        }
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

                            if (!empty($i->ASIN)) {
                                $returnArr[$key.'ASIN'] = $i->ASIN;
                            }
                            if (!empty($i->Condition)) {
                                $returnArr[$key.'Condition'] = $i->Condition;
                            }
                            if (!empty($i->QuantityInCase)) {
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
            }
        }

        return $returnArr;
    }
}
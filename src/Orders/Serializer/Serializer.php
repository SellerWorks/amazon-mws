<?php

namespace SellerWorks\Amazon\Orders\Serializer;

use DateTimeInterface;
use ReflectionClass;
use ReflectionProperty;
use UnexpectedValueException;

use SellerWorks\Amazon\Common\RequestInterface;
use SellerWorks\Amazon\Common\SerializerInterface;
use SellerWorks\Amazon\Orders\Request;

/**
 * Request Serializer / Response Deserializer.
 */
final class Serializer implements SerializerInterface
{
    /**
     * @var Sabre\Xml\Service
     */
    private $xmlDeserializer;

    /**
     * Valid choice values.
     *
     * @var array
     */
    private $validChoices = [
        'FulfillmentChannel' => ['AFN', 'MFN'],
        'OrderStatus' => [
            'PendingAvailability',
            'Pending',
            'Unshipped',
            'PartiallyShipped',
            'Shipped',
            'InvoiceUnconfirmed',
            'Canceled',
            'Unfulfillable',
        ],
        'PaymentMethod' => ['COD', 'CVS', 'Other'],
        'TFMShipmentStatus' => [
            'PendingPickUp',
            'LabelCanceled',
            'PickedUp',
            'AtDestinationFC',
            'Delivered',
            'RejectedByBuyer',
            'Undeliverable',
            'ReturnedToSeller',
            'Lost',
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
            case $request instanceof Request\ListOrdersRequest:
                $action = 'ListOrders';
                break;

            case $request instanceof Request\ListOrdersByNextTokenRequest:
                $action = 'ListOrdersByNextToken';
                break;

            case $request instanceof Request\GetOrderRequest:
                $action = 'GetOrder';
                break;

            case $request instanceof Request\ListOrderItemsRequest:
                $action = 'ListOrderItems';
                break;

            case $request instanceof Request\ListOrderItemsByNextTokenRequest:
                $action = 'ListOrderItemsByNextToken';
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
        $parameters = ['Action' => $action];
        $reflection = new ReflectionClass(get_class($request));
        $properties = $reflection->getProperties();

        foreach ($properties as $p) {
            $propName  = $p->getName();
            $propValue = $p->getValue($request);

//             printf("Checking %s = %s\n", $propName, implode(',', (array) $propValue));

            if (empty($propValue)) {
                continue;
            }

            switch ($propName) {
                // DateTime properties.
                case 'CreatedAfter':
                case 'CreatedBefore':
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
                case 'MaxResultsPerPage':
                    if (is_numeric($propValue) && $propValue >= 1 && $propValue <= 100) {
                        $parameters[$propName] = (int) $propValue;
                    }
                    break;


                // String properties.
                case 'AmazonOrderId' && $action == 'ListOrderItems' || $action == 'ListOrderItemsByNextToken':
                case 'BuyerEmail':
                case 'NextToken':
                case 'SellerOrderId':
                    $parameters[$propName] = $propValue;
                    break;


                // Choice properties.
                case 'AmazonOrderId' && $action == 'GetOrder':
                    $parameters = array_merge(
                        $parameters,
                        $this->buildChoiceList('AmazonOrderId', 'Id', $propValue, false));
                    break;

                case 'FulfillmentChannel':
                    $parameters = array_merge($parameters, $this->buildChoiceList($propName, 'Channel', $propValue));
                    break;

                case 'MarketplaceId':
                    $parameters = array_merge($parameters, $this->buildChoiceList($propName, 'Id', $propValue, false));
                    break;

                case 'OrderStatus':
                    $propValue = (array) $propValue;

                    // Unshipped and PartiallyShipped must be used together in this version of the Orders API section.
                    // Using one and not the other returns an error.
                    if (in_array('Unshipped', (array) $propValue)) {
                        $propValue[] = 'PartiallyShipped';
                    }
                    elseif (in_array('PartiallyShipped', (array) $propValue)) {
                        $propValue[] = 'Unshipped';
                    }

                    $parameters = array_merge($parameters, $this->buildChoiceList($propName, 'Channel', $propValue));
                    break;

                case 'PaymentMethod':
                    // COD and CVS values are valid only in Japan (JP).
                    // Unable to validate without knowing country!
                    $parameters = array_merge($parameters, $this->buildChoiceList($propName, 'Method', $propValue));
                    break;

                case 'TFMShipmentStatus':
                    // Note: The TFMShipmentStatus request parameter is available only in China (CN).
                    $parameters = array_merge($parameters, $this->buildChoiceList($propName, 'Status', $propValue));
                    break;


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
}

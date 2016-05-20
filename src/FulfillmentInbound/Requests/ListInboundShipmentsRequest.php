http://mws.amazonaws.com/FulfillmentInboundShipment/2010-10-01
  ?AWSAccessKeyId=AKIAJGUVGFGHNKE2NVUA
  &Action=ListInboundShipments
  &MWSAuthToken=amzn.mws.4ea38b7b-f563-7709-4bae-87aeaEXAMPLE
  &SellerId=A2NKEXAMPLEF53
  &LastUpdatedAfter=2015-10-02T12%3A00%3A54Z
  $LastUpdatedBefore=2015-11-02T12%3A00%3A54Z
  &SignatureVersion=2
  &Timestamp=2015-12-02T02:40:36Z
  &Version=2010-10-01
  &Signature=COwchWurFSmkpQ9OOCoZy5THApVmrpf0mtyxk5ShtrI%3D
  &SignatureMethod=HmacSHA256
  &ShipmentStatusList.member.1=WORKING
  &ShipmentStatusList.member.2=CLOSED
  &ShipmentIdList.member.1=FBA44JV8R
  &ShipmentIdList.member.2=FBA4X8YLS
  &ShipmentIdList.member.3=FBA4X9FML

<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use SellerWorks\Amazon\MWS\Common\RequestInterface;

final class GetServiceStatusRequest implements RequestInterface
{
    /**
     * @var Array<string>
     */
    public $ShipmentStatusList;

    /**
     * @var Array<string>
     */
    public $ShipmentIdList;

    /**
     * @var DateTimeInterface
     */
    public $LastUpdatedAfter;

    /**
     * @var DateTimeInterface
     */
    public $LastUpdatedBefore;

    /**
     * {@inheritDoc}
     */
    public function getParameters(): array
    {
        $request = [
            'Action' => 'ListInboundShipments',
        ];

        return $request;
    }
}
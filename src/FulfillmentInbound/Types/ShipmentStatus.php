<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
 */
final class ShipmentStatus
{
    /**
     * @const  string
     */
	const WORKING		= 'WORKING';
	const SHIPPED		= 'SHIPPED';
	const IN_TRANSIT	= 'IN_TRANSIT';
	const DELIVERED		= 'DELIVERED';
	const CHECKED_IN	= 'CHECKED_IN';
	const RECEIVING		= 'RECEIVING';
	const CLOSED		= 'CLOSED';
	const CANCELLED		= 'CANCELLED';
	const DELETED		= 'DELETED';
	const ERROR			= 'ERROR';
}
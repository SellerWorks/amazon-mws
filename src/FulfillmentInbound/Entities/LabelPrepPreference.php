<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Entities;

/**
 * Enumorated values for LabelPrepPreference
 */
final class LabelPrepPreference
{
    /**
     * @const  string
     */
	const SELLER_LABEL = 'SELLER_LABEL';
	const AMAZON_LABEL_ONLY = 'AMAZON_LABEL_ONLY';
	const AMAZON_LABEL_PREFERRED = 'AMAZON_LABEL_PREFERRED';
}
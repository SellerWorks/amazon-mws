<?php

namespace SellerWorks\Amazon\Reports\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Creates a report request and submits the request to Amazon MWS.
 */
final class RequestReportRequest implements RequestInterface
{
    /**
     * @enum ReportType
     */
    public $ReportType;

    /**
     * @var DateTimeInterface|string
     */
    public $StartDate;

    /**
     * @var DateTimeInterface|string
     */
    public $EndDate;

    /**
     * @var string
     */
    public $ReportOptions;

    /**
     * @var Array<string>
     */
    public $MarketplaceIdList;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'ReportType'    => ['type' => 'choice', 'multiple' => false, 'choice' => [
                // Listings Reports
                '_GET_FLAT_FILE_OPEN_LISTINGS_DATA_',
                '_GET_MERCHANT_LISTINGS_DATA_',
                '_GET_MERCHANT_LISTINGS_DATA_BACK_COMPAT_',
                '_GET_MERCHANT_LISTINGS_DATA_LITE_',
                '_GET_MERCHANT_LISTINGS_DATA_LITER_',
                '_GET_MERCHANT_CANCELLED_LISTINGS_DATA_',
                '_GET_CONVERGED_FLAT_FILE_SOLD_LISTINGS_DATA_',
                '_GET_MERCHANT_LISTINGS_DEFECT_DATA_',

                // Order Reports
                '_GET_FLAT_FILE_ACTIONABLE_ORDER_DATA_',
                '_GET_ORDERS_DATA_',
                '_GET_FLAT_FILE_ORDERS_DATA_',
                '_GET_CONVERGED_FLAT_FILE_ORDER_REPORT_DATA_',

                // Order Tracking Reports
                '_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_LAST_UPDATE_',
                '_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_ORDER_DATE_',
                '_GET_XML_ALL_ORDERS_DATA_BY_LAST_UPDATE_',
                '_GET_XML_ALL_ORDERS_DATA_BY_ORDER_DATE_',

                // Pending Order Reports
                '_GET_FLAT_FILE_PENDING_ORDERS_DATA_',
                '_GET_PENDING_ORDERS_DATA_',
                '_GET_CONVERGED_FLAT_FILE_PENDING_ORDERS_DATA_',

                // Performance Reports
                '_GET_SELLER_FEEDBACK_DATA_',
                '_GET_V1_SELLER_PERFORMANCE_REPORT_',

                // Settlement Reports
                '_GET_V2_SETTLEMENT_REPORT_DATA_FLAT_FILE_',
                '_GET_V2_SETTLEMENT_REPORT_DATA_XML_',
                '_GET_V2_SETTLEMENT_REPORT_DATA_FLAT_FILE_V2_',

                // Fulfillment By Amazon (FBA) Reports
                    // FBA Sales Reports
                    '_GET_AMAZON_FULFILLED_SHIPMENTS_DATA_',
                    '_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_LAST_UPDATE_',
                    '_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_ORDER_DATE_',
                    '_GET_XML_ALL_ORDERS_DATA_BY_LAST_UPDATE_',
                    '_GET_XML_ALL_ORDERS_DATA_BY_ORDER_DATE_',
                    '_GET_FBA_FULFILLMENT_CUSTOMER_SHIPMENT_SALES_DATA_',
                    '_GET_FBA_FULFILLMENT_CUSTOMER_SHIPMENT_PROMOTION_DATA_',
                    '_GET_FBA_FULFILLMENT_CUSTOMER_TAXES_DATA_',

                        // FBA Inventory Reports
                    '_GET_AFN_INVENTORY_DATA_',
                    '_GET_AFN_INVENTORY_DATA_BY_COUNTRY_',
                    '_GET_FBA_FULFILLMENT_CURRENT_INVENTORY_DATA_',
                    '_GET_FBA_FULFILLMENT_MONTHLY_INVENTORY_DATA_',
                    '_GET_FBA_FULFILLMENT_INVENTORY_RECEIPTS_DATA_',
                    '_GET_RESERVED_INVENTORY_DATA_',
                    '_GET_FBA_FULFILLMENT_INVENTORY_SUMMARY_DATA_',
                    '_GET_FBA_FULFILLMENT_INVENTORY_ADJUSTMENTS_DATA_',
                    '_GET_FBA_FULFILLMENT_INVENTORY_HEALTH_DATA_',
                    '_GET_FBA_MYI_UNSUPPRESSED_INVENTORY_DATA_',
                    '_GET_FBA_MYI_ALL_INVENTORY_DATA_',
                    '_GET_FBA_FULFILLMENT_CROSS_BORDER_INVENTORY_MOVEMENT_DATA_',
                    '_GET_FBA_FULFILLMENT_INBOUND_NONCOMPLIANCE_DATA_',
                    '_GET_STRANDED_INVENTORY_UI_DATA_',
                    '_GET_STRANDED_INVENTORY_LOADER_DATA_',
                    '_GET_FBA_INVENTORY_AGED_DATA_',
                    '_GET_EXCESS_INVENTORY_DATA_',

                    // FBA Payments Reports
                    '_GET_FBA_ESTIMATED_FBA_FEES_TXT_DATA_',
                    '_GET_FBA_REIMBURSEMENTS_DATA_',

                    // FBA Customer Concessions Reports
                    '_GET_FBA_FULFILLMENT_CUSTOMER_RETURNS_DATA_',
                    '_GET_FBA_FULFILLMENT_CUSTOMER_SHIPMENT_REPLACEMENT_DATA_',

                    // FBA Removals Reports
                    '_GET_FBA_RECOMMENDED_REMOVAL_DATA_',
                    '_GET_FBA_FULFILLMENT_REMOVAL_ORDER_DETAIL_DATA_',
                    '_GET_FBA_FULFILLMENT_REMOVAL_SHIPMENT_DETAIL_DATA_',

                // Sales Tax Reports
                '_GET_FLAT_FILE_SALES_TAX_DATA_',

                // Browse Tree Reports
                '_GET_XML_BROWSE_TREE_DATA_',
            ]],
            'StartDate'         => ['type' => 'datetime'],
            'EndDate'           => ['type' => 'datetime'],
            'ReportOptions'     => ['type' => 'scalar'],
            'MarketplaceIdList' => ['type' => 'choice', 'multiple' => true, 'namespace' => 'Id'],
        ];
    }
}

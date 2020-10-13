<?php
/**
 * Created by PhpStorm.
 * User: vasily
 * Date: 16/08/2017
 * Time: 15:37
 */

namespace iikoExchangeBundle\Library\iiko\Model;


class EventType{


    /** GROUP Additional operations (additionalOperations) */

    /**
     * iikoDJ startup
     */
    const DJ_RUN = 'djRun';

    /**
     * iikoOffice startup
     */
    const OFFICE_RUN = 'officeRun';

    /**
     * Shutting down terminal
     */
    const SHUTDOWN_TERMINAL_RUN = 'shutdownTerminalRun';

    /**
     * Starting terminal after emergency shut down
     */
    const START_AFTER_INCORRECT_SHUTDOWN = 'startAfterIncorrectShutdown';

    /**
     * Create the data warehouse for the terminal
     */
    const ENTITIES_STORAGE_CREATED = 'entitiesStorageCreated';

    /**
     * View X-report
     */
    const X_REPORT_VIEWED = 'xReportViewed';

    /**
     * Print X-report
     */
    const X_REPORT_PRINTED = 'xReportPrinted';

    /**
     * View product usage at current cash register
     */
    const CURRENT_SALES_REPORT_BUILT = 'currentSalesReportBuilt';

    /**
     * Print product usage at the current cash register
     */
    const CURRENT_SALES_REPORT_PRINTED = 'currentSalesReportPrinted';

    /**
     * View product usage at all cash registers
     */
    const ALL_SALES_REPORT_BUILT = 'allSalesReportBuilt';

    /**
     * Print product usage at all cash registers
     */
    const ALL_SALES_REPORT_PRINTED = 'allSalesReportPrinted';

    /**
     * Close open shift of another employee
     */
    const FORCED_SESSION_CLOSE = 'forcedSessionClose';



    /** GROUP Measurement scales (productScales) */

    /**
     * Create size scale
     * Attributes:
     * - productScaleId — Size scales
     */
    const PRODUCT_SCALE_CREATED = 'productScaleCreated';

    /**
     * Edit size scale
     * Attributes:
     * - productScaleId — Size scales
     */
    const PRODUCT_SCALE_UPDATED = 'productScaleUpdated';

    /**
     * Delete/restore size scale
     * Attributes:
     * - productScaleId — Size scales
     */
    const PRODUCT_SCALE_SET_DELETED = 'productScaleSetDeleted';



    /** GROUP Work with documents (documents) */

    /**
     * Change document
     * Attributes:
     * - documentNumber — Document No.
     * - documentType — Document type
     */
    const DOCUMENT_MODIFIED = 'documentModified';

    /**
     * Create document
     * Attributes:
     * - documentType — Document type
     * - documentNumber — Document No.
     */
    const DOCUMENT_CREATED = 'documentCreated';

    /**
     * Document posting
     * Attributes:
     * - documentNumber — Document No.
     * - documentType — Document type
     */
    const DOCUMENT_PROCESSED = 'documentProcessed';

    /**
     * Document rollback
     * Attributes:
     * - documentNumber — Document No.
     * - documentType — Document type
     */
    const DOCUMENT_UNPROCESSED = 'documentUnprocessed';

    /**
     * Delete document
     * Attributes:
     * - documentType — Document type
     * - documentNumber — Document No.
     */
    const DOCUMENT_DELETED = 'documentDeleted';

    /**
     * Cancellation of Document Deletion
     * Attributes:
     * - documentNumber — Document No.
     * - documentType — Document type
     */
    const DOCUMENT_UNDELETED = 'documentUndeleted';

    /**
     * Edit document
     * Attributes:
     * - documentType — Document type
     * - documentNumber — Document No.
     */
    const DOCUMENT_CORRECTED = 'documentCorrected';

    /**
     * Send a document to EDI
     * Attributes:
     * - documentType — Document type
     * - documentNumber — Document No.
     */
    const EDI_DOCUMENT_TO_SEND = 'ediDocumentToSend';

    /**
     * The document has been sent to EDI
     * Attributes:
     * - documentType — Document type
     * - documentNumber — Document No.
     */
    const EDI_DOCUMENT_SENT = 'ediDocumentSent';

    /**
     * The EDI order has been confirmed
     * Attributes:
     * - documentType — Document type
     * - documentNumber — Document No.
     */
    const EDI_DOCUMENT_CONFIRMED = 'ediDocumentConfirmed';

    /**
     * The EDI order has been confirmed with changes
     * Attributes:
     * - documentType — Document type
     * - documentNumber — Document No.
     */
    const EDI_DOCUMENT_CONFIRMED_WITH_CHANGES = 'ediDocumentConfirmedWithChanges';

    /**
     * EDI order shipped
     * Attributes:
     * - documentType — Document type
     * - documentNumber — Document No.
     */
    const EDI_DOCUMENT_DESPATCHED = 'ediDocumentDespatched';

    /**
     * EDI order completed
     * Attributes:
     * - documentNumber — Document No.
     * - documentType — Document type
     */
    const EDI_DOCUMENT_EXECUTED = 'ediDocumentExecuted';

    /**
     * Create purchase invoice for EDI order (by iiko system)
     * Attributes:
     * - documentType — Document type
     * - documentNumber — Document No.
     */
    const EDI_ORDER_INVOICE_CREATED = 'ediOrderInvoiceCreated';

    /**
     * Create purchase invoice for EDI order (by user)
     * Attributes:
     * - documentNumber — Document No.
     * - documentType — Document type
     */
    const EDI_ORDER_MANUAL_INVOICE_CREATED = 'ediOrderManualInvoiceCreated';

    /**
     * EDI order cancelled by 3rd party
     * Attributes:
     * - documentType — Document type
     * - documentNumber — Document No.
     */
    const EDI_DOCUMENT_DISCARDED = 'ediDocumentDiscarded';

    /**
     * EDI order cancelled by us
     * Attributes:
     * - documentType — Document type
     * - documentNumber — Document No.
     */
    const EDI_DOCUMENT_CANCELED = 'ediDocumentCanceled';

    /**
     * EDI delivery bill paid
     * Attributes:
     * - documentType — Document type
     * - documentNumber — Document No.
     */
    const EDI_DOCUMENT_PAID = 'ediDocumentPaid';

    /**
     * Error processing EDI document.
     * Attributes:
     * - documentNumber — Document No.
     * - documentType — Document type
     */
    const EDI_DOCUMENT_ERROR = 'ediDocumentError';



    /** GROUP Cash register operations, additional (cashRegisterOperations) */

    /**
     * Open cash drawer
     * Attributes:
     * - manager — Manager
     * - name — Name
     * - drawerName — Cash drawer
     */
    const DRAWER_OPENED = 'drawerOpened';

    /**
     * Binding cash drawer to cashier.
     * Attributes:
     * - name — Name
     * - drawerName — Cash drawer
     * - manager — Manager
     */
    const DRAWER_BOUND = 'drawerBound';

    /**
     * Unbinding cash drawer from cashier
     * Attributes:
     * - drawerName — Cash drawer
     * - manager — Manager
     * - name — Name
     */
    const DRAWER_UNBOUND = 'drawerUnbound';

    /**
     * Print report
     * Attributes:
     * - name — Name
     */
    const REPORT_PRINTED = 'reportPrinted';



    /** GROUP Black list (blackListGroup) */

    /**
     * Blacklist
     */
    const ADDED_TO_BLACK_LIST = 'addedToBlackList';

    /**
     * Remove from black list
     */
    const REMOVED_FROM_BLACK_LIST = 'removedFromBlackList';

    /**
     * Change the reason for blacklisting
     */
    const BLACK_LIST_REASON_CHANGED = 'blackListReasonChanged';



    /** GROUP Accounting operations (accounting) */

    /**
     * Pay invoice
     * Attributes:
     * - invoice — Invoice
     */
    const INVOICE_PAID = 'invoicePaid';

    /**
     * New account
     * Attributes:
     * - account — Account
     * - name — Name
     */
    const ACCOUNT_CREATED = 'accountCreated';

    /**
     * Edit account
     * Attributes:
     * - name — Name
     * - account — Account
     */
    const ACCOUNT_UPDATED = 'accountUpdated';

    /**
     * Activate/deactivate the account
     * Attributes:
     * - name — Name
     * - account — Account
     */
    const ACCOUNT_DELETED = 'accountDeleted';

    /**
     * New manual transaction
     * Attributes:
     * - productId — Stock list item
     * - corrCounterAgent — Correspondent
     * - date — Date
     * - corrAccount — Corr. Account
     * - counterAgent — Contractor
     * - account — Account
     * - sum — Amount
     */
    const ACCOUNTING_TRANSACTION_CREATED = 'accountingTransactionCreated';

    /**
     * Edit transaction
     * Attributes:
     * - date — Date
     * - counterAgent — Contractor
     * - sum — Amount
     * - productId — Stock list item
     * - account — Account
     * - corrCounterAgent — Correspondent
     * - corrAccount — Corr. Account
     */
    const ACCOUNTING_TRANSACTION_UPDATED = 'accountingTransactionUpdated';

    /**
     * Delete transaction
     * Attributes:
     * - date — Date
     * - corrAccount — Corr. Account
     * - corrCounterAgent — Correspondent
     * - account — Account
     * - sum — Amount
     * - counterAgent — Contractor
     * - productId — Stock list item
     */
    const ACCOUNTING_TRANSACTION_DELETED = 'accountingTransactionDeleted';



    /** GROUP Equipment setup (hardwareSettings) */

    /**
     * Add equipment
     */
    const DEVICE_CREATED = 'deviceCreated';

    /**
     * Change equipment parameters
     */
    const DEVICE_UPDATED = 'deviceUpdated';

    /**
     * Delete equipment
     */
    const DEVICE_DELETED = 'deviceDeleted';

    /**
     * Actions with equipment
     */
    const DEVICE_ACTION_PERFORMED = 'deviceActionPerformed';



    /** GROUP External systems (replicationSetup) */

    /**
     * Data exchange settings created
     */
    const REPLICATION_CONFIG_CREATED = 'replicationConfigCreated';

    /**
     * Data exchange settings deleted
     */
    const REPLICATION_CONFIG_DELETED = 'replicationConfigDeleted';

    /**
     * Data exchange settings updated
     */
    const REPLICATION_CONFIG_UPDATED = 'replicationConfigUpdated';

    /**
     * Registered subsidiaries
     */
    const SLAVE_DEPARTMENT_REGISTERED = 'slaveDepartmentRegistered';

    /**
     * Subsidiaries with cancelled registration
     */
    const SLAVE_DEPARTMENT_UNREGISTERED = 'slaveDepartmentUnregistered';

    /**
     * Data exchange with external systems
     */
    const DATA_REPLICATION_RESULT = 'dataReplicationResult';



    /** GROUP Printed form templates (templateReport) */

    /**
     * Create template
     * Attributes:
     * - templateReportItemId — Printed form templates
     * - templateReportItemModelTypes — Template model(s)
     * - name — Name
     * - templateReportItemVersion — Template version
     */
    const TEMPLATE_REPORT_ITEM_CREATED = 'templateReportItemCreated';

    /**
     * Edit template
     * Attributes:
     * - templateReportItemVersion — Template version
     * - templateReportItemId — Printed form templates
     * - templateReportItemModelTypes — Template model(s)
     * - name — Name
     */
    const TEMPLATE_REPORT_ITEM_UPDATED = 'templateReportItemUpdated';

    /**
     * Delete/restore template
     * Attributes:
     * - name — Name
     * - templateReportItemModelTypes — Template model(s)
     * - templateReportItemVersion — Template version
     * - templateReportItemId — Printed form templates
     */
    const TEMPLATE_REPORT_ITEM_DELETED = 'templateReportItemDeleted';



    /** GROUP Change access permissions (permissions) */

    /**
     * User access permissions have changed
     */
    const USER_PERMISSION_CHANGED = 'userPermissionChanged';

    /**
     * Role access permissions have changed
     */
    const ROLE_PERMISSION_CHANGED = 'rolePermissionChanged';



    /** GROUP Delivery (iikoDeliveryGroup) */

    /**
     * Create delivery
     */
    const DELIVERY_ORDER_CREATED = 'deliveryOrderCreated';

    /**
     * Confirm delivery
     */
    const DELIVERY_ORDER_CONFIRMED = 'deliveryOrderConfirmed';

    /**
     * Edit delivery
     */
    const DELIVERY_ORDER_EDITED = 'deliveryOrderEdited';

    /**
     * Create delivery for blacklisted user
     * Attributes:
     * - blackListReason — Reason for blacklisting
     */
    const DELIVERY_ORDER_CREATED_TO_BLACK_LIST_USER = 'deliveryOrderCreatedToBlackListUser';

    /**
     * Cancel delivery
     */
    const DELIVERY_ORDER_CANCELLED = 'deliveryOrderCancelled';

    /**
     * Separate deliveries by fiscal cash registers
     */
    const DELIVERY_ORDER_SPLIT = 'deliveryOrderSplit';

    /**
     * Delivery transfer
     * Attributes:
     * - deliveryTerminalTo — New point of production
     * - deliveryTerminalFrom — Previous point of production
     */
    const DELIVERY_ORDER_MOVED = 'deliveryOrderMoved';

    /**
     * Change 'problem' flag
     */
    const DELIVERY_PROBLEM_CHANGED = 'deliveryProblemChanged';

    /**
     * Emergency cancellation of delivery
     */
    const DELIVERY_EMERGENCY_CANCELLED = 'deliveryEmergencyCancelled';

    /**
     * Emergency closing of delivery
     */
    const DELIVERY_EMERGENCY_CLOSED = 'deliveryEmergencyClosed';

    /**
     * Customer feedback changed.
     * Attributes:
     * - customerOpinionComment — Comment
     * - customerOpinionMarks — Ratings
     */
    const CUSTOMER_OPINION_CHANGED = 'customerOpinionChanged';

    /**
     * Delivery delay forecast
     * Attributes:
     * - deliveryPredictedCookingCompleteTime — Cooking completion forecast
     * - deliveryCookingCompleteTime — Actual time of cooking completion
     * - deliveryPredictedDeliveryTime — Forecast delivery time
     */
    const DELIVERY_DELAY_PREDICTION = 'deliveryDelayPrediction';



    /** GROUP Price categories (priceCategoriesFront) */

    /**
     * Apply price category
     * Attributes:
     * - sum — Amount
     * - openTime — Open order
     * - isBanquet — Banquet order
     * - numGuests — Number of guests
     * - orderSumAfterDiscount — Amount with discount
     * - auth — Add. authorisation
     * - orderNum — Order No.
     * - priceCategory — Price category
     * - waiter — Waiter
     * - newWaiter — New responsible person
     * - tableNum — Table number
     */
    const PRICE_CATEGORY_APPLIED = 'priceCategoryApplied';

    /**
     * Reset price category
     * Attributes:
     * - priceCategory — Price category
     * - tableNum — Table number
     * - sum — Amount
     * - auth — Add. authorisation
     * - waiter — Waiter
     * - newWaiter — New responsible person
     * - numGuests — Number of guests
     * - openTime — Open order
     * - isBanquet — Banquet order
     * - orderNum — Order No.
     * - orderSumAfterDiscount — Amount with discount
     */
    const PRICE_CATEGORY_CLEARED = 'priceCategoryCleared';



    /** GROUP Работа с АЗС (petroleum) */

    /**
     * Ручное удаление транзакции на ТРК
     */
    const TRANSACTION_MANUALLY_REMOVED = 'transactionManuallyRemoved';



    /** GROUP Cash register operations (cash) */

    /**
     * Open shift
     */
    const SESSION_OPENED = 'sessionOpened';

    /**
     * Closing of shift
     */
    const SESSION_CLOSED = 'sessionClosed';

    /**
     * Till assign
     */
    const CASHIER_SESSION_OPENED = 'cashierSessionOpened';

    /**
     * Cash register shift closing
     */
    const CASHIER_SESSION_CLOSED = 'cashierSessionClosed';

    /**
     * Confirm emergency shift opening
     */
    const EMERGENCY_SESSION_OPEN_CONFIRMED = 'emergencySessionOpenConfirmed';

    /**
     * Discrepancy in cash verification
     * Attributes:
     * - sum — Amount
     * - auth — Add. authorisation
     */
    const DEMAND_BALANCE_CHECK_FAILED = 'demandBalanceCheckFailed';



    /** GROUP Safety of terminals (terminalSecurity) */

    /**
     * Terminal registration
     * Attributes:
     * - remoteAddress — Customer terminal address
     * - targetTerminal — Target terminal (object)
     * - user — User
     */
    const TERMINAL_REGISTERED = 'terminalRegistered';

    /**
     * Generating terminal authentication token
     * Attributes:
     * - remoteAddress — Customer terminal address
     * - targetTerminal — Target terminal (object)
     */
    const TERMINAL_TOKEN_ISSUED = 'terminalTokenIssued';

    /**
     * Saving an authentication token by terminal data
     * Attributes:
     * - remoteAddress — Customer terminal address
     * - targetTerminal — Target terminal (object)
     */
    const TERMINAL_TOKEN_STORED = 'terminalTokenStored';

    /**
     * Revoking a terminal authentication token
     * Attributes:
     * - targetTerminal — Target terminal (object)
     */
    const TERMINAL_TOKEN_REVOKED = 'terminalTokenRevoked';

    /**
     * Locking of a terminal by an administrator
     * Attributes:
     * - targetTerminal — Target terminal (object)
     */
    const TERMINAL_LOCKED = 'terminalLocked';

    /**
     * Unlocking of a terminal by an administrator
     * Attributes:
     * - targetTerminal — Target terminal (object)
     */
    const TERMINAL_UNLOCKED = 'terminalUnlocked';



    /** GROUP iikoCard deposit system (iikoCardGroup) */

    /**
     * Object created in iikoCard
     */
    const IIKO_CARD_OBJECT_CREATED = 'iikoCardObjectCreated';

    /**
     * Object edited in iikoCard
     */
    const IIKO_CARD_OBJECT_MODIFIED = 'iikoCardObjectModified';

    /**
     * Object deleted from iikoCard
     */
    const IIKO_CARD_OBJECT_DELETED = 'iikoCardObjectDeleted';



    /** GROUP Operations with payment systems (paymentSystems) */

    /**
     * Cancel the latest PLAS-TEK operation
     */
    const CANCEL_LAST_PLASTEK_OPERATION = 'cancelLastPlastekOperation';



    /** GROUP EDI errors (ediErrors) */

    /**
     * EDI exchange error
     * Attributes:
     * - ediErrorDescription — Error description
     */
    const EDI_EXCHANGE_ERROR = 'ediExchangeError';

    /**
     * EDI error
     * Attributes:
     * - ediErrorDescription — Error description
     * - ediDocumentDescription — EDI document description
     */
    const EDI_PROCESSING_ERROR = 'ediProcessingError';



    /** GROUP Work with reservations (reserves) */

    /**
     * Create reservation
     */
    const RESERVE_CREATED = 'reserveCreated';

    /**
     * Edit reservation
     */
    const RESERVE_MODIFIED = 'reserveModified';

    /**
     * Delete reservation
     */
    const RESERVE_CLOSED = 'reserveClosed';

    /**
     * Banquet started
     */
    const BANQUET_STARTED = 'banquetStarted';

    /**
     * Cancel start of banquet
     */
    const BANQUET_START_CANCELLED = 'banquetStartCancelled';

    /**
     * Change the number of guests for the reservation
     * Attributes:
     * - comment — Comment
     */
    const CHANGED_RESERVE_GUEST_COUNT = 'changedReserveGuestCount';



    /** GROUP Personal events (personal) */

    /**
     * PIN-based authorisation
     */
    const PIN_AUTHORIZATION = 'pinAuthorization';

    /**
     * Card-based authorisation
     */
    const CARD_AUTHORIZATION = 'cardAuthorization';

    /**
     * Magnetic key authorisation
     */
    const KEY_AUTHORIZATION = 'keyAuthorization';

    /**
     * Log out of iikoFront
     */
    const FRONT_LOGOUT = 'frontLogout';

    /**
     * Clock in
     */
    const PERS_SESSION_OPENED = 'persSessionOpened';

    /**
     * Clock out
     */
    const PERS_SESSION_CLOSED = 'persSessionClosed';

    /**
     * Position change
     */
    const ROLE_CHANGED = 'roleChanged';


    /**
     * Authentication
     */
    const PERMISSION_CHECKED = 'permissionChecked';

    /**
     * Manual switch kitchen mode: Peak
     */
    const MANUAL_COOKING_TIME_PEAK = 'manualCookingTimePeak';

    /**
     * Manual switch kitchen mode: Normal
     */
    const MANUAL_COOKING_TIME_NORMAL = 'manualCookingTimeNormal';

    /**
     * Automatic switch kitchen mode: Peak
     */
    const COOKING_TIME_PEAK_BY_SCHEDULE = 'cookingTimePeakBySchedule';

    /**
     * Automatic switch kitchen mode: Normal
     */
    const COOKING_TIME_NORMAL_BY_SCHEDULE = 'cookingTimeNormalBySchedule';

    /**
     * Kitchen mode enabled: By schedule
     */
    const COOKING_TIME_MODE_BY_SCHEDULE = 'cookingTimeModeBySchedule';



    /** GROUP Out of stock list (deliveryStopListGroup) */

    /**
     * Add to out of stock list
     */
    const ADDED_TO_STOP_LIST = 'addedToStopList';

    /**
     * Delete from out of stock list
     */
    const REMOVED_FROM_STOP_LIST = 'removedFromStopList';

    /**
     * Edit out of stock list
     */
    const EDITED_STOP_LIST = 'editedStopList';



    /** GROUP Sending SMS and e-mail (sendingSmsGroup) */

    /**
     * Send SMS
     */
    const SENDING_SMS_EVENT = 'sendingSmsEvent';

    /**
     * Error sending SMS
     * Attributes:
     * - sendingSmsFailedTimeout — Timeout error sending SMS
     */
    const SENDING_SMS_FAILED_EVENT = 'sendingSmsFailedEvent';

    /**
     * Sending e-mail
     */
    const SENDING_EMAIL_EVENT = 'sendingEmailEvent';

    /**
     * Sending e-mail failed
     * Attributes:
     * - sendingEmailFailedTimeout — Timeout error sending e-mail
     */
    const SENDING_EMAIL_FAILED_EVENT = 'sendingEmailFailedEvent';



    /** GROUP Data exchange with KUT/ZUP (kutzup) */

    /**
     * Import stock list
     */
    const IMPORT_MENU = 'importMenu';

    /**
     * Import employees
     */
    const IMPORT_STUFF = 'importStuff';

    /**
     * Export to KUT/ZUP
     */
    const EXPORTED_TO_K_U_T_Z_U_P = 'exportedToKUTZUP';

    /**
     * Import discounts
     */
    const IMPORT_DISCOUNT = 'importDiscount';



    /** GROUP Human resources (managingEmployees) */

    /**
     * Schedule item created
     */
    const SCHEDULE_ITEM_CREATED = 'scheduleItemCreated';

    /**
     * Schedule item deleted
     */
    const SCHEDULE_ITEM_DELETED = 'scheduleItemDeleted';

    /**
     * Issue substitute card
     * Attributes:
     * - auth — Add. authorisation
     * - roleName — Position
     * - reason — Reason
     * - cardNumber — Card number
     * - employee — Employee
     */
    const SUBSTITUTION_CARD_REGISTERED = 'substitutionCardRegistered';



    /** GROUP Work with orders (orders) */

    /**
     * Open order
     * Attributes:
     * - newWaiter — New responsible person
     * - waiter — Waiter
     * - isBanquet — Banquet order
     * - sum — Amount
     * - tableNum — Table number
     * - orderNum — Order No.
     * - numGuests — Number of guests
     * - orderSumAfterDiscount — Amount with discount
     * - auth — Add. authorisation
     * - openTime — Open order
     */
    const ORDER_OPENED = 'orderOpened';

    /**
     * Delete order
     * Attributes:
     * - numGuests — Number of guests
     * - openTime — Open order
     * - sum — Amount
     * - orderNum — Order No.
     * - waiter — Waiter
     * - isBanquet — Banquet order
     * - newWaiter — New responsible person
     * - tableNum — Table number
     * - orderSumAfterDiscount — Amount with discount
     * - auth — Add. authorisation
     */
    const ORDER_DELETED = 'orderDeleted';

    /**
     * Order transfer
     * Attributes:
     * - numGuests — Number of guests
     * - tableNum — Table number
     * - newWaiter — New responsible person
     * - orderNum — Order No.
     * - orderSumAfterDiscount — Amount with discount
     * - waiter — Waiter
     * - openTime — Open order
     * - auth — Add. authorisation
     * - sum — Amount
     * - isBanquet — Banquet order
     */
    const ORDER_MOVED = 'orderMoved';

    /**
     * Guest bill printout
     * Attributes:
     * - openTime — Open order
     * - auth — Add. authorisation
     * - newWaiter — New responsible person
     * - waiter — Waiter
     * - numGuests — Number of guests
     * - orderNum — Order No.
     * - isBanquet — Banquet order
     * - tableNum — Table number
     * - sum — Amount
     * - orderSumAfterDiscount — Amount with discount
     */
    const ORDER_PRECHEQUED = 'orderPrechequed';

    /**
     * Cancellation of guest bill
     * Attributes:
     * - orderSumAfterDiscount — Amount with discount
     * - newWaiter — New responsible person
     * - orderNum — Order No.
     * - sum — Amount
     * - auth — Add. authorisation
     * - tableNum — Table number
     * - numGuests — Number of guests
     * - waiter — Waiter
     * - isBanquet — Banquet order
     * - openTime — Open order
     */
    const ORDER_CANCEL_PRECHEQUE = 'orderCancelPrecheque';

    /**
     * Print sales receipt
     * Attributes:
     * - sum — Amount
     * - newWaiter — New responsible person
     * - orderSumAfterDiscount — Amount with discount
     * - waiter — Waiter
     * - numGuests — Number of guests
     * - orderNum — Order No.
     * - tableNum — Table number
     * - isBanquet — Banquet order
     * - auth — Add. authorisation
     * - openTime — Open order
     */
    const ORDER_CASH_MEMO_PRINTED = 'orderCashMemoPrinted';

    /**
     * Forced order close
     * Attributes:
     * - newWaiter — New responsible person
     * - numGuests — Number of guests
     * - sum — Amount
     * - orderNum — Order No.
     * - waiter — Waiter
     * - isBanquet — Banquet order
     * - tableNum — Table number
     * - auth — Add. authorisation
     * - orderSumAfterDiscount — Amount with discount
     * - openTime — Open order
     */
    const ORDER_CLOSED_AT_WAITER_EXPENSE = 'orderClosedAtWaiterExpense';

    /**
     * Enter prepayment
     * Attributes:
     * - auth — Add. authorisation
     * - orderNum — Order No.
     * - orderSumAfterDiscount — Amount with discount
     * - openTime — Open order
     * - isBanquet — Banquet order
     * - newWaiter — New responsible person
     * - tableNum — Table number
     * - sum — Amount
     * - waiter — Waiter
     * - numGuests — Number of guests
     */
    const ORDER_PREPAID = 'orderPrepaid';

    /**
     * Refund of Prepayment
     * Attributes:
     * - openTime — Open order
     * - tableNum — Table number
     * - auth — Add. authorisation
     * - numGuests — Number of guests
     * - sum — Amount
     * - waiter — Waiter
     * - newWaiter — New responsible person
     * - orderNum — Order No.
     * - orderSumAfterDiscount — Amount with discount
     * - isBanquet — Banquet order
     */
    const ORDER_PREPAY_RETURNED = 'orderPrepayReturned';

    /**
     * Enter cash deposit
     * Attributes:
     * - waiter — Waiter
     * - orderNum — Order No.
     * - orderSumAfterDiscount — Amount with discount
     * - sum — Amount
     * - newWaiter — New responsible person
     * - isBanquet — Banquet order
     * - auth — Add. authorisation
     * - tableNum — Table number
     * - openTime — Open order
     * - numGuests — Number of guests
     */
    const ORDER_DEPOSITED = 'orderDeposited';

    /**
     * Refund cash deposit
     * Attributes:
     * - sum — Amount
     * - orderNum — Order No.
     * - numGuests — Number of guests
     * - tableNum — Table number
     * - openTime — Open order
     * - isBanquet — Banquet order
     * - waiter — Waiter
     * - newWaiter — New responsible person
     * - orderSumAfterDiscount — Amount with discount
     * - auth — Add. authorisation
     */
    const ORDER_DEPOSIT_RETURNED = 'orderDepositReturned';

    /**
     * Void receipt
     * Attributes:
     * - newWaiter — New responsible person
     * - numGuests — Number of guests
     * - waiter — Waiter
     * - auth — Add. authorisation
     * - openTime — Open order
     * - orderNum — Order No.
     * - orderSumAfterDiscount — Amount with discount
     * - isBanquet — Banquet order
     * - sum — Amount
     * - tableNum — Table number
     */
    const ORDER_RETURNED = 'orderReturned';

    /**
     * Order payment
     * Attributes:
     * - isBanquet — Banquet order
     * - newWaiter — New responsible person
     * - tableNum — Table number
     * - sum — Amount
     * - orderNum — Order No.
     * - openTime — Open order
     * - auth — Add. authorisation
     * - waiter — Waiter
     * - numGuests — Number of guests
     * - orderSumAfterDiscount — Amount with discount
     */
    const ORDER_PAID = 'orderPaid';

    /**
     * Payment of order on credit
     * Attributes:
     * - newWaiter — New responsible person
     * - tableNum — Table number
     * - numGuests — Number of guests
     * - counterAgent — Contractor
     * - orderSumAfterDiscount — Amount with discount
     * - orderNum — Order No.
     * - sum — Amount
     * - waiter — Waiter
     * - isBanquet — Banquet order
     * - openTime — Open order
     * - auth — Add. authorisation
     */
    const ORDER_PAID_CREDIT = 'orderPaidCredit';

    /**
     * Order payment without revenue
     * Attributes:
     * - newWaiter — New responsible person
     * - orderNum — Order No.
     * - sum — Amount
     * - isBanquet — Banquet order
     * - openTime — Open order
     * - auth — Add. authorisation
     * - numGuests — Number of guests
     * - tableNum — Table number
     * - waiter — Waiter
     * - orderSumAfterDiscount — Amount with discount
     */
    const ORDER_PAID_NO_CASH = 'orderPaidNoCash';

    /**
     * Emergency order transfer to guest bill
     * Attributes:
     * - orderNum — Order No.
     * - isBanquet — Banquet order
     * - tableNum — Table number
     * - orderSumAfterDiscount — Amount with discount
     * - sum — Amount
     * - waiter — Waiter
     * - numGuests — Number of guests
     * - newWaiter — New responsible person
     * - auth — Add. authorisation
     * - openTime — Open order
     */
    const EMERGENCY_MOVE_TO_PRECHEQUE = 'emergencyMoveToPrecheque';

    /**
     * Emergency deletion of payment
     * Attributes:
     * - openTime — Open order
     * - auth — Add. authorisation
     * - orderNum — Order No.
     * - waiter — Waiter
     * - paymentType — Payment type
     * - newWaiter — New responsible person
     * - sum — Amount
     * - isBanquet — Banquet order
     * - orderSumAfterDiscount — Amount with discount
     * - tableNum — Table number
     * - numGuests — Number of guests
     */
    const EMERGENCY_PAYMENT_CANCEL = 'emergencyPaymentCancel';

    /**
     * Bill amount limit exceeded
     * Attributes:
     * - openTime — Open order
     * - orderNum — Order No.
     * - tableNum — Table number
     * - isBanquet — Banquet order
     * - sum — Amount
     * - auth — Add. authorisation
     * - newWaiter — New responsible person
     * - orderSumAfterDiscount — Amount with discount
     * - waiter — Waiter
     * - numGuests — Number of guests
     */
    const EXCEED_LIMIT = 'exceedLimit';

    /**
     * Bill amount is less than minimum
     * Attributes:
     * - orderSumAfterDiscount — Amount with discount
     * - tableNum — Table number
     * - newWaiter — New responsible person
     * - numGuests — Number of guests
     * - openTime — Open order
     * - auth — Add. authorisation
     * - orderNum — Order No.
     * - waiter — Waiter
     * - isBanquet — Banquet order
     * - sum — Amount
     */
    const LESS_THAN_LIMIT = 'lessThanLimit';

    /**
     * A bonus added by card number
     * Attributes:
     * - cardNumber — Card number
     * - sumBonus — Bonus amount
     */
    const BONUS_BY_CARD_NUMBER = 'bonusByCardNumber';

    /**
     * Bind order to customer's card
     * Attributes:
     * - numGuests — Number of guests
     * - waiter — Waiter
     * - cardNumber — Card number
     * - isBanquet — Banquet order
     * - sum — Amount
     * - orderNum — Order No.
     * - openTime — Open order
     * - auth — Add. authorisation
     * - tableNum — Table number
     * - newWaiter — New responsible person
     * - orderSumAfterDiscount — Amount with discount
     */
    const ORDER_BOUND_TO_CLIENT_CARD = 'orderBoundToClientCard';

    /**
     * Unbind order from customer's card
     * Attributes:
     * - orderSumAfterDiscount — Amount with discount
     * - orderNum — Order No.
     * - auth — Add. authorisation
     * - newWaiter — New responsible person
     * - openTime — Open order
     * - numGuests — Number of guests
     * - tableNum — Table number
     * - isBanquet — Banquet order
     * - sum — Amount
     * - waiter — Waiter
     */
    const ORDER_UNBOUND_FROM_CLIENT_CARD = 'orderUnboundFromClientCard';

    /**
     * Delete external payment
     * Attributes:
     * - auth — Add. authorisation
     * - numGuests — Number of guests
     * - orderSumAfterDiscount — Amount with discount
     * - sum — Amount
     * - orderNum — Order No.
     * - newWaiter — New responsible person
     * - isBanquet — Banquet order
     * - openTime — Open order
     * - tableNum — Table number
     * - waiter — Waiter
     */
    const DELETED_EXTERNAL_PAYMENT = 'deletedExternalPayment';

    /**
     * Change the number of guests for the order
     * Attributes:
     * - sum — Amount
     * - auth — Add. authorisation
     * - waiter — Waiter
     * - newWaiter — New responsible person
     * - isBanquet — Banquet order
     * - orderSumAfterDiscount — Amount with discount
     * - orderNum — Order No.
     * - comment — Comment
     * - numGuests — Number of guests
     * - openTime — Open order
     * - tableNum — Table number
     */
    const CHANGED_ORDER_GUEST_COUNT = 'changedOrderGuestCount';



    /** GROUP Contractors (employees) (employees) */

    /**
     * Add title
     */
    const ROLE_CREATED = 'roleCreated';

    /**
     * Edit title
     */
    const ROLE_UPDATED = 'roleUpdated';

    /**
     * Activate/deactivate title
     */
    const ROLE_DELETED = 'roleDeleted';

    /**
     * Add a person
     * Attributes:
     * - employeeName — Person's name
     */
    const USER_CREATED = 'userCreated';

    /**
     * Edit the person
     * Attributes:
     * - employeeName — Person's name
     */
    const USER_UPDATED = 'userUpdated';

    /**
     * Activate/deactivate the person
     * Attributes:
     * - employeeName — Person's name
     */
    const USER_DELETED = 'userDeleted';

    /**
     * Create shift
     * Attributes:
     * - scheduleTypeName — Shift type
     */
    const SCHEDULE_TYPE_CREATED = 'scheduleTypeCreated';

    /**
     * Edit shift
     * Attributes:
     * - scheduleTypeName — Shift type
     */
    const SCHEDULE_TYPE_UPDATED = 'scheduleTypeUpdated';

    /**
     * Activate/deactivate shift
     * Attributes:
     * - scheduleTypeName — Shift type
     */
    const SCHEDULE_TYPE_DELETED = 'scheduleTypeDeleted';

    /**
     * Edit attendance log item
     * Attributes:
     * - userName — Username
     * - attendanceEntryFrom — Check-in time
     */
    const ATTENDANCE_ENTRY_UPDATED = 'attendanceEntryUpdated';

    /**
     * Create attendance log item
     * Attributes:
     * - userName — Username
     * - attendanceEntryFrom — Check-in time
     */
    const ATTENDANCE_ENTRY_CREATED = 'attendanceEntryCreated';

    /**
     * Delete attendance log item
     * Attributes:
     * - attendanceEntryFrom — Check-in time
     * - userName — Username
     */
    const ATTENDANCE_ENTRY_DELETED = 'attendanceEntryDeleted';

    /**
     * Merge several attendances
     * Attributes:
     * - userName — Username
     * - action — Action
     * - attendanceEntryFrom — Check-in time
     */
    const ATTENDANCE_ENTRY_MERGED = 'attendanceEntryMerged';



    /** GROUP Storage duration and balance control (productStocksGroup) */

    /**
     * Write-off of all items
     * Attributes:
     * - productsList — List of items
     */
    const ALL_PRODUCTS_WRITEOFF = 'allProductsWriteoff';

    /**
     * Preparation
     * Attributes:
     * - product — Item
     * - amount — Quantity
     */
    const PRODUCT_COOK = 'productCook';

    /**
     * Write-off
     * Attributes:
     * - product — Item
     * - amount — Quantity
     */
    const PRODUCT_WRITEOFF = 'productWriteoff';

    /**
     * Edit cooking
     * Attributes:
     * - oldAmount — Old quantity
     * - cookedBy — Cooked by
     * - cookTime — Preparation time
     */
    const PRODUCT_COOK_EDIT = 'productCookEdit';

    /**
     * Edit write-off
     * Attributes:
     * - writeoffTime — Time of write-off
     * - writeoffBy — Written off by
     * - oldAmount — Old quantity
     */
    const PRODUCT_WRITEOFF_EDIT = 'productWriteoffEdit';

    /**
     * Sale of past-due items
     * Attributes:
     * - cookTime — Preparation time
     * - expiredTime — Past-due period
     */
    const EXPIRED_PRODUCT_SELL = 'expiredProductSell';



    /** GROUP Synchronisation monitor (synchroEntity) */

    /**
     * Add record to synchronisation log
     * Attributes:
     * - synchroEntityId — Synchronisation
     */
    const SYNCHRO_ENTITY_CREATED = 'synchroEntityCreated';

    /**
     * Data export to FinForma
     * Attributes:
     * - manual — Manual
     * - exportedDays — Exported
     * - departmentCount — Exported
     */
    const EXPORT_TO_FIN_FORMA = 'exportToFinForma';



    /** GROUP Pre-pay (payments) */

    /**
     * Penalty
     */
    const PENALTY_BACK_ASSIGNED = 'penaltyBackAssigned';

    /**
     * Bonus
     */
    const BONUS_BACK_ASSIGNED = 'bonusBackAssigned';

    /**
     * Cancel penalty
     * Attributes:
     * - employee — Employee
     * - sum — Amount
     * - createdUser — Created by
     * - createdDate — Created on
     */
    const PENALTY_CANCELED = 'penaltyCanceled';

    /**
     * Cancel bonus
     * Attributes:
     * - createdDate — Created on
     * - createdUser — Created by
     * - sum — Amount
     * - employee — Employee
     */
    const BONUS_CANCELED = 'bonusCanceled';

    /**
     * Change penalty
     * Attributes:
     * - comment — Comment
     * - employee — Employee
     * - sum — Amount
     */
    const PENALTY_UPDATED = 'penaltyUpdated';

    /**
     * Change bonus
     * Attributes:
     * - employee — Employee
     * - sum — Amount
     * - comment — Comment
     */
    const BONUS_UPDATED = 'bonusUpdated';

    /**
     * Forcibly delete reservation
     * Attributes:
     * - user — User
     */
    const RESERVE_SYSTEM_CLOSED = 'reserveSystemClosed';

    /**
     * Advance payment of wages
     * Attributes:
     * - sum — Amount
     * - comment — Comment
     * - account — Account
     * - employee — Employee
     */
    const ADVANCE_MADE = 'advanceMade';

    /**
     * Accrual of wages
     * Attributes:
     * - employee — Employee
     * - account — Account
     * - comment — Comment
     * - sum — Amount
     */
    const SALARY_MADE = 'salaryMade';

    /**
     * Penalty from Front
     */
    const PENALTY_FRONT_ASSIGNED = 'penaltyFrontAssigned';

    /**
     * Premium from iikoFront
     */
    const BONUS_FRONT_ASSIGNED = 'bonusFrontAssigned';

    /**
     * Cash add
     */
    const PAY_IN_MADE = 'payInMade';

    /**
     * Cash pull
     */
    const PAY_OUT_MADE = 'payOutMade';

    /**
     * Cash collection
     */
    const PAY_COLLECTION_MADE = 'payCollectionMade';

    /**
     * Discrepancy detected in cash register amount
     */
    const CASH_AUTO_CORRECTION = 'cashAutoCorrection';



    /** GROUP Administration (admin) */

    /**
     * Authorisation in iiko Office
     * Attributes:
     * - userName — Username
     * - success — Success level
     */
    const BACK_LOGIN = 'backLogin';

    /**
     * Exit from iiko Office
     */
    const BACK_LOGOUT = 'backLogout';

    /**
     * Change password
     */
    const PASSWORD_CHANGED = 'passwordChanged';

    /**
     * Run the JSP script
     * Attributes:
     * - userName — Username
     * - scriptName — Script name
     * - description — Description of performed job
     */
    const JSP_EXECUTED = 'jspExecuted';



    /** GROUP Data import (importData) */

    /**
     * Import successfully completed
     */
    const IMPORT_FINISHED_SUCCESSFULLY = 'importFinishedSuccessfully';

    /**
     * Import completed with an error
     */
    const IMPORT_FAILED = 'importFailed';

    /**
     * Create object
     */
    const ENTITY_CREATED = 'entityCreated';

    /**
     * Update object
     */
    const ENTITY_UPDATED = 'entityUpdated';

    /**
     * Delete object
     */
    const ENTITY_DELETED = 'entityDeleted';

    /**
     * Object import error
     */
    const ENTITY_IMPORT_FAILED = 'entityImportFailed';



    /** GROUP Stock list (inventory) */

    /**
     * Tax category adding
     * Attributes:
     * - taxCategoryId — Tax category
     * - name — Name
     * - vatPercent — VAT value
     */
    const TAX_CATEGORY_CREATED = 'taxCategoryCreated';

    /**
     * Tax category editing
     * Attributes:
     * - name — Name
     * - taxCategoryId — Tax category
     * - vatPercent — VAT value
     */
    const TAX_CATEGORY_UPDATED = 'taxCategoryUpdated';

    /**
     * Tax category deletion
     * Attributes:
     * - vatPercent — VAT value
     * - taxCategoryId — Tax category
     * - name — Name
     */
    const TAX_CATEGORY_DELETED = 'taxCategoryDeleted';

    /**
     * Add group
     * Attributes:
     * - groupId — Group
     * - name — Name
     */
    const PRODUCT_GROUP_CREATED = 'productGroupCreated';

    /**
     * Delete group
     * Attributes:
     * - groupId — Group
     * - name — Name
     */
    const PRODUCT_GROUP_DELETED = 'productGroupDeleted';

    /**
     * Edit group
     * Attributes:
     * - name — Name
     * - groupId — Group
     */
    const PRODUCT_GROUP_UPDATED = 'productGroupUpdated';

    /**
     * Add stock list item
     * Attributes:
     * - name — Name
     * - productId — Stock list item
     */
    const PRODUCT_CREATED = 'productCreated';

    /**
     * Delete stock list item
     * Attributes:
     * - name — Name
     * - productId — Stock list item
     */
    const PRODUCT_DELETED = 'productDeleted';

    /**
     * Edit stock list item
     * Attributes:
     * - name — Name
     * - productId — Stock list item
     */
    const PRODUCT_UPDATED = 'productUpdated';

    /**
     * Add recipe
     * Attributes:
     * - productId — Stock list item
     * - name — Name
     */
    const ASSEMBLY_CHART_CREATED = 'assemblyChartCreated';

    /**
     * Edit recipe
     * Attributes:
     * - productId — Stock list item
     * - name — Name
     */
    const ASSEMBLY_CHART_UPDATED = 'assemblyChartUpdated';

    /**
     * Delete recipe
     * Attributes:
     * - name — Name
     * - productId — Stock list item
     */
    const ASSEMBLY_CHART_DELETED = 'assemblyChartDeleted';

    /**
     * Price change in stock list item price list
     * Attributes:
     * - productId — Stock list item
     * - name — Name
     * - priceOld — Price (old)
     * - price — Price
     */
    const DEFAULT_SALE_PRICE_CHANGED = 'defaultSalePriceChanged';

    /**
     * Import from External POS System
     */
    const PRODUCTS_IMPORTED_FROM_R_KEEPER = 'productsImportedFromRKeeper';

    /**
     * Import data from file
     */
    const PRODUCTS_IMPORTED_FROM_FILE = 'productsImportedFromFile';

    /**
     * Export to External System
     */
    const EXPORTED_TO1_C = 'exportedTo1C';

    /**
     * Export to External Inventory Management Software
     */
    const EXPORTED_TO_STORE_HOUSE = 'exportedToStoreHouse';

    /**
     * Enter license key
     */
    const LICENSE_POSTED = 'licensePosted';



    /** GROUP Работа с документами ЕГАИС (egaisDocuments) */

    /**
     * Документ ЕГАИС создан
     * Attributes:
     * - egaisWbDate — Дата документа поставщика
     * - egaisSupplierWbRegId — Регистрационный номер ЕГАИС поставщика
     * - egaisDocumentId — Идентификатор документа
     * - egaisWbNumber — Номер документа поставщика
     * - egaisDestinationWbRegId — Регистрационный номер ЕГАИС УТМ получателя
     * - egaisRejectComment — Причина отклонения документа
     * - egaisSourceWbRegId — Регистрационный номер ЕГАИС УТМ из которого был получен документ
     * - egaisWbRegId — Регистрационный номер документа в ЕГАИС
     */
    const EGAIS_DOCUMENT_CREATED = 'egaisDocumentCreated';

    /**
     * Документ ЕГАИС изменен
     * Attributes:
     * - egaisDocumentId — Идентификатор документа
     * - egaisWbRegId — Регистрационный номер документа в ЕГАИС
     * - egaisDestinationWbRegId — Регистрационный номер ЕГАИС УТМ получателя
     * - egaisWbDate — Дата документа поставщика
     * - egaisSourceWbRegId — Регистрационный номер ЕГАИС УТМ из которого был получен документ
     * - egaisWbNumber — Номер документа поставщика
     * - egaisSupplierWbRegId — Регистрационный номер ЕГАИС поставщика
     * - egaisRejectComment — Причина отклонения документа
     */
    const EGAIS_DOCUMENT_UPDATED = 'egaisDocumentUpdated';

    /**
     * Документ ЕГАИС удален
     * Attributes:
     * - egaisWbRegId — Регистрационный номер документа в ЕГАИС
     * - egaisWbNumber — Номер документа поставщика
     * - egaisDestinationWbRegId — Регистрационный номер ЕГАИС УТМ получателя
     * - egaisRejectComment — Причина отклонения документа
     * - egaisSourceWbRegId — Регистрационный номер ЕГАИС УТМ из которого был получен документ
     * - egaisDocumentId — Идентификатор документа
     * - egaisSupplierWbRegId — Регистрационный номер ЕГАИС поставщика
     * - egaisWbDate — Дата документа поставщика
     */
    const EGAIS_DOCUMENT_DELETED = 'egaisDocumentDeleted';

    /**
     * Документ ЕГАИС восстановлен
     * Attributes:
     * - egaisWbDate — Дата документа поставщика
     * - egaisSourceWbRegId — Регистрационный номер ЕГАИС УТМ из которого был получен документ
     * - egaisDestinationWbRegId — Регистрационный номер ЕГАИС УТМ получателя
     * - egaisWbNumber — Номер документа поставщика
     * - egaisRejectComment — Причина отклонения документа
     * - egaisSupplierWbRegId — Регистрационный номер ЕГАИС поставщика
     * - egaisDocumentId — Идентификатор документа
     * - egaisWbRegId — Регистрационный номер документа в ЕГАИС
     */
    const EGAIS_DOCUMENT_UNDELETED = 'egaisDocumentUndeleted';

    /**
     * Документ ЕГАИС будет отправлен
     * Attributes:
     * - egaisDocumentId — Идентификатор документа
     * - egaisWbNumber — Номер документа поставщика
     * - egaisWbRegId — Регистрационный номер документа в ЕГАИС
     * - egaisSupplierWbRegId — Регистрационный номер ЕГАИС поставщика
     * - egaisWbDate — Дата документа поставщика
     * - egaisDestinationWbRegId — Регистрационный номер ЕГАИС УТМ получателя
     * - egaisRejectComment — Причина отклонения документа
     * - egaisSourceWbRegId — Регистрационный номер ЕГАИС УТМ из которого был получен документ
     */
    const EGAIS_DOCUMENT_TO_SEND = 'egaisDocumentToSend';

    /**
     * Документ ЕГАИС отправлен в УТМ
     * Attributes:
     * - egaisSourceWbRegId — Регистрационный номер ЕГАИС УТМ из которого был получен документ
     * - egaisDocumentId — Идентификатор документа
     * - egaisSupplierWbRegId — Регистрационный номер ЕГАИС поставщика
     * - egaisWbRegId — Регистрационный номер документа в ЕГАИС
     * - egaisDestinationWbRegId — Регистрационный номер ЕГАИС УТМ получателя
     * - egaisWbDate — Дата документа поставщика
     * - egaisWbNumber — Номер документа поставщика
     * - egaisRejectComment — Причина отклонения документа
     */
    const EGAIS_DOCUMENT_SENT = 'egaisDocumentSent';

    /**
     * Ошибка отправки документа ЕГАИС в УТМ
     * Attributes:
     * - egaisErrorDescription — Описание ошибки
     */
    const EGAIS_DOCUMENT_ERROR_TO_SEND = 'egaisDocumentErrorToSend';

    /**
     * Документ отклонен ЕГАИС
     * Attributes:
     * - egaisDestinationWbRegId — Регистрационный номер ЕГАИС УТМ получателя
     * - egaisWbNumber — Номер документа поставщика
     * - egaisDocumentId — Идентификатор документа
     * - egaisWbRegId — Регистрационный номер документа в ЕГАИС
     * - egaisSupplierWbRegId — Регистрационный номер ЕГАИС поставщика
     * - egaisRejectComment — Причина отклонения документа
     * - egaisSourceWbRegId — Регистрационный номер ЕГАИС УТМ из которого был получен документ
     * - egaisWbDate — Дата документа поставщика
     */
    const EGAIS_DOCUMENT_REJECTED_BY_EGAIS = 'egaisDocumentRejectedByEgais';

    /**
     * Документ получен ЕГАИС
     * Attributes:
     * - egaisDocumentId — Идентификатор документа
     * - egaisWbRegId — Регистрационный номер документа в ЕГАИС
     * - egaisDestinationWbRegId — Регистрационный номер ЕГАИС УТМ получателя
     * - egaisSourceWbRegId — Регистрационный номер ЕГАИС УТМ из которого был получен документ
     * - egaisSupplierWbRegId — Регистрационный номер ЕГАИС поставщика
     * - egaisWbDate — Дата документа поставщика
     * - egaisRejectComment — Причина отклонения документа
     * - egaisWbNumber — Номер документа поставщика
     */
    const EGAIS_DOCUMENT_RECEIVED_BY_EGAIS = 'egaisDocumentReceivedByEgais';

    /**
     * Документ проведен ЕГАИС
     * Attributes:
     * - egaisWbRegId — Регистрационный номер документа в ЕГАИС
     * - egaisRejectComment — Причина отклонения документа
     * - egaisDocumentId — Идентификатор документа
     * - egaisWbNumber — Номер документа поставщика
     * - egaisSourceWbRegId — Регистрационный номер ЕГАИС УТМ из которого был получен документ
     * - egaisSupplierWbRegId — Регистрационный номер ЕГАИС поставщика
     * - egaisWbDate — Дата документа поставщика
     * - egaisDestinationWbRegId — Регистрационный номер ЕГАИС УТМ получателя
     */
    const EGAIS_DOCUMENT_PROCESSED_BY_EGAIS = 'egaisDocumentProcessedByEgais';

    /**
     * Получена накладная ЕГАИС
     * Attributes:
     * - egaisSourceWbRegId — Регистрационный номер ЕГАИС УТМ из которого был получен документ
     * - egaisDestinationWbRegId — Регистрационный номер ЕГАИС УТМ получателя
     * - egaisWbDate — Дата документа поставщика
     * - egaisRejectComment — Причина отклонения документа
     * - egaisWbRegId — Регистрационный номер документа в ЕГАИС
     * - egaisSupplierWbRegId — Регистрационный номер ЕГАИС поставщика
     * - egaisWbNumber — Номер документа поставщика
     * - egaisDocumentId — Идентификатор документа
     */
    const EGAIS_INVOICE_CREATED = 'egaisInvoiceCreated';

    /**
     * К накладной ЕГАИС привязана справка Б
     * Attributes:
     * - egaisDocumentId — Идентификатор документа
     * - egaisSupplierWbRegId — Регистрационный номер ЕГАИС поставщика
     * - egaisWbDate — Дата документа поставщика
     * - egaisSourceWbRegId — Регистрационный номер ЕГАИС УТМ из которого был получен документ
     * - egaisWbRegId — Регистрационный номер документа в ЕГАИС
     * - egaisDestinationWbRegId — Регистрационный номер ЕГАИС УТМ получателя
     * - egaisWbNumber — Номер документа поставщика
     * - egaisRejectComment — Причина отклонения документа
     */
    const EGAIS_INVOICE_B_TICKET_LINKED = 'egaisInvoiceBTicketLinked';

    /**
     * От накладной ЕГАИС отвязана справка Б
     * Attributes:
     * - egaisSupplierWbRegId — Регистрационный номер ЕГАИС поставщика
     * - egaisDestinationWbRegId — Регистрационный номер ЕГАИС УТМ получателя
     * - egaisWbNumber — Номер документа поставщика
     * - egaisWbDate — Дата документа поставщика
     * - egaisSourceWbRegId — Регистрационный номер ЕГАИС УТМ из которого был получен документ
     * - egaisRejectComment — Причина отклонения документа
     * - egaisDocumentId — Идентификатор документа
     * - egaisWbRegId — Регистрационный номер документа в ЕГАИС
     */
    const EGAIS_INVOICE_B_TICKET_UNLINKED = 'egaisInvoiceBTicketUnlinked';

    /**
     * Накладная ЕГАИС сохранена
     * Attributes:
     * - egaisDestinationWbRegId — Регистрационный номер ЕГАИС УТМ получателя
     * - egaisWbNumber — Номер документа поставщика
     * - egaisDocumentId — Идентификатор документа
     * - egaisSupplierWbRegId — Регистрационный номер ЕГАИС поставщика
     * - egaisSourceWbRegId — Регистрационный номер ЕГАИС УТМ из которого был получен документ
     * - egaisWbRegId — Регистрационный номер документа в ЕГАИС
     * - egaisRejectComment — Причина отклонения документа
     * - egaisWbDate — Дата документа поставщика
     */
    const EGAIS_INVOICE_SAVED = 'egaisInvoiceSaved';

    /**
     * Накладная ЕГАИС изменена поставщиком
     * Attributes:
     * - egaisWbDate — Дата документа поставщика
     * - egaisDestinationWbRegId — Регистрационный номер ЕГАИС УТМ получателя
     * - egaisDocumentId — Идентификатор документа
     * - egaisSupplierWbRegId — Регистрационный номер ЕГАИС поставщика
     * - egaisWbRegId — Регистрационный номер документа в ЕГАИС
     * - egaisSourceWbRegId — Регистрационный номер ЕГАИС УТМ из которого был получен документ
     * - egaisRejectComment — Причина отклонения документа
     * - egaisWbNumber — Номер документа поставщика
     */
    const EGAIS_INVOICE_UPDATED_BY_SUPPLIER = 'egaisInvoiceUpdatedBySupplier';

    /**
     * Накладная ЕГАИС подтверждена
     * Attributes:
     * - egaisDate — Дата документа в iiko
     * - egaisNumber — Номер документа в iiko
     */
    const EGAIS_INVOICE_CONFIRMED = 'egaisInvoiceConfirmed';

    /**
     * Накладная ЕГАИС отклонена
     * Attributes:
     * - egaisDate — Дата документа в iiko
     * - egaisNumber — Номер документа в iiko
     */
    const EGAIS_INVOICE_REJECTED = 'egaisInvoiceRejected';

    /**
     * Накладная ЕГАИС подтверждена с отклонениями
     * Attributes:
     * - egaisDate — Дата документа в iiko
     * - egaisNumber — Номер документа в iiko
     */
    const EGAIS_INVOICE_CONFIRMED_WITH_CHANGES = 'egaisInvoiceConfirmedWithChanges';

    /**
     * Накладная отправлена в ЕГАИС
     * Attributes:
     * - egaisDate — Дата документа в iiko
     * - egaisNumber — Номер документа в iiko
     */
    const EGAIS_INVOICE_SENT = 'egaisInvoiceSent';

    /**
     * Накладная будет отправлена в ЕГАИС
     * Attributes:
     * - egaisDate — Дата документа в iiko
     * - egaisNumber — Номер документа в iiko
     */
    const EGAIS_INVOICE_TO_SEND = 'egaisInvoiceToSend';

    /**
     * Ответ на акт расхождений будет отправлен в ЕГАИС
     * Attributes:
     * - egaisDate — Дата документа в iiko
     * - egaisNumber — Номер документа в iiko
     */
    const EGAIS_INVOICE_CHANGES_TO_SEND = 'egaisInvoiceChangesToSend';

    /**
     * Ответ на акт расхождений отправлен в ЕГАИС
     * Attributes:
     * - egaisDate — Дата документа в iiko
     * - egaisNumber — Номер документа в iiko
     */
    const EGAIS_INVOICE_CONFIRM_TICKET_SENT = 'egaisInvoiceConfirmTicketSent';

    /**
     * Ответ по накладной отправлен в ЕГАИС
     * Attributes:
     * - egaisNumber — Номер документа в iiko
     * - egaisDate — Дата документа в iiko
     */
    const EGAIS_INVOICE_ANSWER_SENT = 'egaisInvoiceAnswerSent';

    /**
     * Ошибка отправки ответа в ЕГАИС
     * Attributes:
     * - egaisErrorDescription — Описание ошибки
     */
    const EGAIS_INVOICE_ERROR_TO_SEND = 'egaisInvoiceErrorToSend';

    /**
     * Акт расхождений подтвержден ЕГАИС
     * Attributes:
     * - egaisDate — Дата документа в iiko
     * - egaisNumber — Номер документа в iiko
     */
    const EGAIS_INVOICE_CHANGED_ANSWER_CONFIRMED_BY_EGAIS = 'egaisInvoiceChangedAnswerConfirmedByEgais';

    /**
     * Акт расхождений отклонен ЕГАИС
     * Attributes:
     * - egaisNumber — Номер документа в iiko
     * - egaisDate — Дата документа в iiko
     */
    const EGAIS_INVOICE_CHANGED_ANSWER_REJECTED_BY_EGAIS = 'egaisInvoiceChangedAnswerRejectedByEgais';

    /**
     * Накладная подтверждена ЕГАИС
     * Attributes:
     * - egaisNumber — Номер документа в iiko
     * - egaisDate — Дата документа в iiko
     */
    const EGAIS_INVOICE_CONFIRMED_BY_EGAIS = 'egaisInvoiceConfirmedByEgais';

    /**
     * Накладная отклонена ЕГАИС
     * Attributes:
     * - egaisDate — Дата документа в iiko
     * - egaisNumber — Номер документа в iiko
     */
    const EGAIS_INVOICE_REJECTED_BY_EGAIS = 'egaisInvoiceRejectedByEgais';

    /**
     * Ответ по накладной подтвержден ЕГАИС
     * Attributes:
     * - egaisDate — Дата документа в iiko
     * - egaisNumber — Номер документа в iiko
     */
    const EGAIS_INVOICE_ANSWER_CONFIRMED_BY_EGAIS = 'egaisInvoiceAnswerConfirmedByEgais';

    /**
     * Ответ по накладной отклонен ЕГАИС
     * Attributes:
     * - egaisDate — Дата документа в iiko
     * - egaisNumber — Номер документа в iiko
     */
    const EGAIS_INVOICE_ANSWER_REJECTED_BY_EGAIS = 'egaisInvoiceAnswerRejectedByEgais';

    /**
     * Ответ по накладной подтвержден поставщиком
     * Attributes:
     * - egaisDate — Дата документа в iiko
     * - egaisNumber — Номер документа в iiko
     */
    const EGAIS_INVOICE_ANSWER_CONFIRMED_BY_SUPPLIER = 'egaisInvoiceAnswerConfirmedBySupplier';

    /**
     * Ответ по накладной отклонен поставщиком
     * Attributes:
     * - egaisDate — Дата документа в iiko
     * - egaisNumber — Номер документа в iiko
     */
    const EGAIS_INVOICE_ANSWER_REJECTED_BY_SUPPLIER = 'egaisInvoiceAnswerRejectedBySupplier';

    /**
     * Создана приходная накладная
     * Attributes:
     * - egaisWbRegId — Регистрационный номер документа в ЕГАИС
     * - createdIncomingInvoiceId — Идентификатор приходной накладной
     * - egaisSourceWbRegId — Регистрационный номер ЕГАИС УТМ из которого был получен документ
     * - egaisDocumentId — Идентификатор документа
     * - egaisWbNumber — Номер документа поставщика
     * - egaisDestinationWbRegId — Регистрационный номер ЕГАИС УТМ получателя
     * - egaisRejectComment — Причина отклонения документа
     * - egaisWbDate — Дата документа поставщика
     * - egaisSupplierWbRegId — Регистрационный номер ЕГАИС поставщика
     */
    const EGAIS_INVOICE_INCOMING_INVOICE_CREATED = 'egaisInvoiceIncomingInvoiceCreated';

    /**
     * Ошибка при обработке накладной ЕГАИС
     * Attributes:
     * - egaisErrorDescription — Описание ошибки
     */
    const EGAIS_INVOICE_ERROR = 'egaisInvoiceError';



    /** GROUP Database actions (database) */

    /**
     * Backup created at user request
     */
    const DB_BACKUP_NOW = 'dbBackupNow';

    /**
     * Backup deleted at user request
     */
    const DB_BACKUP_REMOVED = 'dbBackupRemoved';

    /**
     * Backup settings have changed
     */
    const DB_BACKUP_SETTINGS_CHANGED = 'dbBackupSettingsChanged';

    /**
     * Indexes have been reorganised
     */
    const DB_INDEXES_REBUILT = 'dbIndexesRebuilt';

    /**
     * Indexes rebuilt automatically
     */
    const DB_INDEXES_AUTO_REBUILT = 'dbIndexesAutoRebuilt';

    /**
     * Database logs compressed
     */
    const DB_LOG_CLEARED = 'dbLogCleared';

    /**
     * DB compressed
     */
    const DB_CLEARED = 'dbCleared';

    /**
     * Clean old actions done
     */
    const DB_EVENTS_CLEANED = 'dbEventsCleaned';

    /**
     * Database server restarted
     */
    const DB_RESTARTED = 'dbRestarted';

    /**
     * DB auto-backup
     * Attributes:
     * - dbBackupType — Backup type
     * - dbBackupErrorDescription — Error description
     */
    const DB_BACKUP = 'dbBackup';



    /** GROUP All events (common) */



    /** GROUP Quick menu operations (quickLabels) */

    /**
     * Edit quick menu
     */
    const QUICK_LABEL_CHANGED = 'quickLabelChanged';

    /**
     * Create quick menu for room
     */
    const QUICK_LABEL_FOR_ROOM_CREATED = 'quickLabelForRoomCreated';

    /**
     * Delete quick menu for room
     */
    const QUICK_LABEL_FOR_ROOM_REMOVED = 'quickLabelForRoomRemoved';



    /** GROUP Corporate settings (chainSetup) */

    /**
     * Add corporation
     * Attributes:
     * - corporationId — Corporation
     */
    const CORPORATION_CREATED = 'corporationCreated';

    /**
     * Edit corporation
     * Attributes:
     * - corporationId — Corporation
     */
    const CORPORATION_UPDATED = 'corporationUpdated';

    /**
     * Delete corporation
     * Attributes:
     * - corporationId — Corporation
     */
    const CORPORATION_DELETED = 'corporationDeleted';

    /**
     * Final lock date change
     * Attributes:
     * - department — Outlet
     * - newDate — New date
     */
    const PERIOD_CLOSE_DATE_UPDATED = 'periodCloseDateUpdated';

    /**
     * Preliminary lock date change
     * Attributes:
     * - department — Outlet
     * - newDate — New date
     */
    const PERIOD_CLOSING_DATE_UPDATED = 'periodClosingDateUpdated';

    /**
     * Changing the precision of calculation
     * Attributes:
     * - newMoneyPrecision — New accuracy calculation
     * - oldMoneyPrecision — Previous accuracy calculation
     */
    const MONEY_PRECISION_CHANGED = 'moneyPrecisionChanged';

    /**
     * Add a legal entity
     * Attributes:
     * - jurPersonId — Leg. Entity
     */
    const JUR_PERSON_CREATED = 'jurPersonCreated';

    /**
     * Edit a legal entity
     * Attributes:
     * - jurPersonId — Leg. Entity
     */
    const JUR_PERSON_UPDATED = 'jurPersonUpdated';

    /**
     * Delete legal entity
     * Attributes:
     * - jurPersonId — Leg. Entity
     */
    const JUR_PERSON_DELETED = 'jurPersonDeleted';

    /**
     * Add a organisation department
     * Attributes:
     * - orgDevelopmentId — Organisation department
     */
    const ORG_DEVELOPMENT_CREATED = 'orgDevelopmentCreated';

    /**
     * Edit organisation department
     * Attributes:
     * - orgDevelopmentId — Organisation department
     */
    const ORG_DEVELOPMENT_UPDATED = 'orgDevelopmentUpdated';

    /**
     * Delete organisation department
     * Attributes:
     * - orgDevelopmentId — Organisation department
     */
    const ORG_DEVELOPMENT_DELETED = 'orgDevelopmentDeleted';

    /**
     * Add an outlet
     * Attributes:
     * - department — Outlet
     */
    const DEPARTMENT_CREATED = 'departmentCreated';

    /**
     * Edit outlet
     * Attributes:
     * - department — Outlet
     */
    const DEPARTMENT_UPDATED = 'departmentUpdated';

    /**
     * Delete outlet
     * Attributes:
     * - department — Outlet
     */
    const DEPARTMENT_DELETED = 'departmentDeleted';

    /**
     * Add production facilities
     * Attributes:
     * - manufactureId — Production
     */
    const MANUFACTURE_CREATED = 'manufactureCreated';

    /**
     * Edit production facilities
     * Attributes:
     * - manufactureId — Production
     */
    const MANUFACTURE_UPDATED = 'manufactureUpdated';

    /**
     * Delete production facilities
     * Attributes:
     * - manufactureId — Production
     */
    const MANUFACTURE_DELETED = 'manufactureDeleted';

    /**
     * Add main storage
     * Attributes:
     * - centralStoreId — Main storage
     */
    const CENTRAL_STORE_CREATED = 'centralStoreCreated';

    /**
     * Edit main storage
     * Attributes:
     * - centralStoreId — Main storage
     */
    const CENTRAL_STORE_UPDATED = 'centralStoreUpdated';

    /**
     * Delete main storage
     * Attributes:
     * - centralStoreId — Main storage
     */
    const CENTRAL_STORE_DELETED = 'centralStoreDeleted';

    /**
     * Add HQ
     * Attributes:
     * - centralOfficeId — HQ
     */
    const CENTRAL_OFFICE_CREATED = 'centralOfficeCreated';

    /**
     * Edit HQ
     * Attributes:
     * - centralOfficeId — HQ
     */
    const CENTRAL_OFFICE_UPDATED = 'centralOfficeUpdated';

    /**
     * Delete HQ
     * Attributes:
     * - centralOfficeId — HQ
     */
    const CENTRAL_OFFICE_DELETED = 'centralOfficeDeleted';

    /**
     * Add outlet
     * Attributes:
     * - salePointId — Point of sale
     */
    const SALE_POINT_CREATED = 'salePointCreated';

    /**
     * Edit outlet
     * Attributes:
     * - salePointId — Point of sale
     */
    const SALE_POINT_UPDATED = 'salePointUpdated';

    /**
     * Delete outlet
     * Attributes:
     * - salePointId — Point of sale
     */
    const SALE_POINT_DELETED = 'salePointDeleted';



    /** GROUP Discount settings (discountSetup) */

    /**
     * Add discount/surcharge
     * Attributes:
     * - discountTypeId — Discount/surcharge type
     */
    const DISCOUNT_TYPE_CREATED = 'discountTypeCreated';

    /**
     * Activate/Deactivate discount/surcharge
     * Attributes:
     * - discountTypeId — Discount/surcharge type
     */
    const DISCOUNT_TYPE_DELETED = 'discountTypeDeleted';

    /**
     * Edit discount/surcharge
     * Attributes:
     * - discountTypeId — Discount/surcharge type
     */
    const DISCOUNT_TYPE_UPDATED = 'discountTypeUpdated';



    /** GROUP Exchange with iiko.Biz (iikoBizReplicationGroup) */

    /**
     * Export cities, streets, regions to iiko.Biz
     * Attributes:
     * - streetsExportedQuantity — Streets exported
     * - citiesExportedQuantity — Cities exported
     * - regionsExportedQuantity — Regions exported
     */
    const CITIES_EXPORT_EVENT = 'citiesExportEvent';

    /**
     * Exchange guests with iiko.Biz
     * Attributes:
     * - customersExportedQuantity — Guests exported
     * - customersBindingsImportedQuantity — Guest bindings imported
     * - customersImportedQuantity — Guests imported
     * - customersFilteredOutQuantity — Guests filtered
     */
    const CUSTOMERS_EXCHANGE_EVENT = 'customersExchangeEvent';

    /**
     * Export stock list items to iiko.Biz
     * Attributes:
     * - hierarchyLevelsWebExportedQuantity — External menu hierarchies exported
     * - forceReload — Full re-export
     * - nomenclatureImagesUploadedQuantity — External menu images exported
     * - productsWebExportedQuantity — External menu products exported
     */
    const NOMENCLATURE_EXPORT_EVENT = 'nomenclatureExportEvent';



    /** GROUP Work with discounts/surcharges of the order (discountsFront) */

    /**
     * Add discount/surcharge
     * Attributes:
     * - dishes — List of order items
     */
    const ORDER_DISCOUNTED = 'orderDiscounted';

    /**
     * Delete discount/surcharge
     * Attributes:
     * - dishes — List of order items
     */
    const ORDER_DISCOUNT_DELETED = 'orderDiscountDeleted';



    /** GROUP Work with order items (dishes) */

    /**
     * Delete unprinted order items
     * Attributes:
     * - dishes — List of order items
     */
    const DELETED_NEW_ITEMS = 'deletedNewItems';

    /**
     * Delete printed order items
     * Attributes:
     * - employee — Employee
     * - operationWithWriteoff — With write-off
     */
    const DELETED_PRINTED_ITEMS = 'deletedPrintedItems';

    /**
     * Reweighing
     * Attributes:
     * - dishes — List of order items
     */
    const RE_PRINTED_BARCODE = 'rePrintedBarcode';

    /**
     * Transfer order items to another responsible person
     * Attributes:
     * - dishes — List of order items
     */
    const DISHES_MOVED = 'dishesMoved';

    /**
     * Transfer items to order
     * Attributes:
     * - dishes — List of order items
     */
    const DISHES_MOVED_TO = 'dishesMovedTo';

    /**
     * Transfer items from order
     * Attributes:
     * - dishes — List of order items
     */
    const DISHES_MOVED_FROM = 'dishesMovedFrom';

    /**
     * Transfer items to new order after guest bill
     * Attributes:
     * - dishes — List of order items
     */
    const DISHES_MOVED_AFTER_CHEQUE = 'dishesMovedAfterCheque';

    /**
     * Emergency deletion of order items
     * Attributes:
     * - dishes — List of order items
     */
    const EMERGENCY_ITEMS_DELETION = 'emergencyItemsDeletion';

    /**
     * Add item to order
     * Attributes:
     * - dishes — List of order items
     */
    const ADD_ITEM_TO_ORDER = 'addItemToOrder';

    /**
     * Changing the size of the position
     * Attributes:
     * - dishes — List of order items
     */
    const CHANGED_ITEM_SIZE = 'changedItemSize';

    /**
     * Print to kitchen
     * Attributes:
     * - dishes — List of order items
     */
    const SERVICE_CHEQUE_FOR_DISHES_PRINTED = 'serviceChequeForDishesPrinted';

    /**
     * Reprint for kitchen
     * Attributes:
     * - dishes — List of order items
     */
    const SERVICE_CHEQUE_RE_PRINTED = 'serviceChequeRePrinted';

    /**
     * Move to next preparation status
     * Attributes:
     * - cookingStatus — Preparation status
     */
    const COOKING_STATUS_CHANGED_TO_NEXT = 'cookingStatusChangedToNext';

    /**
     * Return to previous preparation status
     * Attributes:
     * - cookingStatus — Preparation status
     */
    const COOKING_STATUS_CHANGED_TO_PREVIOUS = 'cookingStatusChangedToPrevious';

    /**
     * Serve item
     * Attributes:
     * - dishes — List of order items
     */
    const DISH_SERVED = 'dishServed';

    /**
     * Cancel serving item
     * Attributes:
     * - dishes — List of order items
     */
    const DISH_SERVED_CANCELLED = 'dishServedCancelled';

    /**
     * Order item split
     * Attributes:
     * - dishes — List of order items
     */
    const SPLIT_ORDER_ITEM = 'splitOrderItem';

    /**
     * Apply free price
     * Attributes:
     * - openPrice — Free price
     */
    const OPEN_PRICE_APPLIED = 'openPriceApplied';

    /**
     * Use of the price list out of schedule
     * Attributes:
     * - priceBefore — Price (old)
     * - inactivePriceListDocumentName — Name of price list used out of schedule
     */
    const INACTIVE_PRICE_LIST_DOCUMENT_APPLIED = 'inactivePriceListDocumentApplied';



    /** GROUP Order service processing (services) */

    /**
     * Service started automatically
     * Attributes:
     * - dishes — List of order items
     */
    const SERVICE_AUTO_STARTED = 'serviceAutoStarted';

    /**
     * Service stopped automatically
     * Attributes:
     * - dishes — List of order items
     */
    const SERVICE_AUTO_STOPPED = 'serviceAutoStopped';

    /**
     * Service started manually
     * Attributes:
     * - dishes — List of order items
     */
    const SERVICE_MANUAL_STARTED = 'serviceManualStarted';

    /**
     * Service stopped manually
     * Attributes:
     * - dishes — List of order items
     */
    const SERVICE_MANUAL_STOPPED = 'serviceManualStopped';



    /** GROUP BackOffice events (BackOffice) */



    /** GROUP Medical cards and analysis (medicalAnalysis) */

    /**
     * Create a medical analysis
     * Attributes:
     * - medicalAnalysisTypeDuration — Validity period
     * - medicalAnalysisTypeId — Analysis
     * - name — Name
     * - medicalAnalysisTypeCode — Code
     */
    const MEDICAL_ANALYSIS_TYPE_CREATED = 'medicalAnalysisTypeCreated';

    /**
     * Edit a medical analysis
     * Attributes:
     * - medicalAnalysisTypeId — Analysis
     * - name — Name
     * - medicalAnalysisTypeDuration — Validity period
     * - medicalAnalysisTypeCode — Code
     */
    const MEDICAL_ANALYSIS_TYPE_UPDATED = 'medicalAnalysisTypeUpdated';

    /**
     * Delete/restore a medical analysis
     * Attributes:
     * - medicalAnalysisTypeDuration — Validity period
     * - name — Name
     * - medicalAnalysisTypeCode — Code
     * - medicalAnalysisTypeId — Analysis
     */
    const MEDICAL_ANALYSIS_TYPE_SET_DELETED = 'medicalAnalysisTypeSetDeleted';



    /** GROUP Settlements (employeesAccounts) */

    /**
     * Add penalty type
     * Attributes:
     * - penaltyOrBonusTypeId — Penalty/bonus type
     * - name — Name
     */
    const PENALTY_TYPE_CREATED = 'penaltyTypeCreated';

    /**
     * Edit penalty type
     * Attributes:
     * - name — Name
     * - penaltyOrBonusTypeId — Penalty/bonus type
     */
    const PENALTY_TYPE_UPDATED = 'penaltyTypeUpdated';

    /**
     * Activate/deactivate a penalty type
     * Attributes:
     * - penaltyOrBonusTypeId — Penalty/bonus type
     * - name — Name
     */
    const PENALTY_TYPE_DELETED = 'penaltyTypeDeleted';

    /**
     * Add bonus type
     * Attributes:
     * - name — Name
     * - penaltyOrBonusTypeId — Penalty/bonus type
     */
    const BONUS_TYPE_CREATED = 'bonusTypeCreated';

    /**
     * Edit bonus type
     * Attributes:
     * - name — Name
     * - penaltyOrBonusTypeId — Penalty/bonus type
     */
    const BONUS_TYPE_UPDATED = 'bonusTypeUpdated';

    /**
     * Activate/deactivate a bonus type
     * Attributes:
     * - penaltyOrBonusTypeId — Penalty/bonus type
     * - name — Name
     */
    const BONUS_TYPE_DELETED = 'bonusTypeDeleted';

    /**
     * Add a type of deposits/withdrawals from the cash register
     * Attributes:
     * - payInOutType — Type of deposit/pull from the cash register
     * - name — Name
     */
    const PAY_IN_OUT_TYPE_CREATED = 'payInOutTypeCreated';

    /**
     * Edit a type of deposits/withdrawals from the cash register
     * Attributes:
     * - name — Name
     * - payInOutType — Type of deposit/pull from the cash register
     */
    const PAY_IN_OUT_TYPE_UPDATED = 'payInOutTypeUpdated';

    /**
     * Activate/deactivate a type of deposits/withdrawals from the cash register
     * Attributes:
     * - name — Name
     * - payInOutType — Type of deposit/pull from the cash register
     */
    const PAY_IN_OUT_TYPE_DELETED = 'payInOutTypeDeleted';

    /**
     * Add deletion type
     * Attributes:
     * - removalType — Deletion type
     * - name — Name
     */
    const REMOVAL_TYPE_CREATED = 'removalTypeCreated';

    /**
     * Edit deletion type
     * Attributes:
     * - name — Name
     * - removalType — Deletion type
     */
    const REMOVAL_TYPE_UPDATED = 'removalTypeUpdated';

    /**
     * Activate/deactivate deletion type
     * Attributes:
     * - removalType — Deletion type
     * - name — Name
     */
    const REMOVAL_TYPE_DELETED = 'removalTypeDeleted';

    /**
     * Add payment type
     * Attributes:
     * - paymentType — Payment type
     * - name — Name
     */
    const PAYMENT_TYPE_CREATED = 'paymentTypeCreated';

    /**
     * Edit payment type
     * Attributes:
     * - paymentType — Payment type
     * - name — Name
     */
    const PAYMENT_TYPE_UPDATED = 'paymentTypeUpdated';

    /**
     * Activate/deactivate payment type
     * Attributes:
     * - name — Name
     * - paymentType — Payment type
     */
    const PAYMENT_TYPE_DELETED = 'paymentTypeDeleted';

    /**
     * Add order type
     * Attributes:
     * - name — Name
     * - orderType — Order type
     */
    const ORDER_TYPE_CREATED = 'orderTypeCreated';

    /**
     * Edit order type
     * Attributes:
     * - name — Name
     * - orderType — Order type
     */
    const ORDER_TYPE_UPDATED = 'orderTypeUpdated';

    /**
     * Activate/deactivate order type
     * Attributes:
     * - orderType — Order type
     * - name — Name
     */
    const ORDER_TYPE_DELETED = 'orderTypeDeleted';



    /** GROUP Telephony (pbxCallGroup) */

    /**
     * Incoming calls
     */
    const PBX_CALL_INCOMING = 'pbxCallIncoming';

    /**
     * Outgoing calls
     */
    const PBX_CALL_OUTCOMING = 'pbxCallOutcoming';

    /**
     * Receive call
     */
    const PBX_CALL_ACCEPTED = 'pbxCallAccepted';

    /**
     * Cancel call
     */
    const PBX_CALL_REJECTED = 'pbxCallRejected';

    /**
     * End call
     */
    const PBX_CALL_HUNG_UP = 'pbxCallHungUp';

    /**
     * Hold call
     */
    const PBX_CALL_HELD = 'pbxCallHeld';

    /**
     * Continue call
     */
    const PBX_CALL_UNHELD = 'pbxCallUnheld';



    /** GROUP Allergen groups (allergens) */

    /**
     * Allergen group creating
     * Attributes:
     * - allergenGroupId — Allergen group
     * - allergenGroupName — Allergen group name
     * - allergenGroupCode — Allergen group code
     */
    const ALLERGEN_CREATED = 'allergenCreated';

    /**
     * Allergen group editing
     * Attributes:
     * - allergenGroupCode — Allergen group code
     * - allergenGroupId — Allergen group
     * - allergenGroupName — Allergen group name
     */
    const ALLERGEN_UPDATED = 'allergenUpdated';

    /**
     * Deleting/restoring of allergen group
     * Attributes:
     * - allergenGroupName — Allergen group name
     * - allergenGroupCode — Allergen group code
     * - allergenGroupId — Allergen group
     */
    const ALLERGEN_SET_DELETED = 'allergenSetDeleted';



    /** GROUP Out of stock list operations (stopList) */

    /**
     * Add a product to out of stock list
     */
    const STOP_LIST_ITEM_ADDED = 'stopListItemAdded';

    /**
     * Delete product from out of stock list
     */
    const STOP_LIST_ITEM_REMOVED = 'stopListItemRemoved';

    /**
     * Print out of stock list
     */
    const STOP_LIST_PRINTED = 'stopListPrinted';



    /** GROUP Delivery settings (deliverySettingsGroup) */

    /**
     * Change delivery terminal
     * Attributes:
     * - deliveryTerminalName — Terminal name
     * - deliveryTerminalIsRegistered — Terminal registered
     * - deliveryTerminalIsDeleted — Terminal deleted
     */
    const DELIVERY_TERMINAL_SETTINGS_CHANGED = 'deliveryTerminalSettingsChanged';



    /** GROUP Working with Plan Actuals (budgetPlans) */

    /**
     * Save Plan Actual
     */
    const BUDGET_PLAN_SAVED = 'budgetPlanSaved';

    /**
     * Create Plan Actual
     */
    const BUDGET_PLAN_CREATED = 'budgetPlanCreated';

    /**
     * Delete Plan Actual
     */
    const BUDGET_PLAN_DELETED = 'budgetPlanDeleted';

    /**
     * Restore Plan Actual
     */
    const BUDGET_PLAN_UNDELETED = 'budgetPlanUndeleted';



    /** GROUP Customers (guests) */

    /**
     * Add club card
     * Attributes:
     * - priceCategory — Price category
     * - discountCardType — Card type
     * - cardNumber — Card number
     * - ownerName — Cardholder
     */
    const DISCOUNT_CARD_CREATED = 'discountCardCreated';

    /**
     * Change club card
     * Attributes:
     * - priceCategory — Price category
     * - cardNumber — Card number
     * - ownerName — Cardholder
     * - discountCardType — Card type
     */
    const DISCOUNT_CARD_UPDATED = 'discountCardUpdated';

    /**
     * Activate/deactivate club card
     * Attributes:
     * - priceCategory — Price category
     * - cardNumber — Card number
     * - discountCardType — Card type
     * - ownerName — Cardholder
     */
    const DISCOUNT_CARD_DELETED = 'discountCardDeleted';



    /** GROUP Restaurant parameters (setup) */

    /**
     * Add storage
     */
    const STORE_CREATED = 'storeCreated';

    /**
     * Edit storage
     */
    const STORE_UPDATED = 'storeUpdated';

    /**
     * Activate/deactivate storage
     */
    const STORE_DELETED = 'storeDeleted';



    /** GROUP Restaurant setup (cafeSetup) */

    /**
     * Change components set
     */
    const CAFE_STRUCTURE_UPDATED = 'cafeStructureUpdated';

    /**
     * Edit restaurant settings
     */
    const CAFE_SETTINGS_UPDATED = 'cafeSettingsUpdated';

    /**
     * Edit group
     */
    const CAFE_GROUP_UPDATED = 'cafeGroupUpdated';

    /**
     * Remove Main Cash Register mode
     */
    const CAFE_GROUP_MAIN_CASH_NOT_PRESENT = 'cafeGroupMainCashNotPresent';

    /**
     * Set/change Main Cash Register mode
     */
    const CAFE_GROUP_MAIN_CASH_CHANGED = 'cafeGroupMainCashChanged';

    /**
     * Edit section
     */
    const CAFE_SECTION_UPDATED = 'cafeSectionUpdated';

    /**
     * Add floor plan
     */
    const SCHEMA_CREATED = 'schemaCreated';

    /**
     * Edit floor plan
     */
    const SCHEMA_UPDATED = 'schemaUpdated';

    /**
     * Delete floor plan
     */
    const SCHEMA_DELETED = 'schemaDeleted';

    /**
     * Create setting to auto-add items
     * Attributes:
     * - autoAdditionSettingsDescription — Settings to auto-add items
     */
    const AUTO_ADDITION_SETTINGS_CREATED = 'autoAdditionSettingsCreated';

    /**
     * Change setting to auto-add items
     * Attributes:
     * - autoAdditionSettingsDescription — Settings to auto-add items
     */
    const AUTO_ADDITION_SETTINGS_EDITED = 'autoAdditionSettingsEdited';

    /**
     * Delete setting to auto-add items
     * Attributes:
     * - autoAdditionSettingsDescription — Settings to auto-add items
     */
    const AUTO_ADDITION_SETTINGS_DELETED = 'autoAdditionSettingsDeleted';

    /**
     * Changing iikoCard5 settings
     */
    const IIKO_CARD51_SETTINGS_UPDATED = 'iikoCard51SettingsUpdated';

}
<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 12/02/2019
 * Time: 22:05
 */

namespace models;


class IuguFatura
{

    public $id;
    public $due_date;
    public $currency;
    public $discount_cents;
    public $email;
    public $notification_url;
    public $return_url;
    public $status;
    public $tax_cents;
    public $total_cents;
    public $total_paid_cents;
    public $taxes_paid_cents;
    public $paid_at;
    public $paid_cents;
    public $cc_emails;
    public $payable_with;
    public $overpaid_cents;
    public $ignore_due_email;
    public $ignore_canceled_email;
    public $advance_fee_cents;
    public $commission_cents;
    public $early_payment_discount;
    public $order_id;
    public $updated_at;
    public $secure_id;
    public $secure_url;
    public $customer_id;
    public $customer_ref;
    public $customer_name;
    public $user_id;
    public $total;
    public $taxes_paid;
    public $total_paid;
    public $total_overpaid;
    public $commission;
    public $fines_on_occurrence_day;
    public $total_on_occurrence_day;
    public $fines_on_occurrence_day_cents;
    public $total_on_occurrence_day_cents;
    public $financial_return_date;
    public $advance_fee;
    public $paid;
    public $original_payment_id;
    public $double_payment_id;
    public $interest;
    public $discount;
    public $created_at;
    public $created_at_iso;
    public $authorized_at;
    public $authorized_at_iso;
    public $expired_at;
    public $expired_at_iso;
    public $refunded_at;
    public $refunded_at_iso;
    public $canceled_at;
    public $canceled_at_iso;
    public $protested_at;
    public $protested_at_iso;
    public $chargeback_at;
    public $chargeback_at_iso;
    public $occurrence_date;
    public $refundable;
    public $installments;
    public $transaction_number;
    public $payment_method;
    public $financial_return_dates;
    public $bank_slip;
}
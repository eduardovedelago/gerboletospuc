<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 30/10/2018
 * Time: 23:23
 */

namespace models;


class IuguChargeModel implements \JsonSerializable
{

    private $method;
    private $restrict_payment_method;
    private $invoice_id;
    private $email;
    private $months;
    private $discount_cents;
    private $bank_slip_extra_days;
    private $keep_dunning;
    private $items;
    private $payer;
    private $order_id;
    private $notes;

    //private $token;
    //private $customer_payment_method_id;
    //private $customer_id;

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return mixed
     */
    public function getRestrictPaymentMethod()
    {
        return $this->restrict_payment_method;
    }

    /**
     * @param mixed $restrict_payment_method
     */
    public function setRestrictPaymentMethod($restrict_payment_method)
    {
        $this->restrict_payment_method = $restrict_payment_method;
    }

    /**
     * @return mixed
     */
    public function getInvoiceId()
    {
        return $this->invoice_id;
    }

    /**
     * @param mixed $invoice_id
     */
    public function setInvoiceId($invoice_id)
    {
        $this->invoice_id = $invoice_id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMonths()
    {
        return $this->months;
    }

    /**
     * @param mixed $months
     */
    public function setMonths($months)
    {
        $this->months = $months;
    }

    /**
     * @return mixed
     */
    public function getDiscountCents()
    {
        return $this->discount_cents;
    }

    /**
     * @param mixed $discount_cents
     */
    public function setDiscountCents($discount_cents)
    {
        $this->discount_cents = $discount_cents;
    }

    /**
     * @return mixed
     */
    public function getBankSlipExtraDays()
    {
        return $this->bank_slip_extra_days;
    }

    /**
     * @param mixed $bank_slip_extra_days
     */
    public function setBankSlipExtraDays($bank_slip_extra_days)
    {
        $this->bank_slip_extra_days = $bank_slip_extra_days;
    }

    /**
     * @return mixed
     */
    public function getKeepDunning()
    {
        return $this->keep_dunning;
    }

    /**
     * @param mixed $keep_dunning
     */
    public function setKeepDunning($keep_dunning)
    {
        $this->keep_dunning = $keep_dunning;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * @return mixed
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * @param mixed $payer
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @param mixed $order_id
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

}
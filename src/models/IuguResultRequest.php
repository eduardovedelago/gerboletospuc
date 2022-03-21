<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 02/11/2018
 * Time: 23:35
 */

namespace models;


class IuguResultRequest implements \JsonSerializable
{

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    private $success = false;
    private $errors = "";
    private $url = "";
    private $pdf = "";
    private $identification = "";
    private $invoice_id = "";
    private $bodyRequest = "";

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param bool $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }

    /**
     * @return string
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param string $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * @param string $pdf
     */
    public function setPdf($pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * @return string
     */
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * @param string $identification
     */
    public function setIdentification($identification)
    {
        $this->identification = $identification;
    }

    /**
     * @return string
     */
    public function getInvoiceId()
    {
        return $this->invoice_id;
    }

    /**
     * @param string $invoice_id
     */
    public function setInvoiceId($invoice_id)
    {
        $this->invoice_id = $invoice_id;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->bodyRequest;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->bodyRequest = $body;
    }
}
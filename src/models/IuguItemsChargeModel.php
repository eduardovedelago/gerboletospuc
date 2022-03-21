<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 31/10/2018
 * Time: 23:20
 */

namespace models;


class IuguItemsChargeModel implements \JsonSerializable
{

    private $description;
    private $quantity;
    private $price_cents;

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getPriceCents()
    {
        return $this->price_cents;
    }

    /**
     * @param mixed $price_cents
     */
    public function setPriceCents($price_cents)
    {
        $this->price_cents = $price_cents;
    }

}
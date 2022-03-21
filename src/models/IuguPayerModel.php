<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 31/10/2018
 * Time: 22:53
 */

namespace models;

class IuguPayerModel implements \JsonSerializable
{

    private $cpf_cnpj;
    private $name;
    private $phone_prefix;
    private $phone;
    private $email;
    private $address;

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }


    /**
     * @return mixed
     */
    public function getCpfCnpj()
    {
        return $this->cpf_cnpj;
    }

    /**
     * @param mixed $cpf_cnpj
     */
    public function setCpfCnpj($cpf_cnpj)
    {
        $this->cpf_cnpj = $cpf_cnpj;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPhonePrefix()
    {
        return $this->phone_prefix;
    }

    /**
     * @param mixed $phone_prefix
     */
    public function setPhonePrefix($phone_prefix)
    {
        $this->phone_prefix = $phone_prefix;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
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
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }


}
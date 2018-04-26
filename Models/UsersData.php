<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 07/02/2018
 * Time: 22:00
 */

class UsersData
{
    public function __construct($dbRow)
    {
        $this->_id = $dbRow['user_id'];
        $this->_email = $dbRow['user_email'];
        $this->_username = $dbRow['user_name'];
        $this->_password = $dbRow['user_password'];
        $this->_phone = $dbRow['user_phone'];
        $this->_address = $dbRow['user_address'];
        $this->_postcode = $dbRow['user_postcode'];
        $this->_city = $dbRow['user_city'];


    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->_address = $address;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->_city = $city;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @param mixed $postcode
     */
    public function setPostcode($postcode)
    {
        $this->_postcode = $postcode;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->_address;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->_city;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return $this->_postcode;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_username;
    }
}
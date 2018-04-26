<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 09/02/2018
 * Time: 22:04
 */

class WishListData
{
    public function __construct($dbRow)
    {
        $this->_id = $dbRow['id'];
        $this->_customer = $dbRow['customerID'];
        $this->_item = $dbRow['itemID'];
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->_customer;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer($customer)
    {
        $this->_customer = $customer;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getItem()
    {
        return $this->_item;
    }

    /**
     * @param mixed $item
     */
    public function setItem($item)
    {
        $this->_item = $item;
    }

}
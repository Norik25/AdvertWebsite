<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 13/02/2018
 * Time: 05:39
 */

class Picture
{

    public function __construct($dbRow)
    {
        $this->_id = $dbRow['id'];
        $this->_name = $dbRow['image_name'];
        $this->_itemID = $dbRow['itemID'];

    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
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
    public function getItemID()
    {
        return $this->_itemID;
    }

    /**
     * @param mixed $itemID
     */
    public function setItemID($itemID)
    {
        $this->_itemID = $itemID;
    }

}
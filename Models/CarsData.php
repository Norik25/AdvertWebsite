<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 04/02/2018
 * Time: 15:34
 */

class CarsData
{
    public function __construct($dbRow)
    {
        $this->_id = $dbRow['id'];
        $this->_title = $dbRow['car_title'];
        $this->_make = $dbRow['car_make'];
        $this->_engine = $dbRow['car_engine'];
        $this->_gearbox = $dbRow['car_gearbox'];
        $this->_mileage = $dbRow['car_milage'];
        $this->_color = $dbRow['car_color'];
        $this->_description = $dbRow['car_desc'];
        $this->_added = $dbRow['car_added'];
        $this->price = $dbRow['car_price'];
        $this->user = $dbRow['car_user'];

    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $added
     */
    public function setAdded($added)
    {
        $this->_added = $added;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->_color = $color;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->_description = $description;
    }

    /**
     * @param mixed $engine
     */
    public function setEngine($engine)
    {
        $this->_engine = $engine;
    }

    /**
     * @param mixed $gearbox
     */
    public function setGearbox($gearbox)
    {
        $this->_gearbox = $gearbox;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @param mixed $make
     */
    public function setMake($make)
    {
        $this->_make = $make;
    }

    /**
     * @param mixed $mileage
     */
    public function setMileage($mileage)
    {
        $this->_mileage = $mileage;
    }

    /**
     * @param mixed $pic
     */
    public function setPic($pic)
    {
        $this->_pic = $pic;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->_color;
    }

    /**
     * @return mixed
     */
    public function getEngine()
    {
        return $this->_engine;
    }

    /**
     * @return mixed
     */
    public function getGearbox()
    {
        return $this->_gearbox;
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
    public function getMake()
    {
        return $this->_make;
    }

    /**
     * @return mixed
     */
    public function getMileage()
    {
        return $this->_mileage;
    }

    /**
     * @return mixed
     */
    public function getPic()
    {
        return $this->_pic;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @return mixed
     */
    public function getAdded()
    {
        return $this->_added;
    }
}
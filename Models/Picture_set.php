<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 13/02/2018
 * Time: 05:39
 */

require_once ('Models/Database.php');
require_once ('Models/Picture.php');

class Picture_set
{

    protected $_dbHandle, $dbInstance;

    public function __construct()
    {
        $this->dbInstance = Database::getInstance();
        $this->_dbHandle = $this->dbInstance->getdbConnection();
    }

    public function fetchAllData() {
        $sqlQuery = 'SELECT * FROM cars_images';

        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare statement
        $statement->execute();

        $dataSet = [];

        while ($row = $statement->fetch()) {
            $dataSet[] = new Picture($row);
        }
        return $dataSet;
    }

    /**
     * Returns all pictures for a (parameter) itemID
     * @param $itemID
     * @return array
     */
    public function getPicsByItemID($itemID) {
        $sqlQuery = "SELECT image_name FROM cars_images WHERE itemID='$itemID'";
        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare statement
        $statement->execute();

        $pics = [];

        while ($row = $statement->fetch()) {
            $pics [] = $row['image_name'];
        }

        return $pics;
    }


}
<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 09/02/2018
 * Time: 22:04
 */
require_once ('Models/Database.php');
require_once ('Models/WishListData.php');
class WishList_data_set
{
    protected $_dbHandle, $dbInstance;

    public function __construct()
    {
        $this->dbInstance = Database::getInstance();
        $this->_dbHandle = $this->dbInstance->getdbConnection();
    }

    public function fetchAllData() { // fetches data from the database
        $sqlQuery = 'SELECT * FROM wish_list';

        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare statement
        $statement->execute();

        $dataSet = [];

        while ($row = $statement->fetch()) {
            $dataSet[] = new WishListData($row);
        }
        return $dataSet;
    }

    /**
     * Checks if a (parameter) item for a (parameter) user is already in the database
     * @param $itemID
     * @param $userID
     * @return bool
     *
     */
    public function isInDatabase($itemID, $userID) {
        $sqlQuery = "SELECT  * FROM wish_list WHERE customerID='$userID' AND itemID='$itemID'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $dataSet = [];

        while ($row = $statement->fetch()) {
            $dataSet[] = new WishListData($row);
        }
        if(empty($dataSet)) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Returns all item IDs of a (parameter) user
     * @param $userID
     * @return array
     */
    public function getWishItems($userID){
        $sqlQuery = "SELECT itemID FROM wish_list WHERE customerID='$userID'";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $itemIDs = [];

        while ($row = $statement->fetch()) {
            $itemIDs[] = $row['itemID'];
        }

        return $itemIDs;
    }

    /**
     * Deletes a data entry from the database by id(parameter)
     * @param $id
     */
    public function deleteById($id) {
        $sqlQuery = "DELETE FROM wish_list WHERE itemID='$id'";

        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare statement
        $statement->execute();
    }
}
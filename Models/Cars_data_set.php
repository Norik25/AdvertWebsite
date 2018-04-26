<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 04/02/2018
 * Time: 15:43
 */

require_once ('Models/Database.php');
require_once ('Models/CarsData.php');

class Cars_data_set
{
    protected $_dbHandle, $dbInstance;

    public function __construct()
    {
        $this->dbInstance = Database::getInstance();
        $this->_dbHandle = $this->dbInstance->getdbConnection();
    }

    public function fetchAllData() {
        $sqlQuery = 'SELECT * FROM cars_items';

        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare statement
        $statement->execute();

        $dataSet = [];

        while ($row = $statement->fetch()) {
            $dataSet[] = new CarsData($row);
        }
        return $dataSet;
    }

    /**
     * Gets all items from database according to the (parameter)set of IDs
     * @param $iDSet
     * @return array
     */
    public function getAllDataFromSet($iDSet) {
        $dataSet = [];
        foreach ($iDSet as $item) {
            $sqlQuery = "SELECT * FROM cars_items WHERE id='$item'";

            $statement = $this->_dbHandle->prepare($sqlQuery); //prepare statement
            $statement->execute();

            while ($row = $statement->fetch()) {
                $dataSet[] = new CarsData($row);
            }






        }
        return $dataSet;

    }

    /**
     * Returns all items from the database by user(parameter)
     * @param $userID
     * @return array
     */
    public function getAllItemsByUser($userID) {

        $dataSet = [];

        $sqlQuery = "SELECT * FROM cars_items WHERE car_user='$userID'";

        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare statement
        $statement->execute();

        while ($row = $statement->fetch()) {
            $dataSet[] = new CarsData($row);
        }
        return $dataSet;
    }

    /**
     * Deletes a data entry from the database by id(parameter)
     * @param $id
     */
    public function deleteById($id) {
        $sqlQuery = "DELETE FROM cars_items WHERE id='$id'";

        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare statement
        $statement->execute();
    }

    /**
     * Search for the item objects from the database according (parameter) keyword and filter
     * @param $search_keyword
     * @param $filter
     * @return array
     */
    public function search($search_keyword) {


            $sqlQuery = 'SELECT * FROM cars_items WHERE car_title LIKE :search OR car_make LIKE :search
              OR car_color LIKE :search OR car_price LIKE :search OR car_engine LIKE :search OR car_milage LIKE :search';


        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare statement
        $statement->bindValue(':search', '%'  . $search_keyword . '%', PDO::PARAM_STR);
        $statement->execute();


        $dataSet = [];

        while ($row = $statement->fetch()) {
            $dataSet[] = new CarsData($row);
        }
        return $dataSet;

    }

    public function getItem($id) {
        $sqlQuery = "SELECT * FROM cars_items WHERE id='$id'";
        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare statement
        $statement->execute();
        $itemObject = new CarsData($statement->fetch());

        return $itemObject;
    }





}
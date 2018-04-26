<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 07/02/2018
 * Time: 22:00
 */

require_once ('Models/Database.php');
require_once ('Models/UsersData.php');

class Users_data_set
{
    protected $_dbHandle, $dbInstance;

    public function __construct()
    {
        $this->dbInstance = Database::getInstance();
        $this->_dbHandle = $this->dbInstance->getdbConnection();
    }

    public function fetchAllData() {
        $sqlQuery = 'SELECT * FROM cars_user';

        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare statement
        $statement->execute();

        $dataSet = [];

        while ($row = $statement->fetch()) {
            $dataSet[] = new UsersData($row);
        }
        return $dataSet;
    }

    /**
     * Returns a UserData object by its userID
     * @param $userID
     * @return array
     */
    public function getUserByID($userID) {
        $sqlQuery = "SELECT * FROM cars_user WHERE user_id='$userID'";

        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare statement
        $statement->execute();

        $dataSet = [];

        while ($row = $statement->fetch()) {
            $dataSet[] = new UsersData($row);
        }
        return $dataSet;
    }

    /**
     * Returns user object by a username(parameter)
     * @param $username
     * @return array
     */
    public function getUserByUsername($username) {
        $sqlQuery ="SELECT * FROM cars_user WHERE user_name='$username'";

        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare statement
        $statement->execute();

        $dataSet = [];

        while ($row = $statement->fetch()) {
            $dataSet[] = new UsersData($row);
        }
        return $dataSet;
    }

    /**
     * Deletes user records from the database by id(parameter)
     * @param $id
     */
    public  function deleteUserById($id) {
        $sqlQuery = "DELETE FROM cars_user WHERE user_id='$id'";

        $statement = $this->_dbHandle->prepare($sqlQuery); //prepare statement
        $statement->execute();
    }
}
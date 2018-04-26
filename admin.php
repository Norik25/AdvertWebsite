<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 07/02/2018
 * Time: 21:51
 */

require_once('Models/Cars_data_set.php');
require_once('Models/Users_data_set.php');
require_once('Models/Picture_set.php');

$view = new stdClass();
$view->pageTitle = 'Admin Page';

$flag = false;
$carsDataSet = new Cars_data_set();
$view->carsDataSet = $carsDataSet->fetchAllData();

$usersDataSet = new Users_data_set();
$view->usersDataSet = $usersDataSet->fetchAllData();

$view->pictureSet = new Picture_set();

if(isset($_POST['archiveAd'])) {
    $itemID = $_GET['id'];
    $item = $carsDataSet->getItem($itemID);

    $sqlQuery = "INSERT INTO cars_users_archive (car_title, car_make, car_engine,car_gearbox, 
                car_milage, car_color, car_desc, car_added, car_price, car_user) 
                  VALUES ('$item->getTitle()', '$item->getMake()', '$item->getEngine()', '$item->getGearbox()', '$item->getMileage()', '$item->getColor()', '$item->getDescription()', 
                  '$item->getAdded', '$item->getPrice', '$item->getUser()');";
    $statement = $dbConnection->prepare($sqlQuery);
    $statement->execute();

    $carsDataSet->deleteById($itemID);
    header("Refresh:0");

}
$userID = '';
if (isset($_POST['deleteUser']))
    $userID = $_GET['id'];
    $usersDataSet->deleteUserById($userID);

require_once('Views/admin.phtml');
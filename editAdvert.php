<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once ('Models/Cars_data_set.php');
require_once ('Models/Database.php');

$view = new stdClass();
$view->pageTitle = 'Edit advert';

$db = Database::getInstance();
$dbConnection = $db->getdbConnection();


$title = "";
$make = "";
$engine = "";
$gearbox = "";
$mileage = "";
$color = "";
$price = "";
$description = "";
$errors = array();

$view->itemID="";

if (isset($_POST['editAd'])) {

    $view->itemID =  $_POST['editAd'];

}



$flag = false;

$carsData = new Cars_data_set();
$itemObject = $carsData->getItem($view->itemID);
$id = $itemObject->getId();

$message= '';

if(isset($_POST['editAdButton'])) {
    $title = $_POST['title'];
    $make = $_POST['make'];
    $engine = $_POST['engine'];
    $gearbox = $_POST['gearbox'];
    $mileage = $_POST['mileage'];
    $color = $_POST['color'];
    $price = $_POST['price'];
    $description = $_POST['desc'];

//    $message = 'post pressed';


    if (empty($title)) {
        array_push($errors, "Title is required");
    }
    if (empty($make)) {
        array_push($errors, "Make is required");
    }
    if (empty($mileage)) {
        array_push($errors, "Mileage is required");
    }
    if (empty($color)) {
        array_push($errors, "Color is required");
    }
    if (empty($price)) {
        array_push($errors, "Price is required");
    }

    if (count($errors) == 0) {

        $message = 'in';
        $sqlQuery = "UPDATE cars_items SET car_title='$title', car_make='$make', car_engine='$engine', 
                    car_gearbox='$gearbox', car_milage='$mileage', car_color='$color', car_desc='$description', 
                    car_price='$price' WHERE id='$id'";


        $statement = $dbConnection->prepare($sqlQuery);
        $statement->execute();






    }
    else {
        $message='some error';
    }
}








require_once('Views/editAdvert.phtml');


<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once ('Models/Cars_data_set.php');
require_once ('Models/Users_data_set.php');
require_once ('Models/Database.php');
require_once ('Models/WishList_data_set.php');
require_once ('Models/Picture_set.php');

$view = new stdClass();
$view->pageTitle = 'Advert';
//

$db = Database::getInstance();
$dbConnection = $db->getdbConnection();

$flag = false;
$message = '';
$itemFromWishList = '';
$view->id = $_GET['id']; //getting the id of clicked ad
if(isset($_SESSION['itemFormWishList'])) {
    $itemFromWishList = $_SESSION['itemFormWishList'];
}



$carsDataSet = new Cars_data_set();
$view->carsDataSet = $carsDataSet->fetchAllData();

$view->car = null;
$view->user = null;

$view->item = "";
$view->userID="";



$wishListDataSet = new WishList_data_set();

$userDataSet = new Users_data_set();



$message5 = "";
$added = ''; // when the advert has been posted
$currentTime = strtotime(date("F j, Y, g:i a"));


$userOfAddedItem=""; //ID of a user who created the advert
//checking if the clicked advert matches with the item in database
foreach ($view->carsDataSet as $carsDataOne) {
    if ($view->id == $carsDataOne->getId()){
        $view->car = $carsDataOne;
        $_SESSION['item'] = $view->car->getId();
        $added = $view->car->getAdded();
        $userOfAddedItem = $view->car->getUser();
        $_SESSION['title'] = $view->car->getTitle();
    }
    if (isset($_SESSION['username'])) {
        if($itemFromWishList == $carsDataOne->getId()) {
            $message5 = $_SESSION['itemFormWishList'];
            $view->car = $carsDataOne;
            $_SESSION['item'] = $view->car->getId();
            $added = $view->car->getAdded();
            $userOfAddedItem = $view->car->getUser();
        }
    }
    $addedSeconds = strtotime($added);
    $elapsedTimeInHours = floor(($currentTime - $addedSeconds) / 60 / 60);


}
$creators = $userDataSet->getUserByID($userOfAddedItem); // user of the created item
$view->creator = null;
foreach ($creators as $creator) {
    $view->creator = $creator;
    $_SESSION['mailTo'] = $creator->getEmail();
}

if (isset($_SESSION[$added])) {
    $added = strtotime($_SESSION['added']);
}



$pictureSet = new Picture_set();
$view->picturesOfItem = $pictureSet->getPicsByItemID($_SESSION['item']);


//adds item to the database
if(isset($_POST['addWish'])) {

    $view->userID = $_SESSION['userID'];
    $view->item= $_SESSION['item'];
    if($wishListDataSet->isInDatabase($view->item, $view->userID)) { //checks if the user has already added the item to the wish list
        $sqlQuery = "INSERT INTO wish_list (customerID, itemID) 
                  VALUES ('$view->userID', '$view->item')";
        $statement = $dbConnection->prepare($sqlQuery);
        $statement->execute();
        $message = 'success';
        //success message
    }
    else {
        $message = 'error';
    }


}



require_once('Views/advert.phtml');
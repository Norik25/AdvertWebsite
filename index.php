<?php

require_once ('Models/Cars_data_set.php');
require_once ('Models/Users_data_set.php');
require_once ('Models/Picture_set.php');
require_once ('Models/Database.php');
require_once ('Models/Pagination.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$view = new stdClass();
$view->pageTitle = 'Homepage';




$carsDataSet = new Cars_data_set();
$view->carsDataSet = $carsDataSet->fetchAllData();
$total = count($view->carsDataSet);

$view->pictureSet = new Picture_set();


$usersDataSet = new Users_data_set();
$view->usersDataSet = $usersDataSet->fetchAllData();

foreach ($view->usersDataSet as $user) {
    if(isset($_SESSION['username'])) {
        if($_SESSION['username'] == $user->getUsername()) {
            $view->user = $user;
            $_SESSION['userID'] = $view->user->getId();
        }
    }

}

$search_keyword = ""; // stores all keywords

// checks if the search input is empty
if (!empty($_POST['s'])) {
    $search_keyword = $_POST['s'];

}

$flag = true; // flag for checking if index.php is being displayed
$searchedCars = $carsDataSet->search($search_keyword);

$limit = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 6; //how many items are being displayed
$page = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
$links = 2;
$pagination = new Pagination();
$view->items = $pagination->getItems($limit, $page);


if (isset($_POST['search'])) {

    require_once('Views/search.phtml');

}
else {
    require_once('Views/index.phtml');
}











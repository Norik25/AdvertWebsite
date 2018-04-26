<?php
require_once ('Models/Database.php');
require_once ('Models/Cars_data_set.php');
require_once ('Models/Picture_set.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$view = new stdClass();
$view->pageTitle = 'Manage my adverts';

$view->user = $_SESSION['userID'];
$flag = false;

$items = new Cars_data_set();

$view->usersItems = $items->getAllItemsByUser($view->user);


$view->pictureSet = new Picture_set();
$message = "";

if (isset($_POST['deleteAd'])) {
    $message = "del";
    $id = $_POST['deleteAd'];
    $items->deleteById($id);
}











require_once('Views/manageAds.phtml');
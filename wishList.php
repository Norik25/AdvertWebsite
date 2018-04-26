<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 10/02/2018
 * Time: 11:58
 */

require_once('Models/Cars_data_set.php');
require_once('Models/WishList_data_set.php');
require_once('Models/Picture_set.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$view = new stdClass();
$view->pageTitle = 'Wish List';

$view->pictureSet = new Picture_set();

$wishListData = new WishList_data_set();
$items = new Cars_data_set();

$view->user = $_SESSION['userID'];

$message = "";
$message2 = "";

$flag = false;


$wishes = $wishListData->getWishItems($view->user);  // gets all the wishes for the user

$view->wishItems = $items->getAllDataFromSet($wishes); // gets all the items for the user

$item=''; //item to be deleted
//deletes the item from the wish list
if(isset($_POST['deleteWish'])) {
    $item = $_POST['deleteWish'];
    $wishListData->deleteById($item);
    header("Refresh:0");

}
if(isset($_POST['view'])) {
    $item = $_POST['view'];
    $_SESSION['itemFormWishList'] = $item;



}



require_once('Views/wishList.phtml');

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once ('Models/Users_data_set.php');
require_once ('Models/Database.php');

$view = new stdClass();
$view->pageTitle = 'Update user';

$db = Database::getInstance();
$dbConnection = $db->getdbConnection();


$email = "";
$name = "";
$phone = "";
$address = "";
$postcode = "";
$city = "";
$errors = array();

$view->userID = $_GET['id'];

$flag = false;

$id='';
$mailForm = '';
$usernameForm = '';
$phoneForm = '';
$addressForm = '';
$postcodeForm = '';
$cityForm = '';

$usersData = new Users_data_set();
$userObject = $usersData->getUserByID($view->userID);
foreach ($userObject as $user){
    $id = $user->getId();
    $mailForm = $user->getEmail();
    $usernameForm = $user->getUsername();
    $phoneForm = $user->getPhone();
    $addressForm = $user->getAddress();
    $postcodeForm = $user->getPostcode();
    $cityForm = $user->getCity();
}


$message= '';

if(isset($_POST['updateUsrButton'])) {
    $email = $_POST['email'];
    $name = $_POST['username'];
    $phone = $_POST['phoneNo'];
    $address = $_POST['address'];
    $postcode = $_POST['postCode'];
    $city = $_POST['city'];


//    $message = 'post pressed';


    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($name)) {
        array_push($errors, "Username is required");
    }
    if (empty($address)) {
        array_push($errors, "Address is required");
    }
    if (empty($postcode)) {
        array_push($errors, "Post code is required");
    }
    if (empty($city)) {
        array_push($errors, "City is required");
    }

    if (count($errors) == 0) {

        $message = 'in';
        $sqlQuery = "UPDATE cars_user SET user_email='$email', user_name='$name', user_phone='$phone', 
                    user_address='$address', user_postcode='$postcode', user_city='$city' WHERE id='$id'";


        $statement = $dbConnection->prepare($sqlQuery);
        $statement->execute();






    }
    else {
        $message='some error';
    }
}








require_once('Views/updateUser.phtml');



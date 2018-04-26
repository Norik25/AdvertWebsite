<?php
require_once ('Models/Users_data_set.php');
$flag = false;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//getting a logged in user's email address
$loggedInUser = $_SESSION['username'];
$usersDataSet = new Users_data_set();
$users = $usersDataSet->getUserByUsername($loggedInUser);
foreach ($users as $user) {
    $loggedInUser = $user->getEmail();
}



$view = new stdClass();
$view->pageTitle = 'MailTo';
$message = "";
//sending the email to the seller
if (isset($_POST['mail'])) {
    $emailFrom = $loggedInUser;
    $emailTo = $_SESSION['mailTo'];
    $subject = $_SESSION['title'] ;
    $comment = $_POST['comment'];
    $comment = wordwrap($comment, 50); // if more than 50 chars wrap it
    $message = $emailFrom . " " . $emailTo . " " . $subject . " " . $comment;
    $message = 'success';

}
else {

    //fill the text area
}



require_once('Views/mail.phtml');
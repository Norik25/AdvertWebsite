<?php
require_once ('Models/Database.php');
require_once ('Models/Users_data_set.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$userDataSet = new Users_data_set();
$users = $userDataSet->fetchAllData();

//sets the captcha if it is not
$captcha = '';
if (isset($_SESSION['captcha'])) {
    $captcha = $_SESSION['captcha'];
}

$successMessages = array();
$username = "";
$email = "";
$errors = array();
$phone = "";
$address = "";
$postCode = "";
$city = "";

//connect to the database
$db = Database::getInstance();
$dbConnection = $db->getdbConnection();
$database = mysqli_connect('helios.csesalford.com', 'lae664', 'Spisska3436/13', 'lae664');



    //if register button is clicked
    if(isset($_POST['registerButton'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password_1 = $_POST['password1'];
        $password_2 = $_POST['password2'];
        $phone = $_POST['phoneNo'];
        $address = $_POST['address'];
        $postCode = $_POST['postCode'];
        $city = $_POST['city'];
        // validates if a correct email format is entered
        if(!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            array_push($errors, "Please enter a valid email address");
        }
        //check if a username or email has already been used
        foreach ($users as $user) {
            if ($username == $user->getUsername()) {
                array_push($errors, "The user name already exists try a different one");
            }
            if ($email == $user->getEmail()) {
                array_push($errors, "This email has already been registered try a different one");
            }
        }

        //forms are filled properly
        if (empty($username)) {
            array_push($errors, "User name is required");
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
        }
        if (empty($password_1)) {
            array_push($errors, "Password is required");
        }
        if ($password_1 != $password_2) {
            array_push($errors, "Passwords do not match");
        }
        if (empty($phone)) {
            array_push($errors, "Phone is required");
        }
        if (empty($address)) {
            array_push($errors, "Address is required");
        }
        if (empty($postCode)) {
            array_push($errors, "Post Code is required");
        }
        if (empty($city)) {
            array_push($errors, "City is required");
        }

        //if no errors, add user to database
        if(count($errors) == 0) {
            $password = md5($password_1); // encrypt password before storing
            $sqlQuery = "INSERT INTO cars_user (user_email, user_name, user_password, user_phone,user_address, 
                user_postcode, user_city) 
                  VALUES ('$email', '$username', '$password', '$phone', '$address', '$postCode', '$city')";
            $statement = $dbConnection->prepare($sqlQuery);
            $statement->execute();
            $_SESSION['username'] = $username;
            $_SESSION['userID'] = "You are now logged in";
            header('location: index.php');
        }
    }

    //log user in from login page
    if(isset($_POST['loginButton'])) {

        $email = mysqli_real_escape_string($database, $_POST['email']);
        $pass = mysqli_real_escape_string($database, $_POST['password']);


        if (empty($email)) {
            array_push($errors, "Email is required");
        }
        if (empty($pass)) {
            array_push($errors, "Password is required");
        }


        if (count($errors) == 0) {

            $password = md5($pass); //encrypt before database check
            $query = "SELECT * FROM cars_user WHERE user_email='$email' AND user_password='$password'";
            $result = mysqli_query($database, $query);
            $rowCnt = mysqli_num_rows($result);
            $rows = array();
            while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                $rows[] = $row;
            }

            if ($rowCnt == 1 && ($_POST['captcha'] == $captcha)){ // checks if we have at least 1 line after query execution

                $usrSess = $rows[0];
                $_SESSION['username'] = $usrSess[2];
                $_SESSION['userid'] = $usrSess[0];
                header('location: index.php');

            } else {
                array_push($errors, "Wrong username/password combination or your captcha has not been submited");




            }


        }

        }

    // logs the user out
    if (isset($_GET['logout'])) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['username']);
        session_destroy();

        header('location: index.php');
    }










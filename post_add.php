<?php
require_once ('Models/Database.php');
require_once ('Models/Cars_data_set.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$flag = false;
$view = new stdClass();
$view->pageTitle = 'Post add';
$errors = array();

$pics = array();

//$carsData = new Cars_data_set();
//$carsDataSet = $carsData->fetchAllData();
//$lastID = array_pop($carsDataSet)->getId();  // gets the vale of the last element from the database
//$nextID = $lastID + 1; // new last id of the list


$title = "";
$make = "";
$engine = "";
$gearbox = "";
$mileage = "";
$color = "";
$price = "";
$description = "";
$added = '';

$message ='';

$user = $_SESSION['userID'];




//connect to the database
$db = Database::getInstance();
$dbConnection = $db->getdbConnection();



//if post your add button is clicked
if(isset($_POST['addAdButton'])) {
    $title = $_POST['title'];
    $make = $_POST['make'];
    $engine = $_POST['engine'];
    $gearbox = $_POST['gearbox'];
    $mileage = $_POST['mileage'];
    $color = $_POST['color'];
    $price = $_POST['price'];
    $description = $_POST['desc'];
    $added = date("F j, Y, g:i a");

    $pics = $_FILES['files'];

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
        $sqlQuery = "INSERT INTO cars_items (car_title, car_make, car_engine,car_gearbox, 
                car_milage, car_color, car_desc, car_added, car_price, car_user) 
                  VALUES ('$title', '$make', '$engine', '$gearbox', '$mileage', '$color', '$description', 
                  '$added', '$price', '$user')";
        $statement = $dbConnection->prepare($sqlQuery);
        echo var_dump($statement);
        if($statement->execute()) {
            $message = 'success';
        }
        else {
            $message = 'item has not been added';
        }



    }


    if (!empty($_FILES['files']['name'][0])) {

        $files = $_FILES['files'];

        $uploaded = array();
        $failed = array();

        $extensions = array('png', 'jpg', 'jpeg', 'gif'); // extensions permitted

        foreach ($files['name'] as $position => $file_name) {

            $file_tmp = $files['tmp_name'][$position];
            $file_size = $files['size'][$position];
            $file_error = $files['error'][$position];
            // gets the file extension
            $file_ext = explode(".", $file_name); // turns the string into an array as file extension
            $file_ext = strtolower(end($file_ext)); // to lower case

            if (in_array($file_ext, $extensions)) { // check if required extension
                if ($file_error == 0) { // check if any errors

                    if ($file_size <= 1000000) { //check if not too big

                        $file_name_new = uniqid("", true) . "." . $file_ext; //generates unique name
                        $file_destination = 'uploads/' . $file_name_new;

                        if (move_uploaded_file($file_tmp, $file_destination)) { // if the f
                            $uploaded[$position] = $file_destination;

                            $carsData = new Cars_data_set();
                            $carsDataSet = $carsData->fetchAllData();
                            $lastID = array_pop($carsDataSet)->getId();

                            $sqlQuery = "INSERT INTO cars_images (image_name, itemID) 
                  VALUES ('$file_name_new', '$lastID')";
                            $statement = $dbConnection->prepare($sqlQuery);
                            $statement->execute();
                        } else {
                            $message = "not moved";
                        }

                    } else {
                        array_push($errors, "The file is too big. Max size 1MB");
                    }

                } else {
                    array_push($errors, "Upload failed. Please try again.");
                }
            } else {
                array_push($errors, "Not supported extension.");

            }


        }
    } else {
        $message = "no images";
    }


}

















require_once('Views/post_add.phtml');
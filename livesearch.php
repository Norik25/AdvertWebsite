<?php

/**
 * Created by PhpStorm.
 * User: oem
 * Date: 26/04/2018
 * Time: 17:54
 */

require_once ('Models/Cars_data_set.php');
require_once ('Models/Users_data_set.php');
require_once ('Models/Database.php');
require_once ('Models/JSONCreator.php');

$db = Database::getInstance();
$dbConnection = $db->getdbConnection();

$carsDataSet = new Cars_data_set();
$view->carsDataSet = $carsDataSet->fetchAllData();
//generating the JSON document from the database
$jsonC = new JSONCreator($view-$carsDataSet);
$jsonC->generate();
//reading the JSON file
$jsonDoc = new DOMDocument();
$jsonDoc->load('data.json');


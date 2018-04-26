<?php

$errorMsg = array();
$successMsg = array();

if(isset($_POST['upload'])) {
    $targetFolder = "Images/";

    foreach ($_FILES as $file => $fileArray) {
        if (!empty($fileArray['name']) && $fileArray['error'] == 0) {
            $getFileExtension = pathinfo($fileArray['name'], PATHINFO_EXTENSION);

            if (($getFileExtension == 'jpg') || ($getFileExtension == 'jpeg') || ($getFileExtension == 'png') || ($getFileExtension == 'gif')) {
                if ($fileArray['size'] <= 1000000) {
                    $breakImgName = explode(".", $fileArray['name']);
                    $imageOldNameWithOutExt = $breakImgName[0];
                    $imageOldExt = $breakImgName[1];
//creating new filename
                    $newFileName = strtotime("now") . "-" . str_replace(" ", "-", strtolower($imageOldNameWithOutExt)) . "." . $imageOldExt;
//where to save it
                    $targetPath = $targetFolder . "/" . $newFileName;

                    if (move_uploaded_file($fileArray['tmp_name'], $targetPath)) {
//sql query here:
                        $successMsg[$file] = "Image is uploaded successfully";
                    } else {
                        $errorMsg[$file] = "Unable to save " . $file . " file ";
                    }

                } else {
                    $errorMsg[$file] = "Image size is too large in " . $file;
                }
            } else {
                $errorMsg[$file] = 'Only image file required in ' . $file . ' position';
            }
        } else {
            $errorMsg[$file] = 'Second if false';
        }
    }
}


require_once('Views/uploader.phtml');
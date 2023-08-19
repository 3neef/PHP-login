<?php

include_once 'dbConfig.php';
session_start();

if (
  isset($_POST["token"]) &&
  isset($_SESSION["token"]) &&
  isset($_SESSION["token-expire"]) &&
  $_SESSION["token"]==$_POST["token"]
) {

  if (time() >= $_SESSION["token-expire"]) {
    exit("Token expired. Please reload form.");
  }
 

  unset($_SESSION["token"]);
  unset($_SESSION["token-expire"]);
}

else { exit("INVALID TOKEN"); }

$target_dir = "uploads/";
$firstName = $_REQUEST['first_name'];
$lastName = $_REQUEST['last_name'];
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}


if (file_exists($target_file)) {
  echo "Sorry, image already exists.";
  $uploadOk = 0;
}


if ($_FILES["fileToUpload"]["size"] > 2000000) {
  echo "Sorry, your image is too large. ";
  $uploadOk = 0;
}


if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  echo "Sorry, your image was not uploaded.";

} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $insert = $db->query("INSERT INTO users (first_name, last_name, user_image_path, created_at) VALUES ('".$firstName."', '".$lastName."', '".$target_file."', NOW())"); 
    echo "welcome home ". $firstName . " " . $lastName;
  } else {
    echo "Sorry, there was an error submitting your file.";
  }
}
?>
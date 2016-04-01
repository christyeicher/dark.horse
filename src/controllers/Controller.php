<?php

namespace dark_horse\hw3\controllers;

// Display any errors
ini_set('display_errors',1);
error_reporting(E_ALL);
$goodToGo = 1;

// Saving the path
$uploaddir = '../resources/';
$uploadfile = $uploaddir . basename($_FILES['photo']['name']);
$imageFileType = pathinfo($uploadfile,PATHINFO_EXTENSION);

// Check if file already exists
if (file_exists($uploadfile)) {
    echo "File already exists!" . "<br/>";
    $goodToGo = 0;
}
// Check file size
if ($_FILES["photo"]["size"] > 500000) {
    echo "Too big!" . "<br/>";
    $goodToGo = 0;
}
// Only allow jpeg, jpg, and png
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Sorry, only JPG, JPEG, & PNG files are allowed." . "<br/>";
    $goodToGo = 0;
}

// If all is good, complete the upload.
if ($goodToGo == 1) {
    if (move_uploaded_file($_FILES['photo']['tmp_name'], "$uploadfile")) {
        echo "File uploaded!" . "<br/>";

        /* ADDING IMAGE INFO TO DATABASE */

        $username = "guest"; // user must have privileges to create DB
        $password = "guest";

        $conn = mysqli_connect("localhost", $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $conn->select_db('DarkHorse');


        $title = $_FILES['photo']['name'];
        $user_id = " ";
        $caption = $_POST['caption'];
        $date = date("Y-m-d H:i:s");

        // Writes the information to the database
        // Inserts current time into the upload_time fieldY
        // Inserts rating as null
        $insert = "INSERT INTO Images VALUES ('$title', '$user_id', '$caption', '$date', null)";

        if (!$conn->query($insert) === TRUE) {
            echo "Error: " . $conn->error . "<br/>";
        }

        $conn->close();
    } else {
        echo "There was an error uploading your file :( Maybe this will help: " . "<br/>";
        print_r($_FILES);
    }
}

else echo "Whoops! There was a problem uploading your image.";


?>
<?php

namespace dark_horse\hw3\models;
use dark_horse\hw3\configs as cfg;
require_once("src/models/Model.php");
require_once("src/configs/Config.php");

class UploadModel extends Model {
    function fetch($data) {

       // Display any errors
       ini_set('display_errors',1);
       error_reporting(E_ALL);

       $goodToGo = 1;

       // Saving the path
       $uploaddir = 'src/resources/userimages/';

       $length = rand(1, 50);
       $randomString = substr(str_shuffle(
           "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"),
           0, $length);
       $uploadfile = $uploaddir . $randomString. basename($_FILES['photo']['name']);
       $imageFileType = pathinfo($uploadfile,PATHINFO_EXTENSION);

       // Check if file already exists
       if (file_exists($uploadfile)) {
           return "File already exists!" . "<br/>";
           $goodToGo = 0;
       }
       // Check file size
       if ($_FILES["photo"]["size"] > 500000) {
           return "Too big!" . "<br/>";
           $goodToGo = 0;
       }
       // Only allow jpeg, jpg
       if($imageFileType != "jpg" && $imageFileType != "jpeg") {
           return "Only JPG & JPEG files are allowed." . "<br/>";
           $goodToGo = 0;
       }

        // Check if the directory exists
        if (!is_dir($uploaddir)) {
            return 'Upload directory does not exist.';
        }
        if (!is_writable($uploaddir)) {
            return "Directory is not writable.";
        }

       // If all is good, complete the upload.
       if ($goodToGo == 1) {
           if (move_uploaded_file($_FILES['photo']['tmp_name'], "$uploadfile")) {

               // ADDING IMAGE INFO TO DATABASE
               $sql = new cfg\Config();
               $sql = $sql->connect();

               if ($sql->connect_errno)
                   return [$sql->connect_error, null, null];

               $title = $_FILES['photo']['name'];
               $user_id = "user";
               $caption = $_POST['caption'];
               $date = date("Y-m-d");

               // Writes the information to the database
               // Inserts current time into the upload_time field
               // Inserts rating as null
               $insert = "INSERT INTO PICTURES(IMG_ID, RATING, USER_ID, CAPTION, POSTED, FILENAME)
                          VALUES (NULL, NULL, '$user_id', '$caption', '$date', '$title')";

               if (!$sql->query($insert) === TRUE) {
                   echo "Error: " . $sql->error . "<br/>";
               }

               $sql->close();

               return "File uploaded!" . "<br/>";
           } else {
               return "There was an error uploading your file :(" . "<br/>";
           }
       }

       else return "Whoops! There was a problem uploading your image.";
    }
}

?>
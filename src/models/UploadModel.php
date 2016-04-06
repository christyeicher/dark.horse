<?php

namespace dark_horse\hw3\models;
use dark_horse\hw3\configs as cfg;
require_once("src/models/Model.php");
require_once("src/configs/Config.php");

class UploadModel extends Model {
    function fetch($data) {

        // THIS IS OLD CODE AND WILL PROBABLY HAVE TO BE READAPTED

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
               $sql = new cfg\Config();
               $sql = $sql->connect();

               if ($sql->connect_errno)
                   return [$sql->connect_error, null, null];


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
               echo "There was an error uploading your file :(" . "<br/>";
           }
       }

       else echo "Whoops! There was a problem uploading your image.";



    }
}

?>
<?php
namespace dark_horse\hw3\models;
use dark_horse\hw3\configs as cfg;
require_once("src/models/Model.php");

class UploadModel extends Model {
    function fetch($data) {
        // Look behind you!
    }

    function submit($data) {
        // Display any errors
        ini_set('display_errors',1);
        error_reporting(E_ALL);

        // Path and filename.
        $uploaddir = 'src/resources/';
        $randomString = "_" . rand() . "_" . rand() . "_" . rand();
        $ext = ".jpg";
        $uploadfile = $uploaddir . $randomString;

        // Check if file already exists
        if (file_exists($uploadfile . $ext)) 
            return "File already exists!";
        
        // Check if the directory exists
        if (!is_dir($uploaddir)) 
            return 'Upload directory does not exist.';
        
        if (!is_writable($uploaddir)) 
            return "Directory is not writable.";
        
        // If all is good, complete the upload.
        if (move_uploaded_file($data[0], $uploadfile . $ext)) {
            // ADDING IMAGE INFO TO DATABASE
            $sql = $this->connect();

            if ($sql->connect_errno)
                return $sql->connect_error;
            
            $stmt = $sql->stmt_init();
            if ($stmt->prepare("INSERT INTO PICTURES
                                VALUES(NULL, NULL, ?, ?, ?, ?)")) {
                $stmt->bind_param("isss",
                                  $data[2],         // user id
                                  $data[1],         // caption
                                  date('Y-m-d'),
                                  $randomString);
                $stmt->execute();
                if (!$stmt->affected_rows) {
                    $stmt->close();
                    $sql->close();
                    return "Error inserting in database.";
                }
                $stmt->close();
            }
            $sql->close();
        }
        return $randomString;
    }
}

?>

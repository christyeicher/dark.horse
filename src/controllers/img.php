<?php
namespace dark_horse\hw3\controllers;
use dark_horse\hw3\configs as cfg;
require_once("../configs/Config.php");

$img_id = $_GET["img"];
if ($img_id) {
    $mysqli = new \mysqli(cfg\Config::host,
                          cfg\Config::username,
                          cfg\Config::password,
                          cfg\Config::db);
    if ($mysqli) {
        $stmt = $mysqli->stmt_init();
        if ($stmt->prepare("SELECT PICTURE_LEN,
                                   PICTURE 
                            FROM PICTURES 
                            WHERE IMG_ID=?;")) {
            $stmt->bind_param("i", $img_id);
            $stmt->execute();
            $stmt->bind_result($length, $image);
            $stmt->fetch();
            header("Content-Type: image/jpeg");
            header("Content-Length: " . $length);
            echo $image;
            $stmt->close();
        }
        $mysqli->close();
    }
}
?>


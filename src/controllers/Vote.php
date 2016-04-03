<?php
namespace dark_horse\hw3\controllers;
use dark_horse\hw3\models as mod;
require_once("src/models/Vote.php");

class Vote {
    function render($data) {
        if (isset($_SESSION["user_id"])) {
            $data["user_id"] = $_SESSION["user_id"];
            mod\Vote::submit($data);
            header("Location: index.php");
        }
        exit();
    }
}
?>

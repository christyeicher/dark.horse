<?php
session_start();
use dark_horse\hw3\controllers as ctrl;
require_once("./src/controllers/FrontPage.php");

if (isset($_SESSION["user_name"]))
    if (isset($_GET["nav"]) and $_GET["nav"] == "vote")
            if (isset($_GET["vote"]) and isset($_GET["img"])) {
                require_once("./src/controllers/Vote.php");
                $data["vote"] = $_GET["vote"];
                $data["img_id"] = $_GET["img"];
                ctrl\Vote::render($data);
            }

ctrl\FrontPage::frontPage();
?>


<?php
namespace dark_horse\hw3\controllers;
use dark_horse\hw3\views as view;
require_once("src/views/UserFront.php");
require_once("src/views/PlainFront.php");
require_once("src/controllers/Most.php");

class FrontPage {
    function frontPage() {
        $data["most_recent"] = Most::recent();
        $data["most_popular"] = Most::popular();
        if (isset($_SESSION["user_id"]) and isset($_SESSION["user_name"])) {
            $data["user_name"] = $_SESSION["user_name"];
            view\UserFrontView::render($data);
        }
        else
            view\PlainFrontView::render($data);
        exit();
    }
}
?>

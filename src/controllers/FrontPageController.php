<?php
namespace dark_horse\hw3\controllers;
use dark_horse\hw3\models as mod;
use dark_horse\hw3\views as view;
require_once("src/controllers/Controller.php");
require_once("src/models/MostRecent.php");
require_once("src/models/MostPopular.php");
require_once("src/views/FrontPageView.php");

class FrontPageController extends Controller {
    function submit($data) {
        $data = [];
        $recent = new mod\MostRecent();
        $data["most_recent"] = $recent->fetch(3);
        $popular = new mod\MostPopular();
        $data["most_popular"] = $popular->fetch(10);

        if (isset($_SESSION["user_id"]) and isset($_SESSION["user_name"])) {
            require_once("src/models/VoteModel.php");
            $votes = new mod\VoteModel();
            $data["votes"] = $votes->fetch($_SESSION["user_id"]);
            $data["user_id"] = $_SESSION["user_id"];
            $data["user_name"] = $_SESSION["user_name"];
        }
        else
            $data["user_id"] = 0;

        $view = new view\FrontPageView();
        $view->render($data);
    }
}
?>

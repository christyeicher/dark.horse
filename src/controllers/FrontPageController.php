<?php
namespace dark_horse\hw3\controllers;
use dark_horse\hw3\models as mod;
use dark_horse\hw3\views as view;
require_once("src/controllers/Controller.php");
require_once("src/models/MostRecent.php");
require_once("src/models/MostPopular.php");
require_once("src/models/UserByNameModel.php");
require_once("src/views/FrontPageView.php");

class FrontPageController extends Controller {
    function submit($data) {
        $data = [];
        $model = new mod\MostRecent();
        $data["most_recent"] = $model->fetch(3);
        $model = new mod\MostPopular();
        $data["most_popular"] = $model->fetch(10);

        $model = new mod\UserByNameModel();
        foreach($data["most_recent"] as $key => $value) 
            $data["most_recent"][$key][2] = $model->fetch($value[2])[0];

        foreach($data["most_popular"] as $key => $value) 
            $data["most_popular"][$key][2] = $model->fetch($value[2])[0];

        if (isset($_SESSION["user_id"]) and isset($_SESSION["user_name"])) {
            require_once("src/models/VoteModel.php");
            $votes = new mod\VoteModel();
            $votes = $votes->fetch($_SESSION["user_id"]);
            if ($votes)
                $data["votes"] = $votes;
            else
                $data["votes"] = [0]; // Give non-empty array to allow voting.
            $data["user_id"] = $_SESSION["user_id"];
            $data["user_name"] = $_SESSION["user_name"];
        }
        else {
            $data["user_id"] = 0;
            $data["votes"] = null;
        }

        $view = new view\FrontPageView();
        $view->render($data);
    }
}
?>

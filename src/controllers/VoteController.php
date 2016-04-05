<?php
namespace dark_horse\hw3\controllers;
use dark_horse\hw3\models as mod;
require_once("src/controllers/Controller.php");
require_once("src/models/VoteModel.php");

class VoteController extends Controller {
    function submit($data) {
        if (isset($_SESSION["user_id"])) {
            $votedata["user_id"] = $_SESSION["user_id"];
            $votedata["img_id"] = $data["img"];
            $votedata["vote"] = $data["vote"];
            $vote = new mod\VoteModel();
            $vote->submit($votedata);

            // Not expecting any data, so just forward.
            header("Location: index.php");
        }
    }
}
?>

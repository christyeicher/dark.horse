<?php
namespace dark_horse\hw3\controllers;
use dark_horse\hw3\models as mod;
require_once("src/models/VoteModel.php");

class VoteController extends Controller {
    function submit($data) {
        if (isset($_SESSION["user_id"])) {
            $data["user_id"] = $_SESSION["user_id"];
            $vote = new mod\VoteModel();
            $vote->submit($data);

            // Not expecting any data, so just forward.
            header("Location: index.php");
        }
    }
}
?>

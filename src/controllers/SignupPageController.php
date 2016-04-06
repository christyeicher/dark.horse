<?php
namespace dark_horse\hw3\controllers;
use dark_horse\hw3\models as mod;
use dark_horse\hw3\views as view;
require_once("src/controllers/Controller.php");
require_once("src/views/SignupPageView.php");
require_once("src/models/SignupModel.php");

class SignupPageController extends Controller {
    function submit($data) {
        $view = new view\SignupPageView();
        $message = null;
        if (!((isset($data["nav"]) and $data["nav"] == "signup"))) {
            if (!isset($data["newuser"]))
                $message = "No username provided.";
            else if (strlen($data["newuser"]) < 6)
                $message = "Username must be at least six characters long.";
            // sanitizing username
            else if ($data["newuser"] != trim($data["newuser"])
                 or  $data["newuser"] 
                     != preg_replace("/[^a-zA-Z0-9]/", "", $data["newuser"]))
                $message = "Username contains invalid characters.";
            else if (!isset($data["newpass1"]) || !isset($data["newpass2"]))
                $message = "Passwords required.";
            else if (strlen($data["newpass1"]) < 8)
                $message = "Password must be at least eight characters long.";
            else if ($data["newpass1"] != $data["newpass2"]) 
                $message = "Passwords mismatch.";
            else if (!isset($data["newname"]) || strlen($data["newname"]) < 1)
                $message = "No name provided.";
            else {
                $model = new mod\SignupModel();
                if ($model->fetch($data))
                    $message = "Registration successful. Please log in.";
                else
                    $message = "Username taken.";
            }
        }
        $view->render($message);
    }
}
?>

<?php
namespace dark_horse\hw3\controllers;
use dark_horse\hw3\models as mod;
use dark_horse\hw3\views as view;
require_once("src/controllers/Controller.php");

class LoginController extends Controller {
    function submit($data) {
        if (isset($data["user"]) and isset($data["pass"])) {
            require_once("src/models/LoginModel.php");
            $login = new mod\LoginModel();
            $credentials = $login->fetch([$data["user"], 
                                          $data["pass"]]);
            if ($credentials[0] == null) {
                session_start();
                $_SESSION["user_id"] = $credentials[1];
                $_SESSION["user_name"] = $credentials[2];
                header("Location: index.php");
            }
            else {
                require_once("src/views/LoginPageView.php");
                $view = new view\LoginPageView();
                $view->render($credentials[0]);
            }
        }
    }
}
?>

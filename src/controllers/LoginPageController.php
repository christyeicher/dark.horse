<?php
namespace dark_horse\hw3\controllers;
use dark_horse\hw3\models as mod;
use dark_horse\hw3\views as view;
require_once("src/controllers/Controller.php");
require_once("src/models/LoginModel.php");
require_once("src/views/LoginPageView.php");

class LoginPageController extends Controller {
    function submit($data) {
        $view = new view\LoginPageView();
        if (isset($data["user"]) and isset($data["pass"])) {
            $login = new mod\LoginModel();
            $credentials = $login->fetch([$data["user"], 
                                          $data["pass"]]);
            // OK. Forward to index.
            if ($credentials[0] == null) {
                $_SESSION["user_id"] = $credentials[1];
                $_SESSION["user_name"] = $credentials[2];
                header("Location: index.php");
            }
            // Invalid credentials. Notify user.
            else {
                $view = new view\LoginPageView();
                $view->render($credentials[0]);
            }
        }
        // No credentials, just plain login page.
        else {
            $view = new view\LoginPageView();
            $view->render(null);
        }
    }
}
?>

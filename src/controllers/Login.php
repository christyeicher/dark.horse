<?php
namespace dark_horse\hw3\controllers;
use dark_horse\hw3\models as mod;
use dark_horse\hw3\views as view;
require_once("../views/LoginPage.php");
require_once("../models/Login.php");

class Login {
    function LoadLoginPage() {
        session_start();
        view\LoginPageView::render(null);
        exit();
    }

    function LogIn($user, $pass) {
        $results = mod\Login::login($user, $pass);
        // If no error...
        if ($results[0] == null) {
            session_start();
            $_SESSION["user_id"] = $results[1];
            $_SESSION["user_name"] = $results[2];
            header("Location: /dark.horse/index.php");
        }
        else
            view\LoginPageView::render($results[0]);
    }
}
?>

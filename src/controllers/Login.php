<?php
namespace dark_horse\hw3\controllers;
use dark_horse\hw3\models as mod;
use dark_horse\hw3\views as view;
require_once("../views/LoginPage.php");
require_once("../models/Login.php");

class Login {
    function LoadLoginPage() {
        view\LoginPageView::render(null);
    }

    function LogIn($user, $pass) {
        $results = mod\Login::login($user, $pass);
        if ($results[0] == null) {
            //echo "index.php as $results[1] with $results[2].";
            setcookie("user",
                      $results[2],
                      time()+3600, // One hour
                      "/dark.horse");
            header("Location: /dark.horse/index.php");
            exit();
        }
        else
            view\LoginPageView::render($results[0]);
    }
}
?>

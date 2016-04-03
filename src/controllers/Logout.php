<?php
namespace dark_horse\hw3\controllers;
use dark_horse\hw3\views as view;
require_once("../views/LogoutPage.php");

class Logout {
    function LoadLogoutPage() {
        session_start();
        session_unset();
        session_destroy();
        view\LogoutPageView::render(null);
        exit();
    }
}
?>

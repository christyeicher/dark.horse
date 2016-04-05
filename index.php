<?php
session_start();
use dark_horse\hw3\controllers as ctrl;
use dark_horse\hw3\views as view;

// Navigational requests.
if (isset($_GET["nav"])) {
    // Request for logged in users.
    if (isset($_SESSION["user_name"])) {
        echo "session";
        if ($_GET["nav"] == "logout") {
            session_destroy();
            header("Location: src/views/Logout.html");
        }

        else if ($_GET["nav"] == "vote") {
            require_once("src/controllers/VoteController.php");
            $data["vote"] = $_GET["vote"];
            $data["img_id"] = $_GET["img"];
            $voter = new ctrl\VoteController();
            $voter->submit($data);
        }

        else if ($_GET["nav"] == "upload") {
            header("Location: src/views/Upload.html");
        }
    }
    
    // Requests for users not logged in.
    else {
        // Login request.
        if ($_GET["nav"] == "login") {
            require_once("src/views/LoginPageView.php");
            $view = new view\LoginPageView();
            $view->render(null);
        }

        // Signup request.
        else if ($_GET["nav"] == "signup") {
            header("Location: src/views/Signup.html");
        }
    }
}

// Login credentials sent.
else if (isset($_GET["user"]) and isset($_GET["pass"])) {
    require_once("src/controllers/LoginController.php");
    $login = new ctrl\LoginController();
    $login->submit($_GET);
}

// No navigation request. Display front page.
else {
    require_once("src/controllers/FrontPage.php");
    $page = new ctrl\FrontPage();
    $page->render(null);
}
?>

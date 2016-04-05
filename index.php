<?php
session_start();
use dark_horse\hw3\controllers as ctrl;

require_once("src/controllers/LogoutPageController.php");
require_once("src/controllers/VoteController.php");
require_once("src/views/LoginPageView.php");
require_once("src/controllers/LoginPageController.php");
require_once("src/controllers/FrontPageController.php");
// Default destination.
$destination = new ctrl\FrontPageController();

// Navigational requests.
if (isset($_GET["nav"])) {
    // Request for logged in users.
    if (isset($_SESSION["user_name"])) {
        // Logout request.
        if ($_GET["nav"] == "logout") 
            $destination = new ctrl\LogoutPageController();
        
        // Vote request.
        else if ($_GET["nav"] == "vote") 
            $destination = new ctrl\VoteController();

        // Upload request.
        else if ($_GET["nav"] == "upload") 
            header("Location: src/views/Upload.html");
    }
    
    // Requests for users not logged in.
    else {
        // Login request.
        if ($_GET["nav"] == "login") 
            $destination = new ctrl\LoginPageController();

        // Signup request.
        else if ($_GET["nav"] == "signup") 
            header("Location: src/views/Signup.html");
    }
}

// Login credentials sent.
else if (isset($_GET["user"]) and isset($_GET["pass"])) 
    $destination = new ctrl\LoginPageController();

// Display page.
$destination->submit($_GET);
?>

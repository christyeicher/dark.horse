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
            // Are we signing up?
            if (!isset($data["newuser"]))
                $message = "No username provided.";

            // Is the username long enough, also sanitize    
            else if (strlen($data["newuser"]) < 6
                 or $data['newuser'] != trim($data['newuser'])
                 or $data['newuser'] != filter_var($data['newuser'],
                                                   FILTER_SANITIZE_ENCODED,
                                                   FILTER_FLAG_STRIP_LOW
                                                  |FILTER_FLAG_STRIP_HIGH))
                $message = "Username is not valid. Length or content.";

            // Validate and sanitize password. Start with easy stuff.
            else if (!isset($data["newpass1"]) || !isset($data["newpass2"]))
                $message = "Passwords required.";
            else if (strlen($data["newpass1"]) < 8)
                $message = "Password must be at least eight characters long.";
            else if ($data["newpass1"] != $data["newpass2"]) 
                $message = "Passwords mismatch.";

            // San/val proper.    
            else if ($data['newpass1'] != trim($data['newpass1'])
                 or  $data['newpass1'] != filter_var($data['newpass1'],
                                                     FILTER_SANITIZE_ENCODED,
                                                     FILTER_FLAG_STRIP_LOW
                                                    |FILTER_FLAG_STRIP_HIGH))
                $message = "Passwords have ugly characters.";

            // Check and San/val name.
            else if (!isset($data["newname"]) || strlen($data["newname"]) < 1
                 or $data['newname'] != trim($data['newname'])
                 or $data['newname'] != filter_var($data['newname'],
                                                   FILTER_SANITIZE_ENCODED,
                                                   FILTER_FLAG_STRIP_LOW
                                                  |FILTER_FLAG_STRIP_HIGH))
                $message = "We don't like the name you provided.";
            else {
                $user = trim($data['user']);
                $pass = trim($data['pass']);
                $user = filter_var($user,
                                    FILTER_SANITIZE_ENCODED,
                                    FILTER_FLAG_STRIP_LOW
                                   |FILTER_FLAG_STRIP_HIGH);
                                                                                                                                
                $pass = filter_var($pass,
                                    FILTER_SANITIZE_ENCODED,
                                    FILTER_FLAG_STRIP_LOW
                                   |FILTER_FLAG_STRIP_HIGH);

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

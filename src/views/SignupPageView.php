<?php
namespace dark_horse\hw3\views;
use dark_horse\hw3\views\elements as el;
require_once("src/views/View.php");
require_once("elements/FrontPageElements.php");

class SignupPageView extends View {
    function render($data) {
        // Did it go through?
        $success = false;
        if (isset($data)) 
            $success = substr($data, 0, 7) == "Registr";

        $elementary = new el\FrontPageElements();
        $elementary->render("top");

        if ($success) {
            echo "\t<h2>$data</h2>\n";
            echo "\t<div class='wrapper-box'>\n";
            echo "\t    <div class='header-links'>
                <a href='index.php?nav=login'>LOG IN</a>\n\t    </div>\n";
        }
        else {
            echo "\t<h2>Please Enter Your Information. All Fields are Required.</h2>\n";
            echo "\t<div class='wrapper-box'>\n";
            if (isset($data))
                $elementary->credError($data);
            $elementary->render("signupForm");
        }
        $elementary->render("bottom");
    }
}
?>

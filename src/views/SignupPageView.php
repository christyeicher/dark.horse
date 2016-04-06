<?php
namespace dark_horse\hw3\views;
use dark_horse\hw3\views\elements as el;
require_once("src/views/View.php");
require_once("elements/FrontPageElements.php");
require_once("elements/LoginPageElements.php");
require_once("elements/SignupPageElements.php");

class SignupPageView extends View {
    function render($data) {
        // Did it go through?
        $success = false;
        if (isset($data)) 
            $success = substr($data, 0, 7) == "Registr";

        $elemFrontPg = new el\FrontPageElements();
        $elemSignupPg = new el\SignupPageElements();

        $elemFrontPg->render("top");
        $elemSignupPg->render("links");
        if ($success) {
            echo "\t<h2>$data</h2>\n";
            echo "\t<div class='images'>\n";
            echo "\t    <div class='header-links'>
                <a href='index.php?nav=login'>LOG IN</a>\n\t    </div>\n";
        }
        else {
            $elemSignupPg->render("prompt");
            if (isset($data)) {
                $elemLoginPg = new el\LoginPageElements();
                $elemLoginPg->credError($data);
            }
            $elemSignupPg->render("form");
        }
        $elemFrontPg->render("bottom");
    }
}
?>
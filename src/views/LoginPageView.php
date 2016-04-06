<?php
namespace dark_horse\hw3\views;
use dark_horse\hw3\views\elements as el;
require_once("src/views/View.php");
require_once("elements/FrontPageElements.php");
require_once("elements/LoginPageElements.php");

class LoginPageView extends View {
    function render($data) {
        $elemFrontPg = new el\FrontPageElements($this);
        $elemLoginPg = new el\LoginPageElements($this);

        $elemFrontPg->render("top");
        $elemLoginPg->render("links");
        $elemLoginPg->render("prompt");

        if ($data) 
            $elemLoginPg->credError($data);        
        
        $elemLoginPg->render("form");
        $elemFrontPg->render("bottom");
    }
}
?>

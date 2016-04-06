<?php
namespace dark_horse\hw3\views;
use dark_horse\hw3\views\elements as el;
require_once("src/views/View.php");
require_once("elements/FrontPageElements.php");

class LoginPageView extends View {
    function render($data) {
        $elementary = new el\FrontPageElements();
        $elementary->render("top");
        $elementary->render("mainpagesignup");
        $elementary->render("prompt");

        if ($data) 
            $elementary->credError($data);        
        
        $elementary->render("form");
        $elementary->render("bottom");
    }
}
?>

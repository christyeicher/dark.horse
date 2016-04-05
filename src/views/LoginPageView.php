<?php
namespace dark_horse\hw3\views;
use dark_horse\hw3\views\elements as el;
require_once("elements/LoginPageElements.php");

class LoginPageView extends View {
    function render($data) {
        $element = new el\LoginPageElements();
        $element->render("top");

        if ($data) 
            echo "
                <div style='color: red;'>
                    $data
                </div><br>";
        
        $element->render("bottom");
    }
}
?>

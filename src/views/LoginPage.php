<?php
namespace dark_horse\hw3\views;
require_once("elements/LoginPageElements.php");

class LoginPageView {
    function render($data) {
        echo elements\LoginPage::top;
        if ($data) 
            echo "<div style='color: red;'>$data</div>";
        echo elements\LoginPage::bottom;
    }
}
?>

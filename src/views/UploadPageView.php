<?php
/**
* class UploadPageView renders the upload page
* uses FrontPageElements as well as UploadPageElements like the form
* @author Christy Eicher
* @author Todor Nikolov
* @author Dennis Simsiman
*/
namespace dark_horse\hw3\views;
use dark_horse\hw3\views\elements as el;
require_once("src/views/View.php");
require_once("elements/FrontPageElements.php");
require_once("elements/UploadPageElements.php");

class UploadPageView extends View
{
    function render($data)
    {
        $elFrontPg = new el\FrontPageElements($this);
        $elUpldPg = new el\UploadPageElements($this);

        $elFrontPg->render("top");
        $elUpldPg->render("links");

        echo "<h2>We hope you are as excited as we are!</h2>\n";
        echo "<div class='forms'>\n";

        if ($data)
            echo "<div style='color: red;'>$data</div><br>\n";

        $elUpldPg->render("form");
        $elFrontPg->render("bottom");
    }
}
?>

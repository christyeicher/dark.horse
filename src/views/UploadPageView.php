<?php
namespace dark_horse\hw3\views;
use dark_horse\hw3\views\elements as el;
require_once("src/views/View.php");
require_once("elements/UploadPageElements.php");

class UploadPageView extends View
{
    function render($data)
    {
        $element = new el\UploadPageElements($this);
        $element->render("top");

        if ($data) {
            echo "
                 <div style='color: white; font-size: larger; font-style: italic;'>
                     $data
                 </div><br>";
        }


        $element->render("bottom");

    }
}
?>

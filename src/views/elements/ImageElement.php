<?php
namespace dark_horse\hw3\views\elements;
require_once("src/views/elements/Element.php");

class ImageElement extends Element {
    function render($data) {
        // data[0] is img_id, data[3] is caption
        echo "\n            <div class='image'>
                <img src='src/resources/userimages/"
                        . $data[0]
                        . ".jpg'
                     alt='" . $data[3] . "'>
            </div>";
    }
}
?>

<?php
namespace dark_horse\hw3\views;

class Picture {
    function render($data) {
        return "
            <div class='image'>
                <img src='src/controllers/img.php?img=".$data["IMG_ID"]."'
                     alt='" . $data["CAPTION"] . "'><br>
                <span class='image-text'>
                    Caption: " . $data["CAPTION"] . "<br>
                    Uploaded by: " . $data["USER_NAME"] . "<br>
                    <span class='rating'>
                       <img class='rating'
                            src='src/resources/0star.png'>
                       <img class='rating'
                            src='src/resources/5star.png'
                            style='clip:rect(0px "
                            . $data["RATING"]
                            . "px 16px 0px);'>
                    </span><br>
                    Date: " . $data["POSTED"] . "<br>
                </span>
            </div>";
    }
}
?>

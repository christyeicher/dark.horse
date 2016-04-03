<?php
namespace dark_horse\hw3\views;

class Picture {
    function render($data) {
        return "
            <div class='image'>
                <img src='src/controllers/img.php?img=" 
                         . $data["IMG_ID"] . "'><br>
                <span class='image-text'>
                    Caption: " . $data["CAPTION"] . "<br>
                    Uploaded by: " . $data["USER_NAME"] . "<br>
                    Rating: " . $data["RATING"] . "<br>
                    Date: " . $data["POSTED"] . "<br>
                </span>
            </div>";
    }
}
?>

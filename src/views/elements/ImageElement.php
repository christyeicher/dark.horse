<?php
namespace dark_horse\hw3\views\elements;
require_once("src/views/elements/Element.php");

class ImageElement extends Element {
    function render($data) {
        // Legend: [0][0] = img_id, 
        //         [0][1] = rating, 
        //         [0][2] = user_id,
        //         [0][3] = caption,
        //         [0][4] = posted
        echo "
            <div class='image'>
                <img src='src/resources/userimages/"
                        . $data[0][0]
                        . ".jpg'
                     alt='" . $data[0][3] . "'><br>
                <span class='image-text'>
                    Caption: " . $data[0][3] . "<br>
                    Uploaded by: " . $data[0][2] . "<br>
                    <span class='rating'>
                       <img class='rating'
                            alt='rating background'
                            src='src/resources/0star.png'>";

        if (isset($data["voted"]) and !$data["voted"])
            echo "<a class='vote1' 
                           href='index.php?nav=vote&vote=1&img="
                                . $data["IMG_ID"] . "'>
                           <img class='vote' alt='Boo!' title='Vote: Boo!' 
                                src='src/resources/nostar.png'></a>
                        <a class='vote2' 
                           href='index.php?nav=vote&vote=2&img="
                                . $data["IMG_ID"] . "'>
                           <img class='vote' alt='Meh!' title='Vote: Meh!' 
                                src='src/resources/nostar.png'></a>
                        <a class='vote3' 
                           href='index.php?nav=vote&vote=3&img="
                                . $data["IMG_ID"] . "'>
                           <img class='vote' alt='Tis alright!' title='Vote: Tis alright!' 
                                src='src/resources/nostar.png'></a>
                        <a class='vote4'
                           href='index.php?nav=vote&vote=4&img="
                                . $data["IMG_ID"] . "'>
                           <img class='vote' alt='Liked it!' title='Vote: Liked it!' 
                                src='src/resources/nostar.png'></a>
                        <a class='vote5'
                           href='index.php?nav=vote&vote=5&img="
                                . $data["IMG_ID"] . "'>
                           <img class='vote' alt='Loved it!' title='Vote: Loved it!'
                                src='src/resources/nostar.png'></a>";

        else
            echo "<img class='rating'
                            src='src/resources/5star.png'
                            alt='Out of five stars.'
                            style='clip:rect(0px "
                            . $data[0][1]*16
                            . "px 16px 0px);'>";

        echo "</span><br>
                    Date: " . $data[0][4] . "<br>
                </span>
            </div>";
    }
}
?>

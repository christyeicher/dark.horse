<?php
namespace dark_horse\hw3\views\elements;
require_once("src/views/elements/Element.php");

class ImageDataElement extends Element {
    function render($data) {
        // Legend: [0] img_id, [1] rating, [2] user_id, [3] caption, [4] posted
        echo "\n            <div class='image'>
               <span class='image-text'>
                    Caption: " . $data[0][3] . "<br>
                    Uploaded by: " . $data[0][2] . "<br>
                    <span class='rating'>
                       <img class='rating'
                            alt='rating background'
                            src='src/resources/0star.png'>
                       <img class='rating'
                            src='src/resources/5star.png'
                            alt='Out of five stars.'
                            style='clip:rect(0px "
                            . $data[0][1]*16
                            . "px 16px 0px);'>";

        if (true or isset($data["voted"]) and !$data["voted"])
            echo "<a href='index.php?nav=vote&vote=1&img="
                          . $data[0][0] . "'>
                     <img class='vote' alt='Boo!' title='Vote: Boo!' 
                          src='src/resources/novote.png'></a>
                  <a href='index.php?nav=vote&vote=2&img="
                          . $data[0][0] . "'>
                     <img class='vote' alt='Meh!' title='Vote: Meh!' 
                          src='src/resources/novote.png'
                          style='clip:rect(0px, 64px, 16px, 0px);'></a>
                  <a href='index.php?nav=vote&vote=3&img="
                          . $data[0][0] . "'>
                     <img class='vote' alt='Tis alright!' title='Vote: Tis alright!' 
                          src='src/resources/novote.png'
                          style='clip:rect(0px, 48px, 16px, 0px);'></a>
                  <a href='index.php?nav=vote&vote=4&img="
                          . $data[0][0] . "'>
                     <img class='vote' alt='Liked it!' title='Vote: Liked it!' 
                          src='src/resources/novote.png'
                          style='clip:rect(0px, 32px, 16px, 0px);'></a>
                  <a href='index.php?nav=vote&vote=5&img="
                          . $data[0][0] . "'>
                     <img class='vote' alt='Loved it!' title='Vote: Loved it!'
                          src='src/resources/novote.png'
                          style='clip:rect(0px, 16px, 16px, 0px);'></a>";

        echo "</span><br>
                    Date: " . $data[0][4] . "<br>
                </span>
            </div>";
    }
}
?>

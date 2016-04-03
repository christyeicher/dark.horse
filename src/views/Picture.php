<?php
namespace dark_horse\hw3\views;

class Picture {
    function render($data) {
        $result = "
            <div class='image'>
                <img src='src/controllers/img.php?img=".$data["IMG_ID"]."'
                     alt='" . $data["CAPTION"] . "'><br>
                <span class='image-text'>
                    Caption: " . $data["CAPTION"] . "<br>
                    Uploaded by: " . $data["USER_NAME"] . "<br>
                    <span class='rating'>
                       <img class='rating'
                            alt='rating background'
                            src='src/resources/0star.png'>";

        if (isset($data["voted"]) and !$data["voted"])
            $result .= "<a class='vote1' 
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
            $result .= "<img class='rating'
                            src='src/resources/5star.png'
                            alt='Out of five stars.'
                            style='clip:rect(0px "
                            . $data["RATING"]
                            . "px 16px 0px);'>";

        $result .= "</span><br>
                    Date: " . $data["POSTED"] . "<br>
                </span>
            </div>";

        return $result;
    }
}
?>

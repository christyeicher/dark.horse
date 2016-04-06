<?php
namespace dark_horse\hw3\views\elements;
require_once("src/views/elements/Element.php");

class ImageDataElement extends Element {
    public $view = null;
    
    function __construct() {
        $view = func_get_args();
    }

    // Legend: [0] img_id, [1] rating, [2] user_id, [3] caption, [4] posted
    function render($data) {?>
                        <span class='image-text'>
                            Caption: <?php echo $data[0][3]?><br>
                            Uploaded by: <?php echo $data[0][2]?><br>
                            <span class='rating'>
                                <img class='rating'
                                     alt='rating background'
                                     src='src/resources/0star.png'>
                                <img class='rating'
                                     src='src/resources/5star.png'
                                     alt='Out of five stars.'
                                     style='clip:rect(0px, <?php
                                     echo ceil($data[0][1]*16)?>px, 16px, 0px);'>
<?php

        // If user hasn't voted, allow voting.
        if (isset($data[1]) and !in_array($data[0][0], $data[1])) {
            $tabs = "\t\t\t\t";
            echo $tabs;
            echo "<a href='index.php?nav=vote&vote=5&img=" . $data[0][0] . "'>
                  \t\t    <img class='vote' 
                  \t\t         alt='Loved it!' 
                  \t\t         title='Vote: Loved it!'
                  \t\t         src='src/resources/novote.png'>
                  \t\t</a>\n";

            echo $tabs;
            echo "<a href='index.php?nav=vote&vote=4&img=" . $data[0][0] . "'>
                  \t\t     <img class='vote' 
                  \t\t          alt='Liked it!' 
                  \t\t          title='Vote: Liked it!' 
                  \t\t          src='src/resources/novote.png'
                  \t\t          style='clip:rect(0px, 64px, 16px, 0px);'>
                  \t\t</a>\n";

            echo $tabs;
            echo "<a href='index.php?nav=vote&vote=3&img=" . $data[0][0] . "'>
                  \t\t     <img class='vote' 
                  \t\t          alt='Tis alright!' 
                  \t\t          title='Vote: Tis alright!' 
                  \t\t          src='src/resources/novote.png'
                  \t\t          style='clip:rect(0px, 48px, 16px, 0px);'>
                  \t\t</a>\n";

            echo $tabs;
            echo "<a href='index.php?nav=vote&vote=2&img=" . $data[0][0] . "'>
                  \t\t     <img class='vote' 
                  \t\t          alt='Meh!' 
                  \t\t          title='Vote: Meh!' 
                  \t\t          src='src/resources/novote.png'
                  \t\t          style='clip:rect(0px, 32px, 16px, 0px);'>
                  \t\t</a>\n";

            echo $tabs;
            echo "<a href='index.php?nav=vote&vote=1&img=" . $data[0][0] . "'>
                 \t\t      <img class='vote' 
                 \t\t           alt='Boo!' 
                 \t\t           title='Vote: Boo!' 
                 \t\t           src='src/resources/novote.png'
                 \t\t           style='clip:rect(0px, 16px, 16px, 0px);'>
                 \t\t</a><br>\n";

            echo "\t\t\t    </span>\n\t\t\t    Rate this image!<br>\n";
        }
        else 
            echo "\t\t\t    </span><br>\n";
?>
                            Date: <?php echo $data[0][4]?><br>
                        </span>
<?php
    }
}
?>

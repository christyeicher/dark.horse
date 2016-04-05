<?php
namespace dark_horse\hw3\views;
use dark_horse\hw3\views\elements as el;
use dark_horse\hw3\views\helpers as hlp;
require_once("src/views/View.php");
require_once("elements/FrontPageElements.php");
require_once("helpers/ImagesHelper.php");

class FrontPageView extends View {
    function render($data) {
        echo el\FrontPageElements::top;
        
        if (isset($data["user_name"])) {
            echo "
            <div id='header-links'>
                Hello, " 
                . $data["user_name"]
                . " ( <a href='index.php?nav=logout'>"
                . " LOG OUT</a> )
                <div>
                    <input type='submit' value='upload image'/>
                </div>
            </div>";
        }
        else 
            echo el\FrontPageElements::loginsignup;
        
        echo el\FrontPageElements::middleRecent;
        $helper = new hlp\ImagesHelper();
        $helper->render([$data["most_recent"],
                         $data["user_id"]]);

        echo el\FrontPageElements::middlePopular;
        $helper->render([$data["most_popular"],
                         $data["user_id"]]);
        
        echo el\FrontPageElements::bottom;
    }
}
?>

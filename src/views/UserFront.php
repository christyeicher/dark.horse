<?php
namespace dark_horse\hw3\views;
require_once("elements/FrontPageElements.php");

class UserFrontView {
    function render($data) {
        echo elements\FrontPage::top;
        echo "
        <div id='header-links'>
            Hello, " 
            . $data["user_name"]
            . " ( <a href='src/controllers/Controller.php?nav=logout'>"
            . " LOG OUT</a> )
            <div>
                <input type='submit' value='upload image'/>
            </div>
        </div>";
        echo elements\FrontPage::middleRecent;
        echo $data["most_recent"];
        echo elements\FrontPage::middlePopular;
        echo $data["most_popular"];
        echo elements\FrontPage::bottom;
    }
}
?>

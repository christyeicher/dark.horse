<?php
namespace dark_horse\hw3\views;
require_once("elements/FrontPageElements.php");

class PlainFrontView {
    function render($data) {
        echo elements\FrontPage::top;
        echo elements\FrontPage::loginsignup;
        echo elements\FrontPage::middleRecent;
        echo $data["most_recent"];
        echo elements\FrontPage::middlePopular;
        echo $data["most_popular"];
        echo elements\FrontPage::bottom;
    }
}
?>

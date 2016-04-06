<?php
namespace dark_horse\hw3\views;
use dark_horse\hw3\views\elements as el;
use dark_horse\hw3\views\helpers as hlp;
require_once("src/views/View.php");
require_once("elements/FrontPageElements.php");
require_once("helpers/ImagesHelper.php");

class FrontPageView extends View {
    function render($data) {
        $elementary = new el\FrontPageElements();
        $helper = new hlp\ImagesHelper();
        
        $elementary->render("top");
        if (isset($data["user_name"])) 
            $elementary->render($data);
        else 
            $elementary->render("loginsignup");
        
        $elementary->render("recent");
        $helper->render([$data["most_recent"],
                         $data["votes"],
                         $data["user_id"]]);

        $elementary->render("popular");
        $helper->render([$data["most_popular"],
                         $data["votes"],
                         $data["user_id"]]);
        
        $elementary->render("bottom");
    }
}
?>

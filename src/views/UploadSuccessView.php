<?php
/**
* class UploadSuccessView shows a page notifying the user
* that thier upload was successful. Elements from FrontPageElements
* @author Christy Eicher
* @author Todor Nikolov
* @author Dennis Simsiman
*/
namespace dark_horse\hw3\views;
use dark_horse\hw3\views\elements as el;
require_once("src/views/View.php");
require_once("elements/FrontPageElements.php");
require_once("elements/UploadPageElements.php");

class UploadSuccessView extends View
{
    function render($data)
    {
        $elFrontPg = new el\FrontPageElements($this);

        $elFrontPg->render("top");?>
        <h2>Image successfully uploaded!</h2>
        <div class='images'>
            <div class='header-links'>
                <a href='index.php'>BACK TO MAIN PAGE</a> |
                <a href='index.php?nav=upload'>UPLOAD ANOTHER IMAGE</a>
            </div>
<?php
        $elFrontPg->render("bottom");
    }
}
?>

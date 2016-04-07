<?php
/**
* class ImageElement renders an image from given path and caption.
* @author Christy Eicher
* @author Todor Nikolov
* @author Dennis Simsiman
*/
namespace dark_horse\hw3\views\elements;
require_once("src/views/elements/Element.php");

class ImageElement extends Element {
    public $view = null;

    function __construct() {
        $view = func_get_args();
    }

    // data[0] is img_id, data[3] is caption
    function render($data) {?>
                        <img class='images'
                             src='src/resources/<?php
                        echo $data[5] ?>.jpg'
                             alt='<?php echo $data[3] ?>'>
<?php
    }
}
?>

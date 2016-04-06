<?php
namespace dark_horse\hw3\views\elements;
require_once("src/views/elements/Element.php");

class ImageElement extends Element {
    // data[0] is img_id, data[3] is caption
    function render($data) {?>
                        <img class='images'
                             src='src/resources/userimages/<?php
                        echo $data[0] ?>.jpg'
                             alt='<?php echo $data[3] ?>'>
<?php
    }
}
?>

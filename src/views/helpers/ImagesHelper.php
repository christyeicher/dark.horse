<?php
/**
* class ImageHelper gets an array of image data, (1) user vote data,
* and user id and iterates over them, sending them to the
* ImageElement (actual image) and ImageDataElement (info) one at time.
* @author Christy Eicher
* @author Todor Nikolov
* @author Dennis Simsiman
*/
namespace dark_horse\hw3\views\helpers;
use dark_horse\hw3\views\elements as el;
require_once("src/views/helpers/Helper.php");
require_once("src/views/elements/ImageElement.php");
require_once("src/views/elements/ImageDataElement.php");

class ImagesHelper extends Helper {
    public $view = null;

    function __contstruct() {
        $view = func_get_args();
    }
    
    function render($data) {
        $cols = 3;
        $rows = floor(count($data[0])/3);
        $image = new el\ImageElement($this);
        $imagedata = new el\ImageDataElement($this);

        // Begining of table
        echo "\t    <table class='images'>\n";
        for ($r = 0; $r < $rows; $r++) {
            // Row
            echo "\t\t<tr>\n";
            for ($c = 0; $c < $cols; $c++) {
                $n = $r * $cols + $c;
                if ($n < count($data[0])) {
                    echo "\t\t    <td class='images'>\n";
                    $image->render($data[0][$n]);
                    echo "\t\t    </td>\n";
                }
            }
            // Row
            echo "\t\t</tr>\n\t\t<tr>\n";
            for ($c = 0; $c < $cols; $c++) {
                $n = $r * $cols + $c;
                if ($n < count($data[0])) {
                    echo "\t\t    <td class='image-data'>\n";
                    $imagedata->render([$data[0][$n],
                                        $data[1],
                                        $data[2]]);
                    echo "\t\t    </td>\n";
                }
            }
            echo "\t\t</tr>\n";
        }
        echo "            </table>\n";
    }
};
?>

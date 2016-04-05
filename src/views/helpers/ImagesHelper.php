<?php
namespace dark_horse\hw3\views\helpers;
use dark_horse\hw3\views\elements as el;
require_once("src/views/helpers/Helper.php");
require_once("src/views/elements/ImageElement.php");

class ImagesHelper extends Helper {
    function render($data) {
        $cols = 3;
        $rows = floor(count($data[0])/3);
        $image = new el\ImageElement();

        // Begining of table
        echo "\n            <table class='images'>";
        for ($r = 0; $r < $rows; $r++) {
            echo "<tr>";
            for ($c = 0; $c < $cols; $c++) {
                $n = $r * $cols + $c;
                if ($n < count($data[0])) {
                    echo "<td class='images'>";
                    $image->render([$data[0][$n],
                                    $data[1]]);
                    echo "</td>";
                }
            }
            echo "</tr>";
        }
        echo "\n            </table>";
    }
};

?>

<?php
namespace dark_horse\hw3\models;
use dark_horse\hw3\configs as cfg;
require_once("src/configs/Config.php");
require_once("src/models/Model.php");

class MostPopular extends Model {
    function fetch($count) {
        $sql = $this->connect();
        $result = [];

        if (!$sql->connect_errno) {
            $stmt = $sql->stmt_init();
            if ($stmt->prepare("SELECT IMG_ID, RATING, USER_ID, CAPTION, POSTED, FILENAME
                                FROM PICTURES
                                ORDER BY RATING DESC,
                                         POSTED DESC
                                LIMIT ?")) {
                $stmt->bind_param("i", $count);
                $stmt->execute();
                $stmt->bind_result($img_id,
                                   $rating,
                                   $user_id,
                                   $caption,
                                   $posted,
                                   $filename);
                $i = 0;
                while ($stmt->fetch()) {
                    $result[$i] = [$img_id,
                                   $rating,
                                   $user_id,
                                   $caption,
                                   $posted,
                                   $filename];
                    $i++;
                }
                $stmt->close();
            }
            $sql->close();
            return $result;
        }
    }
}
?>

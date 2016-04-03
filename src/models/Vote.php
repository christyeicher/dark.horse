<?php
namespace dark_horse\hw3\models;
use dark_horse\hw3\configs as cfg;
require_once("src/configs/Config.php");

class Vote {
    function submit($data) {
        $sql = new \mysqli(cfg\Config::host,
                           cfg\Config::username,
                           cfg\Config::password,
                           cfg\Config::db);

        $stmt = $sql->stmt_init();
        if ($stmt->prepare("SELECT RATING
                            FROM VOTES
                            WHERE USER_ID = ?
                                AND IMG_ID = ?;")) {
            $stmt->bind_param("ii", 
                              $data["user_id"],
                              $data["img_id"]);
            $stmt->execute();
            $stmt->bind_result($rating);
            if ($stmt->fetch()) {
                // Already voted.
                $stmt->close();
                $sql->close();
                exit();
            }
        }

        if ($stmt->prepare("INSERT
                            INTO VOTES
                            VALUES(?, ?, ?);")) {
            $stmt->bind_param("iii",
                              $data["user_id"],
                              $data["img_id"],
                              $data["vote"]);
            $stmt->execute();
        }

        Vote::recalculate_ratings($stmt, $sql);
    }

    private function recalculate_ratings($stmt, $sql) {
        if ($stmt->prepare("SELECT IMG_ID
                            FROM PICTURES;")) {
            $stmt->execute();
            $stmt->bind_result($img_id);

            while ($stmt->fetch())
                $ids[$img_id] = $img_id;
            
            foreach($ids as $img_id) {
                if ($stmt->prepare("SELECT RATING
                                    FROM VOTES
                                    WHERE IMG_ID = ?;"));
                $stmt->bind_param("i", $img_id);
                $stmt->execute();
                $stmt->bind_result($rating);

                $i = 0; $sum = 0;
                while($stmt->fetch()) {
                    $i++;
                    $sum += $rating;
                }
                $new_ratings[$img_id] = $sum/$i;

                if ($stmt->prepare("UPDATE PICTURES
                                    SET RATING = ?
                                    WHERE IMG_ID = ?;")) {
                    foreach($new_ratings as $img_id => $rating) {
                        $stmt->bind_param("di",
                                          $rating,
                                          $img_id);
                        $stmt->execute();
                    }
                }

            }
        }
        $stmt->close();
        $sql->close();
    }
};
?>

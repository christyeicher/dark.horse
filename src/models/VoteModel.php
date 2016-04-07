<?php
/**
* class VoteModel submits a vote to the database.
* If user already has voted on this image, it silently discards it.
* @author Christy Eicher
* @author Todor Nikolov
* @author Dennis Simsiman
*/
namespace dark_horse\hw3\models;
use dark_horse\hw3\configs as cfg;
require_once("src/models/Model.php");
require_once("src/configs/Config.php");

class VoteModel extends Model {
    function fetch($data) {
        $sql = $this->connect();
        $result = [];

        if (!$sql->connect_errno) {
            $stmt = $sql->stmt_init();
            if ($stmt->prepare("SELECT IMG_ID
                                FROM VOTES
                                WHERE USER_ID = ?")) {
                $stmt->bind_param("i", $data);
                $stmt->execute();
                $stmt->bind_result($id);
                $i = 0;
                while ($stmt->fetch()) {
                    $result[$i] = $id;
                    $i++;
                }
                $stmt->close();
            }
            $sql->close();
        }
        return $result;
    }

    // This function does not return data.
    function submit($data) {
        $sql = new cfg\Config();
        $sql = $sql->connect(); 

        // Prepare statement to check if user already voted.
        $stmt = $sql->stmt_init();
        if ($stmt->prepare("SELECT RATING
                            FROM VOTES
                            WHERE USER_ID = ?
                            AND IMG_ID = ?")) {
            $stmt->bind_param("ii", 
                              $data["user_id"],
                              $data["img_id"]);
            $stmt->execute();
            // If user hasn't voted (0 rows)
            if (!$stmt->num_rows) {
                // Prepare insert statement.
                if ($stmt->prepare("INSERT
                                    INTO VOTES
                                    VALUES(?, ?, ?)")) {
                    $stmt->bind_param("iii",
                                      $data["user_id"],
                                      $data["img_id"],
                                      $data["vote"]);
                    $stmt->execute();

                    // Recompute ratings for this image
                    self::recalculate_ratings($stmt, $sql, $data["img_id"]);
                }
            }
            $stmt->close();
        }
        // Close db.
        $sql->close();
    }

    private function recalculate_ratings($stmt, $sql, $img_id) {
        // Prepare select statement to sum all.
        if ($stmt->prepare("SELECT RATING
                            FROM VOTES
                            WHERE IMG_ID = ?")) {
            
            $stmt->bind_param("i", $img_id);
            $stmt->execute();
            $stmt->bind_result($rating);
            
            // Sum.
            $rows = 0;
            $sum = 0;
            while ($stmt->fetch()) {
                $rows++;
                $sum += $rating;
            }
            // Don't divide by zero.
            if ($rows) {
                $new_rating = $sum/$rows;
           
                // Prepare update statement.
                if ($stmt->prepare("UPDATE PICTURES
                                    SET RATING = ?
                                    WHERE IMG_ID = ?")) {
                    $stmt->bind_param("di",
                                      $new_rating,
                                      $img_id);
                    $stmt->execute();
                }
            }
        }
    }
};
?>

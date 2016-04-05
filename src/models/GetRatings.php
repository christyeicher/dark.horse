<?php
namespace dark_horse\hw3\models;
use dark_horse\hw3\configs as cfg;
require_once("src/configs/Config.php");

class GetRatings {
    function byUserId($uid) {
        $sql = new \mysqli(cfg\Config::host,
                           cfg\Config::username,
                           cfg\Config::password,
                           cfg\Config::db);

        if ($sql->connect_error) 
            return null;
        
        $result = [];
        $stmt = $sql->stmt_init();
        if ($stmt->prepare("SELECT IMG_ID, RATING
                            FROM VOTES
                            WHERE USER_ID = ?;")) {
            $stmt->bind_param('i', $uid);
            $stmt->execute();
            $stmt->bind_result($img_id, $rating);
            while($stmt->fetch()) 
                $result[$img_id] = $rating;
        }
        $stmt->close();
        $sql->close();

        return $result;
    }
}
?>

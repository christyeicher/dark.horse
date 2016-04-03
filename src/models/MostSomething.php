<?php
namespace dark_horse\hw3\models;
use dark_horse\hw3\configs as cfg;
require_once("src/configs/Config.php");

class MostSomething {
    function recent() {
        return MostSomething::fetch("IMG_ID");
    }
    
    function popular() {
        return MostSomething::fetch("RATING");
    }
    
    private function fetch($orderBy) {
        $sql = new \mysqli(cfg\Config::host,
                           cfg\Config::username,
                           cfg\Config::password,
                           cfg\Config::db);

        if ($sql->connect_error) 
            return "<div>Database error :( "
                   . $sql->connect_error
                   . "</div>";
        
        $res = $sql->query("SELECT IMG_ID, RATING, USER_ID, CAPTION, POSTED
                            FROM PICTURES
                            ORDER BY " . $orderBy . " DESC
                            LIMIT 3;");
        $i = 0;
        $results = [];
        while($row = $res->fetch_assoc()) {
            // No need to sanitise as we got the results directly from db.
            $name = $sql->query("SELECT NAME
                                 FROM USER
                                 WHERE USER_ID = " . $row["USER_ID"] . ";");

            $results[$i]["USER_NAME"] = $name->fetch_assoc()["NAME"];
            $results[$i]["IMG_ID"] = $row["IMG_ID"];
            $results[$i]["RATING"] = $row["RATING"];
            $results[$i]["CAPTION"] = $row["CAPTION"];
            $results[$i]["POSTED"] = $row["POSTED"];
            $i++;
        }
        return $results;
    }
}
?>

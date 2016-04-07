<?php
namespace dark_horse\hw3\models;
use dark_horse\hw3\configs as cfg;
require_once("src/models/Model.php");
require_once("src/configs/Config.php");

class UserByNameModel extends Model {
    function fetch($data) {
        $result = [];
        $sql = $this->connect();

        if (!$sql->connect_errno) {
            $stmt = $sql->stmt_init();
            if ($stmt->prepare("SELECT NAME
                                FROM USER
                                WHERE USER_ID = ?")) {
            $stmt->bind_param("i", $data);
            $stmt->execute();
            $stmt->bind_result($name);
            
            if ($stmt->fetch()) 
                $result = [$name];
            $stmt->close();
            }
        }
        $sql->close();
        return $result;
    }
}
?>

<?php
namespace dark_horse\hw3\models;
use dark_horse\hw3\configs as cfg;
require_once("src/models/Model.php");
require_once("src/configs/Config.php");

class LoginModel extends Model {
    function fetch($data) {
        $user = $data[0];
        $pass = $data[1];
        $result = ["Could not prepare statement.", null, null];

        $sql = $this->connect();

        if ($sql->connect_errno) 
            return [$sql->connect_error, null, null];

        $stmt = $sql->stmt_init();
        if ($stmt->prepare("SELECT USER_ID, NAME
                            FROM USER
                            WHERE USERNAME = ?
                            AND PASSWORD = ?")) {
            $stmt->bind_param("ss", $user, $pass);
            $stmt->execute();
            $stmt->bind_result($id, $name);
            
            if ($stmt->fetch()) 
                $result = [null, $id, $name];
            else
                $result = ["Invalid credentials.", null, null];
            $stmt->close();
        }
        $sql->close();
        return $result;
    }
}
?>

<?php
namespace dark_horse\hw3\models;
use dark_horse\hw3\configs as cfg;
require_once("src/configs/Config.php");

class LoginModel {
    function login($user, $pass) {
        $sql = new cfg\Config();
        $sql = $sql->connect();

        if ($sql->connect_errno) 
            return [$sql->connect_error, null, null];

        $stmt = $sql->stmt_init();
        if ($stmt->prepare("SELECT USER_ID, NAME
                            FROM USER
                            WHERE USERNAME = ?
                            AND PASSWORD = ?;")) {

            $stmt->bind_param("ss", $user, $pass);
            $stmt->execute();
            $stmt->bind_result($id, $name);
            if ($stmt->fetch()) 
                return [null, $id, $name];
            
            $stmt->close();
            $sql->close();
            return ["Invalid credentials.", null, null];
        }
        $sql->close();
        return ["Could not prepare statement.", null, null];
    }
}
?>

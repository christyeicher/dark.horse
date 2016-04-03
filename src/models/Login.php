<?php
namespace dark_horse\hw3\models;
use dark_horse\hw3\configs as cfg;
require_once("../configs/Config.php");

class Login {
    function login($user, $pass) {
        $mysqli = new \mysqli(cfg\Config::host,
                              cfg\Config::username,
                              cfg\Config::password,
                              cfg\Config::db);

        if ($mysqli->connect_errno) 
            return [$mysqli->connect_error, null, null];

        $stmt = $mysqli->stmt_init();
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
            $mysqli->close();
            return ["Invalid credentials.", null, null];
        }
        $mysqli->close();
        return ["Could not prepare statement.", null, null];
    }
}
?>

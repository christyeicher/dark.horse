<?php
namespace dark_horse\hw3\models;
use dark_horse\hw3\configs as cfg;
require_once("src/models/Model.php");
require_once("src/configs/Config.php");

class SignupModel extends Model {
    function fetch($data) {
        $result = false;
        $sql = $this->connect();

        if (!$sql->connect_errno) {
            // Check if user exists.
            $stmt = $sql->stmt_init();
            if ($stmt->prepare("SELECT USER_ID
                                FROM USER
                                WHERE USERNAME = ?")) {
                $stmt->bind_param("s", $data["newuser"]);
                $stmt->execute();
                $stmt->bind_result($name);
                if (!$stmt->fetch()) {
                    if ($stmt->prepare("INSERT INTO USER
                                        VALUES(NULL, ?, ?, ?)")) {
                        $stmt->bind_param("sss",
                                          $data["newname"],
                                          $data["newuser"],
                                          $data["newpass1"]);
                        $stmt->execute();
                        // Success.
                        if ($stmt->affected_rows)
                            $result = true;
                    }
                }
                $stmt->close();
            }
            $sql->close();
        }
        return $result;
    }
}
?>

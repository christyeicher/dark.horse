<?php
namespace dark_horse\hw3\models;
use dark_horse\hw3\configs as cfg;
require_once("src/configs/Config.php");

abstract class Model {
    abstract function fetch($data);
    
    function connect() {
        $sql = new cfg\Config();
        $sql = $sql->connect();
        return $sql;
    }
};
?>

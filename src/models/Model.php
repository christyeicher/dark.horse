<?php
/**
* base, abstract class Model. It starts the connection with the database.
* @author Christy Eicher
* @author Todor Nikolov
* @author Dennis Simsiman
*/
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

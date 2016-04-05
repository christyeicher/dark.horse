<?php
namespace dark_horse\hw3\configs;

class Config {
    const username = "root";
    const password = "clamp";
    const host = "localhost";
    const db = "HW3";
    
    function connect() {
        return new \mysqli($this::host,
                           $this::username,
                           $this::password,
                           $this::db);
    }
};
?>

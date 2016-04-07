<?php
namespace dark_horse\hw3\configs;

if (!file_exists("./CreateDB.php")) {
        echo "File must be ran from its current folder.\n";
    exit();
}
require_once("./Config.php");

echo "Permissions for src/resources/...";
if (!is_writable("../resources/")) {
    echo "Denied!\n";
    echo "Attempting to chmod o+w src/resources/...";
    if (chmod("../resources", 0777)) {
        if (!is_writable("../resources/"))
            echo "Success?\n";
        else {
            echo "chmod failed.\n";
            exit();
        }
    }
    else {
            echo "Failed.\nFix this and come back.\n";
            exit();
        }
    
}
else
    echo "Granted.\n";

function connect() {
    $sql = new Config();
    $sql = $sql->connect();

    echo "Connecting to MySQL... ";
    if ($sql->connect_errno) {
        echo "Failed to connect to MySQL: " . $sql->connect_error . "\n";
        exit();
    }
    echo "Connected.\n";
    return $sql;
}

function create_db($sql) {
    echo "Creating database HW3...";

    $sql->query("DROP DATABASE
                 IF EXISTS
                 HW3;");

    $sql->query("CREATE DATABASE HW3;");

    if ($sql->query("USE HW3;"))
        echo "Done.\n";
    else {
        echo "Failed to create database HW3.\n";
        $sql->close();
        exit();
    }
}

function create_table_pics($sql) {
    echo "Creating table PICTURES...";

    $sql->query("DROP TABLE
                 IF EXISTS
                 PICTURES;");

    if ($sql->query("CREATE TABLE PICTURES(
                     IMG_ID INT NOT NULL AUTO_INCREMENT, 
                     RATING REAL,
                     USER_ID INT NOT NULL,
                     CAPTION VARCHAR(255),
                     POSTED DATE,
                     FILENAME VARCHAR(100),
                     PRIMARY KEY (IMG_ID));"))
        echo "Done.\n";
    else {
        echo "Could not create table for pictures.\n";
        $sql->close();
        exit();
    }
}

function populate_table_pics($sql) {
    $data = [[],
             [0.5, 1, "One is the bluest number."],
             [1, 2, "Two on fire."],
             [4.5, 3, "Three is deseased."],
             [4.2, 3, "Draw four in under four moves!"],
             [2.5, 2, "Cinema."],
             [3, 4, "Vintage sign. No filter."],
             [3.5, 4, "Rusty 7."],
             [4, 1, "8ball"],
             [4.5, 4, "Vintage sign. No filter."],
             [2.5, 12, "Noble."]];

    echo "Populating table for pictures...";

    $stmt = $sql->stmt_init();
    if ($stmt->prepare("INSERT INTO PICTURES
                        VALUES(?, ?, ?, ?, ?, ?)")) {

        for ($i = 1; $i <= 10; $i++) {
            $stmt->bind_param("idisss",
                              $i,             # id
                              $data[$i][0],   # rating
                              $data[$i][1],   # user_id
                              $data[$i][2],   # caption
                              date("Y-m-d"),  # date
                              $i);            # filename  
            if (!$stmt->execute()) {
                echo "Failed to populate table PICTURES.\n";
                $stmt->close();
                $sql->close();
                exit();
            }
        }
        $stmt->close();
    }
    echo "Done.\n";
}

function create_table_user($sql) {
    echo "Creating table USER...";

    $sql->query("DROP TABLE
                 IF EXISTS
                 USER;");

    if (!$sql->query("CREATE TABLE USER(  
                      USER_ID INT NOT NULL AUTO_INCREMENT,
                      NAME VARCHAR(100),
                      USERNAME VARCHAR(20),
                      PASSWORD VARCHAR(50),
                      PRIMARY KEY(USER_ID));")) {
        echo "Failed to create table USER.\n";
        $sql->close();
        exit();
    }
    echo "Done.\n";
}

function populate_table_user($sql) {
    echo "Populating table with users...";
    $stmt = $sql->stmt_init();

    if ($stmt->prepare("INSERT INTO USER
                        VALUES(?, ?, ?, ?);")) {

        $users = [[1,  "First User",   "fuser", "fpass"],
                  [2,  "Second User",  "suser", "spass"],
                  [3,  "Third User",   "tuser", "tpass"],
                  [4,  "Fourth User",  "4user", "4pass"],
                  [12, "Dozenth User", "duser", "dpass"]];

        foreach($users as $user) {
            $stmt->bind_param("isss",
                              $user[0],   # user_id
                              $user[1],   # actual name
                              $user[2],   # username
                              $user[3]);  # password
            $stmt->execute();
        }
        $stmt->close();
    }
    echo "Done.\n";
}

function create_table_votes($sql) {
    echo "Creating table for votes...";

    $sql->query("DROP TABLE
                 IF EXISTS
                 VOTES");

    if (!$sql->query("CREATE TABLE VOTES(
                      USER_ID INT NOT NULL,
                      IMG_ID INT NOT NULL,
                      RATING INT,
                      PRIMARY KEY(USER_ID, IMG_ID));")) {
        echo "Failed to create table VOTES.\n";
        $sql->close();
        exit();
    }
    echo "Done.\n";
}

function populate_table_votes($sql) {
    echo "Populating table VOTES...";
    $stmt = $sql->stmt_init();

    if ($stmt->prepare("INSERT INTO VOTES
                        VALUES(?, ?, ?);")) {

        $ratings = [[1, 1, 1],
                    [2, 2, 2],
                    [3, 3, 3],
                    [4, 4, 4],
                    [1, 5, 1.5],
                    [2, 6, 2.5],
                    [3, 7, 3.5],
                    [4, 8, 4.5],
                    [1, 9, 2],
                    [2, 10, 3]];

        foreach($ratings as $rating) {
            $stmt->bind_param('iid', 
                              $rating[0], 
                              $rating[1], 
                              $rating[2]);
            $stmt->execute();
        }
        $stmt->close();
    }
    echo "Done.\n";
}

$sql = connect();
create_db($sql);
create_table_pics($sql);
populate_table_pics($sql);
create_table_user($sql);
populate_table_user($sql);
create_table_votes($sql);
populate_table_votes($sql);
$sql->close();
echo "Complete.\n";
?>

<?php
namespace dark_horse\hw3\configs;

if (!file_exists("./CreateDB.php")) {
    echo "File must be ran from current folder.\n";
    exit();
}
require_once("./Config.php");

function connect() {
    $mysqli = mysqli_connect(Config::host, 
                             Config::username, 
                             Config::password);

    echo "Connecting to MySQL.\n";
    if (mysqli_connect_errno($mysqli)) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error() . "\n\n";
        exit();
    }
    echo "Connected.\n\n";
    return $mysqli;
}

function create_db($mysqli) {
    echo "Creating database HW3.\n";

    $mysqli->query("DROP DATABASE
                    IF EXISTS
                    HW3;");

    $mysqli->query("CREATE DATABASE HW3;");

    $res = $mysqli->query("USE HW3;");
    if ($res)
        echo "Done.\n\n";
    else {
        echo "Failed to create database HW3.\n\n";
        $mysqli->close();
        exit();
    }
}

function create_table_pics($mysqli) {
    echo "Creating table PICTURES.\n";

    $mysqli->query("DROP TABLE
                    IF EXISTS
                    PICTURES;");

    $res = $mysqli->query("CREATE TABLE PICTURES(
                           IMG_ID INT NOT NULL AUTO_INCREMENT, 
                           RATING REAL,
                           USER_ID INT NOT NULL,
                           CAPTION VARCHAR(255),
                           POSTED DATE,
                           FILENAME VARCHAR(100),
                           PRIMARY KEY (IMG_ID));");
    if ($res)
        echo "Done.\n\n";
    else {
        echo "Could not create table for pictures.\n\n";
        $mysqli->close();
        exit();
    }
}

function populate_table_pics($mysqli) {
    $captions = [[],
                 [0.5, 1, "One is the bluest number."],
                 [1, 2, "Two on fire."],
                 [4.5, 3, "Three is deseased."],
                 [4.2, 3, "Draw four in under four moves!"],
                 [2.5, 2, "Cinema."],
                 [3, 4, "Vintage sign. No filter."],
                 [3.5, 4, "Rusty 7."],
                 [4, 1, "8ball"],
                 [4.5, 4, "Vintage sign. No filter."],
                 [2.5, 12, "Noble."] ];

    echo "Populating table for pictures.\n";
    $stmt = $mysqli->stmt_init();

    if ($stmt->prepare("INSERT INTO PICTURES
                        VALUES(?, ?, ?, ?, ?, ?);")) {

        for ($i = 1; $i <= 10; $i++) {
            $stmt->bind_param("idisss",
                              $i,                 # id
                              $captions[$i][0],   # rating
                              $captions[$i][1],   # user_id
                              $captions[$i][2],   # caption
                              date("Y-m-d"),      # date
                              $i);                # filename  
            $res = $stmt->execute();
            if (!$res) {
                echo "Failed to populate table PICTURES.\n\n";
                $stmt->close();
                $mysqli->close();
                exit();
            }
        }
        $stmt->close();
    }
    echo "Done.\n\n";
}

function create_table_user($mysqli) {
    echo "Creating table USER.\n";

    $mysqli->query("DROP TABLE
                    IF EXISTS
                    USER;");

    $res = $mysqli->query("CREATE TABLE USER(  
                           USER_ID INT NOT NULL AUTO_INCREMENT,
                           NAME VARCHAR(100),
                           USERNAME VARCHAR(20),
                           PASSWORD VARCHAR(50),
                           PRIMARY KEY(USER_ID));");
    if (!$res) {
        echo "Failed to create table USER.\n\n";
        $mysqli->close();
        exit();
    }
    echo "Done.\n\n";
}

function populate_table_user($mysqli) {
    echo "Populating table with users.\n";
    $stmt = $mysqli->stmt_init();

    if ($stmt->prepare("INSERT INTO USER
                        VALUES(?, ?, ?, ?);")) {

        $users = [[1, "First User", "fuser", "fpass"],
                  [2, "Second User", "suser", "spass"],
                  [3, "Third User", "tuser", "tpass"],
                  [4, "Fourth User", "4user", "4pass"],
                  [12, "Dozenth User", "duser", "dpass"]];

        foreach($users as $user) {
            $stmt->bind_param("isss",
                              $user[0],   # user_id
                              $user[1],   # actual name
                              $user[2],   # username
                              $user[3]);  # password
            $stmt->execute();
        }
    }
    echo "Done.\n\n";
}

function create_table_votes($mysqli) {
    echo "Creating table for votes.\n";

    $mysqli->query("DROP TABLE
                    IF EXISTS
                    VOTES");

    $r = $mysqli->query("CREATE TABLE VOTES(
                         USER_ID INT NOT NULL,
                         IMG_ID INT NOT NULL,
                         RATING INT,
                         PRIMARY KEY(USER_ID, IMG_ID));");
    if (!$r) {
        echo "Failed to create table VOTES.\n";
        $mysqli->close();
        exit();
    }
    echo "Done.\n\n";
}

function populate_table_votes($mysqli) {
    echo "Populating table VOTES.\n";
    $stmt = $mysqli->stmt_init();

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
    }
    $stmt->close();
    echo "Done.\n\n";
}

$mysqli = connect();
create_db($mysqli);
create_table_pics($mysqli);
populate_table_pics($mysqli);
create_table_user($mysqli);
populate_table_user($mysqli);
create_table_votes($mysqli);
populate_table_votes($mysqli);
$mysqli->close();
echo "Complete.\n";
?>

<?php
namespace dark_horse\hw3\views;
require_once("src/views/View.php");

class LogoutPageView extends View {
    function render($data) {?><!doctype html>
<html>
    <head>
        <title>Logout page</title>
        <meta charset='utf-8' />
        <meta http-equiv="refresh" 
              content="3;url=/dark.horse/index.php" />
        <link rel='stylesheet'
              href='src/styles/style.css'
              type='text/css'>
    </head>
    <body>
        <div id='wrapper'>
            <img src='src/resources/logo.png'
                 alt='Dark Horse, Inc.'>
            <h1>You have been logged out.</h1>
            <div class='wrapper-box'>
                <h2>You will be forwarded to the front page.</h2>
            </div>
        </div>
    </body>
</html><?php
    }
};
?>


<?php
namespace dark_horse\hw3\views;

class LogoutPageView {
    function render($data) {
        ?><!doctype html>
        <html>
        <head>
            <title>Logout page</title>
            <meta charset='utf-8' />
            <meta http-equiv="refresh" 
                  content="5;url=/dark.horse/index.php?" />
        </head>
        <body>
            <h1>You have been logged out.</h1>
            <h2>You will be forwarded to the front page
        </body>
        </html><?php
    }
}
?>

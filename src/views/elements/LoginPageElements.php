<?php
namespace dark_horse\hw3\views\elements;

class LoginPageElements extends Element {
    const top = "<!doctype html>
<html>
    <head>
        <title>Log In</title>
        <meta charset='utf-8'>
        <link rel='stylesheet'
              href='src/styles/style.css'
              type='text/css'>
    </head>
    <body>
        <div id='wrapper'>
            <img src='src/resources/logo.png'
                 alt='Dark Horse, Inc.'>
            <div id='header-links'>
                <a href='index.php'>MAIN PAGE</a> |
                <a href='index.php?nav=signup'>SIGN UP</a>
            </div>
            <h2>Please Enter Your Credentials</h2>
            <div class='wrapper-box'>";

    const bottom = "
                <form name='login' 
                      method='get' 
                      action='index.php'>
                    <input type='text' 
                           name='user'
                           placeholder='Username'
                           autofocus><br><br>
                    <input type='password' 
                           name='pass' 
                           placeholder='Password'><br><br>
                    <input type='submit' 
                           value='Login'/>
                </form>
            </div>
        </div>
    </body>
    </html>";

    function render($data) {
        if ($data == "top")
            echo $this::top;
        else if ($data == "bottom")
            echo $this::bottom;
    }   
};
?>

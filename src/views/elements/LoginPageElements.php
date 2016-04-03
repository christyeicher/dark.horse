<?php
namespace dark_horse\hw3\views\elements;

class LoginPage {
    const top = "<!doctype html>
<html>
    <head>
        <title>Log In</title>
        <meta charset='utf-8'>
        <link rel='stylesheet'
              href='../styles/style.css'
              type='text/css'>
    </head>
    <body>
        <div id='wrapper'>
            <img src='../resources/logo.png'
                 alt='Dark Horse, Inc.'>
            <div id='header-links'>
                <a href='../../index.php'>MAIN PAGE</a> |
                <a href='Controller.php?nav=signup'>SIGN UP</a>
            </div>
            <h2>Please Enter Your Credentials</h2>
            <div class='wrapper-box'>";

    const bottom = "
                <form name='login' 
                      method='get' 
                      action='Controller.php'>
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
};
?>

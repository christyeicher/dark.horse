<?php
namespace dark_horse\hw3\views\elements;

class LoginPage {
    const top = 
    "<!doctype html>
        <html>
            <head>
                <title>Log In</title>
                <meta charset='utf-8'>
                <style>
                    body {
                        margin: auto;
                        width: 800px;
                    }
                </style>
            </head>
            <body>
                <h1>Log In</h1>";

    const errorMessage = 
    "<div style='color: red;'>
        Credentials did not match.
    </div>";

    const bottom = 
    "<form name='login' method='get' action='Controller.php'>
        <input type='text' name='user' placeholder='Username'/><br>
        <input type='password' name='pass' placeholder='Password'/><br>
        <input type='submit' value='Login'/>
    </form>
    </body>
    </html>";
};
?>

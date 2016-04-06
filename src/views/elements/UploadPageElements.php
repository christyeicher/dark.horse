<?php
namespace dark_horse\hw3\views\elements;
require_once("src/views/elements/Element.php");

class UploadPageElements extends Element {
    $view = null;

    function __construct($caller) {
        $view = $caller;
    }

    const top = "<!doctype html>
<html>
    <head>
        <title>Upload</title>
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
            <h2>Upload an Image!</h2>
            <div class='wrapper-box'>";

    const bottom = "
                <form name='upload' 
                      method='post' 
                      action=''
                      enctype = multipart/form-data>
                    <input type='file' 
                           name='photo'/><br><br>
                    <input type='text' 
                           name='caption' 
                           maxlength = '255'
                           placeholder='Caption'
                           autofocus/>
                           <br><br>
                    <input type='submit' 
                           value='Upload'/>
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

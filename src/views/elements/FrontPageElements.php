<?php
namespace dark_horse\hw3\views\elements;
require_once("src/views/elements/Element.php");

class FrontPageElements extends Element {
    function render($data) {
        
    }
    
    const top = "<!doctype html>
<html>
<head>
    <title>Image Rater</title>
    <meta charset='utf-8'/>
    <link rel='stylesheet' 
          href='src/styles/style.css'
          type='text/css'/>
</head>
<body>
    <div id='wrapper'>
        <h1 title='Image Rating'>            
        
            <img src='src/resources/logo.png'
                 alt='Dark Horse, Inc.'
                 title='Dark Horse, Inc.' />
         </h1>
             ";

    const loginsignup = "
        <div id='header-links'>
            <a href='index.php?nav=login'>SIGN IN</a> |
            <a href='index.php?nav=signup'>SIGN UP</a>
        </div>";

    const middleRecent = "
        <h2>Recent Images</h2>
        <div id='recent-images' 
             class='wrapper-box'>";

    const middlePopular = "
        </div>
        <h2>Popular Images</h2>
        <div id='popular-images'
             class='wrapper-box'>";

    const bottom = "
        </div>
    </div>
</body>
</html>";
}
?>

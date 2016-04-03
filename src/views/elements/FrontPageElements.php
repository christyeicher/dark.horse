<?php
namespace dark_horse\hw3\views\elements;

class FrontPage {
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
        <img src='src/resources/logo.png'
             alt='Dark Horse, Inc.' >";

    const loginsignup = "
        <div id='header-links'>
            <a href='src/controllers/Controller.php?nav=login'>SIGN IN</a> |
            <a href='src/controllers/Controller.php?nav=signup'>SIGN UP</a>
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
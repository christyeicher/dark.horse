<?php
namespace dark_horse\hw3\views\elements;
require_once("src/views/elements/Element.php");

class FrontPageElements extends Element {
    public $view = null;

    function __construct() {
        $view = func_get_args();
    }
      
    function render($data) {
        if (isset($data)) {
            if ($data == "top")
                self::top();
            else if ($data == "loginsignup")
                self::loginsignup();
            else if (isset($data["user_name"]))
                self::userLinks($data["user_name"]);
            else if ($data == "recent")
                self::recent();
            else if ($data == "popular")
                self::popular();
            else if ($data == "bottom")
                self::bottom();
        }
    }

    private function top() {?><!doctype html>
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
<?php
    }
    
    private function loginsignup() {?>
        <div id='header-links'>
            <a href='index.php?nav=login'>SIGN IN</a> |
            <a href='index.php?nav=signup'>SIGN UP</a>
        </div>
<?php
    }

    private function userLinks($name) {?>
        <div id='header-links'>
            Hello, <?php echo $name ?> ( 
            <a href='index.php?nav=logout'>LOG OUT</a> )</div><br>
                <form action='index.php' name='thisisbad'>
                    <input type='submit' 
                           value='UPLOAD'>
                    <input type='text' 
                           name='nav' 
                           value='upload' 
                           style='visibility: hidden;'>
                </form>
<?php
    }

    private function recent() {?>
        <h2>Recent Images</h2>
        <div class='images'>
<?php
    }

    private function popular() {?>
        </div>
        <h2>Popular Images</h2>
        <div class='images'>
<?php
    }

    private function bottom() {?>
        </div>
    </div>
</body>
</html>
<?php
    }
}
?>

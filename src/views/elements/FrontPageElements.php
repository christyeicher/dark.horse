<?php
namespace dark_horse\hw3\views\elements;
require_once("src/views/elements/Element.php");

class FrontPageElements extends Element {
    function render($data) {
        if (isset($data)) {
            if ($data == "top")
                self::top();
            else if ($data == "loginsignup")
                self::loginsignup();
            else if ($data == "mainpagesignup")
                self::mainpagesignup();
            else if (isset($data["user_name"]))
                self::userLinks($data["user_name"]);
            else if ($data == "prompt")
                self::credPrompt();
            else if ($data == "form")
                self::credForm();
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

    private function mainpagesignup() {?>
        <div id='header-links'>
            <a href='index.php'>MAIN PAGE</a> |
            <a href='index.php?nav=signup'>SIGN UP</a>
        </div>
<?php
    }

    private function userLinks($name) {?>
        <div id='header-links'>
            Hello, <?php $name ?>( 
            <a href='index.php?nav=logout'>LOG OUT</a> |
            <a href='index.php?nav=upload'>UPLOAD</a> )
        </div>
<?php
    }

    private function credPrompt() {?>
        <h2>Please Enter Your Credentials</h2>
        <div class='wrapper-box'>
<?php
    }

    function credError($data) {?>
            <div style='color: red;'>
                <?php echo $data ?>
            </div><br>
<?php
    }
    
    private function credForm() {?>
            <form name='logn'
                  method='get'
                  action='index.php'>
                <input type='text'
                       name='user'
                       placeholder='Username'
                       autofocus>
                <br><br>
                <input type='password'
                       name='pass'
                       placeholder='Password'>
                <br><br>
                <input type='submit'
                       value='Login'>
            </form>
<?php
    }

    private function recent() {?>
        <h2>Recent Images</h2>
        <div id='recent-images' 
             class='wrapper-box'>
<?php
    }

    private function popular() {?>
        </div>
        <h2>Popular Images</h2>
        <div id='popular-images'
             class='wrapper-box'>
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

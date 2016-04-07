<?php
namespace dark_horse\hw3\views\elements;
require_once("src/views/elements/Element.php");

class LoginPageElements extends Element {
    public $view = null;

    function __construct() {
        $view = func_get_args();
    }

    function render($data) {
        if (isset($data)) {
            if ($data == "links")
                self::mainpagesignup();
            else if ($data == "prompt")
                self::credPrompt();
            else if ($data == "form")
                self::credForm();
        }
    }
       
   private function mainpagesignup() {?>
        <div id='header-links'>
            <a href='index.php'>MAIN PAGE</a> |
            <a href='index.php?nav=signup'>SIGN UP</a>
        </div>
<?php
    }

   private function credPrompt() {?>
        <h2>Please Enter Your Credentials</h2>
        <div class='forms'>
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
}
?>

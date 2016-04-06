<?php
namespace dark_horse\hw3\views\elements;
require_once("src/views/elements/Element.php");

class SignupPageElements extends Element {
    function render($data) {
        if (isset($data)) {
            if ($data == "form")
                self::form();
            else if ($data == "prompt")
                self::prompt();
            else if ($data == "links")
                self::links();
        }
    }
       
    private function form() {?>
            <form name='signup'
                  method='get'
                  action='index.php'>
                <input type='text'
                       name='newname'
                       placeholder='Your Full Name'
                       autofocus>
                <br><br>
                <input type='text'
                       name='newuser'
                       placeholder='Desired username'>
                <br><br>
                <input type='password'
                       name='newpass1'
                       placeholder='Enter a password'>
                <br><br>
                <input type='password'
                       name='newpass2'
                       placeholder='Reiterate password'>
                <br><br>
                <input type='submit'
                       value='Sign Up'>
            </form>
<?php
    }

    private function prompt() {?>
        <h2>Please Enter Your Information. All fields are required.</h2>
        <div class='images'>
<?php
    }

    private function links() {?>
        <div id='header-links'>
            <a href='index.php'>MAIN PAGE</a> |
            <a href='index.php?nav=login'>SIGN IN</a>
        </div>
<?php
    }
}
?>

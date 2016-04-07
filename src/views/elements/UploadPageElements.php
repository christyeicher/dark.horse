<?php
namespace dark_horse\hw3\views\elements;
require_once("src/views/elements/Element.php");

class UploadPageElements extends Element {
    public $view = null;

    function __construct() {
        $view = func_get_args();
    }

    function render($data) {
        if ($data == "form")
            self::form();
        else if ($data == "links")
            self::links();
    }

    private function form() {?>
        <form name='upload' 
              method='post' 
              action='index.php?nav=upload'
              enctype = multipart/form-data>
            <input type='file' 
                   name='photo'/>
            <br><br>
            <input type='text' 
                   name='caption' 
                   maxlength = '255'
                   placeholder='Caption'
                   autofocus/>
            <br><br>
            <input type='submit' 
                   value='Upload'/>
            </form>
<?php
    }

    private function links() {?>
            <div id='header-links'>
                <a href='index.php'>MAIN PAGE</a> |
                <a href='index.php?nav=logout'>LOG OUT</a>
            </div>
<?php
    }
};
?>

<?php
/**
* class UploadController sanitizes and validates the uploaded image
* and the accompanying caption, sends them to the database,
* and invokes UploadSuccessView if thing went ok, or returns
* back to UploadPageView with error messages.
* @author Christy Eicher
* @author Todor Nikolov
* @author Dennis Simsiman
*/

namespace dark_horse\hw3\controllers;
use dark_horse\hw3\models as mod;
use dark_horse\hw3\views as view;
require_once("src/controllers/Controller.php");
require_once("src/views/UploadPageView.php");
require_once("src/views/UploadSuccessView.php");
require_once("src/models/UploadModel.php");

class UploadController extends Controller {
    function submit($data){
        // Deadline's coming, implement shortcuts.
        if (isset($data['res']) and $data['res'] == "ok") {
            $view = new view\UploadSuccessView();
            $view->render(null);
            exit();
        }

        $view = new view\UploadPageView();
        $message = null;
        
        // Have we got a photo?
        if (isset($_FILES['photo'])) {
            $pic = $_FILES['photo'];

            // Have we got a caption?
            if (isset($_POST['caption'])
             && strlen($_POST['caption']
             && substr($_POST['caption'], 0, 1) != '&')) {

                // Sanitize string.
                $cap = trim($_POST['caption']);
                $cap = filter_var($cap,
                                  FILTER_SANITIZE_ENCODED,
                                  FILTER_FLAG_STRIP_LOW
                                 |FILTER_FLAG_STRIP_HIGH);

                // Is it ok size?
                if ($pic['size'] < 1000000) {
                    $type = explode('.', $pic['name']);
                    // Is it jpeg?
                    if (end($type) == 'jpg' || end($type) == 'jpeg') {
                        $model = new mod\UploadModel();
                        $message = $model->submit([$pic['tmp_name'],
                                                   $cap,
                                                   $_SESSION['user_id']]);
                        // Mazel tov!
                        if (substr($message, 0, 1) == '_')
                            header("Location: index.php?nav=upload&res=ok");
                    }
                    else
                        $message = "Only jpg/jpeg files are allowed.";
                }
                else
                    $message = "File too big!";
            }
            else
                $message = "You must enter a caption.";
        }

        $view->render($message);
    }
}

?>

<?php

namespace dark_horse\hw3\controllers;
use dark_horse\hw3\models as mod;
use dark_horse\hw3\views as view;
require_once("src/controllers/Controller.php");
require_once("src/views/UploadPageView.php");
require_once("src/models/UploadModel.php");

class UploadController extends Controller {
    function submit($data){

        $upload = new view\UploadPageView();

        if(isset($_FILES['photo'])) {

            $model = new mod\UploadModel();
            $message = $model->fetch($data);

        }
        else $message = "Please select a file for upload.";


        $upload->render($message);
    }
}

?>
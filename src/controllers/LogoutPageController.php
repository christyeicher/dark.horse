<?php
/**
* class LogoutPageController just destroys the current session
* and invokes LogoutPageView, which renders the logout page
* @author Christy Eicher
* @author Todor Nikolov
* @author Dennis Simsiman
*/
namespace dark_horse\hw3\controllers;
use dark_horse\hw3\views as view;
require_once("src/controllers/Controller.php");
require_once("src/views/LogoutPageView.php");

class LogoutPageController extends Controller {
    function submit($data) {
        session_destroy();
        $view = new view\LogoutPageView();
        $view->render(null);
    }
}
?>

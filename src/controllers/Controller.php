<?php
/**
* abstract, base class for Controllers, but it has no control.
* @author Christy Eicher
* @author Todor Nikolov
* @author Dennis Simsiman
*/
namespace dark_horse\hw3\controllers;

abstract class Controller {
    abstract function submit($data);
};
?>

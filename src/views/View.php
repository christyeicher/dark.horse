<?php
/**
* base, abstract class for Views. Not much to view here.
* @author Christy Eicher
* @author Todor Nikolov
* @author Dennis Simsiman
*/
namespace dark_horse\hw3\views;

abstract class View {
    abstract function render($data);
};

?>

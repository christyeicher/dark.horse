<?php
/**
* Base, abstract class for Elements. 
* @author Christy Eicher
* @author Todor Nikolov
* @author Dennis Simsiman
*/
namespace dark_horse\hw3\views\elements;

abstract class Element {
    abstract function render($data);
};
?>

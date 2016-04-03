<?php
namespace dark_horse\hw3\controllers;
use dark_horse\hw3\models as mods;
use dark_horse\hw3\views as views;
require_once("src/models/MostSomething.php");
require_once("src/views/Picture.php");

class Most {
    function popular() {
        $pictures = mods\MostSomething::popular();
        for ($i = 0; isset($pictures[$i]); $i++)
            $pictures[$i]["RATING"] *= 15.8;
        return Most::render($pictures);
    }

    function recent() {
        $pictures = mods\MostSomething::recent();
        for ($i = 0; isset($pictures[$i]); $i++)
            $pictures[$i]["RATING"] *= 15.8;
        return Most::render($pictures);
    }

    private function render($pictures) {
        $result = "";
        foreach ($pictures as $picture) 
            $result .= views\Picture::render($picture);
        return $result;
    }
}
?>

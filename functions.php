<?php

function utf8_converter($array){
    array_walk_recursive($array, function(&$item, $key){
        $item = utf8_decode($item);
    }); 
    return $array;
}

function recursiveAddSlashes($array){
    array_walk_recursive($array, function(&$item, $key){
        $item = addslashes($item);
    }); 
    return $array;
}

?>
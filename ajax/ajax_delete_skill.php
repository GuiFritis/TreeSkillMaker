<?php

include_once("../functions.php");
include_once("../connect_db.php");

$_REQUEST = utf8_converter($_REQUEST);

foreach($_REQUEST as $key => $value){
    $$key = $value;
}

$sql = "DELETE FROM skill
        WHERE id = '{$id}'";

db_query($sql);

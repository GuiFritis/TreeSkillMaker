<?php

include_once("../functions.php");
include_once("../connect_db.php");

$array_request = utf8_converter($_REQUEST);

$array_request = recursiveAddSlashes($array_request);

foreach ($array_request as $key => $value) {
    $$key = $value;
}

$sql = "DELETE FROM skill
        WHERE id = '{$id}'";

db_query($sql);

<?php

date_default_timezone_set("America/Sao_Paulo");

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'treeskill';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}

function db_query($sql){
    GLOBAL $mysqli;

    return $mysqli->query($sql);
}

function db_selectMany($sql){
    $rs = db_query($sql);
    $array = array();
    $rs->data_seek(0);
    while ($row = $rs->fetch_assoc()) {
        $array[] = $row;
    }
    return $array;
}

function db_selectOne($sql){
    $rs = db_query($sql);
    $rs->data_seek(0);
    if($row = $rs->fetch_assoc()) {
        return $row;
    }
    return array();
}
?>
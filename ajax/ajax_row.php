<?php

include_once("../functions.php");
include_once("../connect_db.php");

$_REQUEST = utf8_converter($_REQUEST);

foreach($_REQUEST as $key => $value){
    $$key = $value;
}

if($action = "insert"){
    $sql = "INSERT INTO skilltree_row
                (nivel,
                requirements,
                id_skilltree)
            VALUES
                ('{$nivel}',
                '{$requirements}',
                '{$id_skilltree}')";

    db_query($sql);

    $sql = "SELECT id 
            FROM skilltree_row
            ORDER BY id DESC
            LIMIT 1";

    $id = db_selectOne($sql)['id'];

    echo $id;

} else if($action = "remove" && !empty($id)){
    $sql = "DELETE FROM skilltree_row
            WHERE id = '{$id}'";

    db_query($sql);
}

<?php

include_once("../functions.php");
include_once("../connect_db.php");

$array_request = utf8_converter($_REQUEST);

$array_request = recursiveAddSlashes($array_request);

foreach ($array_request as $key => $value) {
    $$key = $value;
}

if($action == "insert"){
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

} else if($action == "remove" && !empty($id)){
    $sql = "DELETE FROM skilltree_row
            WHERE id = '{$id}'
                AND id_skilltree = '{$id_skilltree}'";

    db_query($sql);
}

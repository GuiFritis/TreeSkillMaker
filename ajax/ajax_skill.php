<?php

include_once("../functions.php");
include_once("../connect_db.php");

$array_request = utf8_converter($_REQUEST);

$array_request = recursiveAddSlashes($array_request);

foreach ($array_request as $key => $value) {
    $$key = $value;
}


foreach($skills as $value){
    if(empty($value['nome'])){
        continue;
    }
    if(empty($value['id'])){
        $sql = "INSERT INTO skill
                    (nome, 
                    descricao, 
                    ordem, 
                    forma, 
                    id_row, 
                    id_skilltree)
                VALUES
                    ('{$value['nome']}', 
                    '{$value['descricao']}', 
                    '{$value['ordem']}', 
                    '{$value['forma']}', 
                    '{$value['row']}', 
                    '{$value['skilltree']}')";

        db_query($sql);
    } else {
        $sql = "UPDATE skill SET
                    nome = '{$value['nome']}', 
                    descricao = '{$value['descricao']}',
                    ordem = '{$value['ordem']}', 
                    forma = '{$value['forma']}', 
                    id_row = '{$value['row']}', 
                    id_skilltree = '{$value['skilltree']}'
                WHERE
                    id = '{$value['id']}'";

        echo $sql;

        db_query($sql);
    }
}


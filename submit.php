
<h2>Processando...</h2>

<?php
    switch($action){
        case "jogo":
            if(empty($id)){
                $sql = "INSERT INTO jogo
                            (nome, descricao)
                        VALUES
                            ('{$nome}', '{$descricao}')";

                db_query($sql);
            } else {
                $sql = "UPDATE jogo SET
                            nome = '{$nome}',
                            descricao = '{$descricao}'
                        WHERE
                            id = '{$id}'";

                db_query($sql);
            }
            break;
        case "classe":
            $cor = substr($cor, 1);
            $texto = !empty($texto)?"1":"0";
            if(empty($id)){
                $sql = "INSERT INTO classe
                            (nome, cor, texto, descricao, id_jogo)
                        VALUES
                            ('{$nome}', '{$cor}', '{$texto}', '{$descricao}', '{$id_jogo}')";

                db_query($sql);
            } else {
                $sql = "UPDATE classe SET
                            nome = '{$nome}', 
                            cor = '{$cor}', 
                            texto = '{$texto}', 
                            descricao = '{$descricao}'
                        WHERE
                            id = '{$id}'";

                db_query($sql);
            }
            break;
        case "skilltree":
            if(empty($id)){
                $sql = "INSERT INTO skilltree
                            (nome, colunas, descricao, id_classe)
                        VALUES
                            ('{$nome}', '{$colunas}', '{$descricao}', '{$id_classe}')";

                db_query($sql);

                $sql = "SELECT id FROM skilltree ORDER BY id DESC LIMIT 1";
                $id = db_selectOne($sql)['id'];

                $sql = "INSERT INTO skilltree_row
                            (nivel, id_skilltree)
                        VALUES 
                            ('1', '{$id}')";

                db_query($sql);

            } else {
                $sql = "UPDATE skilltree SET
                            nome = '{$nome}', 
                            colunas = '{$colunas}',  
                            descricao = '{$descricao}'
                        WHERE
                            id = '{$id}'";

                db_query($sql);
            }
            break;
    }
?>
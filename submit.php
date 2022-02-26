
<h2>Processando...</h2>

<?php
$redirect = "jogos";
switch($action){
    case "jogo":
        if(empty($id)){
            $sql = "INSERT INTO jogo
                        (nome, descricao)
                    VALUES
                        ('{$nome}', '{$descricao}')";

            db_query($sql);
            $redirect = "jogos";
        } else {
            $sql = "UPDATE jogo SET
                        nome = '{$nome}',
                        descricao = '{$descricao}'
                    WHERE
                        id = '{$id}'";

            db_query($sql);
            $redirect = "jogos";
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
            $redirect = "classes&jogo=".$id_jogo;
        } else {
            $sql = "UPDATE classe SET
                        nome = '{$nome}', 
                        cor = '{$cor}', 
                        texto = '{$texto}', 
                        descricao = '{$descricao}'
                    WHERE
                        id = '{$id}'";

            db_query($sql);
            $redirect = "classes&jogo=".$id_jogo;
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
            $redirect = "skilltrees&classe=".$id_classe;

        } else {
            $sql = "UPDATE skilltree SET
                        nome = '{$nome}', 
                        colunas = '{$colunas}',  
                        descricao = '{$descricao}'
                    WHERE
                        id = '{$id}'";

            db_query($sql);

            foreach($row_id as $key => $value){
                $sql = "UPDATE skilltree_row SET
                            requirements = '{$row_requirements[$key]}'
                        WHERE
                            id = '{$value}'";

                db_query($sql);

            }

            $redirect = "skilltrees&classe=".$id_classe;
        }
        break;
}
?>
<script>
    document.location="index.php?page=<?=$redirect?>";
</script>
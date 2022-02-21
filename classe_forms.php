<?php
if(!empty($id)){
    $sql = "SELECT * FROM classe WHERE id = '{$id}'";
    $classe = db_selectOne($sql);
} else {
    $classe = array();
}
?>

<h2 class="text-center">Classe</h2>
<form action="index.php" method="POST">
    <input type="hidden" name="page" value="submit">
    <input type="hidden" name="action" value="classe">
    <input type="hidden" name="id" value="<?=!empty($id)?$id:NULL?>">
    <input type="hidden" name="id_jogo" value="<?=$jogo?>">
    <div class="row">
        <div class="col-12 form-group">
            <label for="" class="control-label">Nome</label>
            <input type="text" class="form-control" name="nome"/>
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label for="" class="control-label">Cor</label>
            <input type="color" class="form-control" name="cor"/>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="texto" value="1">
                <label class="form-check-label">Texto branco</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label for="" class="control-label">Descrição</label>
            <textarea name="descricao" rows="10" class="form-control"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <button type="submit" class="btn btn-primary">
                Enviar
            </button>
        </div>
    </div>
</form>
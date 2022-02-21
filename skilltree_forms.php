<?php
if(!empty($id)){
    $sql = "SELECT * FROM skilltree WHERE id = '{$id}'";
    $skilltree = db_selectOne($sql);
} else {
    $skilltree = array();
}
?>

<h2 class="text-center">Skill Tree</h2>
<form action="index.php" method="POST">
    <input type="hidden" name="page" value="submit">
    <input type="hidden" name="action" value="skilltree">
    <input type="hidden" name="id" value="<?=!empty($id)?$id:NULL?>">
    <input type="hidden" name="id_classe" value="<?=$classe?>">
    <div class="row">
        <div class="col-12 form-group">
            <label for="" class="control-label">Nome</label>
            <input type="text" class="form-control" name="nome"/>
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label for="" class="control-label">Colunas</label>
            <input type="number" class="form-control" name="colunas" min="3" max="10"/>
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
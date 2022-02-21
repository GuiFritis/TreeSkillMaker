<?php
if(!empty($id)){
    $sql = "SELECT * FROM jogo WHERE id = '{$id}'";
    $jogo = db_selectOne($sql);
} else {
    $jogo = array();
}
?>

<h2 class="text-center">Jogo</h2>
<form action="index.php" method="POST">
    <input type="hidden" name="page" value="submit">
    <input type="hidden" name="action" value="jogo">
    <input type="hidden" name="id" value="<?=!empty($id)?$id:NULL?>">
    <div class="row">
        <div class="col-12 form-group">
            <label for="" class="control-label">Nome</label>
            <input type="text" class="form-control" name="nome"/>
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
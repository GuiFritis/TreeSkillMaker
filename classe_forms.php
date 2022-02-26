<?php
if(!empty($id)){
    $sql = "SELECT * FROM classe WHERE id = '{$id}'";
    $classe = db_selectOne($sql);
} else {
    $classe = array();
}
?>
<a href="index.php?page=classes&jogo=<?=$jogo?>" class="btn btn-primary"><span class="bi bi-reply"></span> Voltar</a>

<div class="titulo-page">
    <h2 class="text-center titulo-classes">Classe</h2>
</div>

<form action="index.php" method="POST">
    <input type="hidden" name="page" value="submit">
    <input type="hidden" name="action" value="classe">
    <input type="hidden" name="id" value="<?=!empty($id)?$id:NULL?>">
    <input type="hidden" name="id_jogo" value="<?=$jogo?>">
    <div class="row">
        <div class="col-12 form-group">
            <label for="" class="control-label">Nome</label>
            <input type="text" class="form-control" name="nome" value="<?=!empty($classe['nome'])?$classe['nome']:NULL?>"/>
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label for="" class="control-label">Cor</label>
            <input type="color" class="form-control" name="cor" value="#<?=!empty($classe['cor'])?$classe['cor']:"FFFFFF"?>"/>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="texto" value="1" <?=isset($classe['texto']) && $classe['texto']==1?'checked':NULL?>>
                <label class="form-check-label">Texto branco</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label for="" class="control-label">Descrição</label>
            <textarea name="descricao" rows="10" class="form-control"><?=!empty($classe['descricao'])?$classe['descricao']:NULL?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <button type="submit" class="btn btn-primary">
                <span class="bi bi-send-fill"></span> Enviar
            </button>
        </div>
    </div>
</form>
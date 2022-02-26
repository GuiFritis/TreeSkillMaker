<?php
if(!empty($id)){
    $sql = "SELECT * FROM jogo WHERE id = '{$id}'";
    $jogo = db_selectOne($sql);
} else {
    $jogo = array();
}
?>
<a href="index.php?page=jogos" class="btn btn-primary"><span class="bi bi-reply"></span> Voltar</a>

<div class="titulo-page">
    <h2 class="text-center titulo-jogos">Jogo</h2>
</div>
<form action="index.php" method="POST">
    <input type="hidden" name="page" value="submit">
    <input type="hidden" name="action" value="jogo">
    <input type="hidden" name="id" value="<?=!empty($id)?$id:NULL?>">
    <div class="row">
        <div class="col-12 form-group">
            <label for="" class="control-label">Nome</label>
            <input type="text" class="form-control" name="nome" value="<?=!empty($jogo['nome'])?$jogo['nome']:NULL?>"/>
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label for="" class="control-label">Descrição</label>
            <textarea name="descricao" rows="10" class="form-control"><?=!empty($jogo['descricao'])?$jogo['descricao']:NULL?></textarea>
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
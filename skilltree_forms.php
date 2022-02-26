<?php
if(!empty($id)){
    $sql = "SELECT * FROM skilltree WHERE id = '{$id}'";
    $skilltree = db_selectOne($sql);
} else {
    $skilltree = array();
}
?>
<a href="index.php?page=skilltrees&classe=<?=$classe?>" class="btn btn-primary"><span class="bi bi-reply"></span> Voltar</a>

<div class="titulo-page">
    <h2 class="text-center titulo-skilltrees">Skill Tree</h2>
</div>
    
<form action="index.php" method="POST">
    <input type="hidden" name="page" value="submit">
    <input type="hidden" name="action" value="skilltree">
    <input type="hidden" name="id" value="<?=!empty($id)?$id:NULL?>">
    <input type="hidden" name="id_classe" value="<?=$classe?>">
    <div class="row">
        <div class="col-12 form-group">
            <label for="" class="control-label">Nome</label>
            <input type="text" class="form-control" name="nome" value="<?=!empty($skilltree['nome'])?$skilltree['nome']:NULL?>"/>
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label for="" class="control-label">Colunas</label>
            <input type="number" class="form-control" name="colunas" min="1" max="10" value="<?=!empty($skilltree['colunas'])?$skilltree['colunas']:1?>" />
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label for="" class="control-label">Descrição</label>
            <textarea name="descricao" rows="10" class="form-control"><?=!empty($skilltree['descricao'])?$skilltree['descricao']:NULL?></textarea>
        </div>
    </div>
    <?php 
    if(!empty($id)){
        $sql = "SELECT * 
                FROM skilltree_row
                WHERE id_skilltree = '{$id}'";
        $rows = db_selectMany($sql);

        foreach ($rows as $key => $row) {?>
            <div class="row">
                <div class="col-12 form-group">
                    <label  class="control-label">Row nível <?=$row['nivel']?></label>
                    <input type="hidden" name="row_id[]" value="<?=$row['id']?>">
                    <textarea name="row_requirements[]" class="form-control"><?=$row['requirements']?></textarea>
                </div>
            </div>
        <?php }
    }
    ?>
    <div class="row">
        <div class="col-12 form-group">
            <button type="submit" class="btn btn-primary">
                <span class="bi bi-send-fill"></span> Enviar
            </button>
        </div>
    </div>
</form>
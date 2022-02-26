<?php
    $sql = "SELECT * FROM jogo WHERE id = '{$jogo}'";
    $array_jogo = db_selectOne($sql);
?>
<a href="index.php?page=classe_forms&jogo=<?=$jogo?>" class="btn btn-primary"><span class="bi bi-plus-square"></span> Adicionar classe</a>
<div class="titulo-page">
    <h1 class="text-center titulo-classes"><?=$array_jogo['nome']?> Classes <span class="bi bi-boxes"></span></h1>
</div>
<hr class="mb-4"/>
<?php
$sql = "SELECT * FROM classe WHERE id_jogo = '{$jogo}' ORDER BY nome ASC";
$classes = db_selectMany($sql);
if(count($classes) > 0){?>
    <div class="grid-classes">
    <?php foreach($classes as $value){?>
        <div class="card card-classe <?=$value['texto']==1?"texto-branco":NULL?>" data-search="<?=strtoupper($value['nome'])?>" data-id="<?=$value['id']?>" style="border-color: #<?=$value['cor']?>">
            <div class="card-header" style="background-color: #<?=$value['cor']?>">
                <span><?=$value['nome']?></span>
                <a href="index.php?page=classe_forms&id=<?=$value['id']?>" class="float-right"><span class="bi bi-pencil-square"></span></a>
            </div>
            <div class="card-body"><?=$value['descricao']?></div>
        </div>
    <?php }?>
    </div>
<?php } else {?>
    <div class="card p-3">
        Não existe classes cadastradas.
    </div>
<?php }
?>
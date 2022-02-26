<a href="index.php?page=jogo_forms" class="btn btn-primary"><span class="bi bi-plus-square"></span> Adicionar jogo</a>
<div class="titulo-page">
    <h1 class="text-center titulo-jogos">Jogos <span class="bi bi-joystick"></span></h1>
</div>
<hr class="mb-4"/>
<?php
$sql = "SELECT * FROM jogo ORDER BY nome ASC";
$jogos = db_selectMany($sql);
if(count($jogos) > 0){?>
    <div class="grid-jogos">
    <?php foreach($jogos as $value){?>
        <div class="card card-jogo" data-search="<?=strtoupper($value['nome'])?>" data-id="<?=$value['id']?>">
            <div class="card-header">
                <span><?=$value['nome']?></span>
                <a href="index.php?page=jogo_forms&id=<?=$value['id']?>" class="float-right"><span class="bi bi-pencil-square"></span></a>
            </div>
            <div class="card-body"><?=$value['descricao']?></div>
        </div>
    <?php }?>
    </div>
<?php } else {?>
    <div class="card p-3">
        Não existe jogos cadastrados.
    </div>
<?php }
?>
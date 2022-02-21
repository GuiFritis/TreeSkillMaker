<a href="index.php?page=jogo_forms" class="btn btn-primary">Adicionar jogo</a>
<h1 class="text-center">Jogos</h1>
<hr class="mb-4"/>
<?php
$sql = "SELECT * FROM jogo ORDER BY nome ASC";
$jogos = db_selectMany($sql);
if(count($jogos) > 0){?>
    <div class="grid-jogos">
    <?php foreach($jogos as $value){?>
        <div class="card card-jogo" data-search="<?=strtoupper($value['nome'])?>" data-id="<?=$value['id']?>">
            <div class="card-header"><?=$value['nome']?></div>
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
<?php
$sql = "SELECT * 
        FROM classe 
        WHERE id = '{$classe}'";
$array_classe = db_selectOne($sql);
?>
<a href="index.php?page=classes&jogo=<?=$array_classe['id_jogo']?>" class="btn btn-primary"><span class="bi bi-reply"></span> Voltar</a>
<a href="index.php?page=skilltree_forms&classe=<?=$classe?>" class="btn btn-primary"><span class="bi bi-plus-square"></span> Adicionar skilltree</a>

<div class="titulo-page">
    <h1 class="text-center titulo-skilltrees"><?=$array_classe['nome']?> <span class="bi bi-diagram-3-fill"></span> </h1>
</div>

<hr class="mb-4" style="background-color: #<?=$array_classe['cor']?>"/>
<?php
$sql = "SELECT * 
        FROM skilltree 
        WHERE id_classe = '{$classe}' 
        ORDER BY nome ASC";
$skilltrees = db_selectMany($sql);

if(count($skilltrees) > 0){?>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <?php foreach($skilltrees as $value){?>
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="<?=$value['nome']?>-tab" data-toggle="tab" href="#<?=$value['nome']?>" 
                role="tab" aria-controls="<?=$value['nome']?>" aria-selected="true"><?=$value['nome']?></a>
        </li>
        <?php } ?>
    </ul>
    <div class="tab-content" id="myTabContent">
        <?php foreach($skilltrees as $value){?>
        <div class="tab-pane fade <?=$skilltrees[0]['id']==$value['id']?"show active":NULL?>" id="<?=$value['nome']?>" role="tabpanel" aria-labelledby="home-tab">
            <div class="card card-skilltree" data-id="<?=$value['id']?>">
                <div class="card-header text-center">
                    <?=$value['nome']?> 
                    <a href="index.php?page=skilltree_forms&id=<?=$value['id']?>"><span class="bi bi-pencil-square"></span></a>
                    <br/>
                    <small><?=$value['descricao']?></small>
                </div>
                <div class="card-body grid-skills" style="grid-template-columns: repeat(<?=$value['colunas']?>, 1fr);">
                    <?php $sql = "SELECT * 
                                    FROM skilltree_row 
                                    WHERE id_skilltree = '{$value['id']}' 
                                    ORDER BY nivel ASC";
                    $rows = db_selectMany($sql);
                    foreach ($rows as $row_val) {
                        for($i = 1; $i <= $value['colunas']; $i++){?>
                            <div class="skill-space" data-col="<?=$i?>" data-row="<?=$row_val['nivel']?>">
                                <?php 
                                $sql = "SELECT * 
                                        FROM skill 
                                        WHERE id_skilltree = '{$value['id']}' 
                                            AND id_row = '{$row_val['id']}'
                                            AND coluna = '{$i}'";
                                            
                                $skills = db_selectMany($sql);
                                foreach($skills as $skill){
                                    if(!empty($skill)){
                                        switch($skill['forma']){
                                            case "1":
                                                $forma = 'circulo';
                                                break;
                                            case "2":
                                                $forma = 'quadrado';
                                                break;
                                            case "3":
                                                $forma = 'redondo';
                                                break;
                                        }?>
                                        <div class="<?=$forma?> skill">
                                            <span class="bi bi-arrows-move pin"></span>
                                            <a class="text-danger bi bi-trash3 delete-skill" data-id="<?=$skill['id']?>"></a>
                                            <input type="hidden" class="id-skill" value="<?=$skill['id']?>"/>
                                            <input type="hidden" class="skill-type" value="<?=$skill['forma']?>"/>
                                            <textarea class="skill-input"><?=$skill['nome']?></textarea>
                                            <div class="skill-descricao">
                                                <textarea class="skill-descricao-text" id="descricao-<?=$skill['id']?>"><?=$skill['descricao']?></textarea>
                                            </div>
                                        </div>
                                    <?php } 
                                }?>
                            </div>
                        <?php }
                    }?>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12 text-center">                        
                            <input type="hidden" class="skilltree-colunas" value="<?=$value['colunas']?>"/>
                            <input type="hidden" class="last-row" value="<?=count($rows)?>"/>
                            <input type="hidden" class="id-skilltree" value="<?=$value['id']?>"/>
                            <button type="button" class="btn btn-danger remove-row"> - </button>
                            <button type="button" class="btn btn-success add-row"> + </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
    <button type="button" class="btn btn-danger" id="btn-salvar" data-alt="">
        SALVAR
    </button>
    <div class="skill-menu">
        <div class="circulo skill original">
            <span class="bi bi-arrows-move pin"></span>
            <input type="hidden" class="skill-type" value="1"/>
            <input type="hidden" class="id_skill" value=""/>
            <textarea class="skill-input">NEW</textarea>
            <div class="skill-descricao">
                <textarea class="skill-descricao-text" id="descricao-circulo">Nada aqui por enquanto</textarea>
            </div>
        </div>
        <div class="quadrado skill original">
            <span class="bi bi-arrows-move pin"></span>
            <input type="hidden" class="skill-type" value="2"/>
            <input type="hidden" class="id_skill" value=""/>
            <textarea class="skill-input">NEW</textarea>
            <div class="skill-descricao">
                <textarea class="skill-descricao-text" id="descricao-quadrado">Nada aqui por enquanto</textarea>
            </div>
        </div>
        <div class="redondo skill original">
            <span class="bi bi-arrows-move pin"></span>
            <input type="hidden" class="skill-type" value="3"/>
            <input type="hidden" class="id_skill" value=""/>
            <textarea class="skill-input">NEW</textarea>
            <div class="skill-descricao">
                <textarea class="skill-descricao-text" id="descricao-redondo">Nada aqui por enquanto</textarea>
            </div>
        </div>
    </div>
<?php } else {?>
    <div class="card p-3">
        Não existe skilltrees cadastradas.
    </div>
<?php }
?>
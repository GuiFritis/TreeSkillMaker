<a href="index.php?page=skilltree_forms&classe=<?=$classe?>" class="btn btn-primary">Adicionar skilltree</a>
<?php
$sql = "SELECT * 
        FROM classe 
        WHERE id = '{$classe}'";
$array_classe = db_selectOne($sql);
?>
<h1 class="text-center"><?=$array_classe['nome']?> Skills</h1>
<hr class="mb-4" style="background-color: #<?=$array_classe['cor']?>"/>
<?php
$sql = "SELECT * 
        FROM skilltree 
        WHERE id_classe = '{$classe}' 
        ORDER BY nome ASC";
$skilltrees = db_selectMany($sql);

if(count($skilltrees) > 0){?>
    <div class="grid-skilltrees">
    <?php foreach($skilltrees as $value){?>
        <div class="card card-skilltree" data-id="<?=$value['id']?>" style="border-color: #<?=$array_classe['cor']?>">
            <div class="card-header text-center">
                <?=$value['nome']?><br/>
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
                                        <img src="img/move.svg" alt="Move" class="pin"/>
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
    <?php }?>
    </div>
    <button type="button" class="btn btn-danger" id="btn-salvar" data-alt="">
        SALVAR
    </button>
    <div class="skill-menu">
        <div class="circulo skill original">
            <img src="img/move.svg" alt="Move" class="pin"/>
            <input type="hidden" class="skill-type" value="1"/>
            <input type="hidden" class="id_skill" value=""/>
            <textarea class="skill-input">NEW</textarea>
            <div class="skill-descricao">
                <textarea class="skill-descricao-text" id="descricao-circulo">Nada aqui por enquanto</textarea>
            </div>
        </div>
        <div class="quadrado skill original">
            <img src="img/move.svg" alt="Move" class="pin"/>
            <input type="hidden" class="skill-type" value="2"/>
            <input type="hidden" class="id_skill" value=""/>
            <textarea class="skill-input">NEW</textarea>
            <div class="skill-descricao">
                <textarea class="skill-descricao-text" id="descricao-quadrado">Nada aqui por enquanto</textarea>
            </div>
        </div>
        <div class="redondo skill original">
            <img src="img/move.svg" alt="Move" class="pin"/>
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
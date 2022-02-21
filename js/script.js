$ = jQuery.noConflict();

$(document).ready(function(){

    $(".skill-descricao-text").each(function(id, elem){
        inlineInit("#"+$(elem).attr("id"));
    })

    $(".card-jogo").on("click", function(event){
        let id = $(event.delegateTarget).attr("data-id");
        document.location="index.php?page=classes&jogo="+id
    })

    $(".card-classe").on("click", function(event){
        let id = $(event.delegateTarget).attr("data-id");
        document.location="index.php?page=skilltrees&classe="+id
    })

    $(".skill-circulo").on("click", function(){
        $(".creation-space").html("<div class='circulo skill'>NEW SKILL</div>");
    })

    $(".skill-quadrado").on("click", function(){
        $(".creation-space").html("<div class='quadrado skill'>NEW SKILL</div>");
    })
    $(".skill-redondo").on("click", function(){
        $(".creation-space").html("<div class='redondo skill'>NEW SKILL</div>");
    })

    $(".skill-space").droppable({
        classes: {
            "ui-droppable-active": "droppable-active",
            "ui-droppable-hover": "droppable-hover"
        },
        tolerance: "pointer",
        drop: function(event, ui){
            $("#btn-salvar").attr("data-alt", "1");
            let clone;
            if(ui.helper.is(".original")){
                clone = ui.helper.clone();
                $(clone).removeClass("original");
                $(clone).draggable({  
                    handle: ".pin", 
                    helper: "original",             
                    revert: "invalid",
                    cursorAt: {top: -5}
                });
            } else {
                clone = ui.helper;
            }
            $(clone).css({
                position: 'relative',
                top: '',
                left: ''
            });
            $(event.target).append(clone);
            $(clone).children(".skill-input").select().focus();
            // inlineInit($(clone).find(".skill-descricao-text"));
            // $(clone).on("mouseenter", function(event){
            //     setTimeout(function(){
            //         $(event.delegateTarget).children(".skill-descricao").fadeIn();
            //     }, 500);
            // })
            // $(clone).on("mouseleave", function(event){
            //     $(event.delegateTarget).children(".skill-descricao").fadeOut();
            // })
        }
    });

    $(".skill.original").draggable({
        handle: ".pin",
        helper: "clone",
        revert: "invalid",
        cursorAt: {top: -5},
    });

    $(".skill:not(.original)").draggable({  
        handle: ".pin", 
        helper: "original",             
        revert: "invalid",
        cursorAt: {top: -5}
    })

    $("#btn-salvar").on("click", function(){
        if($(this).attr("data-alt") != ""){
            salvaSkills();
        } else {
            alert("Sem alterações registradas!");
        }
    });

    $(".add-row").on("click", function(event){
        let btn = event.delegateTarget;
        $(btn).prop("disabled", true);
        let id_skilltree = $(btn).siblings(".id-skilltree").val();
        let row = Number($(btn).siblings(".last-row").val());
        let colunas = Number($(btn).siblings(".skilltree-colunas").val());
        let cardSkill = $(".card-skilltree[data-id="+id_skilltree+"]");
        let skillSpace = $(cardSkill).find(".skill-space").last();
        alert("Processando...");
        $.ajax({
            url: "ajax/ajax_row.php",
            method: "POST",
            data: {
                "nivel": row+1,
                "requirements": "",
                "id_skilltree": id_skilltree
            }, 
            success: function(retorno){                
                for(let i = 1; i <= colunas; i++){
                    let clone = $(skillSpace).clone();
                    $(clone).attr("data-row", retorno).attr("data-col", i).html("");
                    $(cardSkill).append(clone);
                }
                $(btn).siblings(".last-row").val(row + 1); 
                $(btn).prop("disabled", false);       
            },
            erro: function(erro){
                alert("Ocorreu algum erro!");
                console.log(erro);
            }
        })  
    });

    $(".remove-row").on("click", function(event){
        let btn = event.delegateTarget;
        let id_skilltree = $(btn).siblings(".id-skilltree").val();
        let cardSkill = $(".card-skilltree[data-id="+id_skilltree+"]");
        let skillSpace = $(cardSkill).find(".skill-space").last();
        let row = Number($(skillSpace).attr("data-row"));
        let num_rows = Number($(btn).siblings(".last-row").val());
        let verify = true;
        if(num_rows > 1){
            $(".skill-space[data-row="+(row)+"]").each(function(id, elem){
                if($(elem).html() != ""){
                    verify = false;
                }
            })
            if(verify){
                $(".skill-space[data-row="+row+"]").remove();
                $(btn).siblings(".last-row").val(num_rows-1);
            } else {
                alert("Existem skills nessa linha!");
            }
        } else {
            alert("Não pode existir menos de uma linha!");
        }
    })



})

window.onbeforeunload = function(){
    if($("#btn-salvar").length > 0){
        if($("#btn-salvar").attr("data-alt") != ""){
            if(confirm("Existem alteração não salvas, deseja salvá-las?")){
                salvaSkills();
            }
        }
    }
}

function salvaSkills(){
    alert("Processando...");
    $("#btn-salvar").attr("data-alt", "");
    
    let id_skilltree;
    let dados = {
        skills: []
    };
    $(".card-skilltree").each(function(id, elem){
        id_skilltree = $(elem).attr("data-id");
        $(elem).find(".skill:not(.original)").each(function(index, element){
            let obj_aux = {};
            let space = $(element).parent();
            obj_aux.nome = $(element).children(".skill-input").val();
            obj_aux.descricao = $(element).find(".skill-descricao-text").val();
            obj_aux.coluna = $(space).attr("data-col");
            obj_aux.forma = $(element).children(".skill-type").val();
            obj_aux.row = $(space).attr("data-row");
            obj_aux.skilltree = id_skilltree;
            obj_aux.id = $(element).children(".id-skill").val();
            dados.skills.push(obj_aux);
        })
    })
    $.ajax({
        url: "ajax/ajax_skill.php",
        method: "POST",
        data: dados,
        success: function(retorno){
            console.log(retorno)
            alert("Alterações salvar com sucesso!");
            // window.location.reload();
        },
        erro: function(erro){
            alert("Ocorreu algum erro!");
            console.log(erro);
        }
    });
}

function inlineInit(selector){
    new inLine(selector, {
        theme: 'dark',
        toolbar: ['bold','italic','underline','orderedList','color','link'],
        onChange: function(){
            $("#btn-salvar").attr("data-alt", "1");
        },
        onToolbarOpen: function(api){
            $(api.output).parent().css({
                "opacity": "1",
                "z-index": "1"
            });
        },
        onToolbarClose: function(api){
            $(api.output).parent().css({
                "opacity": "",
                "z-index": ""
            });
        },
    })
}
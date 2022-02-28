$ = jQuery.noConflict();

$(document).ready(function(){

    $(".skill:not(.original) .skill-descricao-text").each(function(id, elem){
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

    bindSortable();

    $(".skill.original").draggable({
        connectToSortable: ".skilltree-row",
        handle: ".pin",
        helper: "clone",
        revert: "invalid",
        cursorAt: {top: -5},
    });

    $("#btn-salvar").on("click", function(){
        if($(this).attr("data-alt") != ""){
            salvaSkills();
        } else {
            toast("Sem alterações registradas!", "info");
        }
    });

    $(".add-row").on("click", function(event){
        let btn = event.delegateTarget;
        $(btn).prop("disabled", true);
        let id_skilltree = $(btn).siblings(".id-skilltree").val();
        let row = Number($(btn).siblings(".last-row").val());
        let cardSkill = $(".card-skilltree[data-id="+id_skilltree+"]");
        toast("Processando...");
        $.ajax({
            url: "ajax/ajax_row.php",
            method: "POST",
            data: {
                "nivel": row + 1,
                "requirements": "",
                "id_skilltree": id_skilltree,
                "action": "insert"
            }, 
            success: function(retorno){            
                let clone = $(".skilltree-row").last().clone().html("");
                $(clone).attr("data-row", retorno).attr("data-nivel", row + 1);
                $(cardSkill).children(".grid-skills").append(clone);
                $(clone).css("display", "none");
                $(clone).fadeIn("slow");
                $(btn).siblings(".last-row").val(row + 1); 
                $(btn).prop("disabled", false);     
                bindSortable();  
            },
            erro: function(erro){
                toast("Ocorreu algum erro!", "error");
                console.log(erro);
            }
        })  
    });

    $(".remove-row").on("click", function(event){
        let btn = event.delegateTarget;
        $(btn).prop("disabled", true);
        let id_skilltree = $(btn).siblings(".id-skilltree").val();
        let cardSkill = $(".card-skilltree[data-id="+id_skilltree+"]");
        let num_rows = Number($(btn).siblings(".last-row").val());
        let row = $(cardSkill).find(".skilltree-row").last();
        let verify = true;
        toast("Processando...");
        if(num_rows > 1){
            if($(row).children(".skill").length > 0){
                verify = false;
            }
            if(verify){
                $(btn).siblings(".last-row").val(num_rows-1);
                $.ajax({
                    url: "ajax/ajax_row.php",
                    method: "POST",
                    data: {
                        "id": row.attr("data-row"),
                        "id_skilltree": id_skilltree,
                        "action": "remove"
                    },
                    success: function(){
                        row.slideUp("slow", function(){row.remove();});
                        $(btn).prop("disabled", false);
                    }
                })  
            } else {
                toast("Existem skills nessa linha!", "warning");
            }
        } else {
            toast("Não pode existir menos de uma linha!", "warning");
        }
    })

    $(".delete-skill").on("click", function(event){
        $(event.delegateTarget).parent().remove();
        $.ajax({
            url: "ajax/ajax_delete_skill.php",
            method: "POST",
            data: {
                id: $(event.delegateTarget).attr("data-id")
            }
        })
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
    toast("Processando...");
    $("#btn-salvar").attr("data-alt", "");
    
    let id_skilltree;
    let dados = {
        skills: []
    };
    $(".card-skilltree").each(function(id, elem){
        id_skilltree = $(elem).attr("data-id");
        $(elem).find(".skilltree-row").each(function(index, row){
            let row_id = $(row).attr("data-row");
            let cont = 0;
            $(row).children(".skill").each(function(skill_id, skill){
                let obj_aux = {};
                obj_aux.nome = $(skill).children(".skill-input").val();
                obj_aux.descricao = $(skill).find(".skill-descricao-text").val();
                obj_aux.ordem = cont;
                obj_aux.forma = $(skill).children(".skill-type").val();
                obj_aux.row = row_id;
                obj_aux.skilltree = id_skilltree;
                obj_aux.id = $(skill).children(".id-skill").val();
                dados.skills.push(obj_aux);
                cont++;
            })
        })
    })
    $.ajax({
        url: "ajax/ajax_skill.php",
        method: "POST",
        data: dados,
        success: function(retorno){
            toast("Alterações salvar com sucesso!", "success");
            window.location.reload();
        },
        erro: function(erro){
            toast("Ocorreu algum erro!", "error");
            console.log(erro);
        }
    });
}

function inlineInit(selector){
    new inLine(selector, {
        theme: 'dark',
        toolbar: ['bold','italic','underline','orderedList','color','link'],
        colors: ["#DD5500", "#7A00CC", "#3388DD", "#FF33CC", "#FFDD00", "#FFFFFF", "#B3B3B3", "#AA0000", "#00CC33"],
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

function bindSortable(){
    $(".skilltree-row").sortable({
        connectWith: ".skilltree-row",
        handle: ".pin", 
        helper: "original",
        start: function(event, ui){
            $(".skilltree-row").css("justify-content", "center");
        },
        stop: function(event, ui){
            $(".skilltree-row").css("justify-content", "");
        },
        receive: function(event, ui){
            let col = Number($(event.target).attr("data-col"));
            let skills = Number($(event.target).children(".skill").length);

            if(skills > col){
                toast("Número máximo de skills alcançado nessa linha!", "warning");
                if(ui.helper != null){
                    $(ui.helper).remove();
                } else {
                    $(ui.sender).sortable("cancel");
                }
                return;
            }

            $("#btn-salvar").attr("data-alt", "1");

            if(ui.helper != null){
                $(ui.helper).removeClass("original");
                $(ui.helper).draggable({  
                    handle: ".pin", 
                    helper: "original",             
                    revert: "invalid",
                    cursorAt: {top: -5}
                });
                $(ui.helper).draggable('disable');
                $(ui.helper).draggable('destroy');
                $(ui.helper).children(".skill-input").select().focus();
                let cont = $(".skill").length;
                $(ui.helper).find(".skill-descricao-text").attr("id", "descricao-"+cont+"-n");
                inlineInit("#"+$(ui.helper).find(".skill-descricao-text").attr("id"));      
            }
        },
        update: function(event, ui){
            $("#btn-salvar").attr("data-alt", "1");
        },
        cursorAt: {top: -5},
        tolerance: "pointer"
    });
}

function toast(text, icon=""){
    $.toast({
        text: text,
        icon: icon,
        bgColor: "#078D7D",
        textColor: "#FFFFFF",
        loaderBg: "#FFFFFF"
    })
}
function insertTab4Form1() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerSessoesMaterias&&action=insert',
        type: 'POST',
        data: $('#tab-4-form-1').serialize(),
        beforeSend: function () {
            toastr["info"]("Aguarde, as informções estão sendo salvas no banco de dados!");
        },
        success: function (data) {
            if (!isNaN(data)) {
                $('.toast-info').hide();
                toastr["success"]("Cadastro realizado com sucesso!");
                key = $('#relacionamento').val();
                locateTab4Form1(key);
            } else {
                $('.toast-info').hide();
                toastr["error"](data);
            }
        }
    });
}


function locateTab4Form1(id) {
    $("#tab-4-tbody-1").empty();

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerSessoesMaterias&&action=locate',
        cache: false,
        type: 'POST',
        data: {id: id},
        dataType: "json",
        beforeSend: function () {
            $("#tab-4-echos-1").html("<h6 class='text-muted text-center'>Carregando...</h6>"); //Carregando
        },
        error: function () {
            $("#tab-4-echos-1").html("<h6 class='text-muted text-center'>Não foi possivel executar a ação desejada, favor entrar em contato com o administrador.</h6>");
        },
        success: function (retorno) {
            if (!retorno[0]) {
                $("#tab-4-echos-1").html("<h6 class='text-muted text-center'>Não há matérias nessa sessão!</h6>");
            } else {

                $("#tab-4-echos-1").empty();
                
                var tamanhoPagina = 999;
                var pagina = 0;
                for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {
                        
                        if((retorno[i].aberto && retorno[i].aberto === 'N') || !retorno[i].aberto){
                            $("#tab-4-tbody-1").append(
                                $('<tr id="linha' + retorno[i].id + '">')
                                .append($('<td style="width: 5%;">').append(retorno[i].id))
                                .append($('<td style="vertical-align: middle;">')
                                    .append(
                                        '<b>Exerc.:&nbsp;</b>'+retorno[i].exercicio
                                        +'<br/><b>Num.:&nbsp;</b>'+retorno[i].numero 
                                        + '<br/><b>Tipo:&nbsp;</b>' + retorno[i].tipo
                                        + '<br/><b>Descrição:&nbsp;</b><a href="../materias/cadastro.php?id='+retorno[i].id_materias+'">' 
                                        + retorno[i].descricao
                                    )
                                )
                                .append($('<td>').append(
                                    '<div class="form-group mb-2">'
                                        +'<label><b>Ordem</b></label><br/>'
                                        +'<input type="text" class="form-control" placeholder="Ordem" value="' + retorno[i].ordem + '" data-id="' + retorno[i].id + '" data-id_sessoes="' + retorno[i].id_sessoes + '" onkeyup="mudaOrdem(this, event)">'
                                    +'</div>'
                                    +'<button type="button" class="btn btn-sm btn-info w-100 mb-2" onclick="abrirVotacao({idSessoesMaterias: '+ retorno[i].id + ', idSessoes:'+ retorno[i].id_sessoes + '})">Abrir Votação</button>'
                                    +'<button type="button" class="btn btn-danger btn-sm w-100 mb-2"  onclick="deletarTab4Form1(' + retorno[i].id + ')">Excluir</button></center>'
                                ))
                            );
                        }

                        if((retorno[i].aberto && retorno[i].aberto === 'S')){
                            $("#tab-4-tbody-1").append(
                                $('<tr id="linha' + retorno[i].id + '">')
                                .append($('<td style="width: 5%; background:rgba(182, 236, 182, 0.74)" >').append(retorno[i].id))
                                .append($('<td style="vertical-align: middle; background:rgba(182, 236, 182, 0.74)" >')
                                    .append(
                                        '<b>Exerc.:&nbsp;</b>'+retorno[i].exercicio
                                        +'<br/><b>Num.:&nbsp;</b>'+retorno[i].numero 
                                        + '<br/><b>Tipo:&nbsp;</b>' + retorno[i].tipo
                                        + '<br/><b>Descrição:&nbsp;</b>'
                                        +'<a href="../materias/cadastro.php?id='+retorno[i].id_materias+'">' 
                                        + retorno[i].descricao
                                        +'&nbsp;<button class="btn btn-sm btn-warning" style="position: relative">Em votação agora <div class="rec-dot"></div></button>'
                                    )
                                )
                                .append($('<td style="background:rgba(182, 236, 182, 0.74)">').append(
                                    '<div class="form-group mb-3">'
                                        +'<label><b>Ordem</b></label><br/>'
                                        +'<input type="text" class="form-control" placeholder="Ordem" value="' + retorno[i].ordem + '" data-id="' + retorno[i].id + '" data-id_sessoes="' + retorno[i].id_sessoes + '" onkeyup="mudaOrdem(this, event)">'
                                    +'</div>'
                                    +'<div class="btn btn-sm btn-secondary w-100 mb-2" onclick="fecharVotacao({idSessoesMaterias: '+ retorno[i].id + ', idSessoes:'+ retorno[i].id_sessoes + '})">Encerrar Votação</div>'
                                ))
                            );
                        }
                        
        
                }
            }
        }
    });
}




function populaFormTab4Form1(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerSessoesMaterias&&action=locate&&id=' + id,
        type: 'POST',
        dataType: "json",
        data: {id: id},
        success: function (json) {

            //FAZ AS ALTERAÇÕES NESCESSARIAS NO FORM PARA O MODO DE EDIÇÃO
            var data = jQuery.parseJSON(JSON.stringify(json));
            $("#tab-4-btn-salvar").css("display", "none");
            $("#tab-4-btn-voltar").css("display", "none");
            $("#tab-4-btn-cancelar").css("display", "block");
            $("#tab-4-btn-salvar-alteracoes").css("display", "block");
            $("#tab-4-btn-salvar-alteracoes").attr('onclick', 'updateTab4Form1(' + id + ')');


            //POPULA O FORM COM AS INFORMAÇÕES DO BANCO DE DADOS
            $.each(json, function (field, value) {

                container = '';
                prefix_field = '#';

                if ($(container + prefix_field + field).attr('type') == 'checkbox') {
                    if ($(container + prefix_field + field).val() == value) {
                        $(container + 'input[type="checkbox"]' + prefix_field + field).prop('checked', true);
                    } else {
                        $(container + 'input[type="checkbox"]' + prefix_field + field).prop('checked', false);
                    }
                } else

                if ($(container + prefix_field + field).attr('type') == 'radio') {

                    if ($(container + prefix_field + field).val() == value) {
                        $(container + 'input[type="radio"]' + prefix_field + field).prop('checked', true);
                    } else {
                        $(container + 'input[type="radio"]' + prefix_field + field).prop('checked', false);
                    }
                } else

                if ($(container + prefix_field + field).get(0) != undefined && $(container + prefix_field + field).get(0).tagName === 'IMG') {
                    if (value != '') {
                        t = new Date();
                        $(container + prefix_field + field).attr('src', value + '?' + t.getTime());
                    }
                } else {
                    $(container + prefix_field + field).val(value);
                }
            });
        }
    });
};


function deletarTab4Form1(id) {
    if (confirm("TEM CERTEZA QUE DESEJA EXCLUIR ESSE REGISTRO?")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerSessoesMaterias&&action=delete',
            type: "POST",
            data: {id: id},
            success: function (data) {
                $("#linha" + id).remove();
                toastr["success"]("Excluido com sucesso!")
            }
        });
    }
    ;
}


function  updateTab4Form1(idMembro, presenteAtual, idSessao, idServidor) {    
    var presenteNovo = presenteAtual === 'S' ? 'N' : 'S';
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerSessoesMaterias&&action=update&&id=' + idMembro,
        type: 'POST',
        data: {id_servidor: idServidor, id_sessoes: idSessao, presente: presenteNovo},
        beforeSend: function () {
            $(".loading").show()
            $("#tab-4-form-1 :input").prop("disabled", true);
        },
        error: function () {
            $(".loading").hide()
            $("#tab_2_alerts").html("Erro no Ajax");
        },
        success: function (data) {
            $(".loading").hide()
            $("#tab-4-form-1 :input").prop("disabled", false);
            $('.toast-info').hide();

            if (isNaN(data)) {
                toastr["error"](data);
            } else {

                switch (data) {
                    case '1':
                        toastr["success"]("Dados atualizados com sucesso!");
                        locateTab4Form1($('#relacionamento').val());
                        break;
                    case '0':
                        toastr["success"]("Embora a transação tenha sido efetuada com sucesso você não inseriu nenhum dado novo!");
                        break;
                }

            }
        }
    });
}


function importarJsonMaterias() {
    var formData = new FormData(document.getElementById('formJsonMaterias'));

    $.ajax({
      url: '../../_php/Dispatch.php?controller=ControllerSessoesMaterias&&action=importarJson',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      beforeSend: function () {
        $(".loadingFormJson").show();
        toastr["info"]("Aguarde, as informções estão sendo salvas no banco de dados!");
      },
      error: function(error) {
        console.error(error);
        $(".loadingFormJson").hide();
      },
      success: function(response) {
        $(".loadingFormJson").hide();
        console.log(response);
        toastr["success"]("Cadastro realizado com sucesso!");
      },
    });
  }


/*function  updateTab4Form1(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerSessoesMaterias&&action=update&&id=' + id,
        type: 'POST',
        data: $('#tab-4-form-1').serialize(),
        beforeSend: function () {
            toastr["info"]("Aguarde, estamos providenciando o envio de suas informações!")
        },
        success: function (data) {
            $('.toast-info').hide();
            if (isNaN(data)) {
                toastr["error"](data);
            } else {

                switch (data) {
                    case '1':
                        toastr["success"]("Dados atualizados com sucesso!");
                        break;
                    case '0':
                        toastr["success"]("Embora a transação tenha sido efetuada com sucesso você não inseriu nenhum dado novo!");
                        break;
                }

                idServidor = $('#id_servidor').val();
                locatePessoaVinculo(idServidor);
            }
        }
    });
}*/

function mudaOrdem(inputElement, event) {
    const keyCode = event.keyCode || event.which;
    if (keyCode === 13 || keyCode === 9) {
        const id = inputElement.getAttribute('data-id');
        const idSessoes = inputElement.getAttribute('data-id_sessoes');
        const novaOrdem = inputElement.value;

        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerSessoesMaterias&&action=mudaOrdem',
            type: 'POST',
            data: {
                id: id,
                id_sessoes: idSessoes,
                nova_ordem: novaOrdem
            },
            beforeSend: function () {
                toastr["info"]("Aguarde, as informações estão sendo salvas no banco de dados!");
            },
            error: function (xhr, status, error) {
                $('.toast-info').hide();
                toastr["error"]("Erro ao realizar o cadastro: " + error);
            },
            success: function (response) {
                $('.toast-info').hide();
                toastr["success"](response);
                locateTab4Form1(idSessoes)
            }
        });
    }
}


function abrirVotacao({idSessoes, idSessoesMaterias}) {
    if (confirm("\u{26A0}\u{FE0F}  Tem certeza que deseja ABRIR matéria para votação ? \n Isso vai fechar as demais matérias que, por ventura, estejam abertas. ")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerSessoesMaterias&&action=abrirVotacao',
            type: 'POST',
            data: {id: idSessoesMaterias},
            beforeSend: function () {
                toastr["info"]("Aguarde, as informações estão sendo salvas no banco de dados!");
            },
            error: function (xhr, status, error) {
                $('.toast-info').hide();
                toastr["error"]("Erro ao realizar o cadastro: " + error);
            },
            success: function (response) {
                $('.toast-info').hide();
                toastr["success"](response);
                locateTab4Form1(idSessoes)
            }
        });
    }
}

function fecharVotacao({idSessoes, idSessoesMaterias}) {
    if (confirm("\u{26A0}\u{FE0F}  Tem certeza que deseja ENCERRAR VOTAÇÃO da matéria? ")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerSessoesMaterias&&action=fecharVotacao',
            type: 'POST',
            data: {id: idSessoesMaterias},
            beforeSend: function () {
                toastr["info"]("Aguarde, as informações estão sendo salvas no banco de dados!");
            },
            error: function (xhr, status, error) {
                $('.toast-info').hide();
                toastr["error"]("Erro ao realizar o cadastro: " + error);
            },
            success: function (response) {
                $('.toast-info').hide();
                toastr["success"](response);
                locateTab4Form1(idSessoes)
            }
        });
    }
}


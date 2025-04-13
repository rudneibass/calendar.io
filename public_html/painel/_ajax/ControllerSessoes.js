function vizualizar(id) {
    location.href = 'cadastro.php?id=' + id;
}

function populaForm(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerSessoes&&action=locate',
        type: 'POST',
        dataType: "json",
        data: {id: id},
        beforeSend: function () {
            $(".loading").show()
            $("#tab-1-form-1 :input").prop("disabled", true);
        },
        error: function () {
            $(".loading").hide()
            $("#tab_1_alerts").html("Erro no Ajax");
        },
        success: function (json) {
            $(".loading").hide()
            $("#tab-1-form-1 :input").prop("disabled", false);

            //FAZ AS ALTERAÇÕES NESCESSARIAS NO FORM PARA O MODO DE EDIÇÃO
            var data = jQuery.parseJSON(JSON.stringify(json));
            $("#tab-3-btn-show-modal-upload").attr("onclick", "showModalUpload('modal-upload', 'ControllerUploadMultiplo', 'analisaArquivo', " + data.id + ", 'sessoes')");
            $("#tab-1-btn-salvar").css("display", "none");
            $('#tab-1-btn-salvar-alteracoes').css("display","block");
            $('#tab-1-btn-salvar-alteracoes').attr("onclick","update("+data.id+")");

            //POPULA O FORM COM AS INFORMAÇÕES DO BANCO DE DADOS
            $.each(json, function (field, value) {
                container = '';
                prefix_field = '#';

                if ($('#' + field).attr('type') == 'checkbox') {
                    if ($('#' + field).val() == value) {
                        $(container + 'input[type="checkbox"]' + prefix_field + field).prop('checked', true);
                    } else {
                        $(container + 'input[type="checkbox"]' + prefix_field + field).prop('checked', false);
                    }
                } else

                if ($('#' + field).attr('type') == 'radio') {

                    if ($('#' + field).val() == value) {
                        $(container + 'input[type="radio"]' + prefix_field + field).prop('checked', true);
                    } else {
                        $(container + 'input[type="radio"]' + prefix_field + field).prop('checked', false);
                    }
                } else

                if ($('#' + field).get(0) != undefined && $('#' + field).get(0).tagName === 'IMG') {
                    if (value != '') {
                        t = new Date();
                        $('#' + field).attr('src', value + '?' + t.getTime());
                    }
                } else {
                    $('#' + field).val(value);
                    $('.' + field).val(value);
                }
            });

            //LISTAS DAS DEMAIS ABAS
            locateTab2Form1(data.id);
            listarArquivos(data.id, 'sessoes');
            locateTab4Form1(data.id);
        }
    });
}
;


function locate() {
    $("tr").remove();

    $('#thead').append(
            $('<tr>')
            .append($('<th>').append('Cod'))
            .append($('<th>').append('Nome'))
            .append($('<th>').append(''))
            );

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerSessoes&&action=locate',
        cache: false,
        type: 'POST',
        data: $('#search').serialize(),
        dataType: "json",
        beforeSend: function () {
            $(".loading").show();
        },
        error: function () {
            $(".loading").hide();
            $("#tab_1_alerts").html("Não foi possivel executar a ação desejada, favor entrar em contato com o administrador.");
        },
        success: function (retorno) {
            $(".loading").hide();
            
            if(retorno.length === 0){
                $("#tab_1_alerts").show()
                $("#tab_1_alerts").html("Não há dados cadastrados.")
                return
            }

                var tamanhoPagina = 10;
                var pagina = 0;

                function paginar() {

                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {

                        if(retorno[i].situacao && retorno[i].situacao == 'Aberta'){
                            $("#tbody").append(
                                $('<tr id="linha' + retorno[i].id + '">')
                                .append($('<td style="width: 5%; background:rgba(182, 236, 182, 0.74)">').append(retorno[i].id))
                                .append($('<td style="background:rgba(182, 236, 182, 0.74)">')
                                    .append(
                                        retorno[i].nome
                                        + '&nbsp;<button class="btn btn-sm btn-warning" style="position: relative">Aberta agora <div class="rec-dot"></div></button>'
                                        +'<br/><b>Link Painel Eletrônico: </b><a href="http://adminw2e.com.br/painel/votacao-painel" target="_blank">http://adminw2e.com.br/painel/votacao-painel</a>'
                                        +'<br/><b>Link App de Votação: </b><a href="http://adminw2e.com.br/painel/votacao-login" target="_blank">http://adminw2e.com.br/painel/votacao-login</a>'
                                    )
                                )
                                .append($('<td style="width: 10%; background:rgba(182, 236, 182, 0.74)">')
                                    .append(
                                        '<button type="button" class="btn btn-warning btn-sm w-100 mb-2" onclick="vizualizar(' + retorno[i].id + ')" ><i class="fa fa-pencil"></i> Editar</button></center>'
                                        +'<button type="button" class="btn btn-secondary btn-sm w-100 mb-2" onclick="listarArquivos(' + retorno[i].id + ', \'sessoes\',\'tbody_arquivos_modal\')"  data-toggle="modal" data-target="#modal-files"><i class="fa fa-file-text"></i> Anexos</button>'
                                        +'<button type="button" class="btn btn-sm btn-dark w-100 mb-2" onclick="fecharSessao( '+ retorno[i].id + ')"><i class="fa fa-remove"></i> Encerrar Sessão</button>'
                                    )
                                )
                            )
                        }

                        if(retorno[i].situacao && retorno[i].situacao != 'Aberta'){
                            $("#tbody").append(
                                $('<tr id="linha' + retorno[i].id + '">')
                                .append($('<td style="width: 5%;">').append(retorno[i].id))
                                .append($('<td style="background:">').append(retorno[i].nome))
                                .append($('<td style="width: 10%;">')
                                    .append(
                                        '<button type="button" class="btn btn-warning btn-sm w-100 mb-2" onclick="vizualizar(' + retorno[i].id + ')" ><i class="fa fa-pencil"></i> Editar</button></center>'
                                        +'<button type="button" class="btn btn-secondary btn-sm w-100 mb-2" onclick="listarArquivos(' + retorno[i].id + ', \'sessoes\',\'tbody_arquivos_modal\')"  data-toggle="modal" data-target="#modal-files"><i class="fa fa-file-text"></i> Anexos</button>'
                                        +'<button type="button" class="btn btn-sm btn-info w-100 mb-2" onclick="abrirSessao( '+ retorno[i].id + ')"><i class="fa fa-door-open"></i> Abrir Sessão</button>'
                                    )
                                )
                            )
                        }
                        

                    }
                    $("#echos").empty();
                    $('#numeracao').text('Página ' + (pagina + 1) + ' de ' + Math.ceil(retorno.length / tamanhoPagina));
                }

                function ajustarBotoes() {
                    $('#proximo').prop('disabled', retorno.length <= tamanhoPagina || pagina >= Math.ceil(retorno.length / tamanhoPagina) - 1);
                    $('#anterior').prop('disabled', retorno.length <= tamanhoPagina || pagina == 0);
                }

                $(function () {
                    $('#proximo').click(function () {
                        if (pagina < retorno.length / tamanhoPagina - 1) {
                            $("tr").remove();
                            $('#thead').append(
                                    $('<tr>')
                                    .append($('<th>').append('Cod'))
                                    .append($('<th>').append('Nome'))
                                    .append($('<th>').append(''))
                                    );

                            pagina++;
                            paginar();
                            ajustarBotoes();
                        }
                    });
                    $('#anterior').click(function () {
                        if (pagina >= 1) {
                            $("tr").remove();
                            $('#thead').append(
                                    $('<tr>')
                                    .append($('<th>').append('Cod'))
                                    .append($('<th>').append('Nome'))
                                    .append($('<th>').append(''))
                                    );

                            pagina--;
                            paginar();
                            ajustarBotoes();
                        }
                    });
                    paginar();
                    ajustarBotoes();
                });
        }
    });
}

function  update(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerSessoes&&action=update&&id=' + id,
        type: 'POST',
        data: $('#tab-1-form-1').serialize(),
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

                locateTab2Form1(id)
                listarArquivos(id, 'sessoes')
                locateTab4Form1(id)
            }
        }
    });
}


function insert() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerSessoes&&action=insert',
        type: 'POST',
        data: $('#tab-1-form-1').serialize(),
        beforeSend: function () {
            toastr["info"]("Aguarde, as informções estão sendo salvas no banco de dados!");
        },
        success: function (data) {
            if (!isNaN(data)) {
                $('.toast-info').hide();
                $('#relacionamento').val(data);
                toastr["success"]("Cadastro realizado com sucesso!");
                document.getElementById("tab-1-btn-salvar").disabled = true;
                locateTab2Form1(data)
                document.getElementById("tab-3-btn-show-modal-upload").addEventListener('click', () =>{
                    showModalUpload('modal-upload', 'ControllerUploadMultiplo', 'analisaArquivo', data , 'sessoes')  
                });
                

            } else {
                $('.toast-info').hide();
                toastr["error"](data);
            }
        }
    });
}

function deletar(id) {
    if (confirm("TEM CERTEZA QUE DESEJA EXCLUIR ESSE REGISTRO?")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerSessoes&&action=delete',
            type: "POST",
            data: {id: id},
            success: function (data) {
                $("#linha" + id).remove();
                toastr["success"]("Excluido com sucesso!")
            }
        });
    };
}

function importarJson() {
    var formData = new FormData(document.getElementById('formJson'));

    $.ajax({
      url: '../../_php/Dispatch.php?controller=ControllerSessoes&&action=importarJson',
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

  function abrirSessao(id) {
    if (confirm("\u{26A0}\u{FE0F}  Tem certeza que deseja ABRIR SESSÃO ? \n Isso vai fechar as demais sessões que, por ventura, estejam abertas. ")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerSessoes&&action=abrirSessao',
            type: 'POST',
            data: {id},
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
                locate()
            }
        });
    }
}

function fecharSessao(id) {
    if (confirm("\u{26A0}\u{FE0F}  Tem certeza que deseja ENCERRAR SESSÃO? ")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerSessoes&&action=fecharSessao',
            type: 'POST',
            data: {id},
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
                locate()
            }
        });
    }
}


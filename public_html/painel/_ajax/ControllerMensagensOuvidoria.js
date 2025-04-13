function FormRespostaOuvidoria() {
    $('#id_ouvidoria').val()
    $('.form-resposta-ouvidoria').toggle("slide");
}

function changeStatus(id){
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMensagensOuvidoria&&action=changeStatus&&id=' + id,
        type: "POST",
        data: {id: id},
        dataType: "json",
        success: function (response) {
            ouvidoria();       
        }
    });
}


function vizualizarOuvidoria(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMensagensOuvidoria&&action=ouvidoria&&id=' + id,
        type: "POST",
        dataType: "json",
        beforeSend: function(){
            $('#nome').html('<span class="text-muted">&nbsp;carregando...</span>')
            $('#email').html('<span class="text-muted">&nbsp;carregando...</span>')
            $('#data_cadastro').html('<span class="text-muted">&nbsp;carregando...</span>')
            $('#protocolo').html('<span class="text-muted">&nbsp;carregando...</span>')
            $('#fone').html('<span class="text-muted">&nbsp;carregando...</span>')
            $('#assunto').html('<span class="text-muted">&nbsp;carregando...</span>')
            $('#mensagem').html('<span class="text-muted">&nbsp;carregando...</span>')
        },
        success: function (response) {

            $('#nome').html(response.nome)
            $('#email').html(response.email)
            $('#data_cadastro').html(response.data_cadastro)
            $('#protocolo').html('00000'+response.protocolo)
            $('#fone').html(response.fone)
            $('#assunto').html(response.assunto)            
            $('#mensagem').html(response.mensagem)
            $('#id_ouvidoria').val(response.id)
     
        }
    });
};

function vizualizarEnviadasOuvidoria(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMensagensEnviadas&&action=vizualizarEnviadasOuvidoria&&id=' + id,
        type: "POST",
        beforeSend: function(){
            $('#modal-body-enviadas-loading').show();
        },
        success: function (data) {
            $('#modal-body-enviadas-loading').hide();
            $('#modal-body-enviadas').html(data);
        }
    });
};

function enviarRespostaOuvidoria() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMensagensOuvidoria&&action=enviarResposta',
        type: 'POST',
        data: $('#form-resposta-ouvidoria').serialize(),
        beforeSend: function(){
            $('#btn-enviar-resposta').hide()
            $('#btn-carregando-enviar-resposta').show()
        },
        success: function (data) {
            $('#btn-enviar-resposta').show()
            $('#btn-carregando-enviar-resposta').hide()
            if (isNaN(data)) {
                toastr["error"](data);
            } else {
                toastr["success"]('Enviado com sucesso!');
                //enviarResposta();
            }
        }
    });
};



function ouvidoria() {
    $("tr").remove();
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMensagensOuvidoria&&action=ouvidoria',
        cache: false,
        type: 'POST',
        data: $('#tab-1-form-1').serialize(),
        dataType: "json",
        beforeSend: function () {
            $("#tab_1_loading").show()
            $("#tab_1_alerts").hide()
        },
        error: function () {
            $("#tab_1_loading").hide()
            $("#tab_1_alerts").show()
            $("#tab_1_alerts").html("Ocorreu um erro ao tentar conectar-se com o servidor, contate o administrador.") 
        },
        success: function (retorno) {

            $("#tab_1_loading").hide()
            $("#tab_1_alerts").hide()

            if(retorno.length === 0){
                $("#tab_1_alerts").show()
                $("#tab_1_alerts").html("Não há dados cadastrados.")
            }
    
                var tamanhoPagina = 20;
                var pagina = 0;

                function paginar() {
                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {
                        if (retorno[i].status == '0') {
                            $("#tab-1-tbody-1").append(
                                    $('<tr id="tr' + retorno[i].id + '" style="font-weight: bold" onclick="vizualizarOuvidoria(' + retorno[i].id + ');changeStatus(' + retorno[i].id + ')" data-toggle="modal" data-target="#modal-ouvidoria">')
                                    .append($('<td>').append('<input type="checkbox">&nbsp;&nbsp;Protocolo:&nbsp' + retorno[i].id))
                                    .append($('<td>').append('<span class="badge badge-primary">#ouvidoria</span>'))
                                    .append($('<td>').append('<i id="i' + retorno[i].id + '" class="fa fa-bookmark" style="color: #F7CA4C"></i>&nbsp;' + retorno[i].nome))
                                    .append($('<td>').append(retorno[i].assunto))
                                    .append($('<td>').append('<span class="size-12">' + retorno[i].data_formatada))
                                    )
                        } 

                        if (retorno[i].status == '1') {
                            $("#tab-1-tbody-1").append(
                                    $('<tr id="tr' + retorno[i].id + '" style="background-color: #F4F7F7;"  onclick="vizualizarOuvidoria(' + retorno[i].id + ');" data-toggle="modal" data-target="#modal-ouvidoria">')
                                    .append($('<td>').append('<input type="checkbox">&nbsp;&nbsp;Protocolo:&nbsp' + retorno[i].id))
                                    .append($('<td>').append('<span class="badge badge-primary">#ouvidoria</span>'))
                                    .append($('<td>').append('<i class="fa fa-bookmark-o" style="color: #D6D6D6"></i>&nbsp;' + retorno[i].nome))
                                    .append($('<td>').append(retorno[i].assunto))
                                    .append($('<td>').append('<span class="size-12">' + retorno[i].data_formatada))
                                    )
                        }

                    }
                    $("h3").remove();
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
                            pagina++;
                            paginar();
                            ajustarBotoes();
                        }
                    });
                    $('#anterior').click(function () {

                        if (pagina >= 1) {
                            $("tr").remove();
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



function enviadas() {
    $("tr").remove();
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMensagensEnviadas&&action=enviadas',
        cache: false,
        type: 'POST',
        data: $('#tab-2-form-1').serialize(),
        dataType: "json",
        beforeSend: function () {
            $("#tab_2_loading").show()
            $("#tab_2_alerts").hide()
        },
        error: function () {
            $("#tab_2_loading").hide()
            $("#tab_2_alerts").show()
            $("#tab_2_alerts").html("Ocorreu um erro ao tentar conectar-se com o servidor, contate o administrador.") 
        },
        success: function (retorno) {

            $("#tab_2_loading").hide()
            $("#tab_2_alerts").hide()

            if(retorno.length === 0){
                $("#tab_2_alerts").show()
                $("#tab_2_alerts").html("Não há dados cadastrados.")
            }
                var tamanhoPagina = 20;
                var pagina = 0;

                function paginar() {
                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {
                        $("#tab-2-tbody-1").append(
                                $('<tr id="tr' + retorno[i].id + '" onclick="vizualizarEnviadasOuvidoria(' + retorno[i].id + ',2);" data-toggle="modal" data-target="#modal-enviadas">')
                                .append($('<td>').append('<input type="checkbox">&nbsp;&nbsp;Para:&nbsp' + retorno[i].email_destino))
                                .append($('<td>').append('<span class="badge badge-danger">' + retorno[i].tag))
                                .append($('<td>').append('<b>' + retorno[i].assunto + '</b>-' + retorno[i].mensagem_resposta + '...'))
                                .append($('<td>').append('<span class="size-12">' + retorno[i].data))
                                )
                    }
                    $("h3").remove();
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
                            pagina++;
                            paginar();
                            ajustarBotoes();
                        }
                    });
                    $('#anterior').click(function () {

                        if (pagina >= 1) {
                            $("tr").remove();
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

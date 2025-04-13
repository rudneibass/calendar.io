function FormRespostaEsic() {
    var email_destino = $('#email').text();
    var id_ouvidoria = $('#id').text();
    var assunto = $('#assunto').text();

    $('#email_destino_esic').val(email_destino);
    $('#id_esic').val(id_ouvidoria);
    $('#assunto').val(assunto);
    $('.form-resposta-ouvidoria').show("slide");
}



function vizualizarEsic(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMensagensEsic&&action=esic&&id=' + id,
        type: "POST",
        dataType: "json",
        success: function (json) {

            $.each(json, function (field, value) {
                $('#' + field).html(value);
            });

        }
    });
};

function vizualizarEnviadasEsic(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMensagensEsic&&action=vizualizarEnviadasesic&&id=' + id,
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


function salvarRespostaEsic() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMensagensEnviar&&action=salvarResposta',
        type: 'POST',
        data: $('#form-resposta-esic').serialize(),
        success: function (data) {
            if (isNaN(data)) {
                toastr["error"](data);
            } else {
                toastr["success"]('Enviado com sucesso!');
                //enviarResposta();
            }
        }
    });
};



function esic() {
    $("tr").remove();
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMensagensEsic&&action=esic',
        cache: false,
        type: 'POST',
        data: $('#tab-3-form-1').serialize(),
        dataType: "json",
        beforeSend: function () {
            $("#tab_3_loading").show()
            $("#tab_3_alerts").hide()
        },
        error: function () {
            $("#tab_3_loading").hide()
            $("#tab_3_alerts").show()
            $("#tab_3_alerts").html("Ocorreu um erro ao tentar conectar-se com o servidor, contate o administrador.") 
        },
        success: function (retorno) {

            $("#tab_3_loading").hide()
            $("#tab_3_alerts").hide()

            if(retorno.length === 0){
                $("#tab_3_alerts").show()
                $("#tab_3_alerts").html("Não há dados cadastrados.")
            }


                var tamanhoPagina = 20;
                var pagina = 0;

                function paginar() {
                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {
                        if (retorno[i].status != '1') {
                            $("#tab-3-tbody-1").append(
                                    $('<tr id="tr' + retorno[i].id + '" style="font-weight: bold"" onclick="vizualizarEsic(' + retorno[i].id + ');changeStatusEsic(' + retorno[i].id + ')" data-toggle="modal" data-target="#modal-esic">')
                                    .append($('<td>').append('<input type="checkbox">&nbsp;&nbsp;Protocolo:&nbsp' + retorno[i].id))
                                    .append($('<td style="text-align: center; width: 10%">').append('<span class="badge badge-danger">&emsp;#e-sic&emsp;</span>'))
                                    .append($('<td style="width: 60%">').append('<i id="i' + retorno[i].id + '" class="fa fa-bookmark" style="color: #F7CA4C"></i>&nbsp;' + retorno[i].cpfcnpj))
                                    .append($('<td>').append(retorno[i].tipo_solicitacao))
                                    .append($('<td>').append('<span class="size-12">' + retorno[i].data_cadastro_formatada))
                                    )
                        } else {
                            $("#tab-3-tbody-1").append(
                                    $('<tr id="tr' + retorno[i].id + '" style="background-color: #F4F7F7 " onclick="vizualizarEsic(' + retorno[i].id + ');" data-toggle="modal" data-target="#modal-esic">')
                                    .append($('<td>').append('<input type="checkbox">&nbsp;&nbsp;Protocolo:&nbsp' + retorno[i].id))
                                    .append($('<td style="text-align: center; width: 10%">').append('<span class="badge badge-danger">&emsp;#e-sic&emsp;</span>'))
                                    .append($('<td style="width: 60%">').append('<i class="fa fa-bookmark-o" style="color: #D6D6D6"></i>&nbsp;' + retorno[i].cpfcnpj))
                                    .append($('<td>').append(retorno[i].tipo_solicitacao))
                                    .append($('<td>').append('<span class="size-12">' + retorno[i].data_cadastro_formatada))
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

                $("#loading_esic").hide();
        }
    });
}


function respostasEsic() {
    $("tr").remove();
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMensagensEsic&&action=respostasEsic',
        cache: false,
        type: 'POST',
        data: $('#tab-4-form-1').serialize(),
        dataType: "json",
        beforeSend: function () {
            $("#tab_4_loading").show()
            $("#tab_4_alerts").hide()
        },
        error: function () {
            $("#tab_4_loading").hide()
            $("#tab_4_alerts").show()
            $("#tab_4_alerts").html("Ocorreu um erro ao tentar conectar-se com o servidor, contate o administrador.") 
        },
        success: function (retorno) {

            $("#tab_4_loading").hide()
            $("#tab_4_alerts").hide()

            if(retorno.length === 0){
                $("#tab_4_alerts").show()
                $("#tab_4_alerts").html("Não há dados cadastrados.")
            }
            
                var tamanhoPagina = 20;
                var pagina = 0;

                function paginar() {
                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {            
                        $("#tab-4-tbody-1").append(
                            $('<tr id="tr' + retorno[i].id + '" onclick="vizualizarEnviadasEsic(' + retorno[i].id + ',2);" data-toggle="modal" data-target="#modal-enviadas">')
                            .append($('<td>').append('<input type="checkbox" />&nbsp;&nbsp;Protocolo:&nbsp' + retorno[i].id_ouvidoria))
                            .append($('<td style="text-align: center; width: 10%">').append('<span class="badge badge-danger">&emsp;#e-sic&emsp;</span>'))
                            .append($('<td style="width: 60%">').append(retorno[i].mensagem_resposta + '...'))
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
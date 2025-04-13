function respostaOuvidoria() {
    var email_destino = $('#o_email').text();
    var id_ouvidoria = $('#o_id').text();
    
    $('#email_destino').val(email_destino);
    $('#id_ouvidoria').val(id_ouvidoria);   
    $('.form-resposta').show("slide");
}


function vizualizarOuvidoria(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerCaixaDeEntrada&&action=ouvidoria&&id=' + id,
        type: "POST",
        dataType: "json",
        success: function (json) {
            
            $.each(json, function (field, value) {
            
            if($('#'+field).attr('type') == 'input'){
                $('#' + field).val(value);
            }
            else{
                $('#' + field).html(value);
            }
            });
            
        }
    });
};


function vizualizarEsic(id) {
    $.ajax({
        url: "home_controller.php?act=vizualizar-esic",
        type: "POST",
        data: {id: id, tbl: 'ouvidoria'},
        success: function (data) {
            $("#modal-body").html(data);
        },
    });
}
;

function vizualizarEnviadas(id, tbl) {
    $.ajax({
        url: "home_controller.php?act=vizualizar-enviadas",
        type: "POST",
        data: {id: id, tbl: tbl},
        success: function (data) {
            $("#modal-body").html(data);
        },
    });
}
;

function salvarResposta() {
    $.ajax({
        url: 'home_controller.php?act=insert',
        type: 'POST',
        data: $('#form-resposta').serialize(),
        success: function (data) {
            if (isNaN(data)) {
                toastr["error"](data);
            } else {
                enviarResposta();
            }
        }
    });
};

function enviarResposta() {
    $.ajax({
        url: "ouvidoria/enviarResposta.php",
        type: 'POST',
        data: $('#form-resposta').serialize(),
        beforeSend: function (){ toastr["info"]("Aguarde...")},
        success: function (data) {
            $('.toast-info').hide();
            toastr["success"](data);
        },
    })
}


function ouvidoria() {
    $("tr").remove();
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerCaixaDeEntrada&&action=ouvidoria',
        cache: false,
        type: 'POST',
        data: $('#tab-1-form-1').serialize(),
        dataType: "json",
        beforeSend: function () {
            $("#tab-1-js-messages").html("<div class='w-100 text-center' style='padding-top: 100px;'><img class='m-auto' src='../img/loading-md.svg'/> <h6 class='text-muted text-center'>Carregando...</h6></div>"); 
        },
        error: function () {
            $("#tab-1-js-messages").html("<div class='w-100 text-center' style='padding-top: 100px;'><h6 class='text-muted text-center'>Erro na conexão!</h6></div>"); 
        },
        success: function (retorno) {
            if (retorno[0].erro) {
                $("#tab-1-js-messages").html(retorno[0].erro);
            } else {

                var tamanhoPagina = 20;
                var pagina = 0;

                function paginar() {
                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {
                        if (retorno[i].o_status != '1') {
                            $("#tab-1-tbody-1").append(
                                    $('<tr id="tr' + retorno[i].o_id + '" style="font-weight: bold" onclick="vizualizarOuvidoria(' + retorno[i].o_id + ');changeStatus(' + retorno[i].o_id + ')" data-toggle="modal" data-target="#modal-ouvidoria">')
                                    .append($('<td>').append('<input type="checkbox">&nbsp;&nbsp;Protocolo:&nbsp' + retorno[i].o_id))
                                    .append($('<td>').append('<span class="badge badge-primary">#ouvidoria</span>'))
                                    .append($('<td>').append('<i id="i' + retorno[i].o_id + '" class="fa fa-bookmark" style="color: #F7CA4C"></i>&nbsp;' + retorno[i].o_nome))
                                    .append($('<td>').append(retorno[i].o_assunto))
                                    .append($('<td>').append('<span class="size-12">' + retorno[i].o_data_formatada))
                                    )
                        } else {
                            $("#tab-1-tbody-1").append(
                                    $('<tr id="tr' + retorno[i].o_id + '" style="background-color: #F4F7F7;"  onclick="vizualizarOuvidoria(' + retorno[i].o_id + ');" data-toggle="modal" data-target="#modal-ouvidoria">')
                                    .append($('<td>').append('<input type="checkbox">&nbsp;&nbsp;Protocolo:&nbsp' + retorno[i].o_id))
                                    .append($('<td>').append('<span class="badge badge-primary">#ouvidoria</span>'))
                                    .append($('<td>').append('<i class="fa fa-bookmark-o" style="color: #D6D6D6"></i>&nbsp;' + retorno[i].o_nome))
                                    .append($('<td>').append(retorno[i].o_assunto))
                                    .append($('<td>').append('<span class="size-12">' + retorno[i].o_data_formatada))
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
        }
    });
}


function esic() {
    $("tr").remove();
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerCaixaDeEntrada&&action=esic',
        cache: false,
        type: 'POST',
        data: $('#tab-2-form-1').serialize(),
        dataType: "json",
        beforeSend: function () {
            $("#tab-2-js-messages").html("<div class='w-100 text-center' style='padding-top: 100px;'><img class='m-auto' src='../img/loading-md.svg'/> <h6 class='text-muted text-center'>Carregando...</h6></div>"); 
        },
        error: function () {
            $("#tab-2-js-messages").html("<div class='w-100 text-center' style='padding-top: 100px;'><h6 class='text-muted text-center'>Erro de conexão!</h6></div>"); 
        },
        success: function (retorno) {
            if (retorno[0].erro) {
                $("#echos").html(retorno[0].erro);
            } else {

                var tamanhoPagina = 20;
                var pagina = 0;

                function paginar() {
                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {
                        if (retorno[i].status != '1') {
                            $("#tab-2-tbody-1").append(
                                    $('<tr id="tr' + retorno[i].id + '" style="font-weight: bold"" onclick="vizualizarEsic(' + retorno[i].id + ');changeStatusEsic(' + retorno[i].id + ')" data-toggle="modal" data-target="#exampleModal">')
                                    .append($('<td>').append('<input type="checkbox">&nbsp;&nbsp;Protocolo:&nbsp' + retorno[i].id))
                                    .append($('<td>').append('<span class="badge badge-danger">&emsp;#e-sic&emsp;</span>'))
                                    .append($('<td>').append('<i id="i' + retorno[i].id + '" class="fa fa-bookmark" style="color: #F7CA4C"></i>&nbsp;' + retorno[i].cpfcnpj))
                                    .append($('<td>').append(retorno[i].tipo_solicitacao))
                                    .append($('<td>').append('<span class="size-12">' + retorno[i].data_cadastro_formatada))
                                    )
                        } else {
                            $("#tab-2-tbody-1").append(
                                    $('<tr id="tr' + retorno[i].id + '" style="background-color: #F4F7F7 " onclick="vizualizarEsic(' + retorno[i].id + ');" data-toggle="modal" data-target="#exampleModal">')
                                    .append($('<td>').append('<input type="checkbox">&nbsp;&nbsp;Protocolo:&nbsp' + retorno[i].id))
                                    .append($('<td>').append('<span class="badge badge-danger">&emsp;#e-sic&emsp;</span>'))
                                    .append($('<td>').append('<i class="fa fa-bookmark-o" style="color: #D6D6D6"></i>&nbsp;' + retorno[i].cpfcnpj))
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
            }
        }
    });
}


function enviadas() {
    $("tr").remove();
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerCaixaDeEntrada&&action=enviadas',
        cache: false,
        type: 'POST',
        data: $('#tab-3-form-1').serialize(),
        dataType: "json",
        beforeSend: function () {
            $("#tab-3-js-messages").html("<div class='w-100 text-center' style='padding-top: 100px;'><img class='m-auto' src='../img/loading-md.svg'/> <h6 class='text-muted text-center'>Carregando...</h6></div>"); 
        },
        error: function () {
            $("#tab-2-js-messages").html("<div class='w-100 text-center' style='padding-top: 100px;'> <h6 class='text-muted text-center'>Erro de conexão!</h6></div>"); 
        },
        success: function (retorno) {
            if (retorno[0].erro) {
                $("#echos").html(retorno[0].erro);
            } else {

                var tamanhoPagina = 20;
                var pagina = 0;

                function paginar() {
                    var tbody = $('table > tbody');
                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {
                        if (retorno[i].tag != '#ouvidoria') {
                            $("#tab-3-tbody-1").append(
                                    $('<tr id="tr' + retorno[i].id + '" onclick="vizualizarEnviadas(' + retorno[i].id + ',2);" data-toggle="modal" data-target="#exampleModal">')
                                    .append($('<td>').append('<input type="checkbox">&nbsp;&nbsp;Para:&nbsp' + retorno[i].email_destino))
                                    .append($('<td>').append('<span class="badge badge-danger">' + retorno[i].tag))
                                    .append($('<td>').append('<b>' + retorno[i].assunto + '</b>-' + retorno[i].mensagem_resposta + '...'))
                                    .append($('<td>').append('<span class="size-12">' + retorno[i].data))
                                    )
                        } else {
                            $("#tab-3-tbody-1").append(
                                    $('<tr id="tr' + retorno[i].id + '" style="background-color: #F4F7F7 " onclick="vizualizarEnviadas(' + retorno[i].id + ',1);" data-toggle="modal" data-target="#exampleModal">')
                                    .append($('<td>').append('<input type="checkbox">&nbsp;&nbsp;Para:&nbsp' + retorno[i].email_destino))
                                    .append($('<td>').append('<span class="badge badge-primary">' + retorno[i].tag))
                                    .append($('<td>').append('<b>' + retorno[i].assunto + '</b>-' + retorno[i].mensagem_resposta + '...'))
                                    .append($('<td>').append('<span class="size-12">' + retorno[i].data))
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
        }
    });
}

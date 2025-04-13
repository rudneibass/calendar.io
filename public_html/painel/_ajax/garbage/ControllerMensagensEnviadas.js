
function vizualizarEnviadasEsic(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMensagensEnviadas&&action=vizualizarEnviadasEsic&&id=' + id,
        type: "POST",
        success: function (data) {
            $('#modal-body-enviadas').html(data);
        }
    });
}
;

function vizualizarEnviadasOuvidoria(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMensagensEnviadas&&action=vizualizarEnviadasOuvidoria&&id=' + id,
        type: "POST",
        success: function (data) {
            $('#modal-body-enviadas').html(data);
        }
    });
}
;


function enviadas() {
    $("tr").remove();
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMensagensEnviadas&&action=enviadas',
        cache: false,
        type: 'POST',
        data: $('#tab-3-form-1').serialize(),
        dataType: "json",
        beforeSend: function () {
            $("#loading_enviadas").show()
        },
        error: function () {
            $("#loading_enviadas").hide()
            $("#alert_enviadas").html("Erro 500");
        },
        success: function (retorno) {
            $("#loading_enviadas").hide()
            if (retorno[0].erro) {
                $("#alert_enviadas").html(retorno[0].erro);
            } else {
                var tamanhoPagina = 20;
                var pagina = 0;

                function paginar() {
                    var tbody = $('table > tbody');
                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {
                        if (retorno[i].tag != '#ouvidoria') {
                            $("#tab-3-tbody-1").append(
                                    $('<tr id="tr' + retorno[i].id + '" onclick="vizualizarEnviadasEsic(' + retorno[i].id + ',2);" data-toggle="modal" data-target="#modal-enviadas">')
                                    .append($('<td>').append('<input type="checkbox">&nbsp;&nbsp;Para:&nbsp' + retorno[i].email_destino))
                                    .append($('<td>').append('<span class="badge badge-danger">' + retorno[i].tag))
                                    .append($('<td>').append('<b>' + retorno[i].assunto + '</b>-' + retorno[i].mensagem_resposta + '...'))
                                    .append($('<td>').append('<span class="size-12">' + retorno[i].data))
                                    )
                        } else {
                            $("#tab-3-tbody-1").append(
                                    $('<tr id="tr' + retorno[i].id + '" style="background-color: #F4F7F7 " onclick="vizualizarEnviadasOuvidoria(' + retorno[i].id + ',1);" data-toggle="modal" data-target="#modal-enviadas">')
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

                $("#loading_enviadas").hide();
            }
        }
    });
}

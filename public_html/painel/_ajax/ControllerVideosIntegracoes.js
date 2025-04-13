function vizualizar(id) {
    location.href = 'cadastro.php?id=' + id;
}

function populaFormTab2Form1(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerVideosIntegracoes&&action=locate',
        type: 'POST',
        dataType: "json",
        data: {id: id},
        success: function (json) {

            //FAZ AS ALTERAÇÕES NESCESSARIAS NO FORM PARA O MODO DE EDIÇÃO
            $("#tab-2-btn-salvar").css("display", "none");
            $("#tab-2-btn-voltar").css("display", "none");
            $("#tab-2-btn-cancelar").css("display", "block");
            $("#tab-2-btn-salvar-alteracoes").css("display", "block");
            $("#tab-2-btn-salvar-alteracoes").attr('onclick', 'updateTab2Form1(' + id + ')');

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
}
;


function locateTab2Form1() {
    $("tr").remove();
    $('#thead-videos-integracoes').append(
    $('<tr>')
        .append($('<th>').append('Cod'))
        .append($('<th>').append('Plataforma'))
        .append($('<th>').append('Api url'))
        .append($('<th>').append('Api key'))
        .append($('<th>').append('Channel Id'))
    );


    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerVideosIntegracoes&&action=locate',
        cache: false,
        type: 'POST',
        data: $('#search').serialize(),
        dataType: "json",
        beforeSend: function () {
            $("#echos").html("<h6 class='text-muted text-center'>Carregando...</h6>"); //Carregando
        },
        error: function () {
            $("#echos").html("<h6 class='text-muted text-center'>Não foi possivel executar a ação desejada, favor entrar em contato com o administrador.</h6>");
        },
        success: function (retorno) {
            if (!retorno[0]) {
                $("#echos").html("<h6 class='text-muted text-center'>Não há dados cadastrados!</h6>");
            } else {

                var tamanhoPagina = 10;
                var pagina = 0;

                function paginar() {
                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {
                        $("#tbody-videos-integracoes")
                        .append(
                            $('<tr id="linha' + retorno[i].id + '">')
                            .append($('<td width="5%">').append(retorno[i].id))
                            .append($('<td width="10%">').append(retorno[i].platform))
                            .append($('<td>').append(retorno[i].api_url))
                            .append($('<td>').append(retorno[i].api_key))
                            .append($('<td>').append(retorno[i].channel_id))
                            .append($('<td style="width: 5%">').append('<center><button class="btn btn-warning btn-sm" onclick="populaFormTab2Form1(' + retorno[i].id + ')" ><i class="fa fa-pencil"></i></button></center>'))
                            .append($('<td style="width: 5%">').append('<center><button class="btn btn-danger btn-sm"  onclick="deletarTab2Form1(' + retorno[i].id + ', 1)"><i class="fa fa-remove"></i></button></center>'))
                        );
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
                            $('#thead-videos-integracoes').append(
                                $('<tr>')
                                    .append($('<th>').append('Cod'))
                                    .append($('<th>').append('Plataforma'))
                                    .append($('<th>').append('Api url'))
                                    .append($('<th>').append('Api key'))
                                    .append($('<th>').append('Channel Id'))
                                );

                            pagina++;
                            paginar();
                            ajustarBotoes();
                        }
                    });
                    $('#anterior').click(function () {
                        if (pagina >= 1) {
                            $("tr").remove();
                            $('#thead-videos-integracoes')
                            .append(
                                $('<tr>')
                                    .append($('<th>').append('Cod'))
                                    .append($('<th>').append('Plataforma'))
                                    .append($('<th>').append('Api url'))
                                    .append($('<th>').append('Api key'))
                                    .append($('<th>').append('Channel Id'))
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
        }
    });
}

function  updateTab2Form1(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerVideosIntegracoes&&action=update&&id=' + id,
        type: 'POST',
        data: $('#tab-2-form-1').serialize(),
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
                        locateTab2Form1()
                        break;
                    case '0':
                        toastr["success"]("Embora a transação tenha sido efetuada com sucesso você não inseriu nenhum dado novo!");
                        break;
                }
            }
        }
    });
}


function insertTab2Form1() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerVideosIntegracoes&&action=insert',
        type: 'POST',
        data: $('#tab-2-form-1').serialize(),
        beforeSend: function () {
            toastr["info"]("Aguarde, as informções estão sendo salvas no banco de dados!");
        },
        success: function (data) {
            if (!isNaN(data)) {
                $('.toast-info').hide();
                $('#relacionamento').val(data);
                toastr["success"]("Cadastro realizado com sucesso!");
                locateTab2Form1()
            } else {
                $('.toast-info').hide();
                toastr["error"](data);
            }
        }
    });
}

function deletarTab2Form1(id) {
    if (confirm("TEM CERTEZA QUE DESEJA EXCLUIR ESSE REGISTRO?")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerVideosIntegracoes&&action=delete',
            type: "POST",
            data: {id: id},
            success: function (data) {
                $("#linha" + id).remove();
                toastr["success"]("Excluido com sucesso!");
                locateTab2Form1()
            }
        })
    }
}



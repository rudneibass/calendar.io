function vizualizar(id) {
    location.href = 'cadastro.php?id=' + id;
}

function populaForm(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerProcessoSeletivo&&action=locate',
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
            locateTab2Form1(data.id);
            listarArquivos(data.id, data.tbl);
            $("#tab-4-btn-show-modal-upload").attr("onclick", "showModalUpload('modal-upload', 'ControllerUploadMultiplo', 'analisaArquivo', " + data.id + ", \'" + data.tbl + "\')");
            $("#tab-1-btn-salvar").css("display", "none");
            $('#tab-1-btn-salvar-alteracoes').css("display", "block");
            $('#tab-1-btn-salvar-alteracoes').attr("onclick", "update(" + data.id + ")");

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


function locate() {
    $("tr").remove();

    $('#thead').append(
            $('<tr>')
            .append($('<th>').append('Cod'))
            .append($('<th>'))
            .append($('<th>'))
            .append($('<th>'))
            .append($('<th>'))
            );

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerProcessoSeletivo&&action=locate',
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

            if (!retorno[0]) {
                $("#echos").html("<h6 class='text-muted text-center'>Não há dados cadastrados!</h6>");
            } else {

                var tamanhoPagina = 10;
                var pagina = 0;

                function paginar() {
//                    var tbody = $('table > tbody');

                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {

                        $("#tbody").append(
                                $('<tr id="linha' + retorno[i].id + '">')
                                .append($('<td width="3%">').append(retorno[i].id))
                                .append($('<td>').append('<b>Título: </b>' + retorno[i].titulo + '<br/> <b>Data de Publicação: </b>' + retorno[i].data_publicacao + '<br/> <b>Tipo: </b>' + retorno[i].tipo ))
                                .append($('<td width="5%">').append('<center><button class="btn btn-secondary btn-sm"      onclick="listarArquivos(' + retorno[i].id + ',\'' +  retorno[i].tbl +'\',\'tbody_arquivos_modal\' )"       data-toggle="modal" data-target="#modal-files"><i class="fa fa-file-text"></i></button></center>'))
                                .append($('<td style="width: 5%">').append('<center><button class="btn btn-warning btn-sm" onclick="vizualizar(' + retorno[i].id + ')" ><i class="fa fa-pencil"></i></button></center>'))
                                .append($('<td style="width: 5%">').append('<center><button class="btn btn-danger btn-sm"  onclick="deletar(' + retorno[i].id + ', 1)"><i class="fa fa-remove"></i></button></center>'))
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
                            $('#thead').append(
                                    $('<tr>')
                                    .append($('<th>').append('Cod'))
                                    .append($('<th>'))
                                    .append($('<th>'))
                                    .append($('<th>'))
                                    .append($('<th>'))
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
                                    .append($('<th>'))
                                    .append($('<th>'))
                                    .append($('<th>'))
                                    .append($('<th>'))
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

function  update(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerProcessoSeletivo&&action=update&&id=' + id,
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
            }
        }
    });
}


function insert() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerProcessoSeletivo&&action=insert',
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

                document.getElementById("tab-3-btn-show-modal-upload").addEventListener('click', () =>{
                    showModalUpload('modal-upload', 'ControllerUploadMultiplo', 'analisaArquivo', data , 'processo_seletivo')  
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
            url: '../../_php/Dispatch.php?controller=ControllerProcessoSeletivo&&action=delete',
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



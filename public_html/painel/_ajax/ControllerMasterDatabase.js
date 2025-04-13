function vizualizar(table) {
    location.href = 'table.php?table=' + table
}

function vizualizarColuna(column_name) {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const table = urlParams.get('table')

    location.href = 'column.php?table='+table+'&&column_name=' + column_name
}

function populaForm(table, column_name) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMasterDatabase&&action=showOneColumn&&table='+table+'&&id=' + column_name,
        type: 'POST',
        dataType: "json",
        data: {name: column_name},
        success: function (json) {

            //FAZ AS ALTERAÇÕES NESCESSARIAS NO FORM PARA O MODO DE EDIÇÃO
            var data = jQuery.parseJSON(JSON.stringify(json));
            listarArquivos(data.id, data.tbl);
            $("#tab-2-btn-show-modal-upload").attr("onclick", "showModalUpload('modal-upload', 'ControllerUploadMultiplo', 'analisaArquivo', " + data.id + ", \'" + data.tbl + "\')");
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
            .append($('<th>').append(''))
            .append($('<th>').append('Name'))
            );

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMasterDatabase&&action=locate',
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
            
            console.log(retorno);
            
            if (!retorno[0]) {
                $("#echos").html("<h6 class='text-muted text-center'>Não há dados cadastrados!</h6>");
            } else {

                var tamanhoPagina = 10;
                var pagina = 0;

                function paginar() {
//                    var tbody = $('table > tbody');

                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {

                        $("#tbody").append(
                                $('<tr>')
                                .append($('<td style="width: 5%; text-align: center">').append("<input type='checkbox'/>"))
                                .append($('<td>').append(retorno[i]._tables))
                                .append($('<td width="5%">').append('<center><button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-alter-table" onclick="setTable(\''+retorno[i]._tables+'\')"><i class="fa fa-plus"></i></button></center>'))
                                .append($('<td style="width: 5%">').append('<center><button class="btn btn-warning btn-sm"  onclick="vizualizar(\'' + retorno[i]._tables + '\')"><i class="fa fa-eye"></i></button></center>'))
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
                                .append($('<th>').append(''))
                                .append($('<th>').append('Name'))
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
                                .append($('<th>').append(''))
                                .append($('<th>').append('Name'))
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



function showColumns(table) {
    $("tr").remove();
    $('#thead').append(
            $('<tr>')
            .append($('<th>').append('Name'))
            .append($('<th>').append('Type'))
            .append($('<th>').append('Collation'))
            .append($('<th>').append('Null'))
            .append($('<th>').append('Default'))
            .append($('<th>').append('Extra'))
            );

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMasterDatabase&&action=showColumns',
        cache: false,
        type: 'POST',
        data: {table: table},
        dataType: "json",
        beforeSend: function () {
            $("#echos").html("<h6 class='text-muted text-center'>Carregando...</h6>"); //Carregando
        },
        error: function () {
            $("#echos").html("<h6 class='text-muted text-center'>Não foi possivel executar a ação desejada, favor entrar em contato com o administrador.</h6>");
        },
        success: function (retorno) {
            
            console.log(retorno);
            
            if (!retorno[0]) {
                $("#echos").html("<h6 class='text-muted text-center'>Não há dados cadastrados!</h6>");
            } else {

                var tamanhoPagina = 200;
                var pagina = 0;
                
                function paginar() {


                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {

                        $("#tbody").append(
                                $('<tr>')
                                .append($('<td>').append(retorno[i].Field))
                                .append($('<td>').append(retorno[i].Type))
                                .append($('<td>').append(retorno[i].Collation))
                                .append($('<td>').append(retorno[i].Null))
                                .append($('<td>').append(retorno[i].Default))
                                .append($('<td>').append(retorno[i].Extra))
                                .append($('<td>').append('<center><button class="btn btn-warning btn-sm"  onclick="vizualizarColuna(\'' + retorno[i].Field + '\')"><i class="fa fa-pencil"></i></button></center>'))
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
                                .append($('<th>').append('Name'))
                                .append($('<th>').append('Type'))
                                .append($('<th>').append('Collation'))
                                .append($('<th>').append('Null'))
                                .append($('<th>').append('Default'))
                                .append($('<th>').append('Extra'))
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
                                .append($('<th>').append('Name'))
                                .append($('<th>').append('Type'))
                                .append($('<th>').append('Collation'))
                                .append($('<th>').append('Null'))
                                .append($('<th>').append('Default'))
                                .append($('<th>').append('Extra'))
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


function  modifyColumn(column_name) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMasterDatabase&&action=modifyColumn&&id=' + column_name,
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

function setTable(table){
    $('#tab-1-btn-salvar').attr('onclick', 'createColumn("'+table+'")')
}

function createColumn(table) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMasterDatabase&&action=addColumn&&table='+ table,
        type: 'POST',
        data: $('#tab-1-form-1').serialize(),
        beforeSend: function () {
            toastr["info"]("Aguarde, as informções estão sendo salvas no banco de dados!");
        },
        success: function (data) {
            if (!isNaN(data)) {
                $('.toast-info').hide();
                toastr["success"]("Cadastro realizado com sucesso!");   
            } else {
                $('.toast-info').hide();
                toastr["error"](data);
            }
        }
    });
}

function addTable() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMasterDatabase&&action=addTable',
        type: 'POST',
        data: $('#tab-1-form-1').serialize(),
        beforeSend: function () {
            toastr["info"]("Aguarde, as informções estão sendo salvas no banco de dados!");
        },
        success: function (data) {
            if (!isNaN(data)) {
                $('.toast-info').hide();
                toastr["success"]("Cadastro realizado com sucesso!");   
            } else {
                $('.toast-info').hide();
                toastr["error"](data);
            }
        }
    });
}


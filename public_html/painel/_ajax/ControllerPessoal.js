function populaForm(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerPessoal&&action=locate',
        type: 'POST',
        dataType: "json",
        data: {id: id},
        success: function (json) {

            //FAZ AS ALTERAÇÕES NESCESSARIAS NO FORM PARA O MODO DE EDIÇÃO
            var data = jQuery.parseJSON(JSON.stringify(json));
            $("#tab-1-btn-salvar").css("display", "none");
            $('#tab-1-btn-salvar-alteracoes').css("display","block");
            $('#tab-1-btn-salvar-alteracoes').attr("onclick","update("+data.id+")");

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


function locate(table) {
    $("tr").remove();

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerPessoal&&action=locate&&table='+table,
        cache: false,
        type: 'POST',
        data: $('#search').serialize(),
        dataType: "json",
        beforeSend: function () {
            $("#tab-2-js-messages").html("<h6 class='text-muted text-center'>Carregando...</h6>"); //Carregando
        },
        error: function () {
            $("#tab-2-js-messages").html("<h6 class='text-muted text-center'>Não foi possivel executar a ação desejada, favor entrar em contato com o administrador.</h6>");
        },
        success: function (retorno) {
            if (!retorno[0]) {
                $("#tab-2-js-messages").html("<h6 class='text-muted text-center'>Não há dados cadastrados!</h6>");
            } else {

                var tamanhoPagina = 15;
                var pagina = 0;

                function paginar() {

                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {

                        $("#tbody-"+table).append($('<tr id="linha-'+table+'-'+i+'">'));
                        
                        retorno[i].forEach((item, index) => {
                            var child = document.createElement('td');
                            child.innerHTML = item;
                            document.getElementById('linha-'+table+'-'+i).appendChild(child);
                         })

                    }

                    $("#js-messages-"+table).empty();
                    $('#numeracao-'+table).text('Página ' + (pagina + 1) + ' de ' + Math.ceil(retorno.length / tamanhoPagina));
                }

                function ajustarBotoes() {
                    $('#proximo-'+table).prop('disabled', retorno.length <= tamanhoPagina || pagina >= Math.ceil(retorno.length / tamanhoPagina) - 1);
                    $('#anterior-'+table).prop('disabled', retorno.length <= tamanhoPagina || pagina == 0);
                }

                $(function () {
                    $('#proximo-'+table).click(function () {
                        if (pagina < retorno.length / tamanhoPagina - 1) {
                            $("tr").remove();
                            pagina++;
                            paginar();
                            ajustarBotoes();
                        }
                    });
                    $('#anterior-'+table).click(function () {
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


function  update(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerPessoal&&action=update&&id=' + id,
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

    var form = $('#tab-1-form-1')[0];
    var formData = new FormData(form);

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerPessoal&&action=importar',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            toastr["info"]("Aguarde, as informções estão sendo salvas no banco de dados!");
            //Carregando
            $("#js-messages").html("<img src='../img/loading-sm.svg' width='25'/><small> Importando informações, por favor aguarde...</small>"); 
        },
        success: function (data) {
            if (!isNaN(data)) {
                $('.toast-info').hide();
                $('#relacionamento').val(data);
                toastr["success"]("Cadastro realizado com sucesso!");
                $("#js-messages").empty();
                document.getElementById("tab-1-btn-salvar").disabled = true;
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
            url: '../../_php/Dispatch.php?controller=ControllerPessoal&&action=delete',
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


function folhas() {
    $("tr").remove();

    $('#thead').append(
            $('<tr>')
            .append($('<th>').append('<span class="span-14">Cod.</span>'))
            .append($('<th>').append('<span class="span-14">Competência</span>'))
            .append($('<th>').append('<span class="span-14">Tipo de Folha</span>'))
            .append($('<th>').append('<span class="span-14">Proventos</span>'))
            .append($('<th>').append('<span class="span-14">Descontos</span>'))
            .append($('<th>').append('<span class="span-14">Líquidos</span>'))
            .append($('<th>').append('<center>Vizualizar</center>'))
            .append($('<th>').append('<center>Excluir</center>'))
            )

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerPessoal&&action=getFolhas',
        cache: false,
        type: 'POST',
        data: $('#pesquisa').serialize(),
        dataType: "json",
        beforeSend: function () {
            $("#js-messages").html("<div class='w-100 text-center pt-5'><img class='m-auto' src='../img/loading-sm.svg'/></div><h6 class='text-muted text-center'>Carregando...</h6>"); 
        },
        error: function () {
            $("#js-messages").html("<h6 class='text-muted text-center'>Não foi possivel executar a ação desejada, favor entrar em contato com o administrador.</h6>");
        },
        success: function (retorno) {
            if (!retorno[0]) {
                $("#js-messages").html("<h6 class='text-muted text-center'>Não há dados cadastrados!</h6>");
            } else {

                var tamanhoPagina = 15;
                var pagina = 0;

                function paginar() {

                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {

                        $('#tbody').append(
                                $('<tr id="linha' + retorno[i].id + '">')
                                /*.append($('<td style="width: 15%">').append('<span class="span-14">' + retorno[i].mes))
                                .append($('<td style="width: 15%">').append('<span class="span-14">' + retorno[i].ano))*/
                                .append($('<td>').append('<span class="span-14">' + retorno[i].id))
                                .append($('<td style="width: 15%">').append('<span class="span-14">' + retorno[i].mes_ano))
                                .append($('<td >').append('<span class="span-14">'+ retorno[i].tipo_folha))
                                .append($('<td >').append('<span class="span-14">' + 
                                new Intl.NumberFormat(
                                    'pt-BR', 
                                    {
                                      style: 'currency',
                                      currency: 'BRL',
                                      minimumFractionDigits : 2,
                                    }
                                ).format(retorno[i].proventos) ))
                                .append($('<td>').append('<span class="span-14">' + 
                                new Intl.NumberFormat('pt-BR', {
                                    style: 'currency',
                                    currency: 'BRL',
                                    minimumFractionDigits : 2,
                                  }).format( retorno[i].descontos) 
                                ))
                                .append($('<td>').append('<span class="span-14">' + 
                                    new Intl.NumberFormat(
                                        'pt-BR', 
                                        {
                                          style: 'currency',
                                          currency: 'BRL',
                                          minimumFractionDigits : 2,
                                        }
                                    ).format(retorno[i].liquido) 
                                  ))
                                .append($('<td style="width: 10%">').append('<center><button type="button" onclick="vizualizar(\'' + retorno[i].competencia + '\')" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> </button></center>'))
                                .append($('<td style="width: 5%">').append('<center><button class="btn btn-danger btn-sm"  onclick="deletar(' + retorno[i].id + ', 1)"><i class="fa fa-remove"></i></button></center>'))
                                )

                    }
                    $("#js-messages").empty();
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
                                    .append($('<th>').append('<span class="span-14">Cod.</span>'))
                                    .append($('<th>').append('<span class="span-14">Competência</span>'))
                                    .append($('<th>').append('<span class="span-14">Tipo de Folha</span>'))
                                    .append($('<th>').append('<span class="span-14">Proventos</span>'))
                                    .append($('<th>').append('<span class="span-14">Descontos</span>'))
                                    .append($('<th>').append('<span class="span-14">Líquidos</span>'))
                                    .append($('<th>').append('<center>Vizualizar</center>'))
                                    .append($('<th>').append('<center>Excluir</center>'))
                                    )

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
                                    .append($('<th>').append('<span class="span-14">Cod.</span>'))
                                    .append($('<th>').append('<span class="span-14">Competência</span>'))
                                    .append($('<th>').append('<span class="span-14">Tipo de Folha</span>'))
                                    .append($('<th>').append('<span class="span-14">Proventos</span>'))
                                    .append($('<th>').append('<span class="span-14">Descontos</span>'))
                                    .append($('<th>').append('<span class="span-14">Líquidos</span>'))
                                    .append($('<th>').append('<center>Vizualizar</center>'))
                                    .append($('<th>').append('<center>Excluir</center>'))
                                    )

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

function deletar(id) {
    if (confirm("\u{26A0}\u{FE0F}  TEM CERTEZA QUE DESEJA EXCLUIR ESSE REGISTRO ?")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerPessoal&&action=delete',
            type: "POST",
            data: {id: id},
            success: function (data) {
                $("#linha" + id).remove();
                toastr["success"]("Excluido com sucesso!");
            }
        });
    }
    ;
}

function vizualizar(competencia) {
    location.href = 'detalhe.php?competencia=' + competencia;
}

function detalheFolha(competencia) {
    $("tr").remove();
        $('#thead').append(
            $('<tr>')
            .append($('<th>').append('<span class="span-14">Matricula</span>'))
            .append($('<th>').append('<span class="span-14">Nome</span>'))
            .append($('<th>').append('<span class="span-14">Vínculo</span>'))
            .append($('<th>').append('<span class="span-14">Cargo</span>'))
            .append($('<th>').append('<span class="span-14">Competência</span>'))
            .append($('<th>').append('<span class="span-14">Proventos</span>'))
        )

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerPessoal&&action=getFolhaDetalhes&&competencia='+competencia,
        cache: false,
        type: 'POST',
        data: $('#pesquisa').serialize(),
        dataType: "json",
        beforeSend: function () {
            $("#js-messages").html("<div class='w-100 text-center pt-5'><img class='m-auto' src='../img/loading-sm.svg'/></div><h6 class='text-muted text-center'>Carregando...</h6>"); 
        },
        error: function () {
            $("#js-messagess").html("<h6 class='text-muted text-center'>Não foi possivel executar a ação desejada, favor entrar em contato com o administrador.</h6>");
        },
        success: function (retorno) {
            if (!retorno[0]) {
                $("#js-messages").html("<h6 class='text-muted text-center'>Não há dados cadastrados!</h6>");
            } else {

                var tamanhoPagina = 15;
                var pagina = 0;

                function paginar() {
//                    var tbody = $('table > tbody');

                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {

                        $('#tbody').append(
                                $('<tr id="linha">')
                                .append($('<td style="width: 5%">').append('<span class="span-14">' + retorno[i].matricula))
                                .append($('<td >').append('<span class="span-14">' + retorno[i].nome))
                                .append($('<td >').append('<span class="span-14">' + retorno[i].vinculo))
                                .append($('<td >').append('<span class="span-14">' + retorno[i].cargo))
                                .append($('<td >').append('<span class="span-14">' + retorno[i].competencia))
                                .append($('<td >').append('<span class="span-14">' + 
                                    new Intl.NumberFormat(
                                        'pt-BR', 
                                        {
                                          style: 'currency',
                                          currency: 'BRL',
                                          minimumFractionDigits : 2,
                                        }
                                    ).format(retorno[i].proventos) 
                                ))
                                )

                    }
                    $("#js-messages").empty();
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
                                .append($('<th>').append('<span class="span-14">Matricula</span>'))
                                .append($('<th>').append('<span class="span-14">Nome</span>'))
                                .append($('<th>').append('<span class="span-14">Vínculo</span>'))
                                .append($('<th>').append('<span class="span-14">Cargo</span>'))
                                .append($('<th>').append('<span class="span-14">Competência</span>'))
                                .append($('<th>').append('<span class="span-14">Proventos</span>'))
                                )

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
                                .append($('<th>').append('<span class="span-14">Matricula</span>'))
                                .append($('<th>').append('<span class="span-14">Nome</span>'))
                                .append($('<th>').append('<span class="span-14">Vínculo</span>'))
                                .append($('<th>').append('<span class="span-14">Cargo</span>'))
                                .append($('<th>').append('<span class="span-14">Competência</span>'))
                                .append($('<th>').append('<span class="span-14">Proventos</span>'))
                                )

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

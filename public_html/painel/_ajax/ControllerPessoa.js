function vizualizar(id) {
    location.href = 'cadastro.php?id=' + id;
}

function populaForm(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerPessoa&&action=locate',
        type: 'POST',
        dataType: "json",
        data: {id: id},
        beforeSend: function () {
            $("#tab_1_loading").show()
            $("#tab-1-form-1 :input").prop("disabled", true);
        },
        error: function () {
            $("#tab_1_loading").hide()
            $("#tab_1_alerts").html("Erro no Ajax");
        },
        success: function (json) {

            $("#tab_1_loading").hide()
            $("#tab-1-form-1 :input").prop("disabled", false);

            //FAZ AS ALTERAÇÕES NESCESSARIAS NO FORM PARA O MODO DE EDIÇÃO
            var data = jQuery.parseJSON(JSON.stringify(json));
            locatePessoaVinculo(data.id);
            $("#btn-show-modal-upload").attr("onclick", "showModalUpload('modal-upload-preview-imagem', 'ControllerRedimencionaImagem', 'redimensiona', " + data.id + ", \'" + data.tbl + "\', 'update')");
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
                    if (value != '' && value != null) {
                        t = new Date();
                        $(container + prefix_field + field).attr('src', value + '?' + t.getTime());
                    }else {
                        $(container + prefix_field + field).attr('src', '../../img/cam.jpg'); 
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

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerPessoa&&action=locate',
        cache: false,
        type: 'POST',
        data: $('#search').serialize(),
        dataType: "json",

        beforeSend: function () {
            $("#tab_1_loading").show()
            $("#tab_1_alerts").hide()
            $("#tab-1-form-1 :input").prop("disabled", true);
        },
        error: function () {
            $("#tab_1_loading").hide()
            $("#tab_1_alerts").hide()
            $("#tab_1_alerts").html("Não foi possivel estabelecer conexão com o servidor.");
        },
        success: function (retorno) {
            $("#tab_1_loading").hide()
            $("#tab_1_alerts").hide()

            if (!retorno[0]) {
                $("#tab_1_alerts").show()
               $("#tab_1_alerts").html("Não há dados cadastrados!");
            } else {

                var tamanhoPagina = 20;
                var pagina = 0;

                function paginar() {

                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {

                        if (retorno[i].ativo === 'on') {
                            $("#tbody").append(
                                    $('<tr id="linha' + retorno[i].id + '">')
                                    .append($('<td style="width:5%">').append(retorno[i].id))
                                    .append($('<td style="width:10%; text-align: center">').append('<img src="' + retorno[i].imagem_url + '" alt="" class="img-thumbnail" width="100">'))
                                    .append($('<td>')
                                        .append(
                                            '<b>Nome</b>: '+retorno[i].nome
                                            +'<br/><b>Nome Eleitoral</b>: '+retorno[i].nome_eleitoral
                                            +'<br/><b>Partido</b>: '+retorno[i].partido
                                            +'<br/><span class="badge badge-success">Ativo</span>'
                                        )
                                    )
                                    .append($('<td style="width: 5%">').append('<center><button class="btn btn-warning btn-sm" onclick="vizualizar(' + retorno[i].id + ')" ><i class="fa fa-pencil"></i></button></center>'))
                                    )
                        } else {
                            $("#tbody").append(
                                    $('<tr id="linha' + retorno[i].id + '">')
                                    .append($('<td style="background-color: #ededed; width: 5%">').append("<span class='gray '>"+retorno[i].id))
                                    .append($('<td style="background-color: #ededed; width:10%; text-align: center">').append('<img src="' + retorno[i].imagem_url + '" alt="" class="img-thumbnail" width="100">'))
                                    .append($('<td style="background-color: #ededed">')
                                        .append(
                                            '<b>Nome</b>: '+retorno[i].nome
                                            +'<br/><b>Nome Eleitoral</b>: '+retorno[i].nome_eleitoral
                                            +'<br/><b>Partido</b>: '+retorno[i].partido
                                            +'<br/><span class="badge badge-secondary">Inativo</span>'
                                        )
                                    )
                                    .append($('<td style="background-color: #ededed" style="width: 5%" >').append('<center><button class="btn btn-sm btn-secondary" onclick="vizualizar(' + retorno[i].id + ')" ><i class="fa fa-pencil"></i></button></center>'))
                                    )
                        }




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

function  update(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerPessoa&&action=update&&id=' + id,
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
                        setTimeout(()=> {
                            location.reload(true)
                        }, 1500)
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
        url: '../../_php/Dispatch.php?controller=ControllerPessoa&&action=insert',
        type: 'POST',
        dataType: "json",
        data: $('#tab-1-form-1').serialize(),
        beforeSend: function () {
            toastr["info"]("Aguarde, as informções estão sendo salvas no banco de dados!");
        },
        success: function (json) {

            var data = jQuery.parseJSON(JSON.stringify(json));

            if (data) {
                $('.toast-info').hide();
                $('#relacionamento').val(data.id);
                toastr["success"]("Cadastro realizado com sucesso!");
                document.getElementById("tab-1-btn-salvar").disabled = true;
                $("#btn-show-modal-upload").attr("onclick", "showModalUpload('modal-upload-preview-imagem', 'ControllerRedimencionaImagem', 'redimensiona', " + data.id + ", \'" + data.tbl + "\', 'update')");

                setTimeout(()=> {
                    window.location.href = '?id='+data.id
                }, 1500)

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
            url: '../../_php/Dispatch.php?controller=ControllerPessoa&&action=delete',
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



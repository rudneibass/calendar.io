function insertPessoaVinculo() {
    idServidor = $('#relacionamento').val();
    if (idServidor === '') {
        toastr["info"]('Antes de preencher a aba "Detalhes" preencha a aba "Cadastro" e clique no botão "Salvar" da aba "Cadastro" !');
        return;
    }
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerPessoaVinculo&&action=insert',
        type: 'POST',
        data: $('#tab-2-form-1').serialize(),
        beforeSend: function () {
            toastr["info"]("Aguarde, as informções estão sendo salvas no banco de dados!");
        },
        success: function (data) {
            if (!isNaN(data)) {
                $('.toast-info').hide();
                toastr["success"]("Cadastro realizado com sucesso!");
                locatePessoaVinculo(idServidor);
            } else {
                $('.toast-info').hide();
                toastr["error"](data);
            }
        }
    });
}


function locatePessoaVinculo(id) {
    $("#tbody-pessoa-vinculo").empty();

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerPessoaVinculo&&action=locate',
        cache: false,
        type: 'POST',
        data: {id: id},
        dataType: "json",
        beforeSend: function () {
            $("#echos-pessoa-vinculo").html("<h6 class='text-muted text-center'>Carregando...</h6>"); //Carregando
        },
        error: function () {
            $("#echos-pessoa-vinculo").html("<h6 class='text-muted text-center'>Não foi possivel executar a ação desejada, favor entrar em contato com o administrador.</h6>");
        },
        success: function (retorno) {
            if (!retorno[0]) {
                $("#echos-pessoa-vinculo").html("<h6 class='text-muted text-center'>Não há vínculo cadastrado!</h6>");
            } else {

                $("#echos-pessoa-vinculo").empty();
                var tamanhoPagina = 999;
                var pagina = 0;
                for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {
                    if (retorno[i].vinculo_ativo === 'on') {
                        $("#tbody-pessoa-vinculo").append(
                            $('<tr id="linha' + retorno[i].id + '">')
                                .append($('<td style="width: 5%">').append(retorno[i].id))
                                .append($('<td style="width: 5%">').append(retorno[i].matricula))
                                .append($('<td style="width: 5%">').append(retorno[i].data_ingresso))
                                .append($('<td>').append(retorno[i].nome_cargo))
                                .append($('<td style="width: 5%">').append("<center><span class='badge badge-success'>Ativo</span></center>"))
                                .append($('<td style="width: 5%">').append('<center><button class="btn btn-warning btn-sm" onclick="populaFormPessoaVinculo(' + retorno[i].id + ')" ><i class="fa fa-pencil"></i></button></center>'))
                            );
                    }
                    
                    if (retorno[i].vinculo_ativo === 'off') {
                        $("#tbody-pessoa-vinculo").append(
                            $('<tr id="linha' + retorno[i].id + '">')
                                .append($('<td style="background-color: #ededed; width: 5%">').append(retorno[i].id))
                                .append($('<td style="background-color: #ededed; width: 5%">').append(retorno[i].matricula))
                                .append($('<td style="background-color: #ededed; width: 5%">').append(retorno[i].data_ingresso))
                                .append($('<td style="background-color: #ededed;">').append(retorno[i].nome_cargo))
                                .append($('<td style="background-color: #ededed; width: 5%">').append("<center><span class='badge badge-secondary'>Inativo</span><center>"))
                                .append($('<td style="background-color: #ededed; width: 5%">').append('<center><button class="btn btn-warning btn-sm" onclick="populaFormPessoaVinculo(' + retorno[i].id + ')" ><i class="fa fa-pencil"></i></button></center>'))
                            );                        
                    }

                }
            }
        }
    });
}




function populaFormPessoaVinculo(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerPessoaVinculo&&action=locate&&id=' + id,
        type: 'POST',
        dataType: "json",
        data: {id: id},
        success: function (json) {

            //FAZ AS ALTERAÇÕES NESCESSARIAS NO FORM PARA O MODO DE EDIÇÃO
            var data = jQuery.parseJSON(JSON.stringify(json));
            $("#tab-2-btn-salvar").css("display", "none");
            $("#tab-2-btn-salvar-alteracoes").css("display", "block");
            $("#tab-2-btn-salvar-alteracoes").attr('onclick', 'updatePessoaVinculo(' + id + ')');

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

function  updatePessoaVinculo(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerPessoaVinculo&&action=update&&id=' + id,
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
                        break;
                    case '0':
                        toastr["success"]("Embora a transação tenha sido efetuada com sucesso você não inseriu nenhum dado novo!");
                        break;
                }

                idServidor = $('#relacionamento').val();
                locatePessoaVinculo(idServidor);
            }
        }
    });
}



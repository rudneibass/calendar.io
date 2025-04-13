function insertTab2Form1() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerProcessoSeletivoFases&&action=insert',
        type: 'POST',
        data: $('#tab-2-form-1').serialize(),
        beforeSend: function () {
            toastr["info"]("Aguarde, as informções estão sendo salvas no banco de dados!");
        },
        success: function (data) {
            if (!isNaN(data)) {
                $('.toast-info').hide();
                toastr["success"]("Cadastro realizado com sucesso!");
                key = $('#relacionamento').val();
                locateTab2Form1(key);
            } else {
                $('.toast-info').hide();
                toastr["error"](data);
            }
        }
    });
}


function locateTab2Form1(id) {
    $("#tab-2-tbody-1").empty();
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerProcessoSeletivoFases&&action=locate',
        cache: false,
        type: 'POST',
        data: {id: id},
        dataType: "json",
        beforeSend: function () {
            $("#tab-2-echos-1").html("<h6 class='text-muted text-center'>Carregando...</h6>"); //Carregando
        },
        error: function () {
            $("#tab-2-echos-1").html("<h6 class='text-muted text-center'>Não foi possivel executar a ação desejada, favor entrar em contato com o administrador.</h6>");
        },
        success: function (retorno) {
            if (!retorno[0]) {
                $("#tab-2-echos-1").html("<h6 class='text-muted text-center'>Não há vínculo cadastrado!</h6>");
            } else {

                $("#tab-2-echos-1").empty();

                var tamanhoPagina = 999;
                var pagina = 0;
                for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {
                    $("#tab-2-tbody-1").append(
                            $('<tr id="linha' + retorno[i].id + '">')
                            .append($('<td style="width: 5%">').append(retorno[i].id))
                            .append($('<td>').append(retorno[i].fase))
                            .append($('<td>').append(retorno[i].data_fase))
                            .append($('<td>').append(retorno[i].hora_fase))
                            .append($('<td>').append('<center><button class="btn btn-warning btn-sm" onclick="populaFormTab2Form1(' + retorno[i].id + ')" ><i class="fa fa-pencil"></i></button></center>'))
                            );
                }
            }
        }
    });
}




function populaFormTab2Form1(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerProcessoSeletivoFases&&action=locate&&id=' + id,
        type: 'POST',
        dataType: "json",
        data: {id: id},
        success: function (json) {

            //FAZ AS ALTERAÇÕES NESCESSARIAS NO FORM PARA O MODO DE EDIÇÃO
            var data = jQuery.parseJSON(JSON.stringify(json));
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

function  updateTab2Form1(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerProcessoSeletivoFases&&action=update&&id=' + id,
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
            }
        }
    });
}



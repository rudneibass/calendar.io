function insertTab3Form1() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMateriasFases&&action=insert',
        type: 'POST',
        data: $('#tab-3-form-1').serialize(),
        beforeSend: function () {
            toastr["info"]("Aguarde, as informções estão sendo salvas no banco de dados!");
        },
        success: function (data) {
            if (!isNaN(data)) {
                $('.toast-info').hide();
                toastr["success"]("Cadastro realizado com sucesso!");
                key = $('#relacionamento').val();
                locateTab3Form1(key);
            } else {
                $('.toast-info').hide();
                toastr["error"](data);
            }
        }
    });
}


function locateTab3Form1(id) {
    $("#tab-3-tbody-1").empty();

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMateriasFases&&action=locate',
        cache: false,
        type: 'POST',
        data: {id: id},
        dataType: "json",
        beforeSend: function () {
            $("#tab-3-echos-1").html("<h6 class='text-muted text-center'>Carregando...</h6>"); //Carregando
        },
        error: function () {
            $("#tab-3-echos-1").html("<h6 class='text-muted text-center'>Não foi possivel executar a ação desejada, favor entrar em contato com o administrador.</h6>");
        },
        success: function (retorno) {
            if (!retorno[0]) {
                $("#tab-3-echos-1").html("<h6 class='text-muted text-center'>Não há fases cadastradas!</h6>");
            } else {

                $("#tab-3-echos-1").empty();

                var tamanhoPagina = 999;
                var pagina = 0;
                for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {
                    $("#tab-3-tbody-1")
                        .append(
                            $('<tr id="linha' + retorno[i].id + '">')
                            .append($('<td style="width: 5%">').append(retorno[i].id))
                            .append($('<td>').append(retorno[i].fase))
                            .append($('<td>').append('<small class="text-muted">'+retorno[i].descricao))
                            .append($('<td>').append(retorno[i].data_fase))
                            .append($('<td>').append(retorno[i].hora_fase))
                            .append($('<td width="5%">').append('<center><button class="btn btn-secondary btn-sm" onclick="listarArquivos(' + retorno[i].id + ', \'materias_fases\',\'tbody_arquivos_modal\')" data-toggle="modal" data-target="#modal-files"><i class="fa fa-file-text"></i></button></center>'))
                            .append($('<td width="5%">').append('<center><button type="button" class="btn btn-sm btn-info ml-2" id="tab-4-btn-show-modal-upload" onclick="showModalUpload(\'modal-upload\', \'ControllerUploadMultiplo\', \'analisaArquivo\', '+retorno[i].id+', \'materias_fases\')"><i class="fa fa-cloud-upload"></i></button>'))
                            .append($('<td style="width: 5%">').append('<center><button class="btn btn-warning btn-sm" onclick="populaFormTab3Form1(' + retorno[i].id + ')" ><i class="fa fa-pencil"></i></button></center>'))
                            .append($('<td style="width: 5%">').append('<center><button class="btn btn-danger btn-sm"  onclick="deletarTab3Form1(' + retorno[i].id + ', 1)"><i class="fa fa-remove"></i></button></center>'))
                    );
                }
            }
        }
    });
}




function populaFormTab3Form1(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMateriasFases&&action=locate&&id=' + id,
        type: 'POST',
        dataType: "json",
        data: {id: id},
        success: function (json) {

            //FAZ AS ALTERAÇÕES NESCESSARIAS NO FORM PARA O MODO DE EDIÇÃO
            var data = jQuery.parseJSON(JSON.stringify(json));
            $("#tab-3-btn-salvar").css("display", "none");
            $("#tab-3-btn-voltar").css("display", "none");
            $("#tab-3-btn-cancelar").css("display", "block");
            $("#tab-3-btn-salvar-alteracoes").css("display", "block");
            $("#tab-3-btn-salvar-alteracoes").attr('onclick', 'updateTab3Form1(' + id + ')');


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

function  updateTab3Form1(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMateriasFases&&action=update&&id=' + id,
        type: 'POST',
        data: $('#tab-3-form-1').serialize(),
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
                        locateTab3Form1($('#tab_3_form_1_relacionamento').val())
                        break;
                    case '0':
                        toastr["success"]("Embora a transação tenha sido efetuada com sucesso você não inseriu nenhum dado novo!");
                        break;
                }
            }
        }
    });
}


function deletarTab3Form1(id) {
    if (confirm("\u{26A0}\u{FE0F} TEM CERTEZA QUE DESEJA EXCLUIR ESSE REGISTRO?")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerMateriasFases&&action=delete',
            type: "POST",
            data: {id: id},
            success: function (data) {
                $("#linha" + id).remove();
                toastr["success"]("Excluido com sucesso!")
                
                locateTab3Form1($('#tab_3_form_1_relacionamento').val())
            }
        });
    }
    ;
}
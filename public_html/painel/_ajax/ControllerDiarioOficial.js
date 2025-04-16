let mesAtual = new Date().getMonth() + 1; // Mês atual (1-12)
let anoAtual = new Date().getFullYear(); // Ano atual

$(document).ready(function() { carregarCalendario(0) })

function carregarCalendario(incremento) {
    mesAtual += incremento;
    if (mesAtual < 1) {
        mesAtual = 12;
        anoAtual--;
    } else if (mesAtual > 12) {
        mesAtual = 1;
        anoAtual++;
    }
    // Faz requisição AJAX para obter o HTML do calendário
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerDiarioOficial&&action=locate',
        method: 'GET',
        data: { mes: mesAtual, ano: anoAtual },
        beforeSend: function() {
            $('.loading').show();
        },
        success: function(response) {
            $('.loading').hide();
            $('#calendario').html(response);
            let data = new Date(anoAtual, mesAtual - 1).toLocaleString('pt-BR', { month: 'long', year: 'numeric' });
            data = data.charAt(0).toUpperCase() + data.slice(1);
            $('#mesAno').text(data);
        }
    });
}

function abrirModal(modalId, data) {
    $('#' + modalId).modal('show');
    $('#' + modalId).find('input[type="date"]').val(data);
}

function checkDia(dia) {
    const elemento = document.getElementById(dia);
    if (elemento) {
        elemento.classList.toggle('selecionado');
    } else {
        console.warn('Elemento com id "' + dia + '" não encontrado.');
    }
}


function insert() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerDiarioOficial&&action=insert',
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
                document.getElementById("tab-2-btn-show-modal-upload").addEventListener('click', () =>{
                    showModalUpload('modal-upload', 'ControllerUploadMultiplo', 'analisaArquivo', data , 'publicacoes')  
                });

                const dataPublicacao = document.getElementById("data_publicacao").value;
                if (dataPublicacao) {
                    const data = new Date(dataPublicacao);
                    const mes = data.getMonth() + 1;
                    const ano = data.getFullYear();
                    const incremento = (ano - anoAtual) * 12 + (mes - mesAtual);
                    carregarCalendario(incremento);
                }
            } else {
                $('.toast-info').hide();
                toastr["error"](data);
            }
        }
    });
}

function populaForm(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerDiarioOficial&&action=locate',
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

function  update(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerDiarioOficial&&action=update&&id=' + id,
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
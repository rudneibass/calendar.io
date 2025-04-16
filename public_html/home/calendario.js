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
    $.ajax({
        url: 'dispatch.php?controller=MessageController&&action=locate',
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
        url: '../../_php/Dispatch.php?controller=MessageController&&action=insert',
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
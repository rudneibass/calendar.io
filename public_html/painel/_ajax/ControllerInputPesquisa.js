////////////////////////////////////   
//         INPUT PESQUISA         //
////////////////////////////////////
var params = {
    table: '',
    modal_title: '',
    classe_elemento_recebe_codigo: '',
    classe_elemento_exibe_descricao: '',
}

$(".f2").keydown(function (e) {
    if (e.key == "F2") {
        var label = $(this).data('label');
        table = $(this).data('tbl');

        $('#modal-input-pesquisa').modal('show');
        $('#buscarPor').text(label);
        inputSearch();
    }
});


function showModal({
    table, 
    modal_title , 
    classe_elemento_recebe_codigo,
    classe_elemento_exibe_descricao
}) {
    $('#tbody-input-pesquisa').empty()
    $('#modal-input-pesquisa').modal('show');
    $('#buscarPor').text(modal_title);
    params.table = table;
    params.modal_title = modal_title;
    params.classe_elemento_recebe_codigo = classe_elemento_recebe_codigo
    params.classe_elemento_exibe_descricao = classe_elemento_exibe_descricao
    inputSearch();
}

function inputSearch() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerInputPesquisa&&action=inputPesquisa&&tbl=' + params.table,
        cache: false,
        type: 'POST',
        data: $('#form-input-pesquisa').serialize(),
        dataType: "json",
        beforeSend: function () {
            $("#echos-input-pesquisa").empty();
            $('#tbody-input-pesquisa').empty();
            $("#echos-input-pesquisa").html("<h6 class='text-muted text-center'>Carregando...</h6>");
        },
        error: function () {
            $("#echos-input-pesquisa").html("<h6 class='text-muted text-center'>Não foi possivel executar a ação desejada, entre em contato com o administrador!</h6>");
        },
        success: function (retorno) {

            $("#echos-input-pesquisa").empty();
            $('#tbody-input-pesquisa').empty();
            $('#thead-input-pesquisa').empty();
            $('#thead-input-pesquisa').append($('<tr>').append($('<th>').append('Cod')).append($('<th>').append('Nome')).append($('<th>').append('Selecionar')));

            if (!retorno[0]) {
                $("#echos-input-pesquisa").html("<h6 class='text-muted text-center'>Não há dados cadastrados!</h6>");
            } else {
                for (var i = 0; i < retorno.length; i++) {
                    $("#tbody-input-pesquisa").append(
                        $('<tr id="linha">')
                        .append($('<td>').append(retorno[i].id))
                        .append($('<td class="td-nome">')
                        .append('<small>'
                            +retorno[i].descricao
                        ))
                        .append($('<td style="width: 5%;">')
                        .append(
                            `<center>
                                <input 
                                    type="checkbox" 
                                    id="${retorno[i].id}" 
                                    name="${retorno[i].descricao}" 
                                > 
                            </center>`
                        ))
                    );
                }
            }
        }
    });


    var el = document.getElementById('tbody-input-pesquisa');
    el.addEventListener('click', function (e) {
        $("."+params.classe_elemento_recebe_codigo).val(e.target.id);
        $("."+params.classe_elemento_exibe_descricao).val(e.target.name);
        $("#modal-input-pesquisa").modal('hide');
    }); 
}


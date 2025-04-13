////////////////////////////////////   
//         INPUT PESQUISA         //
////////////////////////////////////
var table;

$(".f2").keydown(function (e) {
    if (e.key == "F2") {
        var label = $(this).data('label');
        table = $(this).data('tbl');

        $('#modal-input-pesquisa').modal('show');
        $('#buscarPor').text(label);
        inputSearch();
    }
});


function showModal(tbl, label) {
    $('#tbody-input-pesquisa').empty()
    $('#modal-input-pesquisa').modal('show');
    $('#buscarPor').text(label);
    table = tbl;
    inputSearch();
}
;

function inputSearch() {
    $.ajax({
        url: '../_interfaceController/InterfaceControllerInputPesquisa.php?action=inputPesquisa&&tbl=' + table,
        cache: false,
        type: 'POST',
        data: $('#form-input-pesquisa').serialize(),
        dataType: "json",
        beforeSend: function () {
            $("#echos-input-pesquisa").html("<h6 class='text-muted text-center'>Carregando...</h6>"); //Carregando
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
                    console.log(retorno);
                    $("#tbody-input-pesquisa").append(
                            $('<tr id="linha">')
                            .append($('<td>').append(retorno[i].id))
                            .append($('<td class="td-nome">').append(retorno[i].nome))
                            .append($('<td style="width: 5%">').append('<center><input type="checkbox" id="' + retorno[i].id + '" name="' + retorno[i].nome + '"></center>'))
                            );
                }

            }

        }
    });

    var el = document.getElementById('tbody-input-pesquisa');
    el.addEventListener('click', function (e) {
        var aid = e.target.id;
        var descricao = e.target.name;
        $(".exibe_codigo_" + table).val(aid);
        $(".exibe_descricao_" + table).val(descricao);
        $("#modal-input-pesquisa").modal('hide');
    });
}


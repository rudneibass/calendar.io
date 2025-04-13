function listarImagens(fk, tbl) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerListarArquivos&&action=listarImagens',
        cache: false,
        type: 'POST',
        data: {id_tabela_pai: fk, tabela_pai: tbl},
        beforeSend: function () {
            $("#lista-de-imagens").html("<h6 class='text-muted m-auto'>Carregando...</h6>");
        },
        error: function () {
            $("#lista-de-imagens").html("<h6 class='text-muted m-auto'>Não foi possivel executar a ação desejada, favor entrar em contato com o administrador.</h6>");
        },
        success: function (data) {
            if (!data[0]) {
                $("#lista-de-imagens").html("<h6 class='text-muted m-auto'>Não há envio de imagens!</h6>");
            } else {
                $('#lista-de-imagens').html(data);
            }
        }
    });
}
;

function deletarImagem(id, fk, tbl) {
    if (confirm("TEM CERTEZA QUE DESEJA EXCLUIR ESSE REGISTRO?")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerListarArquivos&&action=deletarImagem',
            type: "POST",
            data: {id_tabela_pai: id},
            success: function (data) {
                toastr["success"]("Excluido com sucesso!")
                listarImagens(fk, tbl);
            }
        });
    }
    ;
}


function listarArquivos(id) {
    $("#id-tabela-pai-form-search-arquivos").val(id);
    $('#pesquisar-arquivos').attr("onclick", "listarArquivos(" + id + ")");
    $("#tbody-arquivos").empty();
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerListarArquivos&&action=listarArquivos',
        cache: false,
        type: 'POST',
        data: $('#search-arquivos').serialize(), //{id_tabela_pai: id},
        dataType: "json",
        beforeSend: function () {
            $("#echos-arquivos").html("<h6 class='text-muted text-center'>Carregando...</h6>"); //Carregando
        },
        error: function () {
            $("#echos-arquivos").html("<h6 class='text-muted text-center'>Não foi possivel executar a ação desejada, favor entrar em contato com o administrador.</h6>");
        },
        success: function (retorno) {
            if (!retorno[0]) {
                $("#echos-arquivos").html("<h6 class='text-muted text-center'>Não envio de arquivo para esse registro!</h6>");
            } else {

                var tamanhoPagina = 10;
                var pagina = 0;

                function paginar() {
//                    var tbody = $('table > tbody');

                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {

                        $("#tbody-arquivos").append(
                            $('<tr id="tr-arquivos">')
                            .append($('<td style="width: 5%">').append('<i class="fa fa-copy"></i>'))
                            .append($('<td>').append(retorno[i].nome))
                            .append($('<td>').append(retorno[i].data))
                            .append($('<td style="width: 5%">').append('<a href="' + retorno[i].caminho_absoluto + '" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-eye"></i> Ver</a>'))
                            .append($('<td style="width: 5%">').append('<a  class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>'))
                        )

                    }
                    $("#echos-arquivos").empty();
                    $('#numeracao-arquivos').text('Página ' + (pagina + 1) + ' de ' + Math.ceil(retorno.length / tamanhoPagina));
                }

                function ajustarBotoes() {
                    $('#proximo-arquivos').prop('disabled', retorno.length <= tamanhoPagina || pagina >= Math.ceil(retorno.length / tamanhoPagina) - 1);
                    $('#anterior-arquivos').prop('disabled', retorno.length <= tamanhoPagina || pagina == 0);
                }

                $(function () {
                    $('#proximo-arquivos').click(function () {
                        if (pagina < retorno.length / tamanhoPagina - 1) {
                            $("#tbody-arquivos").empty();
                            pagina++;
                            paginar();
                            ajustarBotoes();
                        }
                    });
                    $('#anterior-arquivos').click(function () {

                        if (pagina >= 1) {
                            $("#tbody-arquivos").empty();
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

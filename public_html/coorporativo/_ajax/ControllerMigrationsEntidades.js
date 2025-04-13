
function deletar(id) {
    if (confirm("TEM CERTEZA QUE DESEJA EXCLUIR ESSE REGISTRO?")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerMasterMigrationsEntidades&&action=delete',
            type: "POST",
            data: {id: id},
            success: function (data) {
                $("#linha" + id).remove();
                toastr["success"]("Excluido com sucesso!")
            }
        });
    };
}

function locate() {
    $("tr").remove();

    $('#thead').append(
        $('<tr>')
            .append($('<th>').append('Cod'))
            .append($('<th>').append('Entidade'))
            .append($('<th>').append('Migration'))
            .append($('<th>').append('Atualizado em'))
            .append($('<th>').append(''))
        );

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMasterMigrationsEntidades&&action=locate',
        cache: false,
        type: 'POST',
        data: $('#search').serialize(),
        dataType: "json",
        beforeSend: function () {
            $("#echos").html("<h6 class='text-muted text-center'>Carregando...</h6>"); //Carregando
        },
        error: function () {
            $("#echos").html("<h6 class='text-muted text-center'>Não foi possivel executar a ação desejada, favor entrar em contato com o administrador.</h6>");
        },
        success: function (retorno) {
            if (!retorno[0]) {
                $("#echos").html("<h6 class='text-muted text-center'>Não há dados cadastrados!</h6>");
            } else {

                var tamanhoPagina = 10;
                var pagina = 0;

                function paginar() {

                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {

                        $("#tbody").append(
                            $('<tr id="linha' + retorno[i].id + '">')
                                .append($('<td style="width: 3%">').append(retorno[i].id))
                                .append($('<td style="align-text: center">').append(retorno[i].nome_entidade+'<br/><small>'+retorno[i].cnpj_entidade))
                                .append($('<td>').append('<a  target="_blank" href="../master-migrations/cadastro.php?id='+retorno[i].id_migration+'">'+retorno[i].descricao))
                                .append($('<td style="align-text: center">').append(retorno[i].criado_em))
                                .append($('<td>').append('<center><button class="btn btn-danger btn-sm"  onclick="deletar(' + retorno[i].id + ', 1)"><i class="fa fa-remove"></i></button></center>'))
                            )
                    }

                    $("#echos").empty();
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
                                    .append($('<th>').append('Cod'))
                                    .append($('<th>').append('Entidade'))
                                    .append($('<th>').append('Migration'))
                                    .append($('<th>').append('Atualizado em'))
                                    .append($('<th>').append(''))
                                );

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
                                    .append($('<th>').append('Cod'))
                                    .append($('<th>').append('Entidade'))
                                    .append($('<th>').append('Migration'))
                                    .append($('<th>').append('Atualizado em'))
                                    .append($('<th>').append(''))
                                );
                                
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
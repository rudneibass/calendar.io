function deletar(id) {
    if (confirm("TEM CERTEZA QUE DESEJA EXCLUIR ESSE REGISTRO?")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerMultimidia&&action=delete',
            type: "POST",
            data: {id: id},
            success: function (data) {
               /* $("#linha" + id).remove();*/
               locate('tab-1-form-1');
                toastr["success"]("Excluido com sucesso!");
            }
        });
    }
    ;
}

function vizualizar(id) {
    location.href = 'cadastro.php?id=' + id;
}

function populaForm(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMultimidia&&action=locate',
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
           
            $("#tabela_pai").prop("disabled", false);
            $("#id_tabela_pai").prop("disabled", false);
            $("#caminho_relativo").prop("disabled", false);
            $("#caminho_absoluto").prop("disabled", false);
            $("#link").prop("disabled", false);

            //FAZ AS ALTERAÇÕES NESCESSARIAS NO FORM PARA O MODO DE EDIÇÃO
            var data = jQuery.parseJSON(JSON.stringify(json));
            $("#tab-1-btn-salvar").css("display", "none");
            $('#tab-1-btn-salvar-alteracoes').css("display","block");
            $('#tab-1-btn-salvar-alteracoes').attr("onclick","update("+data.id+")");

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
};

function locate(form) {
    $("tr").remove();
    $('thead').append(
            $('<tr>')
            .append($('<th>').append('Cod'))
            .append($('<th>').append('Informações do arquivo'))
            .append($('<th>').append('Data de envio'))
            .append($('<th>').append('Pertence à...'))
            .append($('<th>'))
            .append($('<th>'))
            .append($('<th>'))
            );
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMultimidia&&action=locate',
        cache: false,
        type: 'POST',
        data: $('#'+form).serialize(),
        dataType: "json",
        beforeSend: function () {
            $(".loading").show();
        },
        error: function () {
            $(".loading").hide();
            $("#tab_1_alerts").html("Não foi possivel executar a ação desejada, favor entrar em contato com o administrador.");
        },
        success: function (retorno) {
            $(".loading").hide();
            
            if(retorno.length === 0){
                $("#tab_1_alerts").show()
                $("#tab_1_alerts").html("Não há envio de arquivos.")
                return
            }

            var tamanhoPagina = 10;
            var pagina = 0;
            function paginar() {
                for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {
                    $("#tbody").append(
                            $('<tr id="linha">')
                            .append($('<td>').append(retorno[i].id))
                            .append($('<td>').append(retorno[i].nome+'<br/><small>'+retorno[i].tipo+'<br/><small>'+retorno[i].caminho_absoluto))
                            .append($('<td>').append(retorno[i].data))
                            .append($('<td>').append('<span style="text-transform: uppercase">'+retorno[i].tabela_pai))
                            .append($('<td style="width: 5%">').append('<a href="' + retorno[i].caminho_absoluto + '" target="_blank" ><button class="btn btn-secondary btn-sm" ><i class="fa fa-eye")"></i> Ver</button></a>'))
                            .append($('<td style="width: 5%">').append('<center><button class="btn btn-warning btn-sm" onclick="vizualizar(' + retorno[i].id + ')" ><i class="fa fa-pencil"></i></button></center>'))
                            .append($('<td style="width: 5%">').append('<center><button class="btn btn-danger btn-sm"  onclick="deletar(' + retorno[i].id + ')"><i class="fa fa-remove"></i></button></center>'))                                
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
                        $('thead').append(
                                $('<tr>')
                                .append($('<th>').append('Cod'))
                                .append($('<th>').append('Informações do arquivo'))
                                .append($('<th>').append('Data de envio'))
                                .append($('<th>').append('Pertence à...'))
                                .append($('<th>'))
                                .append($('<th>'))
                                .append($('<th>'))
                                );
                        pagina++;
                        paginar();
                        ajustarBotoes();
                    }
                });
                $('#anterior').click(function () {
                    if (pagina >= 1) {
                        $("tr").remove();
                        $('thead').append(
                                $('<tr>')
                                .append($('<th>').append('Cod'))
                                .append($('<th>').append('Informações do arquivo'))
                                .append($('<th>').append('Data de envio'))
                                .append($('<th>').append('Pertence à...'))
                                .append($('<th>'))
                                .append($('<th>'))
                                .append($('<th>'))
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
    });
}

function  update(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMultimidia&&action=update&&id=' + id,
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

function  updateUrl(id) {
    if (confirm("\u{26A0}\u{FE0F} TEM CERTEZA QUE DESEJA CONTINUAR ? \n \u{1F640} Essa ação vai mudar a url de todos os arquivos!")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerMultimidia&&action=updateUrl&&id=' + id,
            type: 'POST',
            data: $('#form-2').serialize(),
            beforeSend: function () {
                toastr["info"]("Aguarde, estamos providenciando o envio de suas informações!")
            },
            success: function (data) {
                toastr["info"](data)
            }
        });
    }
}

function  updateUrlCapaNoticia() {
    if (confirm("\u{26A0}\u{FE0F}  TEM CERTEZA QUE DESEJA CONTINUAR ? \n \u{1F640} Essa ação vai mudar a url da capa de todas as notícias!")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerMultimidia&&action=updateUrlCapaNoticia',
            type: 'POST',
            data: $('#form-3').serialize(),
            beforeSend: function () {
                toastr["info"]("Aguarde, estamos providenciando o envio de suas informações!")
            },
            success: function (data) {
                toastr["info"](data)
            }
        });
    }
}

function  updateUrlImagemServidor() {
    if (confirm("\u{26A0}\u{FE0F}  TEM CERTEZA QUE DESEJA CONTINUAR ? \n  \u{1F640} Essa ação vai mudar a url da foto de todos os servidores!")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerMultimidia&&action=updateUrlImagemServidor',
            type: 'POST',
            data: $('#form-4').serialize(),
            beforeSend: function () {
                toastr["info"]("Aguarde, estamos providenciando o envio de suas informações!")
            },
            success: function (data) {
                toastr["info"](data)
            }
        });
    }
}
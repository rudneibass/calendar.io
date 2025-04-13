function insertTab5Form1() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMateriasVotos&&action=insert',
        type: 'POST',
        data: $('#tab-5-form-1').serialize(),
        beforeSend: function () {
            toastr["info"]("Aguarde, as informções estão sendo salvas no banco de dados!");
        },
        success: function (data) {
            if (!isNaN(data)) {
                $('.toast-info').hide();
                toastr["success"]("Cadastro realizado com sucesso!");
                key = $('#relacionamento').val();
                locateTab5Form1(key);
            } else {
                $('.toast-info').hide();
                toastr["error"](data);
            }
        }
    });
}


function locateTab5Form1(id) {
    $("#tab-5-tbody-1").empty();

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMateriasVotos&&action=locate',
        cache: false,
        type: 'POST',
        data: {id: id},
        dataType: "json",
        beforeSend: function () {
            $("#tab-5-echos-1").html("<h6 class='text-muted text-center'>Carregando...</h6>"); //Carregando
        },
        error: function () {
            $("#tab-5-echos-1").html("<h6 class='text-muted text-center'>Não foi possivel executar a ação desejada, favor entrar em contato com o administrador.</h6>");
        },
        success: function (retorno) {
            if (!retorno[0]) {
                $("#tab-5-echos-1").html("<h6 class='text-muted text-center'>Não há vínculo cadastrado!</h6>");
            } else {

                $("#tab-5-echos-1").empty();
                
                var tamanhoPagina = 999;
                var pagina = 0;
                for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {
                    if (retorno[i].voto === 'S') {
                        $("#tab-5-tbody-1").append(
                            $('<tr id="linha' + retorno[i].id + '">')
                            .append($('<td style="width: 5%">').append(retorno[i].id))
                            .append($('<td>').append(retorno[i].nome))  
                            .append($('<td style="width: 5%">').append("<center><span class='badge badge-success'>Sim</span></center>"))                  
                            .append($('<td style="width: 5%">').append('<center><button class="btn btn-warning btn-sm" onclick="updateTab5Form1(' + retorno[i].id + ', \''+retorno[i].voto+'\', ' + retorno[i].id_materias + ', ' + retorno[i].id_servidor + ')" ><i class="fa fa-undo"></i>&nbsp;Mudar Voto</button></center>'))
                            .append($('<td style="width: 5%">').append('<center><button class="btn btn-danger btn-sm"  onclick="deletarTab5Form1(' + retorno[i].id + ')"><i class="fa fa-remove"></i></button></center>'))  
                            );
                    }
                    if (retorno[i].voto === 'N') {
                        $("#tab-5-tbody-1").append(
                            $('<tr id="linha' + retorno[i].id + '">')
                            .append($('<td style="width: 5%;">').append(retorno[i].id))
                            .append($('<td>').append(retorno[i].nome))          
                            .append($('<td style="width: 5%;">').append("<center><span class='badge badge-danger'>Não</span><center>"))          
                            .append($('<td style="width: 5%;">').append('<center><button class="btn btn-warning btn-sm" onclick="updateTab5Form1(' + retorno[i].id + ', \''+retorno[i].voto+'\', ' + retorno[i].id_materias + ', ' + retorno[i].id_servidor + ')" ><i class="fa fa-undo"></i>&nbsp;Mudar Voto</button></center>'))
                            .append($('<td style="width: 5%;">').append('<center><button class="btn btn-danger btn-sm"  onclick="deletarTab5Form1(' + retorno[i].id + ')"><i class="fa fa-remove"></i></button></center>'))  
                            );
                    }

                    if (!retorno[i].voto) {
                        $("#tab-5-tbody-1").append(
                            $('<tr id="linha' + retorno[i].id + '">')
                            .append($('<td style="background-color: #ededed; width: 5%;">').append(retorno[i].id))
                            .append($('<td style="background-color: #ededed">').append(retorno[i].nome))          
                            .append($('<td style="background-color: #ededed; width: 5%">').append("<center><span class='badge badge-secondary'>Sem voto</span><center>"))          
                            .append($('<td style="background-color: #ededed; width: 5%;">').append('<center><button class="btn btn-warning btn-sm" onclick="updateTab5Form1(' + retorno[i].id + ', \''+retorno[i].voto+'\', ' + retorno[i].id_materias + ', ' + retorno[i].id_servidor + ')" ><i class="fa fa-undo"></i>&nbsp;Mudar Voto</button></center>'))
                            .append($('<td style="background-color: #ededed; width: 5%;">').append('<center><button class="btn btn-danger btn-sm"  onclick="deletarTab5Form1(' + retorno[i].id + ')"><i class="fa fa-remove"></i></button></center>'))  
                            );
                    }
                    
                }
            }
        }
    });
}


function populaFormTab5Form1(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMateriasVotos&&action=locate&&id=' + id,
        type: 'POST',
        dataType: "json",
        data: {id: id},
        beforeSend: function () {
            $(".loading").show()
            $("#tab-5-form-1 :input").prop("disabled", true);
        },
        error: function () {
            $(".loading").hide()
            $("#tab_5_alerts").html("Erro no Ajax");
        },
        success: function (json) {
            $(".loading").hide()
            $("#tab-5-form-1 :input").prop("disabled", false);


            //FAZ AS ALTERAÇÕES NESCESSARIAS NO FORM PARA O MODO DE EDIÇÃO
            var data = jQuery.parseJSON(JSON.stringify(json));
            $("#tab-5-btn-salvar").css("display", "none");
            $("#tab-5-btn-voltar").css("display", "none");
            $("#tab-5-btn-cancelar").css("display", "block");
            $("#tab-5-btn-salvar-alteracoes").css("display", "block");
            $("#tab-5-btn-salvar-alteracoes").attr('onclick', 'updateTab5Form1(' + id + ')');


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
                    $("." + field).val(value);
                }
            });
        }
    });
};

function  updateTab5Form1(idVoto, votoAtual, idMateria, idServidor) {
    
    var novoVoto = votoAtual === 'S' ? 'N' : 'S';

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMateriasVotos&&action=update&&id=' +idVoto,
        type: 'POST',
        data: {id_servidor: idServidor, id_materias: idMateria, voto: novoVoto},
        beforeSend: function () {
            $(".loading").show()
            $("#tab-5-form-1 :input").prop("disabled", true);
        },
        error: function () {
            $(".loading").hide()
            $("#tab_5_alerts").html("Erro no Ajax");
        },
        success: function (data) {
            $(".loading").hide()
            $("#tab-5-form-1 :input").prop("disabled", false);
            $('.toast-info').hide();

            if (isNaN(data)) {
                toastr["error"](data);
            } else {

                switch (data) {
                    case '1':
                        toastr["success"]("Dados atualizados com sucesso!");
                        locateTab5Form1(idMateria)
                        break;
                    case '0':
                        toastr["success"]("Embora a transação tenha sido efetuada com sucesso você não inseriu nenhum dado novo!");
                        break;
                }

                /*idServidor = $('#id_servidor').val();
                locatePessoaVinculo(idServidor);*/
            }
        }
    });
}


function deletarTab5Form1(id) {
    if (confirm("TEM CERTEZA QUE DESEJA EXCLUIR ESSE REGISTRO?")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerMateriasVotos&&action=delete',
            type: "POST",
            data: {id: id},
            success: function (data) {
                $("#linha" + id).remove();
                toastr["success"]("Excluido com sucesso!")
            }
        });
    }
    ;
}

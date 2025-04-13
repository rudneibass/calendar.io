function vizualizar(id) {

    location.href = 'cadastro.php?id=' + id;

}



function populaForm(id) {

    $.ajax({

        url: '../../_php/Dispatch.php?controller=ControllerMasterMigrations&&action=locate',

        type: 'POST',

        dataType: "json",

        data: {id: id},

        success: function (json) {



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

}

;





function locate() {

    $("tr").remove();



    $('#thead').append(

            $('<tr>')

            .append($('<th>').append('Cod'))

            .append($('<th>').append('Descrição'))

            .append($('<th>').append('Ativo'))

            .append($('<th>').append('Data de Criação'))

            .append($('<th>').append(''))

            .append($('<th>').append(''))

            );



    $.ajax({

        url: '../../_php/Dispatch.php?controller=ControllerMasterMigrations&&action=locate',

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

//                    var tbody = $('table > tbody');



                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {



                        $("#tbody").append(

                                $('<tr id="linha' + retorno[i].id + '">')

                                .append($('<td style="width: 3%">').append(retorno[i].id))

                                .append($('<td>').append(retorno[i].descricao))

                                .append($('<td style="width: 5%; align-text: center">').append(retorno[i].ativo))

                                .append($('<td style="width: 5%;">').append(retorno[i].criado_em))

                                .append($('<td style="width: 5%">').append('<center><button class="btn btn-warning btn-sm" onclick="vizualizar(' + retorno[i].id + ')" ><i class="fa fa-pencil"></i></button></center>'))
                                
                                .append($('<td style="width: 5%">').append('<center><button class="btn btn-danger btn-sm"  onclick="deletar(' + retorno[i].id + ', 1)"><i class="fa fa-remove"></i></button></center>'))

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
                    
                                .append($('<th>').append('Descrição'))

                                .append($('<th>').append('Ativo'))
                    
                                .append($('<th>').append('Data de Criação'))
                     
                                .append($('<th>').append(''))

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
                    
                                .append($('<th>').append('Descrição'))
                    
                                .append($('<th>').append('Ativo'))
                                
                                .append($('<th>').append('Data de Criação'))
                     
                                .append($('<th>').append(''))

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



function  update(id) {

    $.ajax({

        url: '../../_php/Dispatch.php?controller=ControllerMasterMigrations&&action=update&&id=' + id,

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





function insert() {

    $.ajax({

        url: '../../_php/Dispatch.php?controller=ControllerMasterMigrations&&action=insert',

        type: 'POST',

        data: $('#tab-1-form-1').serialize(),

        beforeSend: function () {

            toastr["info"]("Aguarde, as informções estão sendo salvas no banco de dados!");

        },

        success: function (data) {

            if (!isNaN(data)) {

                $('.toast-info').hide();

                toastr["success"]("Cadastro realizado com sucesso!");

                document.getElementById("tab-1-btn-salvar").disabled = true;

            } else {

                $('.toast-info').hide();

                toastr["error"](data);

            }

        }

    });

}



function deletar(id) {

    if (confirm("TEM CERTEZA QUE DESEJA EXCLUIR ESSE REGISTRO?")) {

        $.ajax({

            url: '../../_php/Dispatch.php?controller=ControllerMasterMigrations&&action=delete',

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






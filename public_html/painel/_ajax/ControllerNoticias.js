function vizualizar(id) {
    location.href = 'cadastro.php?id=' + id;
}

function populaForm(id) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerNoticias&&action=locate',
        type: 'POST',
        dataType: "json",
        data: {id: id},
        beforeSend: function () {
            $("#tab_1_loading").show()
            $("#tab-1-form-1 :input").prop("disabled", true);
        },
        error: function () {
            $("#tab_1_loading").hide()
            $("#tab_1_alerts").html("Erro no Ajax");
        },
        success: function (json) {
            $("#tab_1_loading").hide()
            $("#tab-1-form-1 :input").prop("disabled", false);
            
            //FAZ AS ALTERAÇÕES NESCESSARIAS NO FORM PARA O MODO DE EDIÇÃO
            var data = jQuery.parseJSON(JSON.stringify(json));
            document.getElementById("tab-1-btn-show-modal-upload").disabled = false;
            document.getElementById("tab-2-btn-2-show-modal-upload").disabled = false;
            document.getElementById("tab-2-btn-show-modal-upload").disabled = false;

            $("#tab-1-btn-show-modal-upload").attr("onclick", "showModalUpload('modal-upload-preview-imagem', 'ControllerRedimencionaImagem', 'redimensiona', " + data.id + ", \'" + data.tbl + "\', 'update')");
            $("#tab-2-btn-2-show-modal-upload").attr("onclick", "showModalUpload('modal-upload-preview-imagem', 'ControllerRedimencionaImagem', 'redimensiona', " + data.id + ", \'" + data.tbl + "\', 'update')");
            $("#tab-2-btn-show-modal-upload").attr("onclick", "showModalUpload('modal-upload', 'ControllerUploadMultiplo', 'analisaArquivo', " + data.id + ", \'" + data.tbl + "\', 'insert')");

            $('#botoes-foot').append('<button type="button" class="btn btn-info btn-sm" id="submit_form_edit" onclick="update( ' + id + ')"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar Alterações</button>');
            $("#btn_insert").css("display", "none");

            listarImagens(data.id, data.tbl);

            //POPULA O FORM COM AS INFORMAÇÕES DO BANCO DE DADOS
            $.each(json, function (field, value) {
                container = '';
                prefix_field = '#';

                /*if (field == 'descricao'){
                    tinymce.get("descricao").setContent(value)
                }*/

                if (field == 'descricao'){
                    nicEditors.findEditor("descricao").setContent(value)
                }
                
                if ($(container + prefix_field + field).attr('type') == 'text'){
                    $(container + prefix_field + field).val(value);
                }
                if ($(container + prefix_field + field).attr('type') == 'date'){
                    $(container + prefix_field + field).val(value);
                }


                if ($(container + prefix_field + field).attr('type') == 'checkbox') {
                    if ($(container + prefix_field + field).val() == value) {
                        $(container + 'input[type="checkbox"]' + prefix_field + field).prop('checked', true);
                    } else {
                        $(container + 'input[type="checkbox"]' + prefix_field + field).prop('checked', false);
                    }
                }
                
                if ($(container + prefix_field + field).attr('type') == 'radio') {
                    if ($(container + prefix_field + field).val() == value) {
                        $(container + 'input[type="radio"]' + prefix_field + field).prop('checked', true);
                    } else {
                        $(container + 'input[type="radio"]' + prefix_field + field).prop('checked', false);
                    }
                } 
                
                if ($(container + prefix_field + field).get(0) != undefined && $(container + prefix_field + field).get(0).tagName === 'IMG') {
                    if (value != '') {
                        t = new Date();
                        $(container + prefix_field + field).attr('src', value + '?' + t.getTime());
                    }
                }
            });


            $("#spinner").hide()

        }
    });
}
;


function locate() {
    $("tr").remove();

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerNoticias&&action=locate',
        cache: false,
        type: 'POST',
        data: $('#search').serialize(),
        dataType: "json",
        beforeSend: function () {
            $(".loading").show();
        },
        error: function () {
            $(".loading").hide();
            $("#tab_1_alerts").html("Não foi possivel executar a ação desejada, favor entrar em contato com o administrador.");
        },
        success: function (retorno) {
            console.log(retorno)
            $(".loading").hide();

            if (!retorno[0]) {
                $("#tab_1_alerts").html("Não há dados cadastrados!");
            } else {

                var tamanhoPagina = 10;
                var pagina = 0;

                function paginar() {
//                    var tbody = $('table > tbody');

                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {

                        if(!retorno[i].ativo || retorno[i].ativo == 'S'){
                            $("#tbody").append(
                                $('<tr id="linha">')
                                .append($('<td>').append(retorno[i].id))
                                .append($('<td>').append('<img src="' + retorno[i].imagem_url + '" alt="" class="img-thumbnail" width="200">'))
                                .append($('<td>')
                                    .append(
                                        '<p><b>Título:</b> '+ retorno[i].titulo + '&nbsp;<span class="badge badge-info">Notícia publicada no site</span>' 
                                        + '<p><b>Resumo/Subtítulo:</b> '+retorno[i].resumo 
                                        + '<p><small class="text-muted"><i class="fa fa-calendar-o text-muted"></i>&nbsp;' + retorno[i].data_noticia_pt_br 
                                    )
                                )
                                .append($('<td style="width: 8%">')
                                    .append(
                                        '<button class="btn btn-warning btn-sm w-100 mb-2" onclick="vizualizar(' + retorno[i].id + ')" ><i class="fa fa-pencil"></i>&nbsp;Editar</button>'
                                        +'<button class="btn btn-secondary btn-sm w-100 mb-2" onclick="listarArquivos(' + retorno[i].id + ', \'noticias\',\'tbody_arquivos_modal\')" data-toggle="modal" data-target="#modal-files"><i class="fa fa-file-text"></i>&nbsp;Anexos</button>'
                                        +'<button class="btn btn-danger btn-sm w-100 mb-2" onclick="desativar(' + retorno[i].id + ')"><i class="fa fa-file-text"></i>&nbsp;Tirar do ar</button>'
                                    )
                                )

                            )
                        }

                        if(retorno[i].ativo && retorno[i].ativo == 'N'){
                            $("#tbody").append(
                                $('<tr id="linha">')
                                .append($('<td>').append(retorno[i].id))
                                .append($('<td>').append('<img src="' + retorno[i].imagem_url + '" alt="" class="img-thumbnail" width="200" style="filter: grayscale()">'))
                                .append($('<td>')
                                    .append(
                                        '<p><b>Título:</b> '+ retorno[i].titulo 
                                        + '&nbsp;<span class="badge badge-dark">Notícia fora do ar</span>' 
                                        + '<p><b>Resumo/Subtítulo:</b> '+retorno[i].resumo 
                                        + '<p><small class="text-muted"><i class="fa fa-calendar-o text-muted"></i>&nbsp;' + retorno[i].data_noticia_pt_br 
                                    )
                                )
                                .append($('<td style="width: 8%">')
                                    .append(
                                        '<button class="btn btn-warning btn-sm w-100 mb-2" onclick="vizualizar(' + retorno[i].id + ')" ><i class="fa fa-pencil"></i>&nbsp;Editar</button>'
                                        +'<button class="btn btn-secondary btn-sm w-100 mb-2" onclick="listarArquivos(' + retorno[i].id + ', \'noticias\',\'tbody_arquivos_modal\')" data-toggle="modal" data-target="#modal-files"><i class="fa fa-file-text"></i>&nbsp;Anexos</button>'
                                        +'<button class="btn btn-success btn-sm w-100 mb-2" onclick="ativar(' + retorno[i].id + ')"><i class="fa fa-file-text"></i>&nbsp;Colocar no ar</button>'
                                    )
                                )

                            )
                        }
                        
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
                            pagina++;
                            paginar();
                            ajustarBotoes();
                        }
                    });
                    $('#anterior').click(function () {

                        if (pagina >= 1) {
                            $("tr").remove();
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

    /**NicEditor */
    $('textarea').each(function () {
        var id_nic = $(this).attr('id');
        var nic = nicEditors.findEditor(id_nic);
        if (nic)
            nic.saveContent();
    });

    /* tinymce
    let formData = $('#tab-1-form-1').serialize();

    let formObject = {};
    formData.split('&').forEach(function(keyValue) {
        var pair = keyValue.split('=');
        formObject[pair[0]] = decodeURIComponent(pair[1]);
    });
    formObject.descricao = tinymce.get("descricao").getContent();
    let modifiedFormData = $.param(formObject);*/
    
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerNoticias&&action=update&&id=' + id,
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

    /** NicEditor */
    $('textarea').each(function () {
        var id_nic = $(this).attr('id');
        var nic = nicEditors.findEditor(id_nic);
        if (nic)
            nic.saveContent();
    });
    
    /* TinyMce
    let formData = $('#tab-1-form-1').serialize();
    let formObject = {};
    formData.split('&').forEach(function(keyValue) {
        var pair = keyValue.split('=');
        formObject[pair[0]] = decodeURIComponent(pair[1]);
    });
    formObject.descricao = tinymce.get("descricao").getContent();
    let modifiedFormData = $.param(formObject);
    */

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerNoticias&&action=insert',
        type: 'POST',
        data: $('#tab-1-form-1').serialize(),
        beforeSend: function () {
            toastr["info"]("Aguarde, as informções estão sendo salvas no banco de dados!");
        },
        success: function (data) {
            if (!isNaN(data)) {
                $('.toast-info').hide();
                toastr["success"]("Cadastro realizado com sucesso!");
                
                document.getElementById("btn_insert").disabled = true;
                document.getElementById("tab-1-btn-show-modal-upload").disabled = false;
                document.getElementById("tab-2-btn-2-show-modal-upload").disabled = false;
                document.getElementById("tab-2-btn-show-modal-upload").disabled = false;

                $("#tab-1-btn-show-modal-upload").attr("onclick", "showModalUpload('modal-upload-preview-imagem', 'ControllerRedimencionaImagem', 'redimensiona', " + data + ", 'noticias', 'update')");
                $("#tab-2-btn-2-show-modal-upload").attr("onclick", "showModalUpload('modal-upload-preview-imagem', 'ControllerRedimencionaImagem', 'redimensiona', " + data + ", 'noticias', 'update')");
                $("#tab-2-btn-show-modal-upload").attr("onclick", "showModalUpload('modal-upload', 'ControllerUploadMultiplo', 'analisaArquivo', " + data + ", 'noticias', 'insert')");

            } else {
                $('.toast-info').hide();
                toastr["error"](data);
            }
        }
    });
}

function ativar(id) {
    if (confirm("TEM CERTEZA QUE DESEJA ATIVAR ESSE REGISTRO?")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerNoticias&&action=ativar',
            type: "POST",
            data: {id: id},
            dataType: "json",
            success: function (response) {
                if(response.status && response.status == 200){
                    toastr["success"](response.message)
                } else {
                    toastr["error"](response)
                }
                locate();
            }
        });
    };
}

function desativar(id) {
    if (confirm("TEM CERTEZA QUE DESEJA DESATIVAR ESSE REGISTRO?")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerNoticias&&action=desativar',
            type: "POST",
            data: {id: id},
            dataType: "json",
            success: function (response) {
                if(response.status && response.status == 200){
                    toastr["success"](response.message)
                } else {
                    toastr["error"](response)
                }
                locate();
            }
        });
    };
}

function ativarTodos(id) {
    if (confirm("TEM CERTEZA QUE DESEJA ATIVAR TODOS OS REGISTROS?")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerNoticias&&action=ativarTodos',
            type: "POST",
            data: {id: id},
            dataType: 'json',
            success: function (response) {
                if(response.status && response.status == 200){
                    toastr["success"](response.message)
                } else {
                    toastr["error"](response)
                }
                locate();
            }
        });
    };
}

function desativarTodos(id) {
    if (confirm("TEM CERTEZA QUE DESEJA DESATIVAR TODOS OS REGISTROS?")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerNoticias&&action=desativarTodos',
            type: "POST",
            data: {id: id},
            dataType: 'json',
            success: function (response) {
                if(response.status && response.status == 200){
                    toastr["success"](response.message)
                } else {
                    toastr["error"](response)
                }
                locate();
            }
        });
    };
}

function importarJson() {
    var formData = new FormData(document.getElementById('formJson'));

    $.ajax({
      url: '../../_php/Dispatch.php?controller=ControllerNoticias&&action=importarJson',
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      beforeSend: function () {
        $(".loadingFormJson").show();
        toastr["info"]("Aguarde, as informções estão sendo salvas no banco de dados!");
      },
      error: function(error) {
        console.error(error);
        $(".loadingFormJson").hide();
      },
      success: function(response) {
        $(".loadingFormJson").hide();
        console.log(response);
        toastr["success"]("Cadastro realizado com sucesso!");
      },
    });
  }



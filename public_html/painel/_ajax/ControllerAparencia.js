

function deletar(id, tabelaPai) {
    if (confirm("TEM CERTEZA QUE DESEJA EXCLUIR ESSE REGISTRO?")) {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerAparencia&&action=delete',
            type: "POST",
            data: {id: id, tabelaPai: tabelaPai},
            beforeSend: function () {
                toastr["info"]("Aguarde, estamos tentando excluir...");
            },
            success: function () {
                $('.toast-info').hide();
                toastr["success"]("Excluido com sucesso!");
                if (tabelaPai === "header") {
                    //locate("header");
                    locateHeader();
                }
                if (tabelaPai === "slide") {
                    locate("slide");
                }
                if (tabelaPai === "banner") {
                    locate("banner");
                }
            }
        });
    }
    ;
}

function populaForm() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerAparencia&&action=locate',
        type: "POST",
        dataType: "json",
        success: function (json) {

            var data = JSON.parse(JSON.stringify(json));
            var valores = data[0];

            $.each(valores, function (field, value) {

                if ($("#" + field).attr('type') == 'checkbox') {
                    if (value == "on") {
                        $('#' + field).prop("checked", true);
                        $('#' + field).bootstrapToggle('on');
                    }

                }
            });
        }
    });

}


function populaFormCores() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerAparencia&&action=getColors',
        type: "POST",
        dataType: "json",
        data: {table: "cores"},
        success: function (json) {

            var data = JSON.parse(JSON.stringify(json));
            var valores = data[0];

            $.each(valores, function (field, value) {
                container = '';
                prefix_field = '#';
                $(container + prefix_field + field).val(value);
            });
        }
    });

}

function locate(tabelaPai) {
    $('#' + tabelaPai).empty();
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerAparencia&&action=locate',
        cache: false,
        type: 'POST',
        data: {tabelaPai: tabelaPai},
        dataType: "json",
        beforeSend: function () {
            $(".loading").show();
        },
        error: function () {
            $(".loading").hide();
        },
        success: function (retorno) {
            $(".loading").hide();

            if (retorno !== null && retorno !== undefined && retorno.length == 0) {
                $("#echos").html(retorno[0]);
            
            } else {
               

                var tamanhoPagina = 20;
                var pagina = 0;

                function paginar() {
//                    var tbody = $('table > tbody');

                    for (var i = pagina * tamanhoPagina; i < retorno.length && i < (pagina + 1) * tamanhoPagina; i++) {
                        
                        if (retorno[i].tabela_pai === "logo") {
                            $("#" + retorno[i].tabela_pai)
                                    //.append($('<td id="linha-banner">').append('<img src="' + retorno[i].caminho_absoluto + '" alt="" class="img-thumbnail" width="200" style=" filter: grayscale(100%)" ><button type="button" class="btn btn-danger btn-sm"  onclick="deletar(' + retorno[i].id + ', \'' + retorno[i].tabela_pai + '\')"><i class="fa fa-trash"></i></button>'));
                                    .append($('<div class="col-md-2" id="tr' +retorno[i].id+'"><div class="card"><div class="card-body p-0"><a href="../multimidia/cadastro.php?id='+retorno[i].id+'" target="_blank"><img class="card-img-top" src="' +retorno[i].caminho_absoluto+'" style=" filter: grayscale(100%)"></a></div><div class="card-footer p-1"><button class="btn btn-danger btn-sm"  onclick="deletar(' +retorno[i].id+', \'' + retorno[i].tabela_pai + '\')"><i class="fa fa-trash"></i></button><small> ' +retorno[i].nome+ '</small></div></div></div>'));
                        }

                        /*if (retorno[i].tabela_pai === "header") {
                            $("#img-header")
                            .append($('<div class="col-md-12" id="tr' +retorno[i].id+'"><div class="card"><div class="card-body p-0"><a href="../multimidia/cadastro.php?id='+retorno[i].id+'" target="_blank"><img class="card-img-top" src="' +retorno[i].caminho_absoluto+'" style=" filter: grayscale(100%)"></a></div><div class="card-footer p-1"><button class="btn btn-danger btn-sm"  onclick="deletar(' +retorno[i].id+', \'' + retorno[i].tabela_pai + '\')"><i class="fa fa-trash"></i></button><small> ' +retorno[i].nome+ '</small></div></div></div>'));
                        }*/

                        if (retorno[i].tabela_pai === "slide") {
                            $("#" + retorno[i].tabela_pai)
                                    .append($('<div class="col-md-4" id="tr' +retorno[i].id+'"><div class="card"><div class="card-body p-0"><a href="../multimidia/cadastro.php?id='+retorno[i].id+'" target="_blank"><img class="card-img-top" src="' +retorno[i].caminho_absoluto+'" style=" filter: grayscale(100%)"></a></div><div class="card-footer p-1"><button class="btn btn-danger btn-sm"  onclick="deletar(' +retorno[i].id+', \'' + retorno[i].tabela_pai + '\')"><i class="fa fa-trash"></i></button><small> ' +retorno[i].nome+ '</small></div></div></div>'));

                        }

                        if (retorno[i].tabela_pai === "banner") {
                            $("#" + retorno[i].tabela_pai)
                                    .append($('<td id="linha-banner">').append('<img src="' + retorno[i].caminho_absoluto + '" alt="" class="img-thumbnail" width="200" style=" filter: grayscale(100%)" ><button type="button" class="btn btn-danger btn-sm"  onclick="deletar(' + retorno[i].id + ', \'' + retorno[i].tabela_pai + '\')"><i class="fa fa-trash"></i></button>'));
                        }
                    }
                    $("h3").remove();
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


function locateHeader() {
    
    $("#img-header").empty();

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerAparencia&&action=locate',
        cache: false,
        type: 'POST',
        data: {tabelaPai: 'header'},
        dataType: "json",
        beforeSend: function () {
            $(".loading").show();
        },
        error: function () {
            $(".loading").hide();
        },
        success: function (retorno) {
            $(".loading").hide();

            if (retorno !== null && retorno !== undefined && retorno.length == 0) {
                $("#echos").html(retorno[0]);
            
            } else {
                for (var i = 0; i < retorno.length; i++) {
                    if (retorno[i].tabela_pai !== "header") { continue }
                    $("#img-header")
                        .append(
                            $(
                                `<div class="col-md-12" id="tr${retorno[i].id}">
                                    <div class="card">
                                        <div class="card-body p-0">
                                            <a href="../multimidia/cadastro.php?id=${retorno[i].id}" target="_blank">
                                                <img class="card-img-top" src="${retorno[i].caminho_absoluto}" style=" filter: grayscale(100%)">
                                            </a>
                                        </div>
                                        <div class="card-footer p-1">
                                            <button class="btn btn-danger btn-sm"  onclick="deletar('${retorno[i].id}', '${retorno[i].tabela_pai}')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <small> ${retorno[i].nome}</small>
                                        </div>
                                    </div>
                                </div>`
                            )
                        );
                }
            }
        }
    });
}



$(document).ready(function () {
    $('#submit_form_insert').click(function () {
        $.ajax({
            url: '../../_php/Dispatch.php?controller=ControllerAparencia&&action=insert',
            type: 'POST',
            data: $('#form_insert').serialize(),
            beforeSend: function () {
                $(".loading").show();
                toastr["info"]("Aguarde, as informções estão sendo salvas no banco de dados!");
            },
            success: function (data) {
                $(".loading").hide();
                if (!isNaN(data)) {
                    $('.toast-info').hide();
                    toastr["success"]("Cadastro realizado com sucesso!");
                    document.getElementById("anexar_arquivo").disabled = false;
                    document.getElementById("id").value = data;
                } else {
                    toastr["error"](data);
                    $('#echos').html(data);
                }
            }
        });
    });
});

function  update() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerAparencia&&action=setColors',
        type: 'POST',
        data: $('#form_cores').serialize(),
        beforeSend: function () {
            $(".loading").show();
            toastr["info"]("Aguarde, as informções estão sendo salvas no banco de dados!");
        },
        error: function () {
            $(".loading").hide();
        },
        success: function (data) {
            $(".loading").hide();
            if (data == "1") {
                $('#echos').html(data);
                toastr["success"]("Salvo com sucesso!");
            } else {
                toastr["info"]("Não houve alteração pois a cor enviada é a mesma já configurada!");
            }
        },
    });
}

document.getElementsByName('cor').forEach( element => {
    element.addEventListener('click', e => {

        let corUm;
        let corDois;
        let corTres; 
        let corQuatro; 
        let theme = e.target.id;

        switch(theme){
            case 'primary':
                corUm = "#0062ca";
                corDois = "#007BFF";
                corTres = "#CFE2FF";
                corQuatro = "#ffffff";
            break;
            case 'info':
                corUm = "#128696";
                corDois = "#17A2B8";
                corTres = "#CFF4FC";
                corQuatro = "#FEFEFE";
            break;    
            case 'success':
                corUm = "#1e7e34";
                corDois = "#28A745";
                corTres = "#D1E7DD";
                corQuatro = "#FEFEFE";
            break;   
            case 'danger':
                corUm = "#bd2130";
                corDois = "#DC3545";
                corTres = "#F8D7DA";
                corQuatro = "#FEFEFE";
            break;   
            case 'secondary':
                corUm = "#545b62";
                corDois = "#6C757D";
                corTres = "#E2E3E5";
                corQuatro = "#FEFEFE";
            break;   
            case 'dark':
                corUm = "#0C0E0F";
                corDois = "#343A40";
                corTres = "#D3D3D4";
                corQuatro = "#FEFEFE";
            break;                                                               
        }


        document.getElementById('cor_um').value = corUm;
        document.getElementById('cor_dois').value = corDois;
        document.getElementById('cor_tres').value = corTres;
        document.getElementById('cor_quatro').value = corQuatro;

    })
})


$(document).ready(function () {
    $("#input_videos_dois").click(function () {
        bootbox.alert({
            message: "<h5 class='text-muted text-center'>Atenção!</h5><h6 class='text-muted'>Para utilizar esse modelo de vídeo é preciso enviar uma imagem para ser exibida na sessão.</h6>",
            buttons: {
                ok: {
                    label: "Ok",
                    className: "btn-secondary"
                },
            },
            callback: function () {
                showModalUpload('modal-upload-preview-imagem', 'ControllerRedimencionaImagem', 'redimensiona', '1', 'videos')
            }
        });
    });
});

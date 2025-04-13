
var fileInput = document.getElementById('seleciona-arquivos');
fileInput.addEventListener('change', function (event) {
    var input = event.target;

    for (var i = 0; i < input.files.length; i++) {
        console.log(input.files[i]);
        $('#anexos').append(
                $('<div class="row anexo"  id="' + i + '">')
                .append($('<div class="col-9">').append('<span class="name_anexo">' + input.files[i].name + '</span><br /><span class="size_anexo">' + input.files[i].size + ' bytes</span> <small class="type_anexo">' + input.files[i].type + '</small>'))
                .append($('<div class="col-3">').append('<button class="remover btn btn-sm" onclick="remover(' + i + ')"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Remover</button>'))
                );
    }
});


function remover(id) {
//    $('#' + id).remove();
    $('.anexo').remove();
    $('#seleciona-arquivos').val(null);
}

function btnUploadInsert(id, tbl) {
    $('#tabela_pai').val(tbl);
    $('#id_tabela_pai').val(id);
}

$('#enviar').on('click', function () {
    var action = $('#form-upload > #action').val();
    var controller = $('#form-upload >  #controller').val()
    var verificaIdTbl = $('#form-upload > #id_tabela_pai').val();
    var verificaTbl = $('#form-upload >  #tabela_pai').val();
    if (!verificaIdTbl || !verificaTbl) {
        toastr["warning"]("<b>Atenção: </b>Preencha todos os campos, clique em <button class='btn btn-sm btn-success'><i class='fa fa-floppy-o'></i> Salvar</button> e só depois envie a imagem!");
        exit;
    }
    
        var form = $('#form-upload')[0];
        var formData = new FormData(form);

        $.ajax({
            url: '../../_php/Dispatch.php?controller=' + controller + '&&action=' + action,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                toastr["info"]("Aguardando conexão com o servidor...");
                $("#progress").html('<br/><span class="text-muted border-bottom">Enviando Arquivo </span><br/><progress class="mt-1"></progress></div>')
            },
            error: function () {
                toastr["error"]("Não foi possivel executar a ação desejada, favor entrar em contato com o administrador!");
            },
            success: function (data) {
                $('.toast-info').hide();
                $("#progress").empty();
                toastr["success"](data);
                
                if(verificaTbl === 'noticias'){listarImagens(verificaIdTbl, verificaTbl);}
                
                listarArquivos(verificaIdTbl);
            }
        });
    });



//function listarArquivos(tbl) {
//    $.ajax({
//        url: 'controller.php?action=arquivos&&tbl=' + tbl,
//        cache: false,
//        type: 'POST',
//        data: {id: id},
//        beforeSend: function () {
//            $("#tbody-arquivos").html("Carregando..."); //Carregando
//        },
//        error: function () {
//            $("#tbody-arquivos").html("Ajax error function: Ajax não pode receber os dados do controller php!");
//        },
//        success: function (data) {
//            $('#tbody-arquivos').html(data);
//        }
//    });
//};
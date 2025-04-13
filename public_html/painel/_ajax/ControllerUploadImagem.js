//FUNÇÃO ACIONADA NO ONCHANGE DO INPUT DE ARQUIVO
function previewImagem() {
    var imagem = document.querySelector('input[name=seleciona-imagem]').files[0];
    var preview = document.querySelector('img[id=preview-imagem]');
    $('#preview-imagem').show('slideDown');
    var reader = new FileReader();
    reader.onloadend = function () {
        preview.src = reader.result;
    };
    if (imagem) {
        reader.readAsDataURL(imagem);
    } else {
        preview.src = "";
    }
}

var fileInput = document.getElementById('seleciona-imagem');
fileInput.addEventListener('change', function (event) {
    var input = event.target;
    $("#label-anexo").remove();
    $('#card-body-preview-imagem').append(
            $('<div class="row anexo"  id="label-anexo">')
            .append($('<div class="col-9">').append('<span class="name_anexo">' + input.files[0].name + '</span><br /><span class="size_anexo">' + input.files[0].size + ' bytes</span> <small class="type_anexo">' + input.files[0].type + '</small>'))
            .append($('<div class="col-3">').append('<button class="remover" onclick="removerImagem()"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Remover</button>'))
            );
});

function removerImagem() {
    $('#preview-imagem').removeAttr('src');
    $('#label-anexo').remove();
    $('#seleciona-imagem').val(null);
}

$('#enviar-imagem').on('click', function () {

    var action = $('#form-upload-imagem > #action').val();
    var controller = $('#form-upload-imagem > #controller').val()
    var verificaIdTbl = $('#form-upload-imagem > #id-tabela').val();
    var verificaTbl = $('#form-upload-imagem > #tabela').val();
    var verificaSelecionaImagem = $('#seleciona-imagem').val();

    if (!verificaSelecionaImagem) {
        toastr["warning"]("<b>Atenção: </b>Você ainda não selecionou nenhuma imagem!");
        exit;
    }
    if (verificaIdTbl || !verificaTbl) {
        toastr["warning"]("<b>Atenção: </b>Preencha todos os campos, clique em <button class='btn btn-sm btn-success'><i class='fa fa-floppy-o'></i> Salvar</button> e só depois envie a imagem!");
        exit;
    }

    var form = $('#form-upload-imagem')[0];
    var formData = new FormData(form);

    $.ajax({
        url: '../../_php/Dispatch.php?controller=' + controller + '&&action=' + action,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            toastr["info"]("Aguardando conexão com o servidor...");
        },
        error: function () {
            toastr["error"]("Não foi possivel executar a ação desejada, favor entrar em contato com o administrador!");
        },
        success: function (data) {
            $('.toast-info').hide();
            toastr["success"](data);

            var urlAtual = window.location.href;
            if (urlAtual.includes('/aparencia')) {
                locate('logo')
                locate('header')
                locate('slide')
                console.log('/aparencia')
            }
    
        }
    });

});










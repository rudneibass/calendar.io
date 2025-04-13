function login() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerLogin&&action=logar',
        type: 'POST',
        data: $('#login').serialize(),
        beforeSend: function () {
            $(".loading").show();
            $('.btn-login-label').hide()
        },
        error: function () {
            $(".loading").hide();
            $('.btn-login-label').show()

            console.log("Não foi possivel executar a ação desejada, favor entrar em contato com o administrador.");
        },

        success: function (data) {
            if (data == "1") {
                window.location = "../caixa-de-entrada";
            } else {
                toastr["info"](data);
                $(".loading").hide();
                $('.btn-login-label').show()
            }
        }
    });
}

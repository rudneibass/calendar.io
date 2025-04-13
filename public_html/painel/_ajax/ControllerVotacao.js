function login() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerVotacao&&action=login',
        type: 'POST',
        data: $('#login').serialize(),
        beforeSend: function () {
            $(".loading").show();
            $('.btn-login-label').hide()
        },
        error: function () {
            $(".loading").hide();
            $('.btn-login-label').show()
        },
        success: function (response) {
            if (response == "1") {
                //window.location = "../votacao";
                window.location = "../pwa";
            } else {
                toastr["info"](response);
                $(".loading").hide();
                $('.btn-login-label').show()
            }
        }
    });
}

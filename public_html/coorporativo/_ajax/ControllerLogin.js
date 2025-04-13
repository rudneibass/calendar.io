function login() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMasterLogin&&action=logar',
        type: 'POST',
        data: $('#login').serialize(),
        error: function () {
            toastr["info"]("Não foi possivel executar a ação desejada, favor entrar em contato com o administrador: (4j4x)");
        },
        success: function (data) {
            if (data == "1") {
                window.location = "../master-entidade";
            } else {
                toastr["info"](data);
            }
        }
    });
}

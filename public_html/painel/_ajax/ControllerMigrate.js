function migrate() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMigrate&&action=migrate',
        cache: false,
        dataType: "json",
        beforeSend: function () {
            $("#modal-migrate").modal('show');
        },
        error: function () {
            $(".modal-migrate-alerts").html("Ocorreu um erro ao tentar atualizar o sistema, clique em OK para continuar.");
        },
        success: function (response) {
            console.log('Response =>', response);

            var data = jQuery.parseJSON(JSON.stringify(response));
            
            console.log('Data =>', data)
            $(".modal-migrate-alerts").empty();
            $(".modal-migrate-alerts").html(data.output);
        }
    });
}
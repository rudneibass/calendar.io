function  razaoSocial() {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerEntidade&&action=razaoSocial',
        type: 'POST',
        dataType: "json",
        success: function (json) {
            var data = jQuery.parseJSON(JSON.stringify(json));


            $('#span-razao-social').html('Entidade: '+data[0].razao_social); 
            $('#span-cnpj').html('Cnpj: '+data[0].cnpj);
            $('#span-fone-1').html('Telefone: '+data[0].fone_1);
            $('#span-dominio').html('Endereço: '+data[0].dominio);


            
        }
    });
}

function  masterOptionSelect(tbl) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerMasterOptionSelect&&action=optionSelect&&tbl=' + tbl,
        type: 'POST',
        success: function (data) {
            $('#optGroup' + tbl).html(data);
        }
    });
}
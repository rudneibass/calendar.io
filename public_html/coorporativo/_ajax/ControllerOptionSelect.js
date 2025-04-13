function  optionSelect(tbl) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerOptionSelect&&action=optionSelect&&tbl=' + tbl,
        type: 'POST',
        success: function (data) {
            $('#optGroup' + tbl).html(data);
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

function  optionSelectNovo({tabela, filters}) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerOptionSelect&&action=optionSelectNovo&&tbl=' + tabela,
        type: 'POST',
        data: filters,
        success: function (data) {
            $('#optGroup' + tbl).html(data);
        }
    });
}
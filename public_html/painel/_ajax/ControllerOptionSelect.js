function  optionSelect(tbl) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerOptionSelect&&action=optionSelect&&tbl=' + tbl,
        type: 'POST',
        success: function (data) {
            $('#optGroup' + tbl).html(data);
            $('.optGroup' + tbl).html(data);
        }
    });
}

function  masterOptionSelect(tbl) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerOptionSelect&&action=optionSelect&&tbl=' + tbl,
        type: 'POST',
        success: function (data) {
            $('#optGroup' + tbl).html(data);
        }
    });
}

function  optionSelectMaterias(tbl) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerOptionSelect&&action=optionSelectMaterias&&tbl=' + tbl,
        type: 'POST',
        success: function (data) {
            $('#optGroup' + tbl).html(data);
            $('.optGroup' + tbl).html(data);
        }
    });    
}

function  optionSelectTabelas(tbl) {
    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerOptionSelect&&action=optionSelectTabelas&&tbl=' + tbl,
        type: 'POST',
        success: function (data) {
            $('#optGroup' + tbl).html(data);
            $('.optGroup' + tbl).html(data);
        }
    })
}

function  optionSelectColunas(tabelasInputId, colunasInputId) {

    $('#'+ colunasInputId).attr("disabled", "disabled")

    let select = document.getElementById(tabelasInputId);
    let selectedValue = select.value;

    $.ajax({
        url: '../../_php/Dispatch.php?controller=ControllerOptionSelect&&action=optionSelectColunas&&tbl=' + selectedValue,
        type: 'POST',
        success: function (data) {
            console.log('aqui')
            $('#optGroupcolunas').empty();
            $('.optGroupcolunas').empty();

            $('#optGroupcolunas').html(data);
            $('.optGroupcolunas').html(data);

            $('#'+ colunasInputId).removeAttr("disabled")
        }
    })
}
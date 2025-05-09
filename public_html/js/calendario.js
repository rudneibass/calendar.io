let mesAtual = new Date().getMonth() + 1; // Mês atual (1-12)
let anoAtual = new Date().getFullYear(); // Ano atual

$(document).ready(function() { loadCalendar({increment: 0, user: 'calendarioComentado'}) })

function loadCalendar({increment, user}) {
    mesAtual += increment;
    if (mesAtual < 1) {
        mesAtual = 12;
        anoAtual--;
    } else if (mesAtual > 12) {
        mesAtual = 1;
        anoAtual++;
    }
    $.ajax({
        url: 'dispatch.php?controller=CalendarController&&action=loadCalendar',
        method: 'GET',
        data: { mes: mesAtual, ano: anoAtual, user: user },
        beforeSend: function() {
            $('.loading').show();
        },
        success: function(response) {
            $('.loading').hide();
            $('#calendario').html(response);
            let data = new Date(anoAtual, mesAtual - 1).toLocaleString('pt-BR', { month: 'long', year: 'numeric' });
            data = data.charAt(0).toUpperCase() + data.slice(1);
            $('#mesAno').text(data);
        }
    });
}

function loadGroups({date, user}) {
    $('#modal_groups').modal('show');
    $.ajax({
        url: 'dispatch.php?controller=GroupController&&action=all',
        method: 'GET',
        data: { date, user },
        beforeSend: function() {
            $('.loading').show();
        },
        success: function(response) {
           $('.loading').hide();
           $('#list_groups').empty();
           $('#list_groups').html(response);
        }
    });
}

function loadMessages({user, group, date}) {
    $('#modal_messages').modal('show');
    $.ajax({
        url: 'dispatch.php?controller=MessageController&&action=loadMessages',
        method: 'GET',
        data: { user, group, date },
        beforeSend: function() {
            $('.loading').show();
        },
        success: function(response) {
           $('.loading').hide();
           $('.message-hub').empty();
           $('.message-hub').html(response);
        }
    });
}
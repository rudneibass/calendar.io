$(document).ready( function() { loadUsers() })

function loadUsers() {
    $.ajax({
        url: 'dispatch.php?controller=UserController&&action=loadUsers',
        method: 'GET',
        beforeSend: function() {
            $('.loading').show();
        },
        success: function(response) {
            $('.loading').hide();
            $('#users_list').html(response);
        }
    });
}

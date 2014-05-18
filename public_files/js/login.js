$(document).ready(function() {
    $('#alert_please_wait').hide();
    $('#sign_in').click(function(e) {
        e.preventDefault();
        $('#login_form').hide();
        $('#alert_please_wait').show();
        host = $('#host').val();
        $.ajax({
            url: host + 'login',
            type: "POST",
            data: $('#login_form').serializeArray(),
            success: function(data) {
                window.location = data;
            }
        });
    });
});
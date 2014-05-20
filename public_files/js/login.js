$(document).ready(function() {
    $('#alert_please_wait').hide();
    $('#alert_login_failed').hide();
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
                $('#alert_please_wait').hide();
                if (data == 'login_failed') {
                    $('#alert_login_failed').html('Błędne dane, spróbuj ponownie...');
                    $('#alert_login_failed').show();
                    $('#login_form').show();
                } else {
                    window.location.href = data;
                }
            }
        });
    });
});
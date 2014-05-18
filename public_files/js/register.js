$(document).ready(function() {
    $('#alert_register_end').hide();
    $('#alert_register_fail').hide();
    $('#sign_up').click(function(e) {
        e.preventDefault();
        if ($('#rules').is(':checked')) {
            $('#register_form').hide();
            host = $('#host').val();
            $.ajax({
                url: host + 'register',
                type: "POST",
                data: $('#register_form').serializeArray(),
                success: function(data) {
                    $('#alert_register_fail').hide();
                    if (data == 'success') {
                        $('#alert_register_end').show();
                    } else if (data == 'invalid_password') {
                        $('#alert_register_fail').html('Podane hasło jest zbyt krótkie (min. 5 znaków) lub niepoprawnie powtórzone.');
                        $('#alert_register_fail').show();
                        $('#register_form').show();
                    } else if (data == 'customer_exists') {
                        $('#alert_register_fail').html('Istnieje już konto o podanej nazwie użytkownika lub/i haśle.');
                        $('#alert_register_fail').show();
                        $('#register_form').show();
                    } else if (data == 'invalid_data') {
                        $('#alert_register_fail').html('Coś podałeś źle, ale nie miałem czasu, aby napisać indywidualne walidatory, więc szukaj błędu sam.');
                        $('#alert_register_fail').show();
                        $('#register_form').show();
                    } else if (data == 'acctept_rules') {
                        $('#alert_register_fail').html('Przeczytaj i zaakceptuj regulamin.');
                        $('#alert_register_fail').show();
                        $('#register_form').show();
                    }
                }
            });
        } else {
            $('#alert_register_fail').html('Przeczytaj i zaakceptuj regulamin.');
            $('#alert_register_fail').show();
        }
    });
});
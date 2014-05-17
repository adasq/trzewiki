$(document).ready(function() {
    $('#search_button').click(function(e) {
        e.preventDefault();
        host = $('#search_host').val();
        phrase = $('#search_phrase').val();
        window.location.replace(host + 'search/' + phrase);
    });
});




$(document).ready(function() {
    $('#need_login').hide();
    $('#retry').hide();

    $('a[href*=".jpg"]').fancybox();
    $('a[href*=".png"]').fancybox();
    $('a[href*=".JPG"]').fancybox();
    $('a[href*=".PNG"]').fancybox();

    $('a.image_secondary').click(function(e) {
        e.preventDefault();
        $('img#image_primary').attr('src', e.target.src);
        $('a.fancybox').attr('href', e.target.src);
    });

    $('#add_to_cart').click(function(e) {
        e.preventDefault();
        host = $('#host').val();
        $.ajax({
            url: host + 'add_item',
            type: "POST",
            data: $('#add_item_form').serializeArray(),
            success: function(data) {
                if (data == 'need_login') {
                    $('#need_login').show();
                } else if(data == 'retry') {
                    $('#retry').show();
                } else {
                    window.location = data;
                }
            }
        });
    });

    $('#available_sizes').change(function() {
        host = $('#host').val();
        $.ajax({
            url: host + 'find_minimum_price',
            type: "POST",
            data: $('#add_item_form').serializeArray(),
            success: function(data) {
                data = data.split(';');
                if (data.length == 1) {
                    alert(data);
                } else {
                    $('#price').html('<h3>Cena: ' + data[1] + ' PLN</h3>');
                    $('#item_id').val(data[0]);
                }
            }
        });
    });
});


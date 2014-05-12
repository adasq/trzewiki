$(document).ready(function() {
    $('a[href*=".jpg"]').fancybox();
    $('a[href*=".png"]').fancybox();
    $('a[href*=".JPG"]').fancybox();
    $('a[href*=".PNG"]').fancybox();

    $('a.image_secondary').click(function(e) {
        e.preventDefault();
        $('img#image_primary').attr('src', e.target.src);
        $('a.fancybox').attr('href', e.target.src);
    });
});


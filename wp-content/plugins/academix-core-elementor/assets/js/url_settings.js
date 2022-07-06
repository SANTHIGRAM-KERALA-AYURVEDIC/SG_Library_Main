jQuery(document).ready(function ($) {
    var $form = $('#academix_url_settings_form');
    $form.on('submit', function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.post(ajaxurl, data)
            .then(function (response) {
                $('#academix_url_settings_form').before('<div class="updated notice is-dismissible"><p>' +response.data.message+ '</p>' +
                    '<button id="dismiss-admin-message" class="notice-dismiss" type="button">' +
                    '<span class="screen-reader-text">Dismiss this notice.</span></button></div>');
                $("#dismiss-admin-message").click(function(e) {
                    e.preventDefault();
                    $('.updated').fadeTo(100, 0, function() {
                        $('.updated').slideUp(100, function() {
                            $('.updated').remove();
                        });
                    });
                });
            })
            .fail(function (error) {
                $('#academix_url_settings_form').before('<div class="error notice is-dismissible"><p>' +error.responseJSON.data.message+ '</p>' +
                    '<button id="dismiss-admin-message" class="notice-dismiss" type="button">' +
                    '<span class="screen-reader-text">Dismiss this notice.</span></button></div>');
                $("#dismiss-admin-message").click(function(e) {
                    e.preventDefault();
                    $('.error').fadeTo(100, 0, function() {
                        $('.error').slideUp(100, function() {
                            $('.error').remove();
                        });
                    });
                });
            });
    })
});
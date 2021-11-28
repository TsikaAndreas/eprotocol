$(document).ready(function () {
    $('#resend_verify_email').on('click', function () {
        $.ajax(
        {url: window.location.origin + '/email/verification-notification',
            method: "post",
            dataType: "json",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            beforeSend: function () {
                let parent = $('#resend_verify_email');
                if (parent.find('div.resend').length > 0) {
                    parent.find('div.resend').remove();
                }
                if (parent.find('div.ajax-loader').length > 0) {
                    parent.find('div.ajax-loader').remove();
                }
                parent.append("<div class='ajax-loader'></div>");
            },
            success: function (results) {
                if (results.success) {
                    let item = $('#resend_verify_email').find('div.ajax-loader');
                    item.removeClass('ajax-loader').addClass('resend success').text(results.message);
                } else {
                    let item = $('#resend_verify_email').find('div.ajax-loader');
                    item.removeClass('ajax-loader').addClass('resend fail').text('Error!');
                }
            },
            fail: function () {
                let item = $('#resend_verify_email').find('div.ajax-loader');
                item.removeClass('ajax-loader').addClass('resend fail').text('Error!');
            },
            error: function () {
                let item = $('#resend_verify_email').find('div.ajax-loader');
                item.removeClass('ajax-loader').addClass('resend fail').text('Error!');
            }
        });
    });
});

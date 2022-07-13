$('#user_login_form').submit(function(e) {

    e.preventDefault();
    var loginForm = $(this);
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: loginForm.attr('action'),
        data: loginForm.serialize(),
        beforeSend: function () {
         $('#login_button').button('loading');
      },
      success: function (response) {
         if (response.status == 'success') {
            $('form#user_login_form').trigger('reset');
            $('#login_button').button('reset');
            window.location.replace(response['url']);
            success_msg("Register Successfully");
         } else if (response.status == 'failure') {
            error_msg(response.error);
            $('#login_button').button('reset');
         } else {
            window.location.replace(response['url']);
         }
      }
    });
});
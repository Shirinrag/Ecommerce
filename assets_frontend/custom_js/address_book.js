$('#save_new_address_form').submit(function (e) {
   e.preventDefault();
   var save_new_address_form = $(this);
   $.ajax({
      dataType: 'json',
      type: 'POST',
      url: save_new_address_form.attr('action'),
      data: save_new_address_form.serialize(),
      beforeSend: function () {
         $('#save_new_address_button').button('loading');
      },
      success: function (response) {
         if (response.status == 'success') {
            $('form#save_new_address_form').trigger('reset');
            $('#save_new_address_button').button('reset');
            window.location.replace(response['url']);
            success_msg("Register Successfully");
         } else if (response.status == 'failure') {
            error_msg(response.error);
            $('#save_new_address_button').button('reset');
         } else {
            window.location.replace(response['url']);
         }
      }
   });
});
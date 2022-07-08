$('#user_register_form').submit(function (e) {
   e.preventDefault();
   var addCategoryForm = $(this);
   $.ajax({
      dataType: 'json',
      type: 'POST',
      url: addCategoryForm.attr('action'),
      data: addCategoryForm.serialize(),
      beforeSend: function () {
         $('#register_button').button('loading');
      },
      success: function (response) {
         if (response.status == 'success') {
            $('form#user_register_form').trigger('reset');
            $('#register_button').button('reset');
            window.location.replace(response['url']);
            success_msg("Register Successfully");
         } else if (response.status == 'failure') {
            error_msg(response.error);
            $('#register_button').button('reset');
         } else {
            window.location.replace(response['url']);
         }
      }
   });
});
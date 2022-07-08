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
            $('.chosen-select-deselect').val('').trigger('chosen:updated');
            success_msg("Category Added Successfully");
            $('#a_category_data').DataTable().ajax.reload();
         } else if (response.status == 'failure') {
            error_msg(response.error);
            $('#register_button').button('reset');
         } else {
            window.location.replace(response['url']);
         }
      }
   });
});
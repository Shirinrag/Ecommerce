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
            // window.location.replace(response['url']);
            success_msg("Address Added Successfully");
         } else if (response.status == 'failure') {
            error_msg(response.error);
            $('#save_new_address_button').button('reset');
         } else {
            // window.location.replace(response['url']);
         }
      }
   });
});
/**confirm Order */
$('#confirmorderform').submit(function (e) {
   e.preventDefault();
   var save_new_address_form = $(this);
   $.ajax({
      dataType: 'json',
      type: 'POST',
      url: save_new_address_form.attr('action'),
      data: save_new_address_form.serialize(),
      beforeSend: function () {
         $('#confirmorderbtn').button('loading');
      },
      success: function (response) {
         if (response.status == 'success') {
            $('form#confirmorderform').trigger('reset');
            $('#confirmorderbtn').button('reset');
            window.location.replace(response['url']);
            success_msg("Address Added Successfully");
         } else if (response.status == 'failure') {
            error_msg(response.error);
            $('#confirmorderbtn').button('reset');
         } else {
            // window.location.replace(response['url']);
         }
      }
   });
});

 $(document).on('click', '.edit_address', function() {
     var id = $(this).attr("id");
      $.ajax({
         url: bases_url + 'Frontend/get_address_on_id',
         method: "POST",
         data: {
             id: id
         },
         dataType: "json",
         success: function(data) {
             if (data.status == 'success') {
                 var info = data.address_data;
                 $('#id').val(info['id']);
                 $('#edit_address_type').val(info['address_type']);
                 $('#edit_roomno').val(info['roomno']);
                 $('#edit_building').val(info['building']);                
                 $('#edit_city').val(info['street']);
                 $('#edit_zone').val(info['zone']);
             } else {
                 window.location.replace(response['url']);
             }
         }
     });
 });
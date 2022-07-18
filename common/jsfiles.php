<script type="text/javascript" src="<?php echo base_url();?>assets_frontend/js/jquery-2.2.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/unveil/1.3.0/jquery.unveil.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets_frontend/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets_frontend/js/owl-carousel/owl.carousel.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets_frontend/js/themejs/libs.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets_frontend/js/unveil/jquery.unveil.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets_frontend/js/countdown/jquery.countdown.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets_frontend/js/dcjqaccordion/jquery.dcjqaccordion.2.8.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets_frontend/js/datetimepicker/moment.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets_frontend/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets_frontend/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets_frontend/js/jquery-ui/jquery.easy-autocomplete.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets_frontend/js/modernizr/modernizr-2.6.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets_frontend/js/minicolors/jquery.miniColors.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets_frontend/js/themejs/application.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets_frontend/js/themejs/homepage.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets_frontend/js/themejs/toppanel.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets_frontend/js/themejs/so_megamenu.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets_frontend/js/themejs/addtocart.js"></script>  

  <script src="<?=base_url()?>assets_frontend/js/button-inline-loader.js"></script>
  <script src="<?= base_url();?>assets_frontend/js/toastr.min.js"></script>
     <script src="<?=base_url()?>assets/js/jquery.easy-autocomplete.min.js" type="text/javascript"></script>
  <!-- jQuery UI -->

  <script type='text/javascript'>


	function error_msg(t) {
	    for (var i in t) "" != t[i] ? $("#" + i + "_error").html(t[i]).show() : $("#" + i + "_error").html("").hide();
	        $(".error_msg").delay(10000).fadeOut()
	}

	 function success_msg(t) {
        toastr.success(t);
    }

    function success_error(t) {
        toastr.error(t);
    }

    function success_warningt(t) {
        toastr.warning(t);
    }
</script>
<script type="text/javascript">

$(document).ready(function(){
            var new_value=$('#fk_lang_id :selected').val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>Frontend/set_session_data",
                data: {
                    new_value: new_value
                },
                dataType: "json",
                cache: false,
                success: function (result) {
                    var lang_id = result.lang_id;
                    // $('#lang_id_new').val(lang_id);
                }
            });
         $(document).on("change", "#fk_lang_id", function() {
                var fk_lang_id = $('#fk_lang_id').val();
                $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>Frontend/set_session_data",
                data: {
                    new_value: fk_lang_id
                },
                dataType: "json",
                cache: false,
                success: function (result) {
                    location.reload();
                    var lang_id = result.lang_id;
                    
                }
            });
            
        });

        
    });
    var bases_url="<?=base_url() ?>";

      
     // $("#autouser11").autocomplete({
     //    source: function( request, response ) {      
     //        $.ajax({
     //            url: bases_url+"Frontend/get_search_data",
     //            type: 'post',
     //            dataType: "json",
     //            data: {
     //             search: request.term
     //            },
     //            success: function( data ) {
     //               response(data);
     //            }
     //     });
     //  },
     //  select: function (event, ui) {
     //   // Set selection
     //   $('#autouser11').val(ui.item.product_name); // display the selected text
      
     //   return false;
     //  },
     //  focus: function(event, ui){
     //     $("#autouser11").val(ui.item.product_name);      
     //     return false;
     //   },
     // });
      var options = {

  url: function(phrase) {
    return bases_url+"Frontend/get_search_data";
  },

  getValue: function(element) {

    return element.product_name;
  },

  ajaxSettings: {
    dataType: "json",
    method: "POST",
    data: {
      dataType: "json"
    }
  },

  list: {
        match: {
            enabled: true
        }
    },

  preparePostData: function(data) {
    data.phrase = $("#autouser11").val();
    return data;
  },

  requestDelay: 400
};

$("#autouser11").easyAutocomplete(options);

$('#search_form').submit(function(e) {

    e.preventDefault();
    var loginForm = $(this);
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: loginForm.attr('action'),
        data: loginForm.serialize(),
        
      success: function (response) {
         if (response.status == 'success') {
            $('form#search_form').trigger('reset');          
            window.location.replace(response['url']);
            
         } 
      }
    });
});

</script>
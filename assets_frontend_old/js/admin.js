function validate_admin_login(ele){
	hide_message_box(ele);
	var hasError=0;
	var first_name= jQuery("#first_name").val();
    console.log(first_name);
	var last_name= jQuery("#last_name").val();
    var contact_no= jQuery("#contact_no").val();
    var email= jQuery("#email").val();
    var password= jQuery("#password").val();


	if (jQuery.trim(user_id) == '') {
		showError("Please enter user id.", "user_id");
		hasError = 1;
	} 
	else{
		changeError("user_id");
	}
	// else if (isValidEmail(user_id)) {
	// 	changeError("user_id");
	// } else {
	// 	showError("Please enter valid email address.", "user_id");
	// 	hasError = 1;
	// }

	if(jQuery.trim(password)=='') { showError("Please enter password","password"); hasError = 1; } else { changeError("password"); }

	if(hasError==1){
		return false;
	}else{
		var account = {};
		account.login = {};
		account.login.user_id = jQuery("#user_id").val();
		account.login.password = jQuery("#password").val();

		var q = JSON.stringify(account);
		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "alogin/validate_login",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ jQuery(".btn-quirk").text('Validating ...').prop('disabled', true);},
			success: function(res){

				jQuery(".btn-quirk").text('Sign In').prop('disabled', false);
				if(res.status=='1' && res.level=='2'){ // Success
					jQuery(ele).find('.alert-success').css('display','block').html(res.msg); 
					jQuery(ele).find('.alert-danger').css('display','none'); 
					document.getElementById('frmadminlogin').reset();  
					window.location.href="admin";
				}
				else if(res.status=='1')
				{
                   jQuery(ele).find('.alert-success').css('display','block').html(res.msg); 
					jQuery(ele).find('.alert-danger').css('display','none'); 
					document.getElementById('frmadminlogin').reset();  
					/*window.location.href="customer";*/
					window.location.href="admin";
				}
				else
				{ // Failed
					jQuery(ele).find('.alert-success').css('display','none'); 
					jQuery(ele).find('.alert-danger').css('display','block').html(res.msg); 
				}
			}
		});
	}
	return false;
}

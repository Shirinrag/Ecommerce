							// Raj Namdev


function validate_add_product(ele) {
	hide_message_box(ele);

	var hasError=0;
	var product_name = jQuery("#product_name").val();
	var product_name_ar = jQuery("#product_name_ar").val();
	var product_category = jQuery("#product_category").val();
	var subcategory = jQuery('#subcategory').val();
	var product_unit = jQuery('#product_unit').val(); 
	var is_superdeal = jQuery('#is_superdeal').val();
	var pack_size = jQuery('#pack_size').val();
	var product_price = jQuery('#product_price').val();
	var product_offer_price = jQuery('#product_offer_price').val();
	var product_purchase_price = jQuery('#product_purchase_price').val();
	var stock_qty = jQuery('#stock_qty').val();
	var product_barcode = jQuery('#product_barcode').val();
	var product_code = jQuery('#product_code').val();
	var image_name = jQuery('#image_name').val();
	
	if(jQuery.trim(product_name)=='') { showError("Please Enter Product Name", "product_name"); hasError = 1; } else { changeError("product_name"); }
	if(jQuery.trim(product_name_ar)=='') { showError("Please Enter Product Name in ar", "product_name_ar"); hasError = 1; } else { changeError("product_name_ar"); }
	if(jQuery.trim(product_category)=='') { showError("Please Select Category", "product_category"); hasError = 1; } else { changeError("product_category"); }
	if(jQuery.trim(subcategory)=='') { showError("Please Select Subcategory", "subcategory"); hasError = 1; } else { changeError("subcategory"); }
	if(jQuery.trim(product_unit)=='') { showError("Please Select Product Unit", "product_unit"); hasError = 1; } else { changeError("product_unit"); }
	if(jQuery.trim(is_superdeal)=='') { showError("Has product in superdeal?", "is_superdeal"); hasError = 1; } else { changeError("is_superdeal"); }
	if(jQuery.trim(pack_size)=='') { showError("Please Enter Pack Size", "pack_size"); hasError = 1; } else { changeError("pack_size"); }
	if(jQuery.trim(image_name)=='') { showError("Please upload Product Image", "image_name"); hasError = 1; } else { changeError("image_name"); }
	if(jQuery.trim(product_code)=='') { showError("Please Enter Product Code", "product_code"); hasError = 1; } else { changeError("product_code"); }

	if(jQuery.trim(product_price)=='') { 
		showError("Please Enter Product Price", "product_price"); hasError = 1; 
	}else if(!isNumDigit(product_price)){
		showError("Please Enter Numeric values only", "product_price"); hasError = 1; 
	} else { 
		changeError("product_price"); 
	}

	if(jQuery.trim(product_offer_price)=='') { 
		showError("Please Enter Product Offer Price", "product_offer_price"); hasError = 1; 
	}else if(!isNumDigit(product_price)){
		showError("Please Enter Numeric values only", "product_offer_price"); hasError = 1; 
	} else { 
		changeError("product_offer_price"); 
	}

	if(jQuery.trim(product_purchase_price)=='') { 
		showError("Please Enter Purchase price", "product_purchase_price"); hasError = 1; 
	}else if(!isNumDigit(product_price)){
		showError("Please Enter Numeric values only", "product_purchase_price"); hasError = 1; 
	} else { 
		changeError("product_purchase_price"); 
	}



	if(jQuery.trim(product_unit)=='') { showError("Select Product unit", "product_unit"); hasError = 1; } else { changeError("product_unit"); }

/*	if(jQuery.trim(product_image)=='') { 
		showError("Please select .png,.jpg file", "product_image"); hasError = 1; 
	}else if(!check_image_file('product_image')){
		showError("Please select .png,.jpg file only", "product_image"); hasError = 1; 
	} else { 
		changeError("product_image"); 
	}*/

	if(hasError==1){
		return false;
	}else{
		return true;
	}  
}


function validate_update_sub_category(ele){

	var hasError = 0;
	var sub_category_id = $("#sub_category_id").val();
	var category_id = $("#category_id").val();
	var sub_category_name = $("#sub_category_name").val();
	var sub_category_name_ar = $("#sub_category_name_ar").val();
	var sub_category_sort_order = $("#sub_category_sort_order").val();
	
	if(jQuery.trim(category_id)=='') {
	 showError("Please select category","category_id"); hasError = 1; 
	}else {
		changeError("category_id");
	}
	if(jQuery.trim(sub_category_name)==''){
		 showError("Please enter sub category","sub_category_name"); hasError = 1; 
	}else{
		changeError("sub_category_name");
	}

	if(jQuery.trim(sub_category_name_ar)==''){
		 showError("Please enter sub category name in ar","sub_category_name_ar"); hasError = 1; 
	}else{
		changeError("sub_category_name_ar");
	}

	if(jQuery.trim(sub_category_sort_order)==''){
		 showError("Please enter sub category order","sub_category_sort_order"); hasError = 1; 
	}else{
		changeError("sub_category_sort_order");
	}

	if(hasError==1){
		return false;
	}else{

		if(confirm("Are you sure wanted to update category?")){
			var user = {};
			user.product = {};
			user.product.sub_category_id = sub_category_id;
			user.product.category_id = category_id;
			user.product.sub_category_name = sub_category_name;
			user.product.sub_category_name_ar = sub_category_name_ar;
			user.product.sub_category_sort_order = sub_category_sort_order;
						
			var q = JSON.stringify(user);
			jQuery.ajax({
				dataType: 'json',
				type: "POST",
				url: "update_sub_category",
				data: {'jsonObj' : q},
				cache: false,
				beforeSend: function(){ 
					jQuery(".btn-save").html('Please Wait!.').prop('disabled', true);
				},
				success: function(res){
					jQuery(".btn-save").html('<i class="fa fa-check"></i> Update').prop('disabled', true);
		          	if(res.status=='1'){ // Success
		          		jQuery(ele).find('.alert-success').css('display','block').html(res.msg); 
						jQuery(ele).find('.alert-danger').css('display','none'); 
		          	}else{ // Failed
		          		jQuery(ele).find('.alert-success').css('display','none');
						jQuery(ele).find('.alert-danger').css('display','block').html(res.msg);  
		          	}
	      		}
	  		});
		}
	}
	return false;
}



function delete_sub_category(ele,sub_category_id){
	if(confirm("Are you sure wanted to delete the selected category?")){
		var user = {};
		user.product = {};
		user.product.sub_category_id = sub_category_id;
					
		var q = JSON.stringify(user);
		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "delete_sub_category",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ 
				jQuery(ele).html('..').prop('disabled', true);
			},
			success: function(res){
				jQuery(ele).html('Deleted').prop('disabled', true);
	          	if(res.status=='1'){ // Success
	          		jQuery(ele).closest('tr').remove();
	          	}
      		}
  		});
	}
	return false;
}



function validate_new_child_category(ele){
	hide_message_box(ele);
	var hasError = 0;
	var category_id = $("#category_id").val();
	var sub_category_id = $("#sub_category_id").val();
	var child_category_name = $("#child_category_name").val();
	var child_category_name_ar = $("#child_category_name_ar").val(); 
	var child_category_sort_order = $("#child_category_sort_order").val(); 
	
	if(jQuery.trim(category_id)=='') {
	 showError("Please select category","category_id"); hasError = 1; 
	}else {
		changeError("category_id");
	}

	if(jQuery.trim(sub_category_id)=='') {
	 showError("Please select sub category","sub_category_id"); hasError = 1; 
	}else {
		changeError("sub_category_id");
	}



	if(jQuery.trim(child_category_name)==''){
		 showError("Please enter child category","child_category_name"); hasError = 1; 
	}else{
		changeError("child_category_name");
	}

	if(jQuery.trim(child_category_name_ar)==''){
		 showError("Please enter child category name in ar","child_category_name_ar"); hasError = 1; 
	}else{
		changeError("child_category_name_ar");
	}

	if(jQuery.trim(child_category_sort_order)==''){
		 showError("Please enter child category name in ar","child_category_sort_order"); hasError = 1; 
	}else{
		changeError("child_category_sort_order");
	}
	
	if(hasError==1){
		return false;
	}else{
		
	}
}


function validate_update_child_category(ele){
	hide_message_box(ele);
	var hasError = 0;
	var category_id = $("#category_id").val();
	var sub_category_id = $("#sub_category_id").val();
	var child_category_name = $("#child_category_name").val();
	var child_category_name_ar = $("#child_category_name_ar").val(); 
	
	if(jQuery.trim(category_id)=='') {
	 showError("Please select category","category_id"); hasError = 1; 
	}else {
		changeError("category_id");
	}

	if(jQuery.trim(sub_category_id)=='') {
	 showError("Please select sub category","sub_category_id"); hasError = 1; 
	}else {
		changeError("sub_category_id");
	}



	if(jQuery.trim(child_category_name)==''){
		 showError("Please enter child category","child_category_name"); hasError = 1; 
	}else{
		changeError("child_category_name");
	}

	if(jQuery.trim(child_category_name_ar)==''){
		 showError("Please enter child category name in ar","child_category_name_ar"); hasError = 1; 
	}else{
		changeError("child_category_name_ar");
	}
	
	if(hasError==1){
		return false;
	}else{
		
	}
}


function delete_child_category(ele,child_category_id){
	if(confirm("Are you sure wanted to delete the selected child category?")){
		var user = {};
		user.product = {};
		user.product.child_category_id = child_category_id;
		var q = JSON.stringify(user);
		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "delete_child_category",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ 
				jQuery(ele).html('..').prop('disabled', true);
			},
			success: function(res){
				if(res.status=='1'){ // Success
	          		jQuery(ele).closest('tr').remove();
	          	}
      		}
  		});
	}
	return false;
}

function delete_product(ele,product_id){
	if(confirm("Are you sure wanted to delete the selected product?")){
		var user = {};
		user.product = {};
		user.product.product_id = product_id;
					
		var q = JSON.stringify(user);
		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "delete_product",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ 
				jQuery(ele).html('..').prop('disabled', true);
			},
			success: function(res){
				if(res.status=='1'){ // Success
	          		jQuery(ele).closest('tr').remove();
	          	}
      		}
  		});
	}
	return false;
}

function delete_gallery_product(ele,product_id,img_path){
	if(confirm("Are you sure wanted to delete the selected product?")){
		var user = {};
		user.product = {};
		user.product.product_id = product_id;
		user.product.img_path = img_path;
					
		var q = JSON.stringify(user);
		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "delete_gallery_product",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ 
				jQuery(ele).html('..').prop('disabled', true);
			},
			success: function(res){
				if(res.status=='1'){ // Success
	          		jQuery(ele).closest('tr').remove();
	          	}
      		}
  		});
	}
	return false;
}




































							// Ended Raj Namdev

(function ($) {	
	$.fn.serializeFormJSON = function () {
		var o = {};
		var a = this.serializeArray();
		$.each(a, function () {
			if (o[this.name]) {
				if (!o[this.name].push) {
					o[this.name] = [o[this.name]];
				}
				o[this.name].push(this.value || '');
			} else {
				o[this.name] = this.value || '';
			}
		});
		return o;
	};
});

function showErrorOnElement(id){
	$("#"+id).addClass("errorOnElemet");
}

function changeErrorOnElement(id){
	$("#"+id).removeClass("errorOnElemet");
}

function showError(msg, id){
	if($("#"+id).closest(".form-group").hasClass("has-error")){
		$("#"+id).closest(".form-group").find("label.error").html("<label class='error'>"+ msg +"</label>");
	}else{
		$("#"+id).closest(".form-group").addClass("has-error");
		$( "<label class='error'>"+ msg +"</label>" ).appendTo( $("#"+id).closest(".form-group") );
	}
}

function changeError(id){
	$("#"+id).closest(".form-group").removeClass("has-error");
	$("#"+id).closest(".form-group").find("label.error").remove();
}

function trim(str){ 
	return((""+str).replace(/^\s*([\s\S]*\S+)\s*$|^\s*$/,'$1') ); 
}

function isValidEmail(value){
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	if(filter.test(trim(value)))
		return true;
	else
		return false;
} 

function isPhone(value){
	if(value.length !=10){
		return false;
	}else{
		var iChars = "0123456789+-#/() ";
		for (var i = 0; i < value.length; i++){
			if (iChars.indexOf(value.charAt(i)) == -1){
				return false;
			}
		} 
		return true;
	}
}

function is_mobile_number(value){
	var iChars = "0123456789";
	if(value.length!=10){
		return false;
	}
	for (var i = 0; i < value.length; i++){
		if (iChars.indexOf(value.charAt(i)) == -1){
			return false;
		}
	} 
	return true;
}


function isNumber(value){
	var iChars = "0123456789";
	for (var i = 0; i < value.length; i++){
		if (iChars.indexOf(value.charAt(i)) == -1){
			return false;
		}
	} 
	return true;
}

function isNumberKey(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function isNumDigit(value){
	var iChars = "0123456789.";
	for (var i = 0; i < value.length; i++){
		if (iChars.indexOf(value.charAt(i)) == -1){
			return false;
		}
	} 
	return true;
}

function isPincode(value){
	var iChars = "0123456789() ";
	for (var i = 0; i < value.length; i++){
		if (iChars.indexOf(value.charAt(i)) == -1){
			return false;
		}
	} 
	return true;
} //End of isPinocde()

function is_int(value){
	if(value>0 && (value/1)==0){
		return true;
	}else{
		return false;
	}
}

function checkXSLFile(inputfiled) {
	var file = $('input[name=' + inputfiled + ']').val();
	var exts = ['xls','xlsx'];
    // first check if file field has any value
    if (file) {
        // split file name at dot
        var get_ext = file.split('.');
        // reverse name to check extension
        get_ext = get_ext.reverse();
        // check file type is valid as given in 'exts' array
        if ($.inArray(get_ext[0].toLowerCase(), exts) > -1) {
        	return true;
        } else {
        	return false;
        }
    }
}


function check_csv_file(inputfiled) {
	var file = $('input[name=' + inputfiled + ']').val();
	var exts = ['csv'];
    // first check if file field has any value
    if (file) {
        // split file name at dot
        var get_ext = file.split('.');
        // reverse name to check extension
        get_ext = get_ext.reverse();
        // check file type is valid as given in 'exts' array
        if ($.inArray(get_ext[0].toLowerCase(), exts) > -1) {
        	return true;
        } else {
        	return false;
        }
    }
}


function check_image_file(inputfiled) {
	var file = $('input[name=' + inputfiled + ']').val();
	var exts = ['png','jpg'];
    // first check if file field has any value
    if (file) {
        // split file name at dot
        var get_ext = file.split('.');
        // reverse name to check extension
        get_ext = get_ext.reverse();
        // check file type is valid as given in 'exts' array
        if ($.inArray(get_ext[0].toLowerCase(), exts) > -1) {
        	return true;
        } else {
        	return false;
        }
    }
}


function scrollToElement(selector, time, verticalOffset) {
	time = typeof (time) != 'undefined' ? time : 1000;
	verticalOffset = typeof (verticalOffset) != 'undefined' ? verticalOffset : 0;
	element = $(selector);
	offset = element.offset();
	offsetTop = offset.top + verticalOffset;
	$('html, body').animate({
		scrollTop: offsetTop
	}, time);
}

function is_email_exist(email){
	var user = {};
	user.account = {};
	user.account.emailaddress = email;
	var q = JSON.stringify(user);

	var result = jQuery.ajax({
		url: jsBaseUrl+"home/check_email_address",
		type: 'POST',
		data: {'jsonObj': q},
		cache: false,
		async: false,
		success: function(eMsg) {
		}
	}).responseText;
	return result;
}


function is_offer_exist(offer_code){
	var offer = {};
	offer.account = {};
	offer.account.offer_code = offer_code;
	var q = JSON.stringify(offer);

	var result = jQuery.ajax({
		url: jsBaseUrl+"home/check_offer",
		type: 'POST',
		data: {'jsonObj': q},
		cache: false,
		async: false,
		success: function(eMsg) {
		}
	}).responseText;
	return result;
}

function hide_message_box(ele){
	jQuery(ele).find('.alert-success').css('display','none'); 
	jQuery(ele).find('.alert-danger').css('display','none'); 
}

function validate_admin_login(ele){
	hide_message_box(ele);
	var hasError=0;
	var user_id= jQuery("#user_id").val();
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

function validate_add_new_category(ele){
	hide_message_box(ele);
	var hasError = 0;
	var category_name = $('#category_name').val(); 
	var category_name_ar = $('#category_name_ar').val();
	var image_file=$('#image_file').val()

	if(jQuery.trim(category_name)=='') { 
		showError("Please enter category name","category_name"); hasError = 1; 
	}else if(jQuery.trim(category_name_ar)==''){
		showError("Please enter category name in ar","category_name_ar"); hasError = 1; 
	}
	else if(jQuery.trim(image_file) == '')
	{
		showError("Please Select the File");
	}
	else {
		changeError("category_name");
	}
	
	if(hasError==1){
		return false;
	}else{
		
	}
}

function validate_add_banner(ele){
	hide_message_box(ele);
	var hasError = 0;
	var image_file=$('#image_file').val()

	if(jQuery.trim(image_file) == '')
	{
		showError("Please Select the File");
	}
	else {
		changeError("image_file");
	}
	
	if(hasError==1){
		return false;
	}else{
		
	}
}


function validate_edit_user(ele) {
	hide_message_box(ele);

	var hasError=0;
	var user_name = jQuery("#user_name").val();
	var email = jQuery("#email").val();
	var contact_no = jQuery("#contact_no").val();
	var phone_no = jQuery("#phone_no").val();

	if(jQuery.trim(user_name)=='') { showError("Please enter user name ", "user_name"); hasError = 1; } else { changeError("user_name"); }
	
	if( email != '' &&!validateEmail(email)){showError("Please enter proper email", "email"); hasError = 1; } else { changeError("email"); }
	if( contact_no != '' &&!isNumber(contact_no)){showError("Please enter proper number", "contact_no"); hasError = 1; } else { changeError("contact_no"); }
	if( phone_no != '' &&!isNumber(phone_no)){showError("Please enter proper number", "phone_no"); hasError = 1; } else { changeError("phone_no"); }

	if(hasError==1){
		return false;
	}else{
		return true;
	} 
}

function validate_edit_category(ele){
	hide_message_box(ele);
	var hasError = 0;
	var category_id = $('#category_id').val();
	var category_name = $('#category_name').val(); 
		
	if(jQuery.trim(category_name)=='') { showError("Please enter category name","category_name"); hasError = 1; }else {changeError("category_name");}
	if(jQuery.trim(category_id)=='') { alert("Category id is missing. Please refresh the page"); hasError = 1; }
	if(hasError==1){
		return false;
	}else{
		// if(confirm("Are you sure wanted to update this category?")){
		// 	var user = {};
		// 	user.product = {};
		// 	user.product.category_id = category_id;
		// 	user.product.category_name = category_name;
						
		// 	var q = JSON.stringify(user);
		// 	jQuery.ajax({
		// 		dataType: 'json',
		// 		type: "POST",
		// 		url: "update_category",
		// 		data: {'jsonObj' : q},
		// 		cache: false,
		// 		beforeSend: function(){ 
		// 			jQuery(".btn-quirk").text('Please Wait!.').prop('disabled', true);
		// 		},
		// 		success: function(res){
		// 			jQuery(".btn-quirk").text('Submit').prop('disabled', false);
		//           	if(res.status=='1'){ // Success
		//           		jQuery(ele).find('.alert-success').css('display','block').html(res.msg); 
		// 				jQuery(ele).find('.alert-danger').css('display','none'); 
		//           	}else{ // Failed
		//           		jQuery(ele).find('.alert-success').css('display','none');
		// 				jQuery(ele).find('.alert-danger').css('display','block').html(res.msg);  
		//           	}
	 //      		}
	 //  		});
		// }
	}
	// return false;
}


function validate_new_sub_category(ele){

	hide_message_box(ele);
	var hasError = 0;
	var category_id = $('#category_id').val(); 
	var sub_category_name = $('#sub_category_name').val(); 
	var sub_category_name_ar = $('#sub_category_name_ar').val();
	var sub_category_sort_order = $('#sub_category_sort_order').val();  
	
	if(jQuery.trim(category_id)=='') { showError("Please select category","category_id"); hasError = 1; }
	else{
		changeError("category_id");
	}
	if(jQuery.trim(sub_category_name)=='') {
	 showError("Please enter sub category name","sub_category_name"); hasError = 1; }
	 else {
	 	changeError("sub_category_name");
	 }

	 if(jQuery.trim(sub_category_name_ar)=='') {
	 showError("Please enter sub category name in ar","sub_category_name_ar"); hasError = 1; }
	 else {
	 	changeError("sub_category_name_ar");
	 }

	 if(jQuery.trim(sub_category_sort_order)=='') {

	 showError("Please enter sub category Order","sub_category_sort_order"); hasError = 1; }
	 else {
	 	changeError("sub_category_sort_order");
	 }

	if(hasError==1){
		return false;
	}else{
		if(confirm("Are you sure wanted to addmin this sub category?")){
			var user = {};
			user.product = {};
			user.product.category_id = category_id;
			user.product.sub_category_name = sub_category_name;
			user.product.sub_category_name_ar = sub_category_name_ar;
			user.product.sub_category_sort_order = sub_category_sort_order;
						
			var q = JSON.stringify(user);

			jQuery.ajax({
				dataType: 'json',
				type: "POST",
				url: "save_sub_category",
				data: {'jsonObj' : q},
				cache: false,
				beforeSend: function(){ 
					jQuery(".btn-quirk").text('Please Wait!.').prop('disabled', true);
				},
				success: function(res){
					console.log(res);
					jQuery(".btn-quirk").text('Submit').prop('disabled', false);
		          	if(res.status=='1'){ // Success
		          		jQuery(ele).find('.alert-success').css('display','block').html(res.msg); 
						jQuery(ele).find('.alert-danger').css('display','none'); 
						window.location.reload();
		          	}else{ // Failed
		          		jQuery(ele).find('.alert-success').css('display','none');
						jQuery(ele).find('.alert-danger').css('display','block').html(res.msg);  
		          	}
	      		}
	  		});
		}
	}
	return false;
}


// function validate_update_sub_category(ele){
// 	alert('hiiii')
// 	var hasError = 0;
	
// 	var sub_category_id = $("#sub_category_id").val();
// 	var category_id = $("#category_id").val();
// 	var sub_category_name = $("#sub_category_name").val();
	
// 	if(jQuery.trim(category_id)=='') { showError("Please select category","category_id"); hasError = 1; }else {changeError("category_id");}
// 	if(jQuery.trim(sub_category_name)=='') { showError("Please enter sub category","sub_category_name"); hasError = 1; }else {changeError("sub_category_name");}

// 	if(hasError==1){
// 		return false;
// 	}else{

// 		if(confirm("Are you sure wanted to update category?")){
// 			var user = {};
// 			user.product = {};
// 			user.product.sub_category_id = sub_category_id;
// 			user.product.category_id = category_id;
// 			user.product.sub_category_name = sub_category_name;
						
// 			var q = JSON.stringify(user);
// 			jQuery.ajax({
// 				dataType: 'json',
// 				type: "POST",
// 				url: "update_sub_category",
// 				data: {'jsonObj' : q},
// 				cache: false,
// 				beforeSend: function(){ 
// 					jQuery(".btn-save").html('Please Wait!.').prop('disabled', true);
// 				},
// 				success: function(res){
// 					jQuery(".btn-save").html('<i class="fa fa-check"></i> Update').prop('disabled', true);
// 		          	if(res.status=='1'){ // Success
// 		          		jQuery(ele).find('.alert-success').css('display','block').html(res.msg); 
// 						jQuery(ele).find('.alert-danger').css('display','none'); 
// 		          	}else{ // Failed
// 		          		jQuery(ele).find('.alert-success').css('display','none');
// 						jQuery(ele).find('.alert-danger').css('display','block').html(res.msg);  
// 		          	}
// 	      		}
// 	  		});
// 		}
// 	}
// 	return false;
// }







function delete_category(ele,category_id){
	if(confirm("Are you sure wanted to delete the selected category?")){
		var user = {};
		user.product = {};
		user.product.category_id = category_id;
					
		var q = JSON.stringify(user);
		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "delete_category",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ 
				jQuery(ele).html('..').prop('disabled', true);
			},
			success: function(res){
				if(res.status=='1'){ // Success
	          		jQuery(ele).closest('tr').remove();
	          	}
      		}
  		});
	}
	return false;
}

function delete_banner(ele,category_id){
	if(confirm("Are you sure wanted to delete the selected banner?")){
		var user = {};
		user.product = {};
		user.product.category_id = category_id;
					
		var q = JSON.stringify(user);
		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "delete_banner",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ 
				jQuery(ele).html('..').prop('disabled', true);
			},
			success: function(res){
				if(res.status=='1'){ // Success
	          		jQuery(ele).closest('tr').remove();
	          	}
      		}
  		});
	}
	return false;
}

function delete_offer_list(ele,offer_id){
	if(confirm("Are you sure wanted to delete the selected offer?")){
		var user = {};
		user.product = {};
		user.product.offer_id = offer_id;
					
		var q = JSON.stringify(user);
		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "delete_offer",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ 
				jQuery(ele).html('..').prop('disabled', true);
			},
			success: function(res){
				if(res.status=='1'){ // Success
	          		jQuery(ele).closest('tr').remove();
	          	}
      		}
  		});
	}
	return false;
}






function delete_warehouse(ele,wid){
	if(confirm("Are you sure wanted to delete the selected warehouse?")){
		var q = JSON.stringify(wid);
		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "delete_warehouse",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ 
				jQuery(ele).html('..').prop('disabled', true);
			},
			success: function(res){
				console.log(res);
				if(res.status=='1'){ // Success
	          		jQuery(ele).closest('tr').remove();
	          	}

	          	$('.alert-success').show();
	          	$('.alert-success span').html(res.msg);
      		}
  		});
	}
	return false;
}

function delete_kitchen(ele,kitchen_id){
	if(confirm("Are you sure wanted to delete the selected kitchen?")){
		var q = JSON.stringify(kitchen_id);
		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "delete_kitchen",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ 
				jQuery(ele).html('..').prop('disabled', true);
			},
			success: function(res){
				console.log(res);
				if(res.status=='1'){ // Success
	          		jQuery(ele).closest('tr').remove();
	          		$('.alert-success').show();
	          		$('.alert-success span').html(res.msg);
	          	}
      		}
  		});
	}
	return false;
}


function delete_requisition(ele,req_id){
	if(confirm("Are you sure wanted to delete the selected requisition?")){
		var q = JSON.stringify(req_id);
		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "delete_requisition",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ 
				jQuery(ele).html('..').prop('disabled', true);
			},
			success: function(res){
				console.log(res);
				if(res.status=='1'){ // Success
	          		jQuery(ele).closest('tr').remove();
	          	}
      		}
  		});
	}
	return false;
}

function delete_gst_setting(ele,wid){
	if(confirm("Are you sure wanted to delete the selected gst setting?")){
		var q = JSON.stringify(wid);
		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "delete_gst_setting",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ 
				jQuery(ele).html('..').prop('disabled', true);
			},
			success: function(res){
				console.log(res);
				if(res.status=='1'){ // Success
	          		jQuery(ele).closest('tr').remove();
	          		$('.alert-success').show();
	          		$('.alert-success span').html(res.msg);
	          	}
      		}
  		});
	}
	return false;
}

function validate_add_user(ele) {
	hide_message_box(ele);

	var hasError=0;
	var user_name = jQuery("#user_name").val();
	var user_id = jQuery("#user_id").val();
	var password = jQuery("#password").val();
	var confirm_password = jQuery("#confirm_password").val();
	var email = jQuery("#email").val();
	var contact_no = jQuery("#contact_no").val();
	var phone_no = jQuery("#phone_no").val();

	if(jQuery.trim(user_name)=='') { showError("Please enter user name ", "user_name"); hasError = 1; } else { changeError("user_name"); }
	if(jQuery.trim(user_id)=='') { showError("Please enter user id ", "user_id"); hasError = 1; } else { changeError("user_id"); }
	if(jQuery.trim(password)=='') { showError("Please enter password ", "password"); hasError = 1; } else { changeError("password"); }
	if(jQuery.trim(confirm_password)=='') { showError("Please enter confirm password ", "confirm_password"); hasError = 1; } else { changeError("confirm_password"); }
	if(password != confirm_password ) { showError("Password do not match", "confirm_password"); hasError = 1; } else { changeError("confirm_password"); }
	
	if( email != '' &&!validateEmail(email)){showError("Please enter proper email", "email"); hasError = 1; } else { changeError("email"); }
	if( contact_no != '' &&!isNumber(contact_no)){showError("Please enter proper number", "contact_no"); hasError = 1; } else { changeError("contact_no"); }
	if( phone_no != '' &&!isNumber(phone_no)){showError("Please enter proper number", "phone_no"); hasError = 1; } else { changeError("phone_no"); }

	var postData = {
		'user_id' : user_id
	};

	$.post('isUserIdExist',postData,function(res){
		var isUserIdExist = $.parseJSON(res);
		if(jQuery.trim(user_id)!=''){
			if(isUserIdExist){
				showError("User Id already exist", "user_id"); hasError = 1;			
			}
			else{
				changeError("user_id");
			}
		}
	})

	if(hasError==1){
		return false;
	}else{
		return true;
	} 
}

function validate_user_role(ele) {
	hide_message_box(ele);

	var hasError=0;
	var role_name = jQuery("#role_name").val();

	if(jQuery.trim(role_name)=='') { showError("Please enter role name ", "role_name"); hasError = 1; } else { changeError("role_name"); }

	var postData = {
		'role_name' : role_name
	};



	// return false;

	if(hasError==1){
		return false;
	}else{
		return true;
	} 
}




function validate_add_recipe(ele) {
	hide_message_box(ele);

	var hasError=0;
	var product_id = jQuery("#product_id").val();

	if(jQuery.trim(product_id)=='') { showError("Please Enter Product", "product_id"); hasError = 1; } else { changeError("product_id"); }

	$(".product_rows").get().forEach(function(entry, index, array) {
		$.each(array,function(i,val){
			var rowno = val.id.substring(11,val.id.length);
			var product_id = $('#product_id'+rowno).val();
			if(jQuery.trim(product_id)=='') { showError("Please Enter Row Material", "product_id"+rowno); hasError = 1; } else { changeError("product_id"+rowno); }
		});
	    // Here, array.length is the total number of items
	});

	if(hasError==1){
		return false;
	}else{
		return true;
	} 
}

function validate_add_branch(ele) {
	hide_message_box(ele);

	var hasError=0;
	var branch_name = jQuery("#branch_name").val();
	var contact_no = jQuery("#contact_no").val();
	var email = jQuery("#email").val();

	if(jQuery.trim(branch_name)=='') { showError("Please enter branch name ", "branch_name"); hasError = 1; } else { changeError("branch_name"); }
	if( contact_no != '' &&!isNumber(contact_no)){showError("Please enter proper number", "contact_no"); hasError = 1; } else { changeError("contact_no"); }	
	if( email != '' &&!validateEmail(email)){showError("Please enter proper email", "email"); hasError = 1; } else { changeError("email"); }

	if(hasError==1){
		return false;
	}else{
		return true;
	} 
}

function validate_add_warehouse(ele) {
	hide_message_box(ele);

	var hasError=0;
	var location = jQuery("#location").val();
	// var contact_person = jQuery("#contact_person").val();
	var contact_email = jQuery("#contact_email").val();

	if(jQuery.trim(location)=='') { showError("Please enter location ", "location"); hasError = 1; } else { changeError("location"); }
	
	if( contact_email != '' &&!validateEmail(contact_email)){showError("Please enter proper email", "contact_email"); hasError = 1; } else { changeError("contact_email"); }
	if(hasError==1){
		return false;
	}else{
		return true;
	} 
}

function validate_add_kitchen(ele) {
	hide_message_box(ele);

	var hasError=0;
	var location = jQuery("#location").val();
	var contact_email = jQuery("#contact_email").val();

	if(jQuery.trim(location)=='') { showError("Please enter location ", "location"); hasError = 1; } else { changeError("location"); }
	
	if( contact_email != '' &&!validateEmail(contact_email)){showError("Please enter proper email", "contact_email"); hasError = 1; } else { changeError("contact_email"); }
	if(hasError==1){
		return false;
	}else{
		return true;
	} 
}

function validate_add_requisition(ele) {
	hide_message_box(ele);

	var hasError=0;
	var delivery_required_on = jQuery("#delivery_required_on").val();
	//var warehouse_id = jQuery("#warehouse_id").val();
	var request_branch_id = jQuery("#request_branch_id").val();
	var request_warehouse_id = jQuery("#request_warehouse_id").val();
	var deliverd_branch_id = jQuery("#deliverd_branch_id").val();
	var deliverd_warehouse_id = jQuery("#deliverd_warehouse_id").val();

	if(jQuery.trim(delivery_required_on)=='') { showError("Please Enter Delivery Required On ", "delivery_required_on"); hasError = 1; } else { changeError("delivery_required_on"); }
	if(jQuery.trim(request_branch_id)=='' && jQuery.trim(request_warehouse_id)=='') { showError("Please Select Request to branch or warehouse", "request_branch_id"); hasError = 1; } else { changeError("request_branch_id"); }
	if(jQuery.trim(request_branch_id)=='' && jQuery.trim(request_warehouse_id)=='') { showError("Please Select Request to branch or warehouse", "request_warehouse_id"); hasError = 1; } else { changeError("request_warehouse_id"); }
	if(jQuery.trim(deliverd_branch_id)=='' && jQuery.trim(deliverd_warehouse_id)=='') { showError("Please Select deliverd to branch or warehouse", "deliverd_branch_id"); hasError = 1; } else { changeError("deliverd_branch_id"); }
	if(jQuery.trim(deliverd_branch_id)=='' && jQuery.trim(deliverd_warehouse_id)=='') { showError("Please Select deliverd to branch or warehouse", "deliverd_warehouse_id"); hasError = 1; } else { changeError("deliverd_warehouse_id"); }


	$(".product_rows").get().forEach(function(entry, index, array) {

		$.each(array,function(i,val){

			var rowno = val.id.substring(11,val.id.length);
			var product_id = $('#product_id'+rowno).val();
			if(jQuery.trim(product_id)=='') { showError("Please Enter Product", "product_id"+rowno); hasError = 1; } else { changeError("product_id"+rowno); }
		});
		// Here, array.length is the total number of items
	});

	if(hasError==1){
		return false;
	}else{
		return true;
	}
}

function validate_transfer_stock(ele) {
	hide_message_box(ele);

	var hasError=0;
	var warehouse_id = jQuery("#warehouse_id").val();
	if(jQuery.trim(warehouse_id)=='') { showError("Please enter warehouse", "warehouse_id"); hasError = 1; } else { changeError("warehouse_id"); }
	if(hasError==1){
		return false;
	}else{
		return true;
	} 
}

function validate_gst_setting(ele) {
	hide_message_box(ele);

	var hasError=0;
	var location = jQuery("#category_id").val();

	if(jQuery.trim(location)=='') { showError("Please enter Category ", "category_id"); hasError = 1; } else { changeError("category_id"); }
	
	if(hasError==1){
		return false;
	}else{
		return true;
	} 
}

function validateEmail(email) 
{
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function validate_edit_product(ele){
	hide_message_box(ele);

	var hasError=0;
	var product_name = jQuery("#product_name").val();
	var product_type = jQuery("#product_type").val();
	var product_category = jQuery("#product_category").val();
	var subcategory = jQuery('#subcategory').val();
	var is_superdeal = jQuery('#is_superdeal').val();
	var pack_size = jQuery('#pack_size').val();
	var sale_price = jQuery('#sale_price').val();
	var old_price = jQuery('#old_price').val();
	var vendor_sku = jQuery('#vendor_sku').val();
	var sku2 = jQuery('#sku2').val();
	/*var product_image = jQuery('#product_image').val();*/

	var expiry_date = jQuery('#expiry_date').val();

	var product_unit = jQuery('#product_unit').val();

	if(jQuery.trim(product_name)=='') { showError("Please enter product name", "product_name"); hasError = 1; } else { changeError("product_name"); }
	if(jQuery.trim(product_type)=='') { showError("Please enter product type", "product_type"); hasError = 1; } else { changeError("product_type"); }
	if(jQuery.trim(product_category)=='') { showError("Please select category", "product_category"); hasError = 1; } else { changeError("product_category"); }
	//if(jQuery.trim(subcategory)=='') { showError("Please select subcategory", "subcategory"); hasError = 1; } else { changeError("subcategory"); }
	
	if(jQuery.trim(is_superdeal)=='') { showError("Has product in superdeal?", "is_superdeal"); hasError = 1; } else { changeError("is_superdeal"); }
	if(jQuery.trim(pack_size)=='') { showError("Please enter pack size", "pack_size"); hasError = 1; } else { changeError("pack_size"); }
	
	if(jQuery.trim(sale_price)=='') { 
		showError("Please enter sale price", "sale_price"); hasError = 1; 
	}/*else if(!isNumDigit(sale_price)){
		showError("Please enter numeric values only", "sale_price"); hasError = 1; 
	}*/ else { 
		changeError("sale_price"); 
	}

	if(jQuery.trim(old_price)=='') { 
		showError("Please enter old price", "old_price"); hasError = 1; 
	}/*else if(!isNumDigit(old_price)){
		showError("Please enter numeric values only", "old_price"); hasError = 1; 
	}*/ else { 
		changeError("old_price"); 
	}

	if(jQuery.trim(product_unit)=='') { showError("Select product unit?", "product_unit"); hasError = 1; } else { changeError("product_unit"); }

	if(jQuery.trim(vendor_sku)=='' && jQuery.trim(sku2) == '') {
		swal({
			  title: "Enter SKU",
			  text: "Please enter Vendor SKU or SKU2",
			  icon: "warning",
			  dangerMode: true,
			});
		hasError = 1;
	} 
	/*if(jQuery.trim(product_image)!='') { 
		if(!check_image_file('product_image')){
		showError("Please select .png,.jpg file only", "product_image"); hasError = 1; 
		} else { 
			changeError("product_image"); 
		}
	}*/

	if(hasError==1){
		return false;
	}else{
		return true;
	}
}

function send_for_delivery(ele,order_id){
	if(confirm("Do you wanted to deliver selected order?")){
		var user = {};
		user.order = {};
		user.order.order_id = order_id;
					
		var q = JSON.stringify(user);
		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "send_order_for_delivery",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ 
				jQuery(ele).html('..').prop('disabled', true);
			},
			success: function(res){
				if(res.status=='1'){ // Success
					alert(res.msg);
	          		jQuery(ele).closest('tr').remove();
	          	}else{
	          		alert(res.msg);
	          	}
      		}
  		});
	}
	return false;
}

function order_delivered(ele,order_id){
	if(confirm("Has selected order has been delivered?")){
		var user = {};
		user.order = {};
		user.order.order_id = order_id;
					
		var q = JSON.stringify(user);
		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "order_delivered",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ 
				jQuery(ele).html('..').prop('disabled', true);
			},
			success: function(res){
				if(res.status=='1'){ // Success
					alert(res.msg);
	          		jQuery(ele).closest('tr').remove();
	          	}else{
	          		alert(res.msg);
	          	}
      		}
  		});
	}
	return false;
}

function validate_search_form(ele){
	var hasError=0;
	var hdr_search_order = jQuery("#hdr_search_order").val();

	if(jQuery.trim(hdr_search_order)=='') { showError("Please enter order number", "hdr_search_order"); hasError = 1; } else { changeError("hdr_search_order"); }
	if(hasError==1){
		return false;
	}else{
		return true;
	}  
}

function add_product_to_grid(ele,counter_id){
	var product_id = $(ele).val();

	if(product_id!=""){
		var data = {};
		data.product = {};
		data.product.product_id = product_id;
		data.product.counter_id = counter_id;
					
		var q = JSON.stringify(data);
		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "get_product_info",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ },
			success: function(res){
				if(res.status=='1'){
					var tr = '';
					$.each(res.product_data, function (index, data) {
						var idx = parseInt(index)+1;
						tr += '<tr id='+data.product_id+'>'+
				            '<td><a href="javascript:void(0);" onclick="return delete_product_from_counter_data(this,'+data.counter_id+','+counter_id+');"><i class="fa fa-trash"></i></a></td>'+
            				'<td>'+idx+'</td>'+
            				'<td class="text-center">'+(data.product_name)+'</td>'+
            				'<td class="text-right price"><input style="width: 50%;text-align:center" class="txt_price" type="text" name="txt_price" id="txt_price" value="'+parseFloat(data.price).toFixed(2)+'"></td>'+
            				'<td class="text-center"><input style="width: 50%;text-align:center" onkeypress="handle_enter(event,this)" class="txtqty" type="text" name="txtqty" id="txtqty" value="'+data.qty+'"></td>'+
            				'<td class="text-right unit_total">'+parseFloat(data.unit_total).toFixed(2)+'</td>'+
            			'</tr>';
            		});
            		var total_amount = res.total_amount[0]['total'];
					jQuery(".billed_amount").val(parseFloat(total_amount).toFixed(2));
					jQuery(".total_amount").val(parseFloat(total_amount).toFixed(2));
					jQuery(".aftr_wallet_deduct").val(parseFloat(total_amount).toFixed(2));
            		jQuery(".product_grid").find('tbody').html(tr);
            		jQuery(".product_grid").find('table tbody tr:first').find('.txtqty').dblclick();
            		/*jQuery(".product_grid").find('table tbody tr:first').find('.txtqty').select();*/
	          	}else{
	          		alert(res.msg);
	          	}
      		}
  		});
	}
	return false;
}

function handle_enter(e,ele) {
	if(e.keyCode === 13){
        e.preventDefault(); // Ensure it is only this code that rusn
        jQuery(ele).closest('form').find('.product_id').val("").focus();
    }
    return false;
}

function selectAllText(textbox) {
    textbox.focus();
    textbox.select();
}

function validate_coupon_no(ele){
	var hasError=0;
	changeError("coupon_number");
	var counter_id = jQuery(ele).closest(".panel-body").attr('id');
	var billed_amount = jQuery("#billed_amount"+counter_id).val();
	var coupon_number = jQuery("#coupon_number"+counter_id).val();

	if(jQuery.trim(billed_amount)=='') { showError("Billed amount can not be empty.", "billed_amount"+counter_id); hasError = 1; } else { changeError("billed_amount"+counter_id); }
	if(jQuery.trim(coupon_number)=='') { 
		/*showError("Please enter coupon number", "coupon_number"+counter_id); 
		jQuery("#discount_amount").val('');jQuery(".total_amount").val('');*/
		//hasError = 1; 
	} else { 
		changeError("coupon_number"+counter_id); 
	}

	if(hasError==1){
		return false;
	}else{
		var data = {};
		data.product = {};
		data.product.total_amount = billed_amount;
		data.product.coupon_number = coupon_number;
		data.product.counter_id = counter_id;
							
		var q = JSON.stringify(data);
		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "apply_coupon_code",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ },
			success: function(res){
				if(res.status=='1'){
					var discounted_amount = res.discounted_amount;
					var total_discounted_amount = res.total_discounted_amount;

					jQuery("#discount_amount"+counter_id).val(parseFloat(discounted_amount).toFixed(2));
            		jQuery("#total_amount"+counter_id).val(parseFloat(total_discounted_amount).toFixed(2));
	          	}else{
	          		showError(res.msg, "coupon_number"); 
	          		jQuery("#coupon_number"+counter_id).val('');
	          		jQuery("#discount_amount"+counter_id).val('00.00');
            		jQuery("#total_amount"+counter_id).val(billed_amount);
	          	}
          	}
  		});
	}  
	return false;
}

function delete_product_from_counter_data(ele,counter_id,ctr_id){
	var hasError=0;
	if(counter_id!="" && counter_id>0){
		if(confirm("Are you sure wanted to delete the selected product from cart?")){
			var data = {};
			data.product = {};
			data.product.counter_id = counter_id;
			data.product.ctr_id = ctr_id;
						
			var q = JSON.stringify(data);
			jQuery.ajax({
				dataType: 'json',
				type: "POST",
				url: "delete_product_from_counter_data",
				data: {'jsonObj' : q},
				cache: false,
				beforeSend: function(){ },
				success: function(res){
					if(res.status=='1'){
						var total_amount = res.total_amount;
						$('#sgst_value').val(res.sgst);
                        $('#cgst_value').val(res.cgst);
                        $('#igst_value').val(res.igst);
						jQuery("#coupon_number"+ctr_id).val("");
						jQuery("#discount_amount"+ctr_id).val("");

						jQuery("#billed_amount"+ctr_id).val(parseFloat(total_amount).toFixed(2));
						jQuery("#subtotal"+ctr_id).val(parseFloat(res.subtotal).toFixed(2));
	            		jQuery("#total_amount"+ctr_id).val(parseFloat(total_amount).toFixed(2));
	            		jQuery(ele).closest('tr').remove();
		          	}else{
		          		showError(res.msg, "coupon_number"); 
		          		jQuery("#discount_amount"+ctr_id).val('00.00');
	            		jQuery("#total_amount"+ctr_id).val(billed_amount);
		          	}
	          	}
	  		});
	  	}
	}
	return false;
}



function validate_counter_data(ele){

	hide_message_box(ele);
	var hasError=0;
	var counter_id = jQuery(ele).closest(".panel-body").attr('id');

	var customer_name = jQuery(ele).closest(".panel-body").find(".customer_name").val();
	
	var mobile_number = jQuery(ele).closest(".panel-body").find("#mobile_number").val();
	var email_address = jQuery(ele).closest(".panel-body").find("#email_address").val();
	var datepicker = jQuery(ele).closest(".panel-body").find("#datepicker").val();
	var address_1 = jQuery(ele).closest(".panel-body").find("#address_1").val();
	var address_2 = jQuery(ele).closest(".panel-body").find("#address_2").val();
	var city = jQuery(ele).closest(".panel-body").find("#city").val();
	var state = jQuery(ele).closest(".panel-body").find("#state_code").val();
	var pincode = jQuery(ele).closest(".panel-body").find("#pincode").val();

	var billed_amount = jQuery(ele).closest(".panel-body").find("#billed_amount"+counter_id).val();
	var subtotal = jQuery(ele).closest(".panel-body").find("#subtotal"+counter_id).val();
	// var coupon_number = jQuery(ele).closest(".panel-body").find("#coupon_number"+counter_id).val();
	var discount_amount = jQuery(ele).closest(".panel-body").find("#discount_amount"+counter_id).val();
	var total_amount = jQuery(ele).closest(".panel-body").find("#total_amount"+counter_id).val();

	var sudexo_coupon = jQuery(ele).closest(".panel-body").find("#sudexo_coupon"+counter_id).val();
	var credit_debit = jQuery(ele).closest(".panel-body").find("#credit_debit"+counter_id).val();
	var delivery_charges = jQuery(ele).closest(".panel-body").find("#delivery_charges"+counter_id).val();

	
	var cust_paid = jQuery(ele).closest(".panel-body").find(".cust_paid").val();
	var return_amount = jQuery(ele).closest(".panel-body").find(".return_amount").val();

	var user_id = jQuery(ele).closest(".panel-body").find("#user_id").val();
	var address_id = jQuery(ele).closest(".panel-body").find("#address_id").val();
	var sgst = $('#sgst_value').val();
	var cgst = $('#cgst_value').val();
	var igst = $('#igst_value').val();
	var branch = $('#filter_branch').val();
	var warehouse= $('#filter_warehouse').val();
	if(jQuery.trim(customer_name)=='') { showError("Please enter customer name", "customer_name"+counter_id); hasError = 1; } else { changeError("customer_name"+counter_id); }

	if(user_id==''){
		showError("Please select customer from list, Or Add New Customer", "customer_name"+counter_id);
		hasError = 1;
	}else{
		changeError("customer_name"+counter_id);
	}

	/*01_11_2016*/
	var order_source = jQuery(ele).closest(".panel-body").find("#order_source").val();
	var wallet_balance = jQuery(ele).closest(".panel-body").find("#wallet_balance").val();
	var payment_method = jQuery(ele).closest(".panel-body").find("#payment_method").val();
	if(payment_method=='WALLET'){
		if(wallet_balance>0){
			jQuery(ele).closest(".panel-body").find('#wallet_balance').removeClass('error');
		}else{
			jQuery(ele).closest(".panel-body").find('#wallet_balance').addClass('error'); hasError = 1;
		}
	}else{
		jQuery(ele).closest(".panel-body").find('#wallet_balance').removeClass('error');
	}
	var offer_code = jQuery(ele).closest(".panel-body").find("#offer_code"+counter_id).val();

	if(hasError==1){
		return false;
	}else{
		if(jQuery(ele).closest(".panel-body").find('.error').length){
			 alert("Please resolve the error shown on form."); 
			 return false;
		}

		if(jQuery("table > tbody > tr").length){
			if(confirm("Are you sure wanted to place an order?")){

				var data = {};
				data.product = {};
				
				data.product.user_id = user_id;
				data.product.address_id = address_id;				

				data.product.customer_name = customer_name;
				data.product.mobile_number = mobile_number;
				data.product.email_address = email_address;
				data.product.billing_date = datepicker;
				data.product.address_1 = address_1;
				data.product.address_2 = address_2;
				data.product.city = city;
				data.product.state = state;
				data.product.pincode = pincode;

				data.product.billed_amount = billed_amount;
				// data.product.coupon_number = coupon_number;
				data.product.discount_amount = discount_amount;
				data.product.total_amount = total_amount;
				data.product.subtotal = subtotal;
				data.product.cgst = cgst;
				data.product.sgst = sgst;
				data.product.igst = igst;
				data.product.branch_id = branch;
				data.product.warehouse_id= warehouse;
				data.product.delivery_charges = delivery_charges;
				
				data.product.counter_id = counter_id;

				data.product.customer_paid = cust_paid;
				data.product.returned_amount = return_amount;

				data.product.wallet_balance = wallet_balance;
				data.product.payment_method = payment_method;
				data.product.offer_code = offer_code;
				data.product.order_source = order_source;

				data.product.sudexo_coupon = sudexo_coupon;
				data.product.credit_debit = credit_debit;
							
				var q = JSON.stringify(data);
                 /*alert(q);*/
				jQuery.ajax({
					dataType: 'json',
					type: "POST",
					url: "place_counter_order",
					data: {'jsonObj' : q},
					cache: false,
					beforeSend: function(){
						jQuery(".btn-quirk").text('Submiting.. Please wait.').prop('disabled', true);
					},
					success: function(res){
						jQuery(".btn-quirk").text('Submit').prop('disabled', false);
						if(res.status=='1'){ // Success
			          		jQuery(ele).find('.alert-success').css('display','block').html(res.msg); 
							jQuery(ele).find('.alert-danger').css('display','none'); 

							document.getElementById("frm_counter_data"+counter_id).reset();
							jQuery("table > tbody").html("");
							jQuery(".hidden-print").printPage();
							//window.location.href="print_counter_order?order_number="+res.order_number;

							jQuery(ele).closest(".panel-body").find("#total_amount"+counter_id).val(""); 
							jQuery(ele).closest(".panel-body").find("#aftr_wallet_deduct"+counter_id).val(""); 
							jQuery(ele).closest(".panel-body").find("#billed_amount"+counter_id).val(""); 
			          	}else{ // Failed
			          		jQuery(ele).find('.alert-success').css('display','none');
							jQuery(ele).find('.alert-danger').css('display','block').html(res.msg);  
			          	}
						var goToTop = jQuery("#frm_counter_data"+counter_id).offset().top-100;
						jQuery("html, body").animate({ scrollTop: goToTop }, 500);
		          	},
		          	error: function(error,message){
		          		console.log(error,message);
		          	}

		  		});

			}
		}else{
			alert('Your cart is empty. Please add some product.');
		}
	}  
	return false;
}

function update_stock_status(ele,stock_status,product_id){

	if(confirm("Are you sure, to update the selected product's stock status ?")){
		var data = {};
		data.product = {};
		data.product.product_id = product_id;
		data.product.stock_status = stock_status;
		
		var q = JSON.stringify(data);

		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "update_product_status",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){
				//jQuery(".btn-quirk").text('Submiting.. Please wait.').prop('disabled', true);
			},
			success: function(res){
				//jQuery(".btn-quirk").text('Submit').prop('disabled', false);
				if(res.status=='1'){
	          		alert(res.msg);
	          	}else{ // Failed
	          		alert(res.msg);
	          	}
          	}
  		});
	}
	return false;
} 

function update_product_status(ele,status,product_id){
	
		if(confirm("Are you sure, to update the selected product's status ?")){
			var data = {};
			data.product = {};
			data.product.product_id = product_id;
			data.product.status = status;
			
			var q = JSON.stringify(data);

			jQuery.ajax({
				dataType: 'json',
				type: "POST",
				url: "update_product_active_deactive_status",
				data: {'jsonObj' : q},
				cache: false,
				beforeSend: function(){
					//jQuery(".btn-quirk").text('Submiting.. Please wait.').prop('disabled', true);
				},
				success: function(res){
					//jQuery(".btn-quirk").text('Submit').prop('disabled', false);
					if(res.status=='1'){
		          		alert(res.msg);
		          	}else{ // Failed
		          		alert(res.msg);
		          	}
	          	}
	  		});
		}
	
	return false;
}

function update_category_status(ele,status,category_id){
	
	if(confirm("Are you sure, to update the selected category's status ?")){
		var data = {};
		data.product = {};
		data.product.category_id = category_id;
		data.product.status = status;
		
		var q = JSON.stringify(data);

		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "update_category_active_deactive_status",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){
				//jQuery(".btn-quirk").text('Submiting.. Please wait.').prop('disabled', true);
			},
			success: function(res){
				//jQuery(".btn-quirk").text('Submit').prop('disabled', false);
				if(res.status=='1'){
	          		alert(res.msg);
	          	}else{ // Failed
	          		alert(res.msg);
	          	}

	          	location.reload();
	      	}
			});
	}

	return false;
}

function update_sub_category_status(ele,status,sub_category_id){
	if(confirm("Are you sure, to update the selected sub category's status ?")){
			var data = {};
			data.product = {};
			data.product.sub_category_id = sub_category_id;
			data.product.status = status;
			
			var q = JSON.stringify(data);

			jQuery.ajax({
				dataType: 'json',
				type: "POST",
				url: "update_sub_category_active_deactive_status",
				data: {'jsonObj' : q},
				cache: false,
				beforeSend: function(){
					//jQuery(".btn-quirk").text('Submiting.. Please wait.').prop('disabled', true);
				},
				success: function(res){
					//jQuery(".btn-quirk").text('Submit').prop('disabled', false);
					if(res.status=='1'){
		          		alert(res.msg);
		          	}else{ // Failed
		          		alert(res.msg);
		          	}
	          	}
	  		});
		}
	
	return false;
}



function validate_change_password(ele){
	hide_message_box(ele);
	var hasError=0;
	var old_password = jQuery("#old_password").val();
	var new_password = jQuery("#new_password").val();
	var cnf_password = jQuery("#cnf_password").val();

	if(jQuery.trim(old_password)=='') { showError("Please enter old password","old_password"); hasError = 1; }else { changeError("old_password"); }
	if(jQuery.trim(new_password)=='') { showError("Please enter new password","new_password"); hasError = 1; }else { changeError("new_password"); }
	
	if(jQuery.trim(cnf_password)=='') { 
		showError("Please re-type new password","cnf_password"); hasError = 1; 
	}else if(jQuery.trim(cnf_password)!=jQuery.trim(new_password)) { 
		showError("Passwords do not match. Please re-type the password.","cnf_password"); hasError = 1; 
	}else { 
		changeError("cnf_password"); 
	}
	
	if(hasError==1){
		return false;
	}else{
		if(confirm("are you sure wanted to change the password?")){
			var data = {};
			data.user_data = {};
			data.user_data.old_password = old_password;
			data.user_data.new_password = new_password;
			data.user_data.conf_password = cnf_password;
			var q = JSON.stringify(data);

			
				jQuery.ajax({
					dataType: 'json',
					type: "POST",
					url: "update_password",
					data: {'jsonObj' : q},
					cache: false,
					beforeSend: function(){
						jQuery(ele).find(".btn-success").text("Please wait.").prop('disabled', true);
					},
					success: function(res){
						jQuery(ele).find(".btn-success").text("Submit").prop('disabled', false);
						
						if(res.status=='1'){
			          		jQuery('.alert-success').css('display', 'block').html(res.msg);
			          		jQuery('.alert-danger').css('display', 'none').html(res.msg);
			          	}else{ // Failed
			          		jQuery('.alert-success').css('display', 'none').html(res.msg);
			          		jQuery('.alert-danger').css('display', 'block').html(res.msg);
			          	}
		          	}
		  		});
		}
	}
	return false;
}


function validate_upload_price(ele){
	hide_message_box(ele);
	var hasError=0;
	var product_excel = jQuery("#product_excel").val();

	if(jQuery.trim(product_excel)=='') { 
		showError("Please select .csv file","product_excel"); hasError = 1; 
	}else if(check_csv_file('product_excel')){
	 	changeError("product_excel"); 
	}else {
		showError("Please select only (.csv) downloaded file.","product_excel"); hasError = 1; 
	}
		
	if(hasError==1){
		return false;
	}else{
		if(confirm("are you sure wanted to upload the product price list?")){
			return true;
		}
	}
	return false;
}

function sync_live_product_list(ele){
	if(confirm("Do you wanted to sync live product?")){
		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "sync_live_product_list",
			cache: false,
			beforeSend: function(){
				jQuery(ele).html('<i class="fa fa-refresh"></i> Syncing... Please wait').prop('disabled', true);
			},
			success: function(res){
				jQuery(ele).html('<i class="fa fa-refresh"></i> Sync Product').prop('disabled', true);
				
				if(res.status=='1'){
	          		alert(res.msg);
	          	}else{ // Failed
	          		alert(res.msg);
	          	}
          	}
  		});
	}
	return false;
}



function validate_purchase_product(ele){
	jQuery(ele).closest('.panel-body').find('.alert-success').css('display','none'); 
	jQuery(ele).closest('.panel-body').find('.alert-danger').css('display','none'); 

	var hasError = 0;

	var purchase_order_number = jQuery("#purchase_order_number").val();
	var supplier_details = jQuery("#supplier_details").val();
	var sup_id = jQuery("#sup_id").val();
	var purchase_date = jQuery("#purchase_date").val();
	var total_amount = jQuery("#total_amount").val();
	var warehouse_id = jQuery("#warehouse_id").val();
	var branch_id = jQuery("#branch_id").val();

	if(jQuery.trim(sup_id)=='') {showError("Invalid supplier", "sup_id"); hasError = 1; } else { changeError("sup_id"); }
	if(jQuery.trim(supplier_details)=='') { showError("Invalid supplier", "supplier_details"); hasError = 1; } else { changeError("supplier_details"); }
	if(jQuery.trim(purchase_order_number)=='') { showError("Purchase Order", "purchase_order_number"); hasError = 1; } else { changeError("purchase_order_number"); }
	if(jQuery.trim(warehouse_id)=='' && jQuery.trim(branch_id)=='') { showError("branch or warehouse selected is required", "warehouse_id"); hasError = 1; } else { changeError("warehouse_id"); }
	if(jQuery.trim(warehouse_id)=='' && jQuery.trim(branch_id)=='') { showError("branch or warehouse selected is required", "branch_id"); hasError = 1; } else { changeError("branch_id"); }

	if(hasError==1){
		return false;
	}else{
		if(confirm("Are you sure wanted to purchase the product?")){
			var data = {};
			var formData = new FormData($("#pur_form")[0]);
			var q = JSON.stringify(data);
			console.log(formData);

	        jQuery.ajax({
	            dataType: 'json',
	            type: 'POST',
	            url: 'add_product_to_purchase_list',
	            data: formData,
	            cache: false,
	            processData: false,
				contentType: false,
	            mimeType: "multipart/form-data",
	            success: function(res) {
	            	console.log(res);
	                jQuery('.alert-success').css('display', 'block').html(res.msg);
	                jQuery(".product_grid").find('tbody').html("");
	                document.getElementById('pur_form').reset(); 
	            }
	        });
		}
	}
	return false;
}

function validate_add_supplier(ele) {
	hide_message_box(ele);

	var hasError=0;
	var supplier_name = jQuery("#supplier_name").val();
	var phone_number = jQuery("#phone_number").val();
	var email_address = jQuery("#email_address").val();
	var contact_person_name = jQuery("#contact_person_name").val();
	var address_1 = jQuery("#address_1").val();
	var address_2 = jQuery("#address_2").val();
	var area_name = jQuery("#area_name").val();
	var city_name = jQuery("#city_name").val();
	var state = jQuery("#state").val();
	var pincode = jQuery("#pincode").val();

	if(jQuery.trim(supplier_name)=='') { showError("Please enter supplier name", "supplier_name"); hasError = 1; } else { changeError("supplier_name"); }
	if(jQuery.trim(phone_number)!='' && !$.isNumeric(phone_number)) { showError("Please enter numbers", "phone_number"); hasError = 1; } else { changeError("phone_number"); }
	if(jQuery.trim(email_address)!='' && !isValidEmailAddress(email_address)) { showError("Please enter valid email", "email_address"); hasError = 1; } else { changeError("email_address"); }
	if(jQuery.trim(pincode)!='' && !$.isNumeric(pincode)) { showError("Please enter numbers", "pincode"); hasError = 1; } else { changeError("pincode"); }

	if(hasError==1){
		return false;
	}else{
		return true;
	}
	return false;
}



function validate_update_supplier(ele){
	hide_message_box(ele);

	var hasError=0;
	var sup_id = jQuery("#sup_id").val();
	var supplier_name = jQuery("#supplier_name").val();
	var phone_number = jQuery("#phone_number").val();
	var email_address = jQuery("#email_address").val();
	var contact_person_name = jQuery("#contact_person_name").val();
	var address_1 = jQuery("#address_1").val();
	var address_2 = jQuery("#address_2").val();
	var area_name = jQuery("#area_name").val();
	var city_name = jQuery("#city_name").val();
	var state = jQuery("#state").val();
	var pincode = jQuery("#pincode").val();

	if(jQuery.trim(supplier_name)=='') { showError("Please enter supplier name", "supplier_name"); hasError = 1; } else { changeError("supplier_name"); }
	if(jQuery.trim(phone_number)!='' && !$.isNumeric(phone_number)) { showError("Please enter numbers", "phone_number"); hasError = 1; } else { changeError("phone_number"); }
	if(jQuery.trim(email_address)!='' && !isValidEmailAddress(email_address)) { showError("Please enter valid email", "email_address"); hasError = 1; } else { changeError("email_address"); }
	if(jQuery.trim(pincode)!='' && !$.isNumeric(pincode)) { showError("Please enter numbers", "pincode"); hasError = 1; } else { changeError("pincode"); }
	
	if(hasError==1){
		return false;
	}else{
		return true;
	}
	return false;
}


function update_supplier_status(ele,status,sup_id){
	if(confirm("Are you sure, to update the selected supplier status ?")){
		var data = {};
		data.supplier = {};
		data.supplier.status = status;
		data.supplier.sup_id = sup_id;
		
		var q = JSON.stringify(data);

		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "update_supplier_active_deactive_status",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){
				jQuery(".btn-quirk").text('Submiting.. Please wait.').prop('disabled', true);
			},
			success: function(res){
				jQuery(".btn-quirk").text('Submit').prop('disabled', false);
				if(res.status=='1'){
	          		alert(res.msg);
	          	}else{ // Failed
	          		alert(res.msg);
	          	}
          	}
  		});
	}

return false;
}

function update_user_address(e) {
	var address_id = jQuery(e).closest('.panel-body').find("#address_id").val();
	//if(address_id!=""){

	var user_id = jQuery(e).closest('.panel-body').find("#user_id").val();
	var customer_name = jQuery(e).closest('.panel-body').find(".customer_name").val();
	var mobile_number = jQuery(e).closest('.panel-body').find("#mobile_number").val();
	var email_address = jQuery(e).closest('.panel-body').find("#email_address").val();
	var address_1 = jQuery(e).closest('.panel-body').find("#address_1").val();
	var address_2 = jQuery(e).closest('.panel-body').find("#address_2").val();
	var nearest_area = jQuery(e).closest('.panel-body').find("#nearest_area").val();
	var city = jQuery(e).closest('.panel-body').find("#city").val();
	var state_code = jQuery(e).closest('.panel-body').find("#state_code").val();
	var pincode = jQuery(e).closest('.panel-body').find("#pincode").val();

	var data = {};
	data.user = {};
	data.user.address_id = address_id;
	data.user.user_id = user_id;
	data.user.customer_name = customer_name;
	data.user.mobile_number = mobile_number;
	data.user.email_address = email_address;
	data.user.address_1 = address_1;
	data.user.address_2 = address_2;
	data.user.nearest_area = nearest_area;
	data.user.city = city;
	data.user.state_code = state_code;
	data.user.pincode = pincode;

	var q = JSON.stringify(data);

	jQuery.ajax({
		dataType: 'json',
		type: "POST",
		url: "update_user_address",
		data: {'jsonObj' : q},
		cache: false,
		success: function(res){
			if(res.status=='1'){
				alert(res.msg);
			}else if(res.status=='2'){ // New Address added successfully.
				alert(res.msg);
				jQuery(e).closest('.panel-body').find("#address_id").val(res.address_id);
			}else{ // failed
				alert(res.msg);
			}
		}
	});
	/*}else{
		alert('Invalid address. Please select user address');
	}*/
}


function validate_counter_customer(e,company_state_code){

	var hasError = 0;
	var user_id = jQuery(e).closest('.panel-body').find("#user_id").val();
	var customer_name = jQuery(e).closest('.panel-body').find(".customer_name").val();
	var mobile_number = jQuery(e).closest('.panel-body').find("#mobile_number").val();
	var email_address = jQuery(e).closest('.panel-body').find("#email_address").val();
	var pincode = jQuery(e).closest('.panel-body').find("#pincode").val();
	var state_code = jQuery(e).closest('.panel-body').find("#state_code").val();
	var address_1 = jQuery(e).closest('.panel-body').find("#address_1").val();


	if(user_id!=''){ alert("Blank the customer name first then enter customer name.");  hasError = 1; }
	if(jQuery.trim(customer_name)=='') {
		jQuery(e).closest('.panel-body').find(".customer_name").addClass("errorOnElemet"); hasError = 1;
	}else{
		jQuery(e).closest('.panel-body').find(".customer_name").removeClass("errorOnElemet");
	}

	if (jQuery.trim(email_address)!='') {
		if(isValidEmail(email_address)) {
			jQuery(e).closest('.panel-body').find("#email_address").removeClass("errorOnElemet");
		}else{
			jQuery(e).closest('.panel-body').find("#email_address").addClass("errorOnElemet");
			hasError = 1;
		}
	} else {
		jQuery(e).closest('.panel-body').find("#email_address").removeClass("errorOnElemet");
	}

	if(jQuery.trim(state_code)=='') { showError("Please select state", "state_code"); hasError = 1; } else { changeError("state_code"); }
	if(jQuery.trim(address_1)=='') { showError("Please enter address", "address_1"); hasError = 1; } else { changeError("address_1"); }

	if (jQuery.trim(pincode)!='') {
		if(isNumber(pincode)) {
			jQuery(e).closest('.panel-body').find("#pincode").removeClass("errorOnElemet");
		}else{
			jQuery(e).closest('.panel-body').find("#pincode").addClass("errorOnElemet");
			hasError = 1;
		}
	} else {
		jQuery(e).closest('.panel-body').find("#pincode").removeClass("errorOnElemet");
	}

	if(hasError==1){
		return false;
	}else{
		if(confirm("are you sure wanted to add new user?")){
			var mobile_number = jQuery(e).closest('.panel-body').find("#mobile_number").val();
			var email_address = jQuery(e).closest('.panel-body').find("#email_address").val();
			var address_1 = jQuery(e).closest('.panel-body').find("#address_1").val();
			var address_2 = jQuery(e).closest('.panel-body').find("#address_2").val();
			var nearest_area = jQuery(e).closest('.panel-body').find("#nearest_area").val();
			var city = jQuery(e).closest('.panel-body').find("#city").val();
			var state_code = jQuery(e).closest('.panel-body').find("#state_code").val();
			var pincode = jQuery(e).closest('.panel-body').find("#pincode").val();

			var data = {};
			data.user = {};

			data.user.customer_name = customer_name;
			data.user.mobile_number = mobile_number;
			data.user.email_address = email_address;
			data.user.address_1 = address_1;
			data.user.address_2 = address_2;
			data.user.nearest_area = nearest_area;
			data.user.city = city;
			data.user.state_code = state_code;
			data.user.pincode = pincode;

			var q = JSON.stringify(data);

			jQuery.ajax({
				dataType: 'json',
				type: "POST",
				url: "add_new_counter_customer",
				data: {'jsonObj' : q},
				cache: false,
				success: function(res){
					alert(res.msg);
					if(company_state_code == state_code){
						$("#sgst").show();
						$("#cgst").show();
						$("#igst").hide();
					}
					else{
						$("#sgst").hide();
						$("#cgst").hide();
						$("#igst").show();
					}
					jQuery(e).closest('.panel-body').find("#user_id").val(res.user_id);
					jQuery(e).closest('.panel-body').find("#address_id").val(res.address_id);

				}
			});
		}
	}
	return false;
}

function validate_stock_out(ele) {

	jQuery('.alert-success').css('display', 'none').html("");
	jQuery('.alert-danger').css('display', 'none').html("");

	var hasError=0;
	// var pcategory = jQuery("#pcategory").val();
	// var supplier_details = jQuery("#supplier_details").val();

	// var purchase_date = jQuery("#purchase_date").val();
	// var supply_date = jQuery("#supply_date").val();
 	var filter_status = jQuery("#filter_status").val();
	var filter_stock = jQuery("#filter_stock").val();
	var filter_branch = jQuery("#filter_branch").val();
	var filter_warehouse = jQuery("#filter_warehouse").val();
	//var filter_supplier = jQuery("#filter_supplier").val();
	var location_type = jQuery("#location_type").val();
	var location_id = jQuery("#location_id").val();
	var remark = jQuery("#remark").val();


	// if(jQuery.trim(supplier_details)=='') { showError("Please select supplier", "supplier_details"); hasError = 1; } else { changeError("supplier_details"); }
	//if(jQuery.trim(purchase_order_number)=='') { showError("Purchase order can't be empty.", "purchase_order_number"); hasError = 1; } else { changeError("purchase_order_number"); }
	if(jQuery.trim(filter_status)=='') { showError("status is required", "filter_status"); hasError = 1; } else { changeError("filter_status"); }
	if(jQuery.trim(filter_stock)=='') { showError("Stock selected is required", "filter_stock"); hasError = 1; } else { changeError("filter_stock"); }
	if(jQuery.trim(filter_branch)=='' && jQuery.trim(filter_warehouse)=='') { showError("branch or warehouse selected is required", "filter_branch"); hasError = 1; } else { changeError("filter_branch"); }
	if(jQuery.trim(filter_branch)=='' && jQuery.trim(filter_warehouse)=='') { showError("branch or warehouse selected is required", "filter_warehouse"); hasError = 1; } else { changeError("filter_warehouse"); }
	//if(jQuery.trim(filter_supplier)=='') { showError("Supplier selected is required", "filter_supplier"); hasError = 1; } else { changeError("filter_supplier"); }

	if(hasError==1){
		return false;
	}else{
		//changeError("pcategory");
		if(jQuery("table > tbody > tr").length){
			if(confirm("Are you sure wanted to stock out?")){
				var purchase = [];
				jQuery(".tblproduct >tbody >tr").each(function(){
					var data = {};
					var price = jQuery(this).find('.txt_price').val();
					var qty = jQuery(this).find('.txtqty').val();
					//var pack_size = parseFloat(jQuery(this).find('.pack_size').html());
					if(parseFloat(qty)>0){
						data['product_id'] = jQuery(this).attr('id');
						data['qty'] = qty;
						data['price'] = price;
						data['filter_stock'] = filter_stock;
						data['filter_status'] = filter_status;
						//data['filter_supplier'] = filter_supplier;
						data['location_type'] = location_type;
						data['location_id'] = location_id;
						data['remark'] = remark;

						purchase.push(data);
					}
				});

				var q = JSON.stringify(purchase);
				//console.log(q);
				jQuery.ajax({
					dataType: 'json',
					type: "POST",
					url: "create_stockout_order",
					data: {'jsonObj' : q},
					cache: false,
					beforeSend: function(){ jQuery(".btn-quirk").val('CREATING PURCHASE ORDER').prop('disabled', true); },
					success: function(res){
						console.log(res);
						jQuery(".btn-quirk").val('CREATE PURCHASE ORDER').prop('disabled', false);
						if(res.status=='1'){

							window.location.href="confirm_stock_list";
							jQuery('.alert-success').css('display', 'block').html(res.msg);
							jQuery('.alert-danger').css('display', 'none').html("");
							document.getElementById('pur_form').reset();
							location.reload();
						}else{
							jQuery('.alert-danger').css('display', 'block').html(res.msg);
							jQuery('.alert-success').css('display', 'none').html("");
						}
					}
				});
			}
		}else{
			//if(jQuery.trim(pcategory)=='') { showError("Please select category", "pcategory"); }
		}
		return false;
	}
}


function validate_stock_in(ele) {

	jQuery('.alert-success').css('display', 'none').html("");
	jQuery('.alert-danger').css('display', 'none').html("");

	var hasError=0;
	// var pcategory = jQuery("#pcategory").val();
	// var supplier_details = jQuery("#supplier_details").val();

	// var purchase_date = jQuery("#purchase_date").val();
	// var supply_date = jQuery("#supply_date").val();
//	var filter_id = jQuery("#filter").val();
	var filter_stock = jQuery("#filter_stock").val();
	var filter_branch = jQuery("#filter_branch").val();
	var filter_warehouse = jQuery("#filter_warehouse").val();
	var filter_supplier = jQuery("#filter_supplier").val();
	var location_type = jQuery("#location_type").val();
	var location_id = jQuery("#location_id").val();


	// if(jQuery.trim(supplier_details)=='') { showError("Please select supplier", "supplier_details"); hasError = 1; } else { changeError("supplier_details"); }
	//if(jQuery.trim(purchase_order_number)=='') { showError("Purchase order can't be empty.", "purchase_order_number"); hasError = 1; } else { changeError("purchase_order_number"); }
	//if(jQuery.trim(filter_id)=='') { showError("Purchase date is required", "filter"); hasError = 1; } else { changeError("filter"); }
	if(jQuery.trim(filter_stock)=='') { showError("Stock selected is required", "filter_stock"); hasError = 1; } else { changeError("filter_stock"); }
	if(jQuery.trim(filter_branch)=='' && jQuery.trim(filter_warehouse)=='') { showError("branch or warehouse selected is required", "filter_warehouse"); hasError = 1; } else { changeError("filter_warehouse"); }
	if(jQuery.trim(filter_branch)=='' && jQuery.trim(filter_warehouse)=='') { showError("branch or warehouse selected is required", "filter_branch"); hasError = 1; } else { changeError("filter_branch"); }
	if(jQuery.trim(filter_supplier)=='') { showError("Supplier selected is required", "filter_supplier"); hasError = 1; } else { changeError("filter_supplier"); }

	if(hasError==1){
		return false;
	}else{
		//changeError("pcategory");
		if(jQuery("table > tbody > tr").length){
			if(confirm("Are you sure wanted to stock in?")){
				var purchase = [];
				jQuery(".tblproduct >tbody >tr").each(function(){
					var data = {};
					var price = jQuery(this).find('.txt_price').val();
					var qty = jQuery(this).find('.txtqty').val();
					//var pack_size = parseFloat(jQuery(this).find('.pack_size').html());
					if(parseFloat(qty)>0){
						data['product_id'] = jQuery(this).attr('id');
						data['qty'] = qty;
						data['price'] = price;
						data['filter_stock'] = filter_stock;
						data['filter_supplier'] = filter_supplier;
						data['location_type'] = location_type;
						data['location_id'] = location_id;

						purchase.push(data);
					}
				});

				var q = JSON.stringify(purchase);
				//console.log(q);
				jQuery.ajax({
					dataType: 'json',
					type: "POST",
					url: "create_stockin_order",
					data: {'jsonObj' : q},
					cache: false,
					beforeSend: function(){ jQuery(".btn-quirk").val('CREATING PURCHASE ORDER').prop('disabled', true); },
					success: function(res){
						console.log(res);
						jQuery(".btn-quirk").val('CREATE PURCHASE ORDER').prop('disabled', false);
						if(res.status=='1'){

							window.location.href="confirm_stock_list";
							jQuery('.alert-success').css('display', 'block').html(res.msg);
							jQuery('.alert-danger').css('display', 'none').html("");
							document.getElementById('pur_form').reset();
							location.reload();
						}else{
							jQuery('.alert-danger').css('display', 'block').html(res.msg);
							jQuery('.alert-success').css('display', 'none').html("");
						}
					}
				});
			}
		}else{
			//if(jQuery.trim(pcategory)=='') { showError("Please select category", "pcategory"); }
		}
		return false;
	}
}


function validate_create_offer(ele){
	hide_message_box(ele);
	var hasError=0;
	var org_id = jQuery("#org_id").val();
	var offer_name = jQuery("#offer_name").val();
	var nos_of_uses = jQuery("#nos_of_uses").val();
	var from_date = jQuery("#from_date").val();
	var to_date = jQuery("#to_date").val();
	var offer_type = jQuery("#offer_type").val();
	var offer_amount = jQuery("#offer_amount").val();
	var amount_purchase = jQuery("#amount_purchase").val();
	var product_category = jQuery("#product_category").val();
	var is_on_first_order = jQuery("#is_on_first_order").val();

	if(jQuery.trim(org_id)=='') { showError("Please select orgnisation", "org_id"); hasError = 1; } else { changeError("org_id"); }

	if(jQuery.trim(offer_name)=='') { 
		showError("Please enter offer name", "offer_name"); hasError = 1; 
	} else if (jQuery.trim(is_offer_exist(jQuery.trim(offer_name))) == "1") {
		showError("Offer with this name is already exist.", "offer_name");
		hasError = 1;
	}else{
		changeError("offer_name");
	}

	/*if(jQuery.trim(nos_of_uses)=='') { showError("Required", "nos_of_uses"); hasError = 1; } else { changeError("nos_of_uses"); }*/
	if(jQuery.trim(from_date)=='') { showError("Required", "from_date"); hasError = 1; } else { changeError("from_date"); }
	if(jQuery.trim(to_date)=='') { showError("Required", "to_date"); hasError = 1; } else { changeError("to_date"); }
	if(jQuery.trim(offer_type)=='') { showError("Select offer type", "offer_type"); hasError = 1; } else { changeError("offer_type"); }
	if(jQuery.trim(offer_amount)=='') { showError("Enter offer amt", "offer_amount"); hasError = 1; } else { changeError("offer_amount"); }
	if(jQuery.trim(amount_purchase)=='') { showError("Enter min. purchase amt.", "amount_purchase"); hasError = 1; } else { changeError("amount_purchase"); }
	/*if(jQuery.trim(product_category)=='') { showError("Enter product category", "product_category"); hasError = 1; } else { changeError("product_category"); }*/

	if(hasError==1){
		return false;
	}else{
		if(confirm("Are you sure wanted to create new offer?")){
			/*alert('hi');*/
			return true;
		}else{
			return false;
		}
	}
}

function validate_update_offer(ele){
	hide_message_box(ele);
	var hasError=0;
	var offer_id = jQuery("#offer_id").val();
	var org_id = jQuery("#org_id").val();
	var offer_name = jQuery("#offer_name").val();
	var nos_of_uses = jQuery("#nos_of_uses").val();
	var from_date = jQuery("#from_date").val();
	var to_date = jQuery("#to_date").val();
	var offer_type = jQuery("#offer_type").val();
	var offer_amount = jQuery("#offer_amount").val();
	var amount_purchase = jQuery("#amount_purchase").val();
	var product_category = jQuery("#product_category").val();
	var is_on_first_order = jQuery("#is_on_first_order").val();

	if(jQuery.trim(org_id)=='') { showError("Please select orgnisation", "org_id"); hasError = 1; } else { changeError("org_id"); }

	if(jQuery.trim(offer_name)==''){ showError("Please enter offer name", "offer_name"); hasError = 1; }else{ changeError("offer_name");}

	/*if(jQuery.trim(nos_of_uses)=='') { showError("Required", "nos_of_uses"); hasError = 1; } else { changeError("nos_of_uses"); }*/
	if(jQuery.trim(from_date)=='') { showError("Required", "from_date"); hasError = 1; } else { changeError("from_date"); }
	if(jQuery.trim(to_date)=='') { showError("Required", "to_date"); hasError = 1; } else { changeError("to_date"); }
	if(jQuery.trim(offer_type)=='') { showError("Select offer type", "offer_type"); hasError = 1; } else { changeError("offer_type"); }
	if(jQuery.trim(offer_amount)=='') { showError("Enter offer amt", "offer_amount"); hasError = 1; } else { changeError("offer_amount"); }
	if(jQuery.trim(amount_purchase)=='') { showError("Enter min. purchase amt.", "amount_purchase"); hasError = 1; } else { changeError("amount_purchase"); }
	/*if(jQuery.trim(product_category)=='') { showError("Enter product category", "product_category"); hasError = 1; } else { changeError("product_category"); }*/

	if(hasError==1){
		return false;
	}else{
		if(confirm("Are you sure wanted to update the offer details?")){
			return true;
		}else{
			return false;
		}
	}
}


function validate_new_orgnisation(ele){
	hide_message_box(ele);
	var hasError=0;

	var org_name = jQuery("#org_name").val();
	var contact_number = jQuery("#contact_number").val();
	var email_address = jQuery("#email_address").val();
	var org_code = jQuery("#org_code").val();
	var address_1 = jQuery("#address_1").val();
	var address_2 = jQuery("#address_2").val();
	var city = jQuery("#city").val();
	var state = jQuery("#state").val();
	var pincode = jQuery("#pincode").val();

	if(jQuery.trim(org_name)=='') { showError("Please enter orgnisation name", "org_name"); hasError = 1; } else { changeError("org_name"); }
	if(jQuery.trim(contact_number)=='') { showError("Please enter contact number", "contact_number"); hasError = 1; } else { changeError("contact_number"); }
	//if(jQuery.trim(email_address)=='') { showError("Required", "email_address"); hasError = 1; } else { changeError("email_address"); }
	if(jQuery.trim(address_1)=='') { showError("Required", "address_1"); hasError = 1; } else { changeError("address_1"); }
	if(jQuery.trim(address_2)=='') { showError("Required", "address_2"); hasError = 1; } else { changeError("address_2"); }
	if(jQuery.trim(city)=='') { showError("Enter city name", "city"); hasError = 1; } else { changeError("city"); }
	if(jQuery.trim(state)=='') { showError("Enter state", "state"); hasError = 1; } else { changeError("state"); }
	if(jQuery.trim(pincode)=='') { showError("Enter pincode", "pincode"); hasError = 1; } else { changeError("pincode"); }
	
	//alert(hasError);

	if(hasError==1){
		return false;
	}else{
		if(confirm("Are you sure wanted to save the orgnisation?")){
			var orgnisation_data = jQuery(ele).serialize();
	        var q = orgnisation_data;
			jQuery.ajax({
	            dataType: 'json',
	            type: 'POST',
	            url: 'submit_new_orgnisation',
	            data: q,
	            cache: false,
	            success: function(res) {
	            	if(res.status=='1'){
	            		jQuery('.alert-success').css('display', 'block').html(res.msg);
	            		jQuery('.alert-danger').css('display', 'none').html("");
	            		document.getElementById('basicForm').reset();
	            	}else{
	            		jQuery('.alert-success').css('display', 'none').html(res.msg);
	            		jQuery('.alert-danger').css('display', 'block').html("");
	            	}
	            }
	        });
		}
	}
	return false;
}


function validate_offer_on_counter_order(ele){

	var hasError=0;
	var counter_id = jQuery(ele).closest(".panel-body").attr('id');
	var billed_amount = jQuery("#billed_amount"+counter_id).val();
	var offer_code = jQuery("#offer_code"+counter_id).val();
	var mobile_number = jQuery(ele).closest(".panel-body").find('.mobile_number').val();

	changeError("offer_code"+counter_id);

	if(jQuery.trim(billed_amount)=='') { showError("Billed amount can not be empty.", "billed_amount"+counter_id); hasError = 1; } else { changeError("billed_amount"+counter_id); }
	
	// if(jQuery.trim(mobile_number)=='') {
	// 	jQuery(ele).closest(".panel-body").find('.mobile_number').addClass('error'); hasError = 1; 
	// } else { 
	// 	jQuery(ele).closest(".panel-body").find('.mobile_number').removeClass('error');
	// }
	
	if(jQuery.trim(offer_code)=='') { 
		/*showError("Please enter offer code", "offer_code"+counter_id); */
		changeError("offer_code"+counter_id); 
		jQuery("#discount_amount").val('');
		jQuery(".total_amount").val(billed_amount);
		jQuery(".aftr_wallet_deduct ").val(billed_amount);
		hasError = 1; 
	} else { 
		changeError("offer_code"+counter_id); 
	}
	if(hasError==1){
		return false;
	}else{
		var data = {};
		data.product = {};
		data.product.total_amount = billed_amount;
		data.product.offer_code = offer_code;
		data.product.counter_id = counter_id;
		// data.product.mobile_number = mobile_number;

		var q = JSON.stringify(data);
		console.log(data);

		jQuery.ajax({
			dataType: 'json',
			type: "POST",
			url: "apply_offer_code",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ },
			success: function(res){
				if(res.status=='1'){
					var discounted_amount = res.discounted_amount;
					var total_discounted_amount = res.total_discounted_amount;

					jQuery("#discount_amount"+counter_id).val(parseFloat(discounted_amount).toFixed(2));
            		jQuery("#total_amount"+counter_id).val(parseFloat(billed_amount).toFixed(2));
            		jQuery("#aftr_wallet_deduct"+counter_id).val(parseFloat(billed_amount).toFixed(2));
	          	}else{

	          		showError(res.msg, "offer_code"+counter_id); 
	          		jQuery("#coupon_number"+counter_id).val('');
	          		jQuery("#discount_amount"+counter_id).val('00.00');
            		jQuery("#total_amount"+counter_id).val(billed_amount);
            		jQuery("#aftr_wallet_deduct"+counter_id).val(billed_amount);
	          	}
          	},
          	error:function(error,message){
          		console.log(error,message);
          	}
  		});
	}  
	return false;
}


function validate_payment_method(ele){
	var hasError=0;
	var counter_id = jQuery(ele).closest(".panel-body").attr('id');
	var total_amount = jQuery(ele).closest(".panel-body").find("#total_amount"+counter_id).val();
	var wallet_balance = jQuery(ele).closest(".panel-body").find("#wallet_balance").val();

	var payment_type = jQuery(ele).val();
	if(payment_type=='WALLET'){
		if(wallet_balance>0){
			jQuery(ele).closest(".panel-body").find('#wallet_balance').removeClass('error');
			$amount_to_pay = parseFloat(total_amount)-parseFloat(wallet_balance);
			jQuery("#aftr_wallet_deduct"+counter_id).val(parseFloat($amount_to_pay).toFixed(2));
		}else{
			jQuery(ele).closest(".panel-body").find('#wallet_balance').addClass('error'); hasError = 1;
		}
	}else{
		jQuery(ele).closest(".panel-body").find('#wallet_balance').removeClass('error');
		jQuery("#aftr_wallet_deduct"+counter_id).val(parseFloat(total_amount).toFixed(2));
	}

	return false;
}

function validate_purchase_order(ele) {
	jQuery('.alert-success').css('display', 'none').html("");
	jQuery('.alert-danger').css('display', 'none').html("");

	var hasError=0;
	// var pcategory = jQuery("#pcategory").val();
	// var supplier_details = jQuery("#supplier_details").val();
	var purchase_order_number = jQuery("#purchase_order_number").val();
	var purchase_date = jQuery("#purchase_date").val();
	var supply_date = jQuery("#supply_date").val();
	var sup_id = jQuery("#sup_id").val();

	// if(jQuery.trim(supplier_details)=='') { showError("Please select supplier", "supplier_details"); hasError = 1; } else { changeError("supplier_details"); }
	if(jQuery.trim(purchase_order_number)=='') { showError("Purchase order can't be empty.", "purchase_order_number"); hasError = 1; } else { changeError("purchase_order_number"); }
	if(jQuery.trim(purchase_date)=='') { showError("Purchase date is required", "purchase_date"); hasError = 1; } else { changeError("purchase_date"); }

	if(hasError==1){
		return false;
	}else{
		//changeError("pcategory");
		if(jQuery("table > tbody > tr").length){
			if(confirm("Are you sure wanted to place an order?")){
				var purchase = []; 
		        jQuery(".tblproduct >tbody >tr").each(function(){
		            var data = {};
		            var price = jQuery(this).find('.txt_price').val();
		            var qty = jQuery(this).find('.txtqty').val();
		            var pack_size = parseFloat(jQuery(this).find('.pack_size').html());
		            if(parseFloat(qty)>0){
			          	data['product_id'] = jQuery(this).attr('id');
			          	data['qty'] = qty;

			          	data['pack_size'] = pack_size;
			          	data['price'] = price;
			          	data['supplier_id'] = sup_id;
			          	data['order_no'] = purchase_order_number;
			          	data['date'] = purchase_date;
			          	data['supply_date'] = supply_date;

			            purchase.push(data);
			        }
		        });

		        var q = JSON.stringify(purchase);
		        jQuery.ajax({
					dataType: 'json',
					type: "POST",
					url: "create_purchase_order",
					data: {'jsonObj' : q},
					cache: false,
					beforeSend: function(){ jQuery(".btn-quirk").val('CREATING PURCHASE ORDER').prop('disabled', true); },
					success: function(res){
						jQuery(".btn-quirk").val('CREATE PURCHASE ORDER').prop('disabled', false);
						if(res.status=='1'){
							jQuery('.alert-success').css('display', 'block').html(res.msg);
		            		jQuery('.alert-danger').css('display', 'none').html("");
		            		document.getElementById('pur_form').reset();
		            		location.reload();
	            		}else{
	            			jQuery('.alert-danger').css('display', 'block').html(res.msg);
		            		jQuery('.alert-success').css('display', 'none').html("");
	            		}
		          	}
		  		});
			}
		}else{
			//if(jQuery.trim(pcategory)=='') { showError("Please select category", "pcategory"); }
		}
		return false;
	}	
}

function validate_add_remark(ele) {
	hide_message_box(ele);

	var hasError=0;
	$(".remark_rows").get().forEach(function(entry, index, array) {
		$.each(array,function(i,val){
			var rowno = val.id.substring(10,val.id.length);
			var remark = $('#remark'+rowno).val();
			if(jQuery.trim(remark)=='') { showError("Please Enter Remark", "remark"+rowno); hasError = 1; } else { changeError("remark"+rowno); }
		});
	    // Here, array.length is the total number of items
	});

	if(hasError==1){
		return false;
	}else{
		return true;
	} 
}


function delete_product_from_purchase_data(ele,purchase_id){

	var hasError=0;
	var po_number = jQuery("#purchase_order_number").val();
	var data = {};
	data.product = {};
	data.product.purchase_id = purchase_id;
	data.product.po_number = po_number;
				
	var q = JSON.stringify(data);
	jQuery.ajax({
		dataType: 'json',
		type: "POST",
		url: "delete_product_from_purchase_data",
		data: {'jsonObj' : q},
		cache: false,
		beforeSend: function(){},
		success: function(res){
			if(res.status=='1'){
				var total_amount = res.total_amount;
        		jQuery(ele).closest('tr').remove();
        		jQuery("#total_amount").val(parseFloat(total_amount).toFixed(2));
          	}
      	}
	});
	return false;
}

function validate_add_money_wallet(ele){
	jQuery('.alert-success').css('display', 'none').html("");
	jQuery('.alert-danger').css('display', 'none').html("");

	var hasError=0;
	var customer_id = jQuery("#customer_id").val();
	var customer_name = jQuery("#customer_name").val();
	var mobile_number = jQuery("#mobile_number").val();
	var amount = jQuery("#amount").val();
	var wallet_balance = jQuery("#wallet_balance").val();
	var add_date = jQuery("#add_date").val();

	if(jQuery.trim(customer_name)=='') { showError("Select customer.", "customer_name"); hasError = 1; } else { changeError("customer_name"); }
	if(jQuery.trim(mobile_number)=='') { 
		showError("Please enter valid mobile number.", "mobile_number"); hasError = 1;
	}else if(is_mobile_number(mobile_number)) {
		changeError("mobile_number");
	} else {
		showError("Please enter 10 digit valid mobile number.", "mobile_number"); hasError = 1;
	}

	if(jQuery.trim(amount)=='') { showError("Enter amount to add.", "amount"); hasError = 1; } else { changeError("amount"); }
	if(jQuery.trim(add_date)=='') { showError("Select data.", "add_date"); hasError = 1; } else { changeError("add_date"); }


	if(hasError==1){
		return false;
	}else{
		if(confirm("Are you sure wanted to add money into selected customer's wallet?")){
			var data = {};
			data.product = {};
			data.product.customer_id = customer_id;
			data.product.customer_name = customer_name;
			data.product.mobile_number = mobile_number;
			data.product.amount = amount;
			data.product.add_date = add_date;
										
			var q = JSON.stringify(data);

			jQuery.ajax({
				dataType: 'json',
				type: "POST",
				url: "add_money_to_customer_wallet",
				data: {'jsonObj' : q},
				cache: false,
				beforeSend: function(){ },
				success: function(res){
					if(res.status=='1'){
						jQuery('.alert-success').css('display', 'block').html(res.msg);
	            		jQuery('.alert-danger').css('display', 'none').html("");
	            		document.getElementById('basicForm').reset();
	        		}else{
	        			jQuery('.alert-danger').css('display', 'block').html(res.msg);
	            		jQuery('.alert-success').css('display', 'none').html("");
	        		}
	          	}
	  		});
		}  
	}
	return false;
}

function validate_sales_report(ele){
	var hasError=0;
	var category_id = jQuery("#category_id").val();
	var product_id = jQuery("#product_id").val();
	var product_name = jQuery("#product_name").val();
	var frm_date = jQuery("#frm_date").val();
	var to_date = jQuery("#to_date").val();

	if(jQuery.trim(frm_date)=='') { showError("Select from date.", "frm_date"); hasError = 1; } else { changeError("frm_date"); }
	if(jQuery.trim(to_date)=='') { showError("Select to date.", "to_date"); hasError = 1; } else { changeError("to_date"); }

	if(hasError==1){
		return false;
	}else{
		var data = {};
		data.report = {};
		data.report.category_id = category_id;
		data.report.product_id = product_id;
		data.report.frm_date = frm_date;
		data.report.to_date = to_date;
									
		var q = JSON.stringify(data);

		jQuery.ajax({
			type: "POST",
			url: "get_sales_report",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ jQuery('.loader').css('display','block'); jQuery("#sales_report").html("");},
			success: function(res){
				jQuery('.loader').css('display','none');
				jQuery("#sales_report").html(res);
	      	}
		});
	}
	return false;
}

function validate_date_wise_report(ele){
	var hasError=0;
	var category_id = jQuery("#category_id").val();
	var product_id = jQuery("#product_id").val();
	var product_name = jQuery("#product_name").val();
	var frm_date = jQuery("#frm_date").val();
	var to_date = jQuery("#to_date").val();

	if(jQuery.trim(frm_date)=='') { showError("Select from date.", "frm_date"); hasError = 1; } else { changeError("frm_date"); }
	if(jQuery.trim(to_date)=='') { showError("Select to date.", "to_date"); hasError = 1; } else { changeError("to_date"); }

	if(hasError==1){
		return false;
	}else{
		var data = {};
		data.report = {};
		data.report.category_id = category_id;
		data.report.product_id = product_id;
		data.report.frm_date = frm_date;
		data.report.to_date = to_date;
									
		var q = JSON.stringify(data);

		jQuery.ajax({
			type: "POST",
			url: "get_date_wise_sales_report",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ jQuery('.loader').css('display','block'); jQuery("#sales_report").html("");},
			success: function(res){
				jQuery('.loader').css('display','none');
				jQuery("#sales_report").html(res);
	      	}
		});
	}
	return false;
}


function payment_wish_report(ele){
	var hasError=0;
	var category_id = jQuery("#category_id").val();
	var product_id = jQuery("#product_id").val();
	var product_name = jQuery("#product_name").val();
	var pymt_type= jQuery("#pymt_type").val();
	var frm_date = jQuery("#frm_date").val();
	var to_date = jQuery("#to_date").val();

	if(jQuery.trim(frm_date)=='') { showError("Select from date.", "frm_date"); hasError = 1; } else { changeError("frm_date"); }
	if(jQuery.trim(to_date)=='') { showError("Select to date.", "to_date"); hasError = 1; } else { changeError("to_date"); }

	if(hasError==1){
		return false;
	}else{
		var data = {};
		data.report = {};
		data.report.category_id = category_id;
		data.report.product_id = product_id;
		data.report.pymt_type = pymt_type;
		data.report.frm_date = frm_date;
		data.report.to_date = to_date;
									
		var q = JSON.stringify(data);

		jQuery.ajax({
			type: "POST",
			url: "pymt_wish_report",
			data: {'jsonObj' : q},
			cache: false,
			beforeSend: function(){ jQuery('.loader').css('display','block'); jQuery("#sales_report").html("");},
			success: function(res){
				jQuery('.loader').css('display','none');
				jQuery("#sales_report").html(res);
	      	}
		});
	}
	return false;
}



function hasNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;

    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}


function delete_product_from_edit_bill_data(ele,order_details_id){
	var hasError=0;
	if(order_details_id!="" && order_details_id>0){
		if(confirm("Are you sure wanted to delete the selected product?")){
			var data = {};
			data.product = {};
			data.product.order_details_id = order_details_id;
									
			var q = JSON.stringify(data);
			jQuery.ajax({
				dataType: 'json',
				type: "POST",
				url: "delete_product_from_edit_bill_data",
				data: {'jsonObj' : q},
				cache: false,
				beforeSend: function(){ },
				success: function(res){
					if(res.status=='1'){
						var total_amount = res.total_amount;
						jQuery("#coupon_number").val("");
						jQuery("#discount_amount").val("");
						jQuery("#billed_amount").val(parseFloat(total_amount).toFixed(2));
	            		jQuery("#total_amount").val(parseFloat(total_amount).toFixed(2));
	                    jQuery(".aftr_wallet_deduct").val(parseFloat(total_amount).toFixed(2));
	            		jQuery(ele).closest('tr').remove();
		          	}else{
		          		showError(res.msg, "coupon_number"); 
		          		jQuery("#discount_amount").val('00.00');
	            		jQuery("#total_amount").val(billed_amount);
		          	}
	          	}
	  		});
	  	}
	}
	return false;
}



function validate_edit_order_data(ele){
	hide_message_box(ele);
	var hasError=0;
	
	var order_number = jQuery(ele).closest(".panel-body").find("#order_number").val();
	var order_id = jQuery(ele).closest(".panel-body").find("#order_id").val();

	var customer_name = jQuery(ele).closest(".panel-body").find("#customer_name").val();
	var mobile_number = jQuery(ele).closest(".panel-body").find("#mobile_number").val();
	var email_address = jQuery(ele).closest(".panel-body").find("#email_address").val();
	var datepicker = jQuery(ele).closest(".panel-body").find("#datepicker").val();
	var address_1 = jQuery(ele).closest(".panel-body").find("#address_1").val();
	var address_2 = jQuery(ele).closest(".panel-body").find("#address_2").val();

	var nearest_area = jQuery(ele).closest(".panel-body").find("#nearest_area").val();
	
	var city = jQuery(ele).closest(".panel-body").find("#city").val();
	var state = jQuery(ele).closest(".panel-body").find("#state").val();
	var pincode = jQuery(ele).closest(".panel-body").find("#pincode").val();

	var billed_amount = jQuery(ele).closest(".panel-body").find("#billed_amount").val();
	var coupon_number = jQuery(ele).closest(".panel-body").find("#coupon_number").val();
	var discount_amount = jQuery(ele).closest(".panel-body").find("#discount_amount").val();
	var total_amount = jQuery(ele).closest(".panel-body").find("#total_amount").val();

	var sudexo_coupon = jQuery(ele).closest(".panel-body").find("#sudexo_coupon").val();
	var credit_debit = jQuery(ele).closest(".panel-body").find("#credit_debit").val();

	var cust_paid = jQuery(ele).closest(".panel-body").find(".cust_paid").val();
	var return_amount = jQuery(ele).closest(".panel-body").find(".return_amount").val();

	var user_id = jQuery(ele).closest(".panel-body").find("#user_id").val();
	var address_id = jQuery(ele).closest(".panel-body").find("#address_id").val();
	if(jQuery.trim(customer_name)=='') { showError("Please enter customer name", "customer_name"); hasError = 1; } else { changeError("customer_name"); }

	if(user_id==''){
		showError("Please select customer from list, Or Add New Customer", "customer_name");
		hasError = 1;
	}else{
		changeError("customer_name");
	}

	var order_source = jQuery(ele).closest(".panel-body").find("#order_source").val();
	var wallet_balance = jQuery(ele).closest(".panel-body").find("#wallet_balance").val();
	var payment_method = jQuery(ele).closest(".panel-body").find("#payment_method").val();
	if(payment_method=='WALLET'){
		if(wallet_balance>0){
			jQuery(ele).closest(".panel-body").find('#wallet_balance').removeClass('error');
		}else{
			jQuery(ele).closest(".panel-body").find('#wallet_balance').addClass('error'); hasError = 1;
		}
	}else{
		jQuery(ele).closest(".panel-body").find('#wallet_balance').removeClass('error');
	}
	var offer_code = jQuery(ele).closest(".panel-body").find("#offer_code").val();

	if(hasError==1){
		return false;
	}else{
		if(jQuery(ele).closest(".panel-body").find('.error').length){
			 alert("Please resolve the error shown on form."); 
			 return false;
		}

		if(jQuery("table > tbody > tr").length){
			if(confirm("Are you sure wanted to update the counter order?")){

				var data = {};
				data.product = {};
				
				data.product.user_id = user_id;

				data.product.customer_name = customer_name;
				data.product.mobile_number = mobile_number;
				data.product.email_address = email_address;
				data.product.billing_date = datepicker;
				
				data.product.address_id = address_id;				
				data.product.address_1 = address_1;
				data.product.address_2 = address_2;
				data.product.nearest_area = nearest_area;
				data.product.city = city;
				data.product.state = state;
				data.product.pincode = pincode;

				data.product.order_number = order_number; 
				data.product.order_id = order_id; 

				data.product.customer_paid = cust_paid;
				data.product.returned_amount = return_amount;
				data.product.total_amount = total_amount;

				data.product.billed_amount = billed_amount;
				data.product.coupon_number = coupon_number;
				data.product.discount_amount = discount_amount;

				data.product.wallet_balance = wallet_balance;
				data.product.payment_method = payment_method;
				data.product.offer_code = offer_code;
				data.product.order_source = order_source;

				data.product.sudexo_coupon = sudexo_coupon;
				data.product.credit_debit = credit_debit;
							
				var q = JSON.stringify(data);

				jQuery.ajax({
					dataType: 'json',
					type: "POST",
					url: "update_order_data",
					data: {'jsonObj' : q},
					cache: false,
					beforeSend: function(){
						jQuery(".btn-quirk").text('Submiting.. Please wait.').prop('disabled', true);
					},
					success: function(res){
						jQuery(".btn-quirk").text('Submit').prop('disabled', false);
						if(res.status=='1'){ // Success
			          		jQuery(ele).find('.alert-success').css('display','block').html(res.msg); 
							jQuery(ele).find('.alert-danger').css('display','none'); 

			          	}else{ // Failed
			          		jQuery(ele).find('.alert-success').css('display','none');
							jQuery(ele).find('.alert-danger').css('display','block').html(res.msg);  
			          	}
						var goToTop = jQuery("#frm_counter_data").offset().top-100;
						jQuery("html, body").animate({ scrollTop: goToTop }, 500);
		          	}
		  		});

			}
		}else{
			alert('Your cart is empty. Please add some product.');
		}
	}  
	return false;
}

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
};
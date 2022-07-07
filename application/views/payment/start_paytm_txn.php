<?php

?>
<html>
  	<head>
	  	<script>
			function submitAgsForm() {
				var agsForm = document.forms.agsForm;
				agsForm.submit();
			}
		</script>
	</head>
	<body onload="submitAgsForm()" style="margin: 0px;">
		<div class="container header-fill" style="text-align: center;">
			<div class="main-header" style="background-color: #7BBF7E;">
				<?php $logo = $this->model->getData('company_setting')[0]['company_logo']; ?>
				<img src="<?php echo base_url();?>uploads/<?php echo $logo?>">
			</div>
		
			<h2>
				Please wait while we are redirecting you to payment gateway.
			</h2><br>
				<h3>Please Do not close the window or try to refresh the page.</h3>
			<br/>
			<img src="<?php echo base_url();?>assets/images/ajax-loader_processing.gif">
			<!-- <?php if($formError) { ?>
				<span style="color:red;display:none">Please fill all mandatory fields.</span>
			<br/>
			<br/>
			<?php } ?> -->
	</div>

	
		
	<form action="https://securegw-stage.paytm.in/theia/processTransaction" method="post" name="agsForm" style="display:none;">
		<input type="text" name="MID" value="<?php echo $MID; ?>" />
		<input type="text" name="ORDER_ID" value="<?php echo $ORDER_ID; ?>"/>
		<input type="text" name="CUST_ID" value="<?php echo $CUST_ID; ?>"/>
		<input type="text" name="INDUSTRY_TYPE_ID" value="<?php echo $INDUSTRY_TYPE_ID; ?>"/>
		<input type="text" name="CHANNEL_ID" value="<?php echo $CHANNEL_ID; ?>"/>
		<input type="text" name="TXN_AMOUNT" value="<?php echo $TXN_AMOUNT; ?>">
		<input type="text" name="WEBSITE" value="<?php echo $WEBSITE; ?>">
		<input type="text" name="CALLBACK_URL" value="<?php echo $CALLBACK_URL; ?>">
		<input type="text" name="MSISDN" value="<?php echo $MSISDN; ?>" />
		<input type="text" name="EMAIL" value="<?php echo $EMAIL; ?>" />
		<input type="text" name="VERIFIED_BY" value="<?php echo $VERIFIED_BY; ?>" />
		<input type="text" name="IS_USER_VERIFIED" value="<?php echo $IS_USER_VERIFIED; ?>" />
		<input type="text" name="CHECKSUMHASH" value="<?php echo $CHECKSUMHASH; ?>" />
	</form>

</body>

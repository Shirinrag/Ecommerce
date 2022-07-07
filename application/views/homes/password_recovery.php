<div class="main-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				
				<div class="col-md-6 col-sm-6 sign-in">
					<h4 class="">Password Recovery</h4>
					<?php 
					
					if(isset($fp_data) && empty($fp_data)){?>
						<div class="alert alert-danger" style="display:block">Opss..! Invalid link, your link has been expired.</div>
					<?php }else{ ?>
						<form class="register-form outer-top-xs" role="form" id="account_log_in" name="account_log_in" onsubmit="return validate_password_recovery(this);" autocomplete="off">
							<div class="alert alert-success" style="display:none"> </div>
							<div class="alert alert-danger" style="display:none"></div>

							<input type="hidden" id="fp_id" name="fp_id" value="<?php echo $fp_data[0]['fp_id']; ?>">
							<input type="hidden" id="email_address" name="email_address" value="<?php echo $fp_data[0]['email_address']; ?>">
							<input type="hidden" id="user_id" name="user_id" value="<?php echo $fp_data[0]['user_id']; ?>">

							<div class="form-group">
							    <label class="info-title" for="new_password">Enter your new password <span>*</span></label>
							    <input type="password" class="form-control unicase-form-control text-input" id="new_password" >
							</div>

							<div class="form-group">
							    <label class="info-title" for="confirm_password">Confirm password <span>*</span></label>
							    <input type="password" class="form-control unicase-form-control text-input" id="confirm_password" >
							</div>

							<div class="form-group">
						  		<button type="submit" class="btn-upper btn btn-primary btn_change_password">Change Password</button>
							</div>
						</form>
					<?php } ?>
				</div>

				<div class="col-md-6 col-sm-6 sign-in">
					<p>
						For greater security, use a mix of capital and small letters, punctuations and numbers for your password.
					</p>
					<p>	Avoid using:
						<li>Personal data like birthdays, name etc.
						<li>Keyboard patterns (asdfgh)
						<li>Serial numbers (123) or repeated letters (aaa)
					</p>
				</div>

			</div>
		</div>
	</div>
</div>


<?php include_once(APPPATH.'views/includes/footer.php'); ?>


<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-hover-dropdown.min.js"></script>
<script src="<?php echo base_url();?>assets/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url();?>assets/js/echo.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.easing-1.3.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-slider.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.rateit.min.js"></script>
<script src="<?php echo base_url();?>assets/js/lightbox.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
<script src="<?php echo base_url();?>assets/js/scripts.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/peekABar/js/jquery.peekabar.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/front.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/google_tracker.js"></script>

</body>
</html>
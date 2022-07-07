<div class="main-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<div class="col-md-6 col-sm-6 sign-in">
					<h4 class="">Forgot your password ? <br><sub style="font-size:12px">Don't worry we will get it back to you!</sub></h4>
					<form class="register-form outer-top-xs" role="form" id="account_registration" name="account_registration" onsubmit="return validate_forgot_password(this);" autocomplete="off">
						<div class="alert alert-success" style="display:none"> </div>
						<div class="alert alert-danger" style="display:none"></div>

						<div class="form-group">
						    <label class="info-title" for="registered_email_address">Enter your registered email address <span>*</span></label>
						    <input type="text" class="form-control unicase-form-control text-input" id="registered_email_address" >
						</div>

						<div class="form-group">
					  		<button type="submit" class="btn-upper btn btn-primary btn_forgot_password">Reset My Password</button>
						  	<a href="<?php echo base_url();?>account/my_account" class="forgot-password pull-right">
						  		<button type="button" class="btn-upper btn btn-primary btn-login">Sign In ></button>
						  	</a>
						</div>
					</form>					
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
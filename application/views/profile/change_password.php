<div class="main-content">
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li class="active">My Profile</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-4 mb-4" >
        <div class="row">
            <?php include_once('side_bar.php'); ?>
                    
                <div class="col-md-9 track-order-page"> 

                    <div class="main-single-post">
                        <div class="single-post-leading"><h3>Change Password</h3></div>
                        <hr>
                        
                        <div class="col-md-6 col-sm-6 col-ms-12" style="margin-left:-13px;">
                            <form class="form-my-account" name="frm_change_password" id="frm_change_password" onsubmit="return validate_change_password(this);">
                                <div class="alert alert-success" style="display:none"></div>
                                <div class="alert alert-danger" style="display:none"></div>
                                <p>
                                    <label>Enter your old password</label>
                                    <input type="password" class="form-control unicase-form-control text-input" name="old_password" id="old_password" >
                                </p>
                                <p>
                                    <label>Enter your New password</label>
                                    <input type="password" class="form-control unicase-form-control text-input" name="new_password" id="new_password" >
                                </p>
                                <p>
                                    <label>Confirm your new password</label>
                                    <input type="password" class="form-control unicase-form-control text-input" name="confirm_new_password" id="confirm_new_password" >
                                </p>                    
                                <p><input type="submit" class="btn-upper btn btn-primary checkout-page-button btn-submit btn-change-password" value="Change Password"></p>
                            </form>       
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content Page -->
</div>


<?php include_once(APPPATH.'views/includes/footer.php'); ?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui-1.12.0.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.1.12.0.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/owl.carousel.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/echo.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-slider.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.rateit.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/lightbox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/wow.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/scripts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/sweet-alert.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/peekABar/js/jquery.peekabar.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/direct_farm.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/google_tracker.js"></script>

</body>
</html>


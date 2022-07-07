<style type="text/css">
    fieldset {
    min-width: 0;
    padding: 0;
    margin: 0;
    border: 0;
}
</style>
<div class="main-content" id="top-banner-and-menu">
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
    <div class="container-fluid mt-4 mb-4">
        <div class="row">
            <?php include_once('side_bar.php'); ?>
                   
                <div class="col-md-9 track-order-page"> 
                    <form class="form-my-account" name="account_registration" id="account_registration" onsubmit="return validate_personal_information(this);"> 
                    <div class="alert alert-success" style="display:none"></div>
                    <div class="alert alert-error" style="display:none"></div>
                    <fieldset>
                        <legend>Personal Information</legend>

                        <div class="form-group woocommerce-form-row woocommerce-form-row--wide form-row-wide">
                            <label for="password_current">Your full name</label>
                            <input type="text" class="form-control unicase-form-control text-input" name="full_name" id="full_name" value="<?php echo $profile_data[0]['full_name']; ?>">
                        </div>
                        <div class="form-group woocommerce-form-row woocommerce-form-row--wide form-row-wide">
                            <label for="password_1">You are:</label>
                            <select name="gender" id="gender" class="form-control unicase-form-control text-input">
                                <option value="">Select your gender</option>
                                <option value="male" <?php if($profile_data[0]['gender']=="male"){ echo "selected"; } ?> > Male</option>
                                <option value="female" <?php if($profile_data[0]['gender']=="female"){ echo "selected"; } ?> > Female</option>
                            </select>
                        </div>
                        <!-- <div class="form-group woocommerce-form-row woocommerce-form-row--wide form-row-wide">
                            <label for="password_2">Confirm new password</label>
                            <input type="password" class="form-control woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2">
                        </div> -->
                    </fieldset>

                   <!--  <div class="main-single-post">
                        <div class="single-post-leading">
                            <h3>Personal Information</h3>
                        </div>
                        <hr>
                        
                        <div class="col-md-6 col-sm-6 col-ms-12" style="margin-left:-13px;">
                           
                            <form class="form-my-account" name="account_registration" id="account_registration" onsubmit="return validate_personal_information(this);">
                               
                                <div class="alert alert-success" style="display:none"></div>
                                <div class="alert alert-error" style="display:none"></div>
                                <p>
                                    <label>Your full name</label>
                                    <input type="text" class="form-control unicase-form-control text-input" name="full_name" id="full_name" value="<?php //echo $profile_data[0]['full_name']; ?>">
                                </p> -->
                                <!-- <p>
                                    <label>Your email address</label>
                                    <input type="text" name="reg_email_address" id="reg_email_address" value="<?php //echo $profile_data[0]['email_address']; ?>" disabled>
                                </p> -->

                                <!-- <div class="row"> -->
                                   <!--  <div class="col-md-6 col-sm-6 col-xs-12">
                                        <p>
                                            <label>Mobile number</label>
                                            <input type="text"  name="mobile_number" id="mobile_number" maxlength="10" value="<?php //echo $profile_data[0]['mobile_number']; ?>">
                                        </p>
                                    </div> -->
                                    <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                                        <p>
                                            <label>You are:</label>
                                            <select name="gender" id="gender" class="form-control unicase-form-control text-input">
                                                <option value="">Select your gender</option>
                                                <option value="male" <?php //if($profile_data[0]['gender']=="male"){ echo "selected"; //} ?> > Male</option>
                                                <option value="female" <?php //if($profile_data[0]['gender']=="female"){ echo "selected"; //} ?> > Female</option>
                                            </select>
                                        </p>
                                    </div>
                                </div> -->                                  
                                <fieldset>
                                    <legend>Password change</legend>

                                    <div class="form-group woocommerce-form-row woocommerce-form-row--wide form-row-wide">
                                        <label for="password_current">Current password (leave blank to leave unchanged)</label>
                                        <input type="password" class="form-control woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" onkeyup="validatePassword()">
                                    </div>
                                    <div class="form-group woocommerce-form-row woocommerce-form-row--wide form-row-wide">
                                        <label for="password_1">New password (leave blank to leave unchanged)</label>
                                        <input type="password" class="form-control woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" readonly>
                                    </div>
                                    <div class="form-group woocommerce-form-row woocommerce-form-row--wide form-row-wide">
                                        <label for="password_2">Confirm new password</label>
                                        <input type="password" class="form-control woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" readonly>
                                    </div>
                                </fieldset>
                                <p class="mt-4"><input type="submit" class="btn-upper btn btn-primary checkout-page-button checkout-continue btn-submit" value="Save Changes"></p>
                            
                                 
                        </div>
                    </form>   
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content Page -->
</div>


<?php include_once(APPPATH.'views/includes/footer.php'); ?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui-1.12.0.css">
<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url();?>assets/js/jquery-ui.1.12.0.js"></script>
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
<script type="text/javascript" src="<?php echo base_url();?>assets/js/sweet-alert.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/peekABar/js/jquery.peekabar.js"></script>
<!-- <script type="text/javascript" src="<?php //echo base_url();?>assets/js/direct_farm.js"></script> -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/google_tracker.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/front.js"></script>

<script type="text/javascript">
    function validatePassword()
    {
        var old_password = jQuery("#password_current").val();
        var hasError = 0;
        if (jQuery.trim(old_password) == '') {
            showError("Please enter old password.", "password_current");
            hasError = 1;
        }

        if(hasError == 1){
            return false;
        }else{
            
            var postOData = {
                'opasswrd':old_password
            }
            //console.log(postOData);
            $.post('<?php echo base_url('home/validate_old_password')?>',postOData,function(res){
                
                if(res.status==0){ //Failed
                    jQuery(ele).find('.alert-success').css('display','none'); 
                    jQuery(ele).find('.alert-error').css('display','block').html(res.msg); 
                }else{ //Success
                    jQuery("#password_1").attr("readonly", false); 
                    jQuery("#password_2").attr("readonly", false); 
                    jQuery(ele).find('.alert-success').css('display','block').html(res.msg); 
                    jQuery(ele).find('.alert-error').css('display','none'); 
                    // document.getElementById('account_registration').reset();
                    // setTimeout(function() {
                    //     location.reload();  
                    // }, 500); 
                    
                }
                
                
            })
        }
        
    }
</script>

</body>
</html>


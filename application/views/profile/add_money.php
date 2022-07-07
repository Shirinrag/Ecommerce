<div class="main-content">
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li class="active">Add Money</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-4 mb-4">
        <div class="row">
            <?php include_once('side_bar.php'); ?>
                    
                <div class="col-md-9 track-order-page"> 

                    <div class="main-single-post">
                        <div class="single-post-leading">
                            <h3> + Add Money to Wallet</h3>
                        </div>
                        <hr>
                        
                        <div class="col-md-12 col-sm-12 col-ms-12" style="margin-left:-13px;">
                            <form class="form-my-account" name="account_registration" id="account_registration" onsubmit="return validate_money_wallet(this);">
                               
                                <div class="alert alert-success" style="display:none"></div>
                                <div class="alert alert-error" style="display:none"></div>
                                <p>
                                    <label>Enter amount</label>
                                    <input type="text" maxlength="3" class="form-control unicase-form-control text-input" onkeypress="return isNumberKey(event)" name="amount_add" id="amount_add" style="width: 200px" />
                                </p>
                                                            
                                
                                <p class="mt-4"><input type="submit" class="btn-upper btn btn-primary checkout-page-button checkout-continue btn-submit" value="Add to Wallet"></p>
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
<script type="text/javascript" src="<?php echo base_url();?>assets/js/direct_farm.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/google_tracker.js"></script>

</body>
</html>


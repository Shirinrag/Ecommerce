<div class="main-content">
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li class="active">Add New Address</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid mb-4 mt-4">
        <div class="row">
            <?php include_once('side_bar.php'); ?>
                    
                <div class="col-md-9 track-order-page"> 

                    <div class="main-single-post">
                        <div class="single-post-leading">
                            <h3>Add New Address</h3>
                        </div>
                        <hr>
                        
                        <div class="col-md-6 col-sm-6 col-ms-12" style="margin-left:-13px;">
                           
                            <form class="form-my-account" name="frmnew_address" id="frmnew_address" onsubmit="return validate_add_new_adress(this);">
                                
                                <div class="alert alert-success" style="display:none"> </div>
                                <div class="alert alert-danger" style="display:none"></div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label class="info-title" for="user_name">Name </label>
                                            <input type="text" class="form-control unicase-form-control text-input" id="user_name" >
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label class="info-title" for="del_mobile_number">Mobile_number </label>
                                            <input type="text" class="form-control unicase-form-control text-input" id="del_mobile_number" maxlength="10">
                                        </div>
                                    </div>
                                </div>

                                 <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="info-title" for="address_1">Address 1 </label>
                                            <input type="text" class="form-control unicase-form-control text-input" id="address_1">
                                        </div>
                                    </div>
                                </div>

                                 <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="info-title" for="address_2">Address 2 </label>
                                            <input type="text" class="form-control unicase-form-control text-input" id="address_2">
                                        </div>
                                    </div>
                                </div>

                                 <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="info-title" for="landamrk">Nearest Area / Landmark</label>
                                            <input type="text" class="form-control unicase-form-control text-input" id="landamrk">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label class="info-title" for="del_city"> City </label>
                                            <input type="text" class="form-control unicase-form-control text-input" id="del_city" >
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label class="info-title" for="pincode"> Pincode </label>
                                            <input type="text" class="form-control unicase-form-control text-input" id="pincode" maxlength="6" >
                                        </div>
                                    </div>
                                </div>
   

                                <div class="row">
                                    <div class="col-md-12  col-sm-12 col-xs-12">
                                        <input type="submit" class="btn-upper btn btn-primary checkout-page-button checkout-continue btn-submit" value="Add New Address">
                                    </div>
                                </div>
                            </form>
                                 
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
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


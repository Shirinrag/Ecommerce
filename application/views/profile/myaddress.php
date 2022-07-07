<div class="main-content" id="top-banner-and-menu">
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li class="active">My Saved Addresses</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-4 mb-4">
        <div class="row">
            <?php include_once('side_bar.php'); ?>
                    
                <div class="col-md-9 track-order-page"> 

                    <div class="more-info-tab clearfix ">
                        <h3 class="new-product-title pull-left">My Saved Addresses</h3>
                        <ul class="pull-right" id="new-products-1">
                            <li class="active">
                                <a href="<?php echo base_url();?>profile/add_new_address"><button class="bt-link bt-blue btn btn-info btn-md">+ ADD NEW ADDRESS</button></a>
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <div class="row ml-4" style="text-transform: capitalize;">    
                        <?php if(isset($address_data) && !empty($address_data)){
                            foreach ($address_data as $key => $value) { ?>
                                <div class="col-md-4 col-sm-6 col-ms-12 address" style="margin-left:-13px;">
                                    <div><label><?php echo $value['full_name']; ?></label><br>
                                        <?php echo $value['mobile_number']; ?><br>
                                        <?php echo $value['address1']; ?><br>
                                        <?php echo $value['address2']; ?><br>
                                        <?php echo $value['landmark_nearest_area']; ?><br>
                                        <?php echo $value['town_city']; ?>, <?php echo $value['pincode']; ?><br>
                                    </div>  
                                    <div> 
                                        <a href="<?php echo base_url();?>profile/edit_address?address_id=<?php echo $value['address_id'];?>">
                                            <button class="btn-filter"><i class="fa fa-edit"></i> Edit</button>
                                        </a>
                                        <button class="btn-filter" onclick="return delete_my_address(this,<?php echo $value['address_id']; ?>);">
                                            <i class="fa fa-remove"></i> Delete
                                        </button>
                                    </div>             
                                </div>
                            <?php } ?>
                        <?php }?>
                    </div>
                </div>
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


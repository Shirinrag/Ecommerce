<div class="main-content">
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="<?php echo base_url();?>">Home</a></li>
                    <li class="active">My Wallet</li>
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
                            <h3>My Wallet</h3>
                            <div class="row ml-3">
                                <div class="col-md-6"> <span style="margin-left: -30px;"> Wallet Balance : Rs. <?php echo upto2Decimal($w_balance); ?></span></div>
                                <div class="col-md-6"> <a href="<?php echo base_url();?>profile/add_money">+ Add Money to Wallet</a></div>
                            </div>
                        </div>
                        <hr>
                        
                        <div class="col-md-12 col-sm-12 col-ms-12" style="margin-left:-13px;">
                           
                            <div class="table-responsive">
                                <table class="table nomargin">
                                    <?php if(isset($wallet_data) && empty($wallet_data)){ ?>
                                        <tr><td colspan="20">No record found</td></tr>
                                    <?php }else{?>
                                        <thead>
                                            <tr>
                                                <th>SR</th>
                                                <th>Transaction No</th>
                                                <th>Offer Code</th>
                                                <th class="text-center">Order No</th>
                                                <th class="text-right">Amount</th>
                                                <th>Type</th>
                                                <th class="text-right">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($wallet_data as $key => $value) {?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>
                                                    <td><?php echo $value['txn_no']; ?></td>
                                                    <td><?php echo $value['offer_code']; ?></td>
                                                    <td class="text-center"><?php echo $value['order_number']; ?></td>
                                                    <td class="text-right"><?php echo ($value['txn_type']=='1')? ' + ' : ' - ' ; echo $value['wallet_amount']; ?></td>
                                                    <td><?php echo ($value['txn_type']=='1')? 'CREDIT' : 'DEBIT' ; ?></td>
                                                    <td class="text-right"><?php echo $value['updated_on']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    <?php } ?>
                                </table>
                            </div>
                                 
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


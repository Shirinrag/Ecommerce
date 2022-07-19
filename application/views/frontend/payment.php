
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.smartaddons.com/templates/html/emarket/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Jun 2022 06:25:29 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
   <!-- Basic page needs
    ============================================ -->
    <?php include('common/cssfiles.php');?>
    <style type="text/css">
         body{font-family:'Roboto', sans-serif}
    </style>

</head>

<body class="res layout-1">
    
    <div id="wrapper" class="wrapper-fluid banners-effect-5">
    

    <!-- Header Container  -->
    <?php include('common/header.php');?>
    <!-- //Header Container  -->
    
	<!-- Main Container  -->
	<div class="main-container container">
		<ul class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i></a></li>
			<li><a href="#">Payment</a></li>
			
		</ul>
		
		<div class="row">
			<!--Middle Part Start-->
			<div id="content" class="col-sm-12">
			  <h2 class="title">Payment Mode</h2>
			  <div class="so-onepagecheckout row">
			
				<div class="col-right col-sm-9">
				  <div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default no-padding">
							
							<div class="col-sm-6  checkout-payment-methods">
								<div class="panel-heading">
								  <h4 class="panel-title"><i class="fa fa-credit-card"></i> Payment Method</h4>
								</div>
								<div class="panel-body">
									<p>Please select the preferred payment method to use on this order.</p>
									<div class="radio">
									  <label>
										<input type="radio" checked="checked" name="Cash On Delivery">Cash On Delivery</label>
									</div>
									
									<div class="radio">
									  <label>
										<input type="radio" name="Paypal">Paypal</label>
									</div>
								</div>
							</div>
						</div>
						
						
							
						</div>

				  </div>
				</div>
			  </div>
			</div>
			<!--Middle Part End -->
			
		</div>
	</div>
	<!-- //Main Container -->
	
	<!-- Footer Container -->
    <?php include('common/footer.php');?>
    <!-- //end Footer Container -->

    </div>
	
	

<!-- Include Libs & Plugins
	============================================ -->
    <!-- Placed at the end of the document so the pages load faster -->
     <?php include('common/jsfiles.php');?>
	 <script src="<?= base_url(); ?>assets_frontend/custom_js/cart.js"></script>
	 <script src="<?= base_url();?>assets_frontend/custom_js/address_book.js"></script>
		
</body>

<!-- Mirrored from demo.smartaddons.com/templates/html/emarket/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Jun 2022 06:25:29 GMT -->
</html>
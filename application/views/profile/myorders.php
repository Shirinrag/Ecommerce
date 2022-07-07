<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<div class="main-content">
	<div class="breadcrumb">
		<div class="container">
			<div class="breadcrumb-inner">
				<ul class="list-inline list-unstyled">
					<li><a href="<?php echo base_url();?>">Home</a></li>
					<li class="active">My Orders</li>
				</ul>
			</div>
		</div>
	</div>

    <div class="container-fluid mt-4 mb-4">
        <div class="row">
			<?php include_once('side_bar.php'); ?>
					
				<div class="col-md-9 track-order-page">	
					<div class="panel-group checkout-steps" id="accordion">
						
					<?php if(isset($order_data) && !empty($order_data)){ 
						foreach ($order_data as $key => $value) {
							$order_details = $this->model->getData('order_data_details',array('order_id'=>$value['order_id']));?>

						<div class="panel panel-default checkout-step-01">
							<div class="panel-heading">
								<h4 class="unicase-checkout-title" style="padding: 5px;">
									<a data-toggle="collapse" class="" data-parent="#accordion" href="#<?php echo $value['order_number']; ?>">
										<?php echo ++$key; ?>. Order Number: #<?php echo $value['order_number']; ?> on 
										<?php echo date('d-m-Y H:i:s',strtotime($value['order_date_time']));?>
										<span style="float: right;">
											<?php 
												if($value['status']=='0'){
													echo "Cancelled";
												}else if($value['status']=='1'){
													echo "Preparing..";
												}else if($value['status']=='2'){
													echo "Out for Delivery";
												}else if($value['status']=='3'){
													echo "Delivered";
												}
											?>
										</span>
									</a>
								</h4>
							</div>
							
							<div id="<?php echo $value['order_number']; ?>" class="panel-collapse collapse <?php if($key=='1'){ echo 'in'; } ?>">
								<div class="panel-body">
									<div class="row">	
										<div class="col-md-12 col-sm-12">
										<table class="table">
												<tr>
													<th align="left">Sr No.</th>
													<th align="left">Product Name</th>
													<th align="left">Qty</th>
													<th align="right">Price</th>
													<th align="right">Unit Price</th>
												</tr>
											<?php 
											$total_amount = 0;
											if(isset($order_details) && !empty($order_details)){
												foreach ($order_details as $pd_key => $pd_value) { 
													$total_amount = $total_amount+$pd_value['unit_total'];
													$product_data = $this->model->getData('product',array('product_id'=>$pd_value['product_id']));
												?>
												<tr>
													<td><?php echo ++$pd_key; ?></td>
													<td><?php echo $product_data[0]['product_name']; ?></td>
													<td><?php echo $pd_value['qty']; ?></td>
													<td>Rs. <?php echo $pd_value['price']; ?></td>
													<td>Rs. <?php echo $pd_value['unit_total']; ?></td>
												</tr>		
											<?php }
											} ?>
												<tr>
													<td>
														<?php 
														if($value['status']=='1'){?>
															<a href="javascript:void(0);" style="color: red;" class="checkout-button button" onclick="return cancel_order(this,'<?php echo $value['order_number'];?>');">Cancel your order</a>
														<?php } ?>
													</td>
													<td></td><td></td><td></td>
													<td align="left"> Rs. : <?php echo upto2Decimal($total_amount); ?></td>
												</tr>
											</table>			
										</div>			
									</div>
								</div>
							</div>					
						</div>
					<?php }
						}else{?>
							<div class="alert alert-error"><p>No order found in your account.</p></div>
					<?php } ?>
					 
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

<!-- <script type="text/javascript" src="<?php //echo base_url();?>assets/js/front.js"></script> -->

<script type="text/javascript" src="<?php echo base_url();?>assets/peekABar/js/jquery.peekabar.js"></script>
<!-- <script type="text/javascript" src="<?php //echo base_url();?>assets/js/direct_farm.js"></script> -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/google_tracker.js"></script>

<script type="text/javascript">
  	$(function(){
    	$( "#delivery_date" ).datepicker({ minDate: 0, maxDate: "1D", dateFormat:"dd-mm-yy" });
  	});
</script>

</body>
</html>


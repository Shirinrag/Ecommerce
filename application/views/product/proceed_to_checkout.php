<?php 
	$total_cart_item=$this->model->CountWhereRecord('cart',array('session_id'=>$this->session->userdata('session_id')));
	$unit_total = $this->model->getSqlData("SELECT sum(unit_total) as total FROM cart WHERE session_id='".$this->session->userdata('session_id')."'");
	$cart_total_amount = $unit_total[0]['total'];

	$subtotal = $unit_total[0]['total'];
	$total = $unit_total[0]['total'];

	if($gst_type == 'I'){
		$subtotal -= $igst;
	}
	else if($gst_type == 'E'){
		$total += $igst;
	}

	$wallet_balance = $this->model->wallet_balance($this->session->userdata('user_id'));
?>
<style type="text/css">
.delivery_here {
    background-color: #00c0f3;
    color: #000;
    text-align: center;
    border-radius: 5px;
}
.delivery_here {
	width: 94%;
    background-color: #00c0f3;
    color: #000;
    text-align: center;
    border-radius: 5px;
    margin-bottom: 10px;
}
</style>
<div class="main-content">
	<div class="breadcrumb">
		<div class="container">
			<div class="breadcrumb-inner">
				<ul class="list-inline list-unstyled">
					<li><a href="<?php echo base_url();?>">Home</a></li>
					<li class='active'>Checkout</li>
				</ul>
			</div>
		</div>
	</div>


	<div class="container" style="margin-top: 20px;">
		<div class="checkout-box">
			
			<?php if(isset($item_in_cart) && empty($item_in_cart)){ ?>
				<div class="alert alert-danger" style="text-align: center;"> Your cart is empty. <br>
					<img src="<?php echo base_url();?>assets/images/empty_cart.png">
					<br><br>
					<a href="<?php echo base_url();?>"><button class="bt-link bt-info btn btn-info btn-md">CONTINUE SHOPPING </button></a>
				</div>
			<?php }else{ ?>
					<div class="row">
						
						<div class="col-md-6">
							<form name="frmcheckout" method="post" onsubmit="return validate_checkout_place_order(this);" >
								<div id="accordion">
									
									<!-- <div class="card">
										<div class="card-header" >
											<a data-toggle="collapse" class="card-link" data-parent="#accordion" href="#collapseOne">
												<span>1</span>Schedule your delivery time
											</a>
										</div>
										
										<div id="collapseOne" class="collapse show" data-parent="#accordion">
											<div class="card-body panel-body">
												<div class="row">	
													<div class="col-md-12 col-sm-12">
														<div class="form-group">
													    	<label class="info-title" for="delivery_date">Select delivery date <span>*</span></label>
													    	<input type="text" style="width:160px" value="" readonly class="form-control unicase-form-control text-input" id="delivery_date" name="delivery_date"> <?php //echo date('d-m-Y'); ?>
													  	</div>

													  	<div class="form-group">
													    	<label class="info-title" for="sel_delivery_time">Select delivery time slot <span>*</span></label>
													    	<div class="">  
														       
														        <input class="ml0" id="2nd_slot" type="radio"  name="delivery_time" value="12.00 PM - 03.00 PM">  
														        <label  class="radio-button guest-check" for="2nd_slot">12.00 PM - 03.00 PM</label>  
														        <br>
														        <input class="ml0" id="3rd_slot" type="radio"  name="delivery_time" value="03.00 PM - 06.00 PM">  
														        <label  class="radio-button guest-check" for="3rd_slot">03.00 PM - 06.00 PM</label> 
														        <br>
														        <input class="ml0" id="4rth_slot" type="radio" name="delivery_time"  value="06.00 PM - 10.00 PM">  
														        <label  class="radio-button guest-check" for="4rth_slot">06.00 PM - 09.00 PM</label> 
														    </div>
														    <span class="errorMsgArrow mb10 del_error" style="display:none;">Please select delivery time</span>
													  	</div>
													</div>
													
													<button type="button" onclick="return validate_delivery_date_time(this);" class="ml-auto btn-upper btn btn-primary checkout-page-button checkout-continue" >Continue ></button>									
												</div>			
											</div>
										</div>
									</div> -->

									<div class="card">
										<div class="card-header">
											<a data-toggle="collapse" class="card-link" data-parent="#accordion" href="#collapseTwo">
												SELECT DELIVERY ADDRESS
											</a>
										</div>
										<div id="collapseTwo" class="collapse" data-parent="#accordion">
											<div class="card-body panel-body" style="padding: 0px;">
												<?php if(isset($my_address) && !empty($my_address)){ ?>
							                        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp" style="margin-top: 2px;">
							                            <div class="more-info-tab clearfix ">
							                                <h3 class="new-product-title" style="padding: 15px;">Your Saved Addresses</h3>
							                                <ul class="pull-right" style="margin-right: 65px;">
								                                <li><a href="javascript:void(0);" onclick="return hide_pop_msg(this);" data-toggle="modal" data-target="#my_new_address">+ Add New Address</a></li>
								                            </ul>
							                            </div>
							                            <div class="tab-content outer-top-xs">
							                                <div class="tab-pane in active" id="all">
							                                    <div class="product-slider">
							                                        <div class="carousel" data-ride="carousel" data-item="3">
							                                        	<div class="carousel-inner">
							                                                	<div class="row ml-2">
											                                        <?php foreach ($my_address as $pkey => $value) { ?>
											                                            <div class="carousel-item active col-md-12">
									                                                		<div class="" style="min-height: 220px;">
										                                                    	<p class="clearfix"><h5><?php echo $value['full_name']; ?></h5></p><hr>
																								<p class="clearfix"><?php echo $value['mobile_number']; ?></p>
																								<p class="clearfix"><?php echo $value['address1']; ?></p>
																								<p class="clearfix"><?php echo $value['address2']; ?></p>
																								<p class="clearfix"><?php echo $value['landmark_nearest_area']; ?></p>
																								<p class="clearfix"><?php echo $value['town_city']; ?>, <?php echo $value['pincode']; ?></p>
																								<p class="clearfix"><?php echo $value['state_name']; ?></p>
										                                                    </div>
										                                                    <div class="delivery_here"> 
																			                    <input class="ml0" name="deliver_here" id="deliver_here<?php echo $value['address_id'];?>" type="radio" name="text" value="<?php echo $value['address_id'];?>">  
																			                    <input class="ml0" name="delivery_state" id="deliver_state<?php echo $value['address_id'];?>" type="hidden" value="<?php echo $value['state_code'];?>"> 
																								<label name="delivery_here" class="radio-button guest-check" for="deliver_here<?php echo $value['address_id'];?>" style="font-size: 20px;">DELIVER HERE</label>
																	        				</div>
									                                            		</div>
									                                        		<?php } ?>
									                                        	</div>
									                                    </div>
							                                        </div>
							                                    </div>
							                                    <span class="errorMsgArrow mb10 del_address_error" style="display:none;">Please select delivery address</span>
							                                </div>
							                            </div>
							                        </div>
							                        <button type="button" onclick="return show_payment_method(this,<?= $state_code;?>);" class="btn-upper btn btn-primary checkout-page-button checkout-continue" style="float: right;">Continue to payment ></button>
							                    <?php }else{ ?>
							                    	<div class="outer-top-xs outer-bottom-xs pull-right">
							                    		<a href="javascript:void(0);" onclick="return hide_pop_msg(this);" data-toggle="modal" data-target="#my_new_address">+ Add New Address</a>
							                    	</div>
							                    <?php } ?>
											</div>
										</div>
									</div>
									
									<div class="card">
										<div class="card-header">
											<a data-toggle="collapse" class="card-link" data-parent="#accordion" href="#collapseThree">
												PAYMENT INFORMATION
											</a>
										</div>

										<div id="collapseThree" class="collapse" data-parent="#accordion"> 
											<div class="card-body panel-body">
												<div class="col-md-12 col-sm-12 guest-login">
													<p class="text title-tag-line">SELECT YOUR PAYMENT MODE:</p>
													
													<?php 
													//echo $cart_total_amount.'_'.$wallet_balance;
													if($cart_total_amount>$wallet_balance){ ?>
														<!-- <div class="radio radio-checkout-unicase">  
													        <input id="netbanking" type="radio" name="payment_method" value="netbanking">  
													        <label class="radio-button guest-check" for="netbanking">Netbanking / Debit Card / Credit Card Payment</label>  
													    </div> -->

													    <div class="">  
													        <input id="cod" type="radio" name="payment_method" value="COD">  
													        <label class="radio-button guest-check" for="cod">CASH ON DELIVERY</label>  
													        <span class="errorMsgArrow mb10 payment_mode_error" style="display: none;">Please select payment mode</span>
													    </div>
												    <?php }else{ ?>
												    	<div class="">  
													        <input id="wallet_payment" type="radio" name="payment_method" value="wallet">  
													        <label class="radio-button guest-check" for="wallet_payment">Pay <b>Rs. <?php echo upto2Decimal($cart_total_amount); ?> </b> from Wallet</label>  
													        <span class="errorMsgArrow mb10 payment_mode_error" style="display: none;">Please select payment mode</span>
													    </div>

												    <?php } ?>
												    <div class="">  
												    	<input id="paytm" type="radio" name="payment_method" value="paytm">  
													    <label class="radio-button guest-check" for="paytm">PAYTM</label>  
													    <span class="errorMsgArrow mb10 payment_mode_error" style="display: none;">Please select payment mode</span>
												    </div>

												    <br>

												   <!--  <p class="text title-tag-line">Please enter below image value</p>
												    <div class="radio radio-checkout-unicase">  
												        <label for="captch"></label>
														<div class="captcha_img" style="float: left;"><?php echo $captcha['image']; ?></div><br><br>
														<input type="text" class="form-control unicase-form-control text-input"  style="width: 152px" name="userCaptcha" id="userCaptcha" placeholder="" />
												    </div>  -->

												    <br><br>
												    <p class="text title-tag-line">Have a promo code?</p>
												    <input type="text" class="form-control unicase-form-control text-input" onkeyup="applyOffer(this.value)"  style="width: 152px" name="promo_code" id="promo_code" placeholder="" />

												    <br><br>
													<button type="submit" class="btn-upper btn btn-primary checkout-page-button checkout-continue btn_place_order" >COMPLETE CHECKOUT ></button>
												</div>
											</div>
										</div>
									</div>
									
								</div>
							</form>
						</div>

						<div class="col-md-6">
							<div class="checkout-progress-sidebar ">
								<div class="panel-group">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="unicase-checkout-title">Order Review</h4>
										</div>
										<div class="">
											<table id="" class="table order_review table-bordered">
												<thead>
													<tr>
														<th class="cart-product-name item">Product</th>
														<th class="cart-product-name item">Pack Size</th>
														<th class="cart-product-name item">Cat</th>
														<th class="cart-qty item">Qty</th>
														<th style="text-align: right;" class="cart-sub-total item">Price(Rs.)</th>
														<th style="text-align: right;" class="cart-total last-item">Total(Rs.)</th>
													</tr>
												</thead>
												<tbody>
												<?php if(isset($item_in_cart) && !empty($item_in_cart)){ 
														foreach ($item_in_cart as $key => $value) {
															$product_data=$this->model->getData('product',array('product_id'=>$value['product_id'])); 
															$cat_data = $this->model->getData('category',array('category_id'=>$product_data[0]['category_id']));
															$unit_data = $this->model->getData('product_unit',array('unit_id'=>$product_data[0]['unit_id']));
															?>
																<tr id="<?php echo $value['cart_id']; ?>">
																	<td class="cart-product-name-info"><?php echo ucfirst($product_data[0]['product_name']); ?></td>
																	<td class="cart-product-name-info"><?php echo ucfirst($value['pack_size']); ?></td>
																	<td class="cart-product-name-info">
																	<?php if(isset($cat_data) && !empty($cat_data)){echo $cat_data[0]['category_name']; }?>
																	</td>
																	<td class="cart-product-quantity">
																		<?php echo $exact_qty = gram_to_kg($product_data[0]['unit_id'],$value['qty']);?>&nbsp;
																		<?php echo (isset($unit_data) && !empty($unit_data)) ?  strtolower($unit_data[0]['abbrivation']) : ''; ?>
																	</td>
																	<td style="text-align: right;" class="cart-product-sub-total"><?php echo $value['price'];?></td>
																	<td style="text-align: right;" class="cart-product-grand-total"><?php echo upto2Decimal($value['unit_total']);?></td>
																</tr>
														<?php }?>
															<tr>
																<td colspan="5"><h5 style="margin-top:1px;" ><b>SUBTOTAL</b></h5></td>
																<td style="text-align: right;font-size: 13px;display: inline-flex;"><span><b>Rs.</b></span>
																	<span class="total_billed_amount" ><b><?php echo upto2Decimal($subtotal); ?></b></span>
																</td>
															</tr>
															<tr id="sgst_row" style="display: none">
																<td colspan="5"><h5 style="margin-top:1px;">SGST</h5></td>
																<td style="text-align: right;font-size: 13px;">Rs. 
																	<span class="sgst"><?php echo upto2Decimal($sgst); ?></span>
																</td>
															</tr>
															<tr id="cgst_row"  style="display: none">
																<td colspan="5"><h5 style="margin-top:1px;">CGST</h5></td>
																<td style="text-align: right;font-size: 13px;">Rs. 
																	<span class="cgst"><?php echo upto2Decimal($cgst); ?></span>
																</td>
															</tr>
															<tr id="igst_row">
																<td colspan="5"><h5 style="margin-top:1px;">IGST</h5></td>
																<td style="text-align: right;font-size: 13px;">Rs. 
																	<span class="igst"><?php echo upto2Decimal($igst); ?></span>
																</td>
															</tr>
															<tr >

															<tr>
																<td colspan="5"><h5 style="margin-top:1px;"><b>TOTAL</b></h5></td>
																<td style="text-align: right;font-size: 15px;">Rs. 
																	<span class="total_billed_amount"><?php echo upto2Decimal($cart_total_amount); ?></span>
																</td>
															</tr>

															<tr>
																<td colspan="5"><h5 style="margin-top:1px;">DISC. AMT</h5> <span class="disc_text"></span></td>
																<td style="text-align: right;font-size: 15px;"> - <span class="disc_amount"> 00.00 </span></td>
															</tr>
																

															<tr>
																<td colspan="5"><h5 style="margin-top:1px;">DELIVERY CHARGES</h5></td>
																<td style="text-align: right;font-size: 15px;"> +
																	<span class="deli_charges">
																		<?php if(upto2Decimal($cart_total_amount)<100){ echo '20.00'; }else{ echo '00.00'; } ?>
																	</span>
																</td>
															</tr

															<tr>
																<td colspan="5"><h5 style="margin-top:1px;"><b>PAYABLE AMOUNT</b></h5></td>
																<td style="text-align: right;font-size: 15px;"> Rs. <span class="payable_amount">
																	<?php if(upto2Decimal($cart_total_amount)<100){ echo upto2Decimal($cart_total_amount+20); }else{ echo upto2Decimal($cart_total_amount); } ?>
																	</span>
																</td>
															</tr>
														<?php } ?>
													
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div> 
						</div>
					</div>
			<?php } ?>
			
		</div>

	</div>
</div>

<div id="my_new_address" class="modal fade" role="dialog">
  	<div class="modal-dialog">
    	<div class="modal-content" >
	      	<div class="modal-header">
	        	<h4 class="modal-title">Enter your new shipping address</h4>
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	
	      	</div>
	      	<div class="modal-body">
	      		<form novalidate="true" id="frmnew_address" name="frmnew_address" onsubmit="return validate_add_new_adress_while_checkout(this);">
	      			<div class="alert alert-success" style="display:none"><i class="fa fa-check-square"></i> 
	      				<span class="msg-section"></span>
	      			</div>
					<div class="alert alert-warning" style="display:none"><i class="fa fa-exclamation-triangle"></i>
						<span class="msg-section"></span>
					</div>
					<table width="100%" >
						<tr style="height: 65px;">
							<td width="20%"><label>Name</label></td>
							<td><input id="user_name" type="text" class="form-control unicase-form-control text-input"></td>
						</tr>
						<tr style="height: 65px;">
							<td><label>Pincode</label></td><td>
							<input id="del_pincode" type="text" maxlength="6" class="form-control unicase-form-control text-input"></td>
						</tr>
						<tr style="height: 65px;">
							<td><label>Address 1</label></td>
							<td><input id="address_1" type="text" class="form-control unicase-form-control text-input"></td>
						</tr>
						<tr style="height: 65px;">
							<td><label>Address 2</label></td>
							<td><input id="address_2" type="text" class="form-control unicase-form-control text-input"></td>
						</tr>
						<tr style="height: 65px;">
							<td><label>Landmark</label></td>
							<td><input id="landamrk" type="text" class="form-control unicase-form-control text-input"></td>
						</tr>
						<tr style="height: 65px;">
							<td><label>State</label></td>
							<td>
								<select name="state_code" id="state_code" class="form-control">
									<option value="">Select</option>
									<?php foreach($states as $state){?>
										<option value="<?php echo $state['state_code'];?>"><?php echo $state['state_name'];?></option>
									<?php }?>
								</select>
							</td>
						</tr>
						<tr style="height: 65px;">
							<td><label>City</label></td>
							<td><input id="del_city" type="text" class="form-control unicase-form-control text-input"></td>
						</tr>
						<tr style="height: 65px;">
							<td><label>Phone</label></td>
							<td><input id="del_phone_number" type="text" maxlength="10" class="form-control unicase-form-control text-input"></td>
						</tr>
						<tr>
							<td colspan="2">
								<button type="submit" class="btn-upper btn btn-primary btn_save_continue checkout-page-button" style="float: right;">+ SAVE & CONTINUE &gt;</button>
							</td>
						</tr>
					</table>
				</form>
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
<script type="text/javascript" src="<?php echo base_url();?>assets/js/front.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/google_tracker.js"></script>

<script type="text/javascript">
  	$(function(){
    	$( "#delivery_date" ).datepicker({ minDate: 3, dateFormat:"dd-mm-yy" });
  	});
  	function applyOffer(promo_code){
  		var total_billed_amount = jQuery('table').find(".total_billed_amount").text();
  		var offer_data = jQuery.parseJSON(has_valid_offer(promo_code));
		var discount_amount = offer_data.discounted_amount;
		var total_discounted_amount = offer_data.total_discounted_amount;
				
		var disc_total_amt = parseFloat(total_billed_amount)-parseFloat(discount_amount);
		var final_amount = parseFloat(disc_total_amt);

		if(offer_data.status=="0"){
			showError(offer_data.msg,"promo_code"); hasError = 1; 
			jQuery('table').find(".disc_text").html("");
			jQuery('table').find(".disc_amount").html("00.00");
			jQuery('table').find(".payable_amount").html((parseFloat(total_billed_amount) ).toFixed(2));

		}else{
			jQuery('table').find(".disc_amount").html(parseFloat(discount_amount).toFixed(2));
			jQuery('table').find(".disc_text").html(promo_code +" code has been applied successfully");
			jQuery('table').find('.payable_amount').html(final_amount.toFixed(2));
			changeError("promo_code"); 
		}
  	}
</script>

</body>
</html>

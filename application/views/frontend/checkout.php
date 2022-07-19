<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>

    <!-- Basic page needs
    ============================================ -->
    <?php include('common/cssfiles.php');?>
    <style type="text/css">
    body {
        font-family: 'Roboto', sans-serif
    }
    </style>

</head>

<body class="res layout-1">

    <!-- Header Container  -->
    <?php include('common/header.php');?>
    <!-- //Header Container  -->
    
	<!-- Main Container  -->
	<div class="main-container container">
		<ul class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i></a></li>
			<li><a href="#">Checkout</a></li>
			
		</ul>
		
		<div class="row">
			<!--Middle Part Start-->
			<div id="content" class="col-sm-12">
			  <h2 class="title">Checkout</h2>
			  <div class="so-onepagecheckout row">
				<div class="col-left col-sm-3" id="add_addresses" style="display:none;"	>
				
				  <div class="panel panel-default">
					<div class="panel-heading">
					  <h4 class="panel-title"><i class="fa fa-user"></i> Your Personal Details</h4>
					</div>
					<?php echo form_open('Frontend/save_new_address', array('id' => 'save_new_address_form')) ?>
                     
					 <div class="panel-body">

					 <fieldset id="shipping-address">
							 <legend>Shipping Address</legend>
							 <div class="form-group">
								<label class="control-label">Address Type</label>
								<select class="form-control select2" name="address_type" data-placeholder="Address Type">
								   <option value=""></option>
								   <option value="1">Home</option>
								   <option value="2">Office</option>
								   <option value="3">Others</option>
								   
								</select>
								 <span class="error_msg" id="address_type_error"></span>
							 </div>
							 <div class="form-group">
								<label for="input-company" class="control-label">Room No</label>
								<input type="text" class="form-control"  placeholder="Room No" name="roomno" id="roomno">
								 <span class="error_msg" id="address_type_error"></span>

							 </div>
							 <div class="form-group required">
								<label for="input-address-1" class="control-label">Building</label>
								<input type="text" class="form-control" placeholder="Building" name="building" id="building">
								 <span class="error_msg" id="building_error"></span>

							 </div>
							 <div class="form-group required">
								<label for="input-city" class="control-label">Street</label>
								<input type="text" class="form-control" id="city" placeholder="City" name="city">
								 <span class="error_msg" id="city_error"></span>

							 </div>
							 <div class="form-group required">
								<label for="input-postcode" class="control-label">Pincode</label>
								<input type="text" class="form-control" id="postcode" placeholder="Post Code" name="postcode">
								 <span class="error_msg" id="postcode_error"></span>

							 </div>
							 </fieldset>
					   <div class="buttons clearfix">
					   <div class="pull-left">
						   <button class="btn btn-primary" id="save_new_address_button" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading" type="submit">Submit</button>
					   </div>
					</div>
				 <?php echo form_close() ?>
				  </div>
				  </div>
				</div>
				<form action="<?php echo base_url(); ?>Frontend/confirmorder" method="post">
				<div class="col-right col-sm-9">
				  <div class="row">
					<div class="col-sm-12">
						<!--<div class="panel panel-default no-padding">
							 <div class="col-sm-6 checkout-shipping-methods">
								<div class="panel-heading">
								  <h4 class="panel-title"><i class="fa fa-truck"></i> Delivery Method</h4>
								</div>
								<div class="panel-body ">
									<p>Please select the preferred shipping method to use on this order.</p>
									<div class="radio">
									  <label>
										<input type="radio" checked="checked" name="Free Shipping">
										Free Shipping - $0.00</label>
									</div>
									<div class="radio">
									  <label>
										<input type="radio" name="Flat Shipping Rate">
										Flat Shipping Rate - $7.50</label>
									</div>
									
								</div>
							</div>
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
						</div>-->
					</div>
				
					<div class="col-sm-12">
					  <div class="panel panel-default">
						<div class="panel-heading">
						  <h4 class="panel-title"><i class="fa fa-ticket"></i>Select Address <a  style="float:right;" id="add_address"><i class="fa fa-plus btn" ></i></a></h4>
						  
						</div>
						<div class="panel-body">
							<?php  foreach($user_address as $key =>$values) {?>
								<div class="radio">
							  <label>
								<input type="radio" value="<?php echo 'Room No: '.$values['roomno'].','.$values['building'].','.$values['street'].','.$values['zone']; ?>" name="account">
								<input type="radio" value="<?php echo 'Room No: '.$values['roomno'].','.$values['building'].','.$values['street'].','.$values['zone']; ?>" name="account"><?php echo 'Room No: '.$values['roomno'].','.$values['building'].','.$values['street'].','.$values['zone']; ?></label><a  style="float:right;" class="btn" id="edit_address" data-toggle="modal" data-target="#myModal_<?php echo $values['id']?>"><i class="fa fa-edit"></i></a>
								<input type="hidden" name="fk_address_id" value="<?php echo 'Room No: '.$values['roomno'].','.$values['building'].','.$values['street'].','.$values['zone']; ?>">
							</div>
					<div id="myModal_<?php echo $values['id']?>" class="modal fade" role="dialog">
					 <div class="modal-dialog">
							
						<!-- Modal content-->
						<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Edit Address</h4>
						</div>
						<div class="modal-body">
						<form action="<?php echo base_url(); ?>Frontend/edit_new_address" method="post">
						
						<fieldset id="shipping-address">
							 <legend>Shipping Address</legend>
							 <div class="form-group">
								<label class="control-label">Address Type</label>
								<select class="form-control select2" name="address_type" data-placeholder="Address Type">
								   <option value=""></option>
								   <option value="1" <?php if($values['address_type'] == '1'){?> selected=selected <?php } ?>>Home</option>
								   <option value="2" <?php if($values['address_type'] == '2'){?> selected=selected <?php } ?>>Office</option>
								   <option value="3" <?php if($values['address_type'] == '3'){?> selected=selected <?php } ?>>Others</option>
								   
								</select>
								 <span class="error_msg" id="address_type_error"></span>
							 </div>
							 <div class="form-group">
							 <input type="hidden" class="form-control"  name="id" value="<?php echo $values['id']; ?>">
								<label for="input-company" class="control-label">Room No</label>
								<input type="text" class="form-control"  placeholder="Room No" name="roomno" id="roomno" value="<?php echo $values['roomno']; ?>">
								 <span class="error_msg" id="address_type_error" ></span>

							 </div>
							 <div class="form-group required">
								<label for="input-address-1" class="control-label">Building</label>
								<input type="text" class="form-control" placeholder="Building" name="building" id="building" value="<?php echo $values['building']; ?>">
								 <span class="error_msg" id="building_error" ></span>

							 </div>
							 <div class="form-group required">
								<label for="input-city" class="control-label">Street</label>
								<input type="text" class="form-control" id="city" placeholder="City" name="city" value="<?php echo $values['street']; ?>">
								 <span class="error_msg" id="city_error" ></span>

							 </div>
							 <div class="form-group required">
								<label for="input-postcode" class="control-label">Pincode</label>
								<input type="text" class="form-control" id="postcode" placeholder="Post Code" name="postcode" value="<?php echo $values['zone']; ?>">
								 <span class="error_msg" id="postcode_error" ></span>

							 </div>
							 </fieldset>
							 <div class="buttons clearfix">
					   <div class="pull-left">
						   <button class="btn btn-primary"  data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading" type="submit">Submit</button>
					   	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
						</form>
					</div>
					
						</div>
						
						</div>

					</div>
					</div>
							<?php } ?>
						
					  </div>		  
					  </div>
					</div>
					</div>
					
					<div class="col-sm-12">
					
					  <div class="panel panel-default">
						<div class="panel-heading">
						  <h4 class="panel-title"><i class="fa fa-shopping-cart"></i> Shopping cart</h4>
						</div>
						  <div class="panel-body">
							<div class="table-responsive">
							  <table class="table table-bordered">
								<thead>
								  <tr>
									<td class="text-center">Image</td>
									<td class="text-left">Product Name</td>
									<!-- <td class="text-left">Quantity</td> -->
									<!-- <td class="text-left">Action</td> -->
									<td class="text-right">Unit Price</td>
									<td class="text-right">Total</td>
								  </tr>
								</thead>
								<tbody>
								<?php 
                              foreach ($cart_product_details as $cart_data_key => $cart_data_row) { ?>
								  <tr>
							  <input type="hidden" value="<?=$cart_data_row['product_id']?>" name="fk_product_id[]">
							  <input type="hidden" value="<?=$cart_data_row['cart_qty']?>" name="quantity[]">
							  <input type="hidden" value="<?=$cart_data_row['product_offer_price']?>" name="unit_price[]">
							  <input type="hidden" value="<?=$cart_total?>" name="sub_total">
							  <input type="hidden" value="" name="tax">
							  <input type="hidden" value="<?=$cart_total?>" name="grand_total">
					
                              <td class="text-center"><a href="product.html"><img width="70px" src="<?=$cart_data_row['image_name']?>" alt="Aspire Ultrabook Laptop" title="Aspire Ultrabook Laptop" class="img-thumbnail" /></a></td>
                              <td class="text-left"><a href="product.html"><?=$cart_data_row['product_name']?></a><br />
                              </td>
                              <!--<td class="text-left" width="200px">
                           
                                
                                  <div class="option quantity">
  
                                       <div class="num-block skin-2">
                                         <div class="num-in">
                                           <span class="minus dis" id="<?= $cart_data_row['cart_id']?>" onClick="decrement_quantity(<?= $cart_data_row['cart_id']?>, '<?=$cart_data_row['product_offer_price']?>','<?=$cart_data_row['product_id']?>')"></span>
                                           <input type="text"  id="input-quantity-<?= $cart_data_row['cart_id']?>" value="<?= $cart_data_row['cart_qty']?>" class="in-num" value="<?= $cart_data_row['cart_qty']?>" readonly>
                                           <span class="plus" id="<?= $cart_data_row['cart_id']?>" onClick="increment_quantity(<?= $cart_data_row['cart_id']?>, '<?=$cart_data_row['product_offer_price']?>','<?=$cart_data_row['product_id']?>')"></span>
                                         </div>
                                       </div>
  
                                       <div class="cart-item-container">
                                       <p class="text-center" id="message_<?= $cart_data_row['cart_id']?>" style="font-size:12px;color:red;"></p>
                                 </div> 
                             
                              </td>-->
                               <td class="text-right">$ <?=$cart_data_row['product_offer_price']?></td>
                              <td class="text-right" id="product_offer_price_<?= $cart_data_row['cart_id']?>">$ <?=$cart_data_row['cartPrice']?></td>
							  <input type="hidden" value="<?=$cart_data_row['cartPrice']?>" name="total[]" >
                           </tr>
								  <?php } ?>
								</tbody>
								<tfoot>
								<tbody>
                              <tr>
                                 <td class="text-right" colspan="3">
                                    <strong >Sub-Total:</strong>
                                 </td>
                                 <td class="text-right" id="subtotal">$ <?php echo $cart_total; ?></td>
                              </tr>
                             
                              <tr>
                                 <td class="text-right" colspan="3">
                                    <strong>Total:</strong>
                                 </td>
                                 <td class="text-right" id="subtotal">$ <?php echo $cart_total; ?></td>
                              </tr>
                           </tbody>
								</tfoot>
							  </table>
							</div>
							<div class="buttons">
							  <div class="pull-right">
								<input type="submit" class="btn btn-primary" id="confirmorder" value="Confirm Order" >
							  </div>
							</div>
						  </div>
					  </div>
					  </form>
					</div>
					<div class="col-sm-12">
					  <!-- <div class="panel panel-default">
						<div class="panel-heading">
						  <h4 class="panel-title"><i class="fa fa-pencil"></i> Add Comments About Your Order</h4>
						</div>
						  <div class="panel-body">
							<textarea rows="4" class="form-control" id="confirm_comment" name="comments"></textarea>
							<br>
							<label class="control-label" for="confirm_agree">
							  <input type="checkbox" checked="checked" value="1" required="" class="validate required" id="confirm_agree" name="confirm agree">
							  <span>I have read and agree to the <a class="agree" href="#"><b>Terms &amp; Conditions</b></a></span> </label>
							<div class="buttons">
							  <div class="pull-right">
								<input type="button" class="btn btn-primary" id="button-confirm" value="Confirm Order">
							  </div>
							</div>
						  </div>
					  </div> -->
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
	 <script type="text/javascript">
   $(document).ready(function() {

    <script type="text/javascript">
    $(document).ready(function() {

        $('.num-in span').click(function() {
            var cartid = $('.cartid').val();
            var product_id = $('.product_id').val();
            var $input = $(this).parents('.num-block').find('input.in-num');

            if ($(this).hasClass('minus')) {
                var count = parseFloat($input.val()) - 1;
                count = count < 1 ? 1 : count;
                if (count < 2) {
                    $(this).addClass('dis');
                } else {
                    $(this).removeClass('dis');
                }
                $input.val(count);
            } else {
                var count = parseFloat($input.val()) + 1
                $input.val(count);
                if (count > 1) {
                    $(this).parents('.num-block').find(('.minus')).removeClass('dis');
                }
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>Frontend/updatecarts',
                    data: {
                        qty: $input,
                        cartid: count,
                        productid: product_id
                    },
                    success: function(result) {
                        if (result['status'] == 'false') {
                            $('message').val(result['message'])
                        }
                    }
                });
            }
            $input.change();
            return false;


        });

        $('#add_address').click(function() {
            $('#add_addresses').css("display", "block");
        });

    });
    // product +/-
    </script>
</body>

</html>
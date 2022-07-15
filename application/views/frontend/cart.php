<!DOCTYPE html>
<html lang="en">
   
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

   <head>
      <!-- css
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
               <li><a href="#">Shopping Cart</a></li>
            </ul>
            <div class="row">
               <!--Middle Part Start-->
               <div id="content" class="col-sm-12">
                  <h2 class="title">Shopping Cart</h2>
                  <div class="table-responsive form-group">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <td class="text-center">Image</td>
                              <td class="text-left">Product Name</td>
                              <td class="text-left">Model</td>
                              <td class="text-left">Quantity</td>
                              <td class="text-right">Unit Price</td>
                              <td class="text-right">Total</td>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              foreach ($cart_data as $cart_data_key => $cart_data_row) { ?>
                           <tr>
                              <td class="text-center"><a href="product.html"><img width="70px" src="<?=$cart_data_row['image_name']?>" alt="Aspire Ultrabook Laptop" title="Aspire Ultrabook Laptop" class="img-thumbnail" /></a></td>
                              <td class="text-left"><a href="product.html"><?=$cart_data_row['product_name']?></a><br />
                              </td>
                              <td class="text-left"><?=$cart_data_row['product_code']?></td>
                              <td class="text-left" width="200px">
                                  <div class="input-group btn-block quantity input-group quantity-control" style="-webkit-user-select: none;">
                                  <input type="hidden" name="product_id" id="<?= $cart_data_row['product_id']?>" value="<?= $cart_data_row['product_id']?>">
                                    <span class="input-group-btn">
                                    <button class="btn update_qty input-group-addon product_quantity_down text-center"  id="<?= $cart_data_row['cart_id']?>" data-toggle="tooltip" onclick="updatecart(this, <?php echo $cart_data_row['cart_id']; ?>, <?php echo $cart_data_row['product_id']; ?>)"  style="padding:16px;">-</button>
                                    <input type="text" name="qty[]" value="1" size="1" class="form-control qty" readonly  style="width:100px;"/>
                                    <button class="btn update_qty  input-group-addon product_quantity_down text-center" id="<?= $cart_data_row['cart_id']?>" data-toggle="tooltip" onclick="updatecart(this, <?php echo $cart_data_row['cart_id']; ?>, <?php echo $cart_data_row['product_id']; ?>)"  style="padding:16px;">+</button>
                                    </span>
                                 </div>
                                
                                 <!-- <div class="option quantity">
                                    <div class="input-group quantity-control" unselectable="on" style="-webkit-user-select: none;">
                                      
                                       <button class="input-group-addon product_quantity_down">−</button>
                                       <input class="form-control text-center" type="text" name="quantity"
                                          value="1" readonly>
                                       <input type="hidden" name="product_id" value="50">
                                       <button class="input-group-addon product_quantity_up">+</button>
                                    </div>
                                 </div> -->
                             
                              </td>
                              <td class="text-right">$ <?=$cart_data_row['product_offer_price']?></td>
                              <td class="text-right">$ <?=$cart_data_row['product_offer_price']?></td>
                           </tr>
                           <?php }
                           ?>
                        </tbody>
                     </table>
                  </div>
                  <h3 class="subtitle no-margin">What would you like to do next?</h3>
                  <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
                  <div class="panel-group" id="accordion">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <h4 class="panel-title">
                              <a href="#collapse-coupon" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" aria-expanded="true">Use Coupon Code 
                              <i class="fa fa-caret-down"></i>
                              </a>
                           </h4>
                        </div>
                        <div id="collapse-coupon" class="panel-collapse collapse in" aria-expanded="true">
                           <div class="panel-body">
                              <label class="col-sm-2 control-label" for="input-coupon">Enter your coupon here</label>
                              <div class="input-group">
                                 <input type="text" name="coupon" value="" placeholder="Enter your coupon here" id="input-coupon" class="form-control">
                                 <span class="input-group-btn"><input type="button" value="Apply Coupon" id="button-coupon" data-loading-text="Loading..." class="btn btn-primary"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <h4 class="panel-title">
                              <a href="#collapse-voucher" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle collapsed" aria-expanded="false">Use Gift Certificate 
                              <i class="fa fa-caret-down"></i>
                              </a>
                           </h4>
                        </div>
                        <div id="collapse-voucher" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                           <div class="panel-body">
                              <label class="col-sm-2 control-label" for="input-voucher">Enter your gift certificate code here</label>
                              <div class="input-group">
                                 <input type="text" name="voucher" value="" placeholder="Enter your gift certificate code here" id="input-voucher" class="form-control">
                                 <span class="input-group-btn"><input type="submit" value="Apply Gift Certificate" id="button-voucher" data-loading-text="Loading..." class="btn btn-primary"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-4 col-sm-offset-8">
                        <table class="table table-bordered">
                           <tbody>
                              <tr>
                                 <td class="text-right">
                                    <strong>Sub-Total:</strong>
                                 </td>
                                 <td class="text-right">$168.71</td>
                              </tr>
                              <tr>
                                 <td class="text-right">
                                    <strong>Flat Shipping Rate:</strong>
                                 </td>
                                 <td class="text-right">$4.69</td>
                              </tr>
                              <tr>
                                 <td class="text-right">
                                    <strong>Eco Tax (-2.00):</strong>
                                 </td>
                                 <td class="text-right">$5.62</td>
                              </tr>
                              <tr>
                                 <td class="text-right">
                                    <strong>VAT (20%):</strong>
                                 </td>
                                 <td class="text-right">$34.68</td>
                              </tr>
                              <tr>
                                 <td class="text-right">
                                    <strong>Total:</strong>
                                 </td>
                                 <td class="text-right">$213.70</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="buttons">
                     <div class="pull-left"><a href="<?php echo base_url();?>" class="btn btn-primary">Continue Shopping</a></div>
                     <div class="pull-right"><a href="checkout.html" class="btn btn-primary">Checkout</a></div>
                  </div>
               </div>
               <!--Middle Part End -->
            </div>
         </div>
         <!-- //Main Container -->
         <!-- Footer Container -->
         
         <!-- //end Footer Container -->
      </div>
      <!-- footer
         ============================================ -->
      <?php include('common/footer.php');?>

<script type="text/javascript">
function updatecart(obj,$cartid,$opt){
	objRow = obj.parentNode;
    var qty = $(objRow).find('.qty').val();
	$.ajax({
	type:"POST",
	url:'<?php echo base_url(); ?>Frontend/updatecarts',
	data: { qty:qty, cartid:$cartid ,productid:$opt},
	success:function (result) {
	 
	}
	});
}
</script> 
      <!-- Include Libs & Plugins
         ============================================ -->
      <?php include('common/jsfiles.php');?>
     
   </body>

</html>
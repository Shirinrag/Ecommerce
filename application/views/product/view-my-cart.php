<?php 
    $total_cart_item=$this->model->CountWhereRecord('cart',array('session_id'=>$this->session->userdata('session_id')));
    $unit_total = $this->model->getSqlData("SELECT sum(unit_total) as total FROM cart WHERE session_id='".$this->session->userdata('session_id')."'");
    $cart_total_amount = $unit_total[0]['total'];
?>
<style type="text/css">
    .icon {
    display: inline-block;
    background-image: url(../images/sprite.png);
    width: 30px;
    height: 35px;
    background-repeat: no-repeat;
}
.main-content {
    margin-top: 17em;
}

@media only screen and (max-width: 767px) {
        #header .logo {
            float: left;
            margin-top: -0em;
            position: relative;
            z-index: 1;
        }
        .clearfix {
            margin-bottom: 46px;
        }
        .cart_itemspage{
            margin-top: 13em;
        }
        .cartbody {
            border: 1px solid #ddd;
            padding: 10px;
            height: auto !important;
            margin-top: 10px;
        }
}
</style>
    <div class="main-content">
        <div class="container mb-3 cart_itemspage">
            <div class="row">
                <?php if(isset($item_in_cart) && !empty($item_in_cart)){  ?>
                    <div class="col-md-8">
                        <?php foreach ($item_in_cart as $key => $value) {
                    $product_data=$this->model->getData('product',array('product_id'=>$value['product_id'])); 
                    $unit_data = $this->model->getData('product_unit',array('unit_id'=>$product_data[0]['unit_id']));?>
                            <div class="row cartbody" id="<?php echo $value['cart_id']; ?>">
                                <div class="col-md-2 col-xs-12">
                                    <div class="cart1abc">
                                        <?php if(!empty($product_data[0]['image_name'])){?>
                                            <img class="img-responsive" src="<?php echo base_url();?>products/<?php echo $product_data[0]['image_name']; ?>" style="width: 100%;object-fit:cover;height:100%;">
                                            <?php }else{?>
                                                <img class="img-responsive" src="<?php echo base_url();?>assets/images/no-image.png" style="width: 100%;object-fit:cover;height:100%;">
                                                <?php }?>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <h6 style="color:#005599;font-size: 16px;"><?php echo $product_data[0]['product_name']; ?></h6>
                                    <p>Flavour: <?php echo $value['flavour']; ?></p>
                                </div>
                                <div class="col-md-2 col-xs-12">
                                    <h6 style="color:#005599;font-size: 14px;text-align: right;">Rs. <?php echo $value['price'];?></h6>

                                </div>

                                <div class="col-md-3 col-xs-12" style="padding-left: 0px;padding-right: 0px;">
                                    <div class="col-md-12 input-group quant-input">
                                        <span class="input-group-btn">
                                   <button type="button" class="btn btn-danger btn-number arrow minus"  data-type="minus" data-field="quant[2]" style="height:34px;">
                                      <span class="glyphicon glyphicon-minus "></span>
                                        </button>
                                        </span>
                                        <input type="text" name="quant[1]" style="text-align: center;" class="form-control input-number purchased_qty" value="<?php echo $value['qty'];?>" style="height:34px;">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-success btn-number arrow plus" data-type="plus" style="height:34px;">
                                          <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-1 col-xs-12">
                                    <p style="text-align: justify;">Total</p>
                                    <h6 style="color:#005599;font-size: 14px;text-align: justify;">Rs. <span class="totalunitprice"><?php echo $value['unit_total'];?></span></h6>

                                </div>

                                <div class="col-md-1">
                                    
                                    <a onclick="return delete_item_from_cart(this,'<?php echo $value['cart_id'];?>');" href="javascript:void(0);" title="cancel" ><i class="fa fa-trash-o" style="font-size: 28px;"></i></a>

                                </div>

                            </div>
                            <?php }?>

                    </div>
                    <div class="col-md-4">
                        <!-- <div class="coupon-box m-b-10 b1">
                            <h3>Apply Coupon</h3>
                            <div class="desc">
                                <div class="input-group">
                                    <input type="text" name="coupon_code" class="input-text form-control" id="coupon_code" value="" placeholder="Coupon code" style="width:70%;">
                                    <input type="submit" name="apply_coupon" class="btn btn-blue" value="Apply" style="background: #005599;color: #fff;font-size: 13.4px;">
                                </div>
                            </div>
                        </div> -->
                        <div class="cart-collaterals">
                            <div class="cart_totals ">
                                <h2 class="entry-title t2">Order Summary</h2>
                                <div class="b1">
                                    <div class="row">
                                        <div class="col-md-8">Subtotal</div>
                                        <div class="col-md-4 text-right"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span><span class="GrandTotalValue"><?php echo upto2Decimal($cart_total_amount); ?></span></span>
                                        </div>
                                    </div>
                                    <div class="row bbd1 row1 btd1">
                                        <div class="col-md-8">Amount Payable</div>
                                        <div class="col-md-4 text-right"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span><span class="GrandTotalValue"><?php echo upto2Decimal($cart_total_amount); ?></span></span>
                                        </div>
                                    </div>
                                    <div class="row note">
                                        <div class="col-md-12">(Shipping Charges may be applied at Checkout Page)</div>
                                    </div>
                                </div>

                                <table cellspacing="0" class="shop_table shop_table_responsive" style="display:none">

                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td data-title="Subtotal"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>19,992</span>
                                            </td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td data-title="Total"><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>19,992</span></strong> </td>
                                        </tr>

                                    </tbody>
                                </table>

                                <div class="wc-proceed-to-checkout">
                                    <a href="<?php echo base_url()?>account/proceed_to_checkout" class="btn btn-block btn-blue checkout-button button alt wc-forward" style="background: #005599;color: #fff;font-size: 16px;">
                                        Proceed to checkout
                                    </a> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }else{ ?>
                        <div class="col-md-12 alert alert-warning" style="text-align:center">
                            <h4>Oopss. Your bag is empty. Please add some product into your bag.</h4>
                            <a href="<?php echo base_url();?>" class="mt-4 btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
                        </div>
                        <?php } ?>

            </div>
        </div>
    </div>

    <?php include_once(APPPATH.'views/includes/footer.php'); ?>
        <script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
        <script type="<?php echo base_url();?>assets/text/javascript" src="js/move-top.js"></script>
        <script src="<?php echo base_url();?>assets/js/minicart.min.js"></script>
        <script src="<?php echo base_url();?>assets/peekABar/js/jquery.peekabar.js"></script>
        <!-- <script src="<?php //echo base_url();?>assets/js/front.js"></script> -->
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $(".scroll").click(function(event) {
                    event.preventDefault();
                    $('html,body').animate({
                        scrollTop: $(this.hash).offset().top
                    }, 1000);
                });
            });
        </script>
        <!-- top-header and slider -->
        <!-- here stars scrolling icon -->
        <script type="text/javascript">
            $(document).ready(function() {
                /*
                var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear' 
                };
                */

                $().UItoTop({
                    easingType: 'easeOutQuart'
                });

            });
        </script>
        <!-- //here ends scrolling icon -->
        <script>
            // Mini Cart
            paypal.minicart.render({
                action: '#'
            });

            if (~window.location.search.indexOf('reset=true')) {
                paypal.minicart.reset();
            }
        </script>
        <!-- main slider-banner -->
        <script src="<?php echo base_url();?>assets/js/skdslider.min.js"></script>
        <link href="<?php echo base_url();?>assets/css/skdslider.css" rel="stylesheet">
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('#demo1').skdslider({
                    'delay': 5000,
                    'animationSpeed': 2000,
                    'showNextPrev': true,
                    'showPlayButton': true,
                    'autoSlide': true,
                    'animationType': 'fading'
                });

                jQuery('#responsive').change(function() {
                    $('#responsive_wrapper').width(jQuery(this).val());
                });

            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {

                $('#itemslider').carousel({
                    interval: 3000
                });

                $('.carousel-showmanymoveone .item').each(function() {
                    var itemToClone = $(this);

                    for (var i = 1; i < 6; i++) {
                        itemToClone = itemToClone.next();

                        if (!itemToClone.length) {
                            itemToClone = $(this).siblings(':first');
                        }

                        itemToClone.children(':first-child').clone()
                            .addClass("cloneditem-" + (i))
                            .appendTo($(this));
                    }
                });
            });
        </script>
        <!-- //main slider-banner -->
        </body>

        </html>
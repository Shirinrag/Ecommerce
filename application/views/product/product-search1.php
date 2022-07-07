
<style type="text/css">
.variant-rating-count {
    margin-top: -23px;
    position: absolute;
    z-index: 2;
    margin-left: 2em;
}
.variant-rating-count .review-stars {
    display: inline-block;
    width: 70px;
    height: 14px;
    background-image: url(<?php echo base_url();?>/assets/images/star-empty.svg);
    background-repeat: repeat-x;
    margin-right: 6px;
}
.variant-rating-count .review-count {
    display: inline-block;
    font-size: 12px;
    vertical-align: top;
}
.ab11{
-webkit-transform: rotate(90deg);  /* to support Safari and Android browser */
    -ms-transform: rotate(90deg);      /* to support IE 9 */
    transform: rotate(90deg);
}

.ui-widget.ui-widget-content {
    border: 1px solid #c5c5c5;
}

.ui-slider-horizontal .ui-slider-range {
    background: #08C7B2;
}

.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    border: 0;
    border-radius: 50%;
    background: #DADADA;
    width: 15px;
    height: 15px;
}

.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    border: 0;
    border-radius: 50%;
    background: #DADADA;
    width: 15px;
    height: 15px;
}
.ui-widget.ui-widget-content {
    z-index: 0;
}
.ui-slider-horizontal .ui-slider-range {
    background: #08C7B2;
}
.ui-slider-horizontal .ui-slider-range {
    top: 0;
    height: 100%;
}

.ui-slider .ui-slider-range {
    position: absolute;
    z-index: 1;
    font-size: .7em;
    display: block;
    border: 0;
    background-position: 0 0;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    border: 1px solid #c5dbec;
    background: #dfeffc url(images/ui-bg_glass_85_dfeffc_1x400.png) 50% 50% repeat-x;
    font-weight: bold;
    color: #2e6e9e;
}
.ui-slider-horizontal .ui-slider-handle {
    top: -.3em;
    margin-left: -.6em;
}
.ui-slider .ui-slider-handle {
    position: absolute;
    z-index: 2;
    width: 1.2em;
    height: 1.2em;
    cursor: default;
    -ms-touch-action: none;
    touch-action: none;
}


</style>
<div class="main-content">
    <div id="container">
        <div id="content" role="main">
            <!-- <div class="scp-breadcrumb">
                <ul class="breadcrumb">
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">BOGO OFFER</a></li>

                </ul>
            </div> -->
             <nav class="woocommerce-breadcrumb" itemprop="breadcrumb">
                <div class="container">
                    <?php //echo $breadcrumbs; ?>
            </nav>

            <div id="main-content" class="shop-content position-relative" data-max-page="3">
                <div class="ajsearch-loading d-none">
                    <div class="loading-stat"><i class="icon icon-loading"></i> Loading...</div>
                </div>
                <div class="container">
                    <div class="row">
                        
                        <div class="col-12 order-2 product-view">
                             <?php if(!empty($child_category_data[0]['image_name'])){ ?>
                                <img src="<?php echo base_url();?>uploads/childbanerimg/<?php echo $child_category_data[0]['image_name'];?>" style="width:100%;">
                            <?php } ?>
                            <div class="clearfix"></div>

                              <div class="row">
                                <div class="breadcrumb-inner" style="background: #ddd;padding: 15px;margin-top: 2em;margin-left: 15px;">
                                  <ul class="list-inline list-unstyled">
                                      <li style="color: #015daa;"><b>Searched for:</b> <?php echo $product_name; ?></li>
                                  </ul>
                                </div>
                              </div>
                            <div class="row" style="margin-top: 2em;">

                                <?php foreach ($product_data as $key => $pvalue) { ?>
                                     <div class="col-4">
                                 <div class="products">
                                    <div class="product-short-info product-info">
                                       <div>
                                          <?php $minus = (float)$pvalue['mrp'] - (float)$pvalue['price'];
                                                $divide   = $minus/(float)$pvalue['mrp']*100; ?>
                                          <div class="p-discount" style="background-color: #00bfbf;"><?php echo round($divide);?>%<br></div>
                                          <div class="product-img">
                                             <a href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '-',$pvalue['product_name'])).'-'.$pvalue['product_id'];?>">
                                             <?php if(!empty($pvalue['image_name'])){ ?>
                                                   <img width="370" height="370" src="<?php echo base_url();?>products/<?php echo $pvalue['image_name'];?>" class="attachment-shop_single size-shop_single wp-post-image" alt="<?php echo $pvalue['image_name'];?>">
                                             <?php }else{ ?>
                                                   <img width="370" height="370" class="attachment-shop_single size-shop_single wp-post-image" src="<?php echo base_url();?>assets/images/no-image.png">
                                             <?php } ?>
                                               <!--  <img width="370" height="370" src="http://healthxp.microlan.co.in/products/7599136347-600x600.jpg" class="attachment-shop_single size-shop_single wp-post-image" alt="BPI Sports ISO HD whey isolated"></a> -->
                                          </div>
                                          <div class="product-desc">
                                             <h4 class="text-truncate"><a href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '-',$pvalue['product_name'])).'-'.$pvalue['product_id'];?>"><?php echo $pvalue['product_name'];?>
                                                </a>
                                             </h4>
                                             <br>
                                             <div class="ratings">
                                                <div class="empty-stars"></div>
                                                <div class="full-stars" style="width:80%"></div>
                                             </div>
                                             <br><input type="hidden" class="qty" value="1">
                                             <input type="hidden" class="price" value="<?php echo $pvalue['price'];?>">
                                             <div class="product-price "><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span><?php echo $pvalue['mrp'];?></span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span><span class="search_PSellingP"> <?php echo $pvalue['price'];?></span></span></ins></div>
                                          </div>
                                          <p class="text-center"></p>
                                          <br>
                                          <div class="p-action">
                                             <a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart" style="color:#27313D;"></i>
                                             </a>
                                             <a href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '-',$pvalue['product_name'])).'-'.$pvalue['product_id'];?>" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #76B51B;font-size: 20px;padding-right: 10px;"></i>View Product</a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                                <?php } ?>
                            </div>
                            <!-- <div class="infinity-page-title">Page 2</div> -->
                            <div id="productEndsHere"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

    <br>

    <!-- //n -->
    <!-- footer -->

    <?php include_once(APPPATH.'views/includes/footer.php'); ?>

      
        <script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
        <script type="<?php echo base_url();?>assets/text/javascript" src="js/move-top.js"></script>
        <script src="<?php echo base_url();?>assets/js/minicart.min.js"></script>
        <script src="<?php echo base_url();?>assets/peekABar/js/jquery.peekabar.js"></script>
        <script src="<?php echo base_url();?>assets/js/front.js"></script>



      
       
</body>

</html>
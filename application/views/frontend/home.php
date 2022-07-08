<!DOCTYPE html>
<html lang="en">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <!-- css
         ============================================ -->
      <?php include('common/cssfiles.php');?>
      <style type="text/css">
         body{font-family:'Roboto', sans-serif}
         }
      </style>
   </head>
   <body class="common-home res layout-1">
      <div id="wrapper" class="wrapper-fluid banners-effect-5">
         <!--Header=======================-->
         <?php include('common/header.php');?>
         <!-- Main Container  -->
         <div class="main-container container">
            <div id="content">
               <div class="box-top hidden-lg hidden-md hidden-sm ">
                  <div class="module sohomepage-slider ">
                     <div class="yt-content-slider"  data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="0" data-items_column0="1" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="no" data-pagination="yes" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                        <div class="yt-content-slide">
                           <a href="#"><img src="<?php echo base_url();?>assets_frontend/image/catalog/slideshow/home1/slider-1.jpg" alt="slider1" class="img-responsive"></a>
                        </div>
                        <div class="yt-content-slide">
                           <a href="#"><img src="<?php echo base_url();?>assets_frontend/image/catalog/slideshow/home1/slider-2.jpg" alt="slider2" class="img-responsive"></a>
                        </div>
                        <div class="yt-content-slide">
                           <a href="#"><img src="<?php echo base_url();?>assets_frontend/image/catalog/slideshow/home1/slider-3.jpg" alt="slider3" class="img-responsive"></a>
                        </div>
                     </div>
                     <div class="loadeding"></div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">
                     <div class="slider-container row">
                        <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12">
                           <div class="module sohomepage-slider ">
                              <div class="yt-content-slider"  data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="0" data-items_column0="1" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="no" data-pagination="yes" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                                 <?php foreach ($slider as $slider_key => $slider_row) { ?>
                                    <div class="yt-content-slide">
                                    <a href="#"><img src="<?php echo base_url();?><?=$slider_row['img_url']?>" alt="slider1" id="sliders" class="img-responsive sliders"></a>
                                 </div>
                                    
                                <?php }?>
                                 
                                
                              </div>
                              <div class="loadeding"></div>
                           </div>
                        </div>
                        <!-- <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col3">
                           <div class="modcontent clearfix">
                              <div class="banners banners1">
                                 <div class="b-img">
                                    <a href="#"><img src="<?php echo base_url();?>assets_frontend/image/catalog/banners/banner1.jpg" alt="banner1"></a>
                                 </div>
                                 <div class="b-img2">
                                    <a href="#"><img src="<?php echo base_url();?>assets_frontend/image/catalog/banners/banner2.jpg" alt="banner2"></a>
                                 </div>
                              </div>
                           </div>
                           </div> -->
                     </div>
                     <!-- Deals -->
                     <div class="module deals-layout1" style="margin-top:50px;">
                        <!--  <h3 class="modtitle"><span>Daily Deals</span></h3> -->
                        <div class="modcontent">
                           <div id="so_deal_1" class="so-deal style2">
                              <div class="extraslider-inner products-list yt-content-slider" data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column0="2" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="yes" data-pagination="yes" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                                 <div class="item">
                                    <div class="product-thumb">
                                       <div class="row">
                                          <div class="inner">
                                             <div class="item-left col-lg-6 col-md-5 col-sm-5 col-xs-12">
                                                <div class="image">
                                                   <span class="label-product label-product-sale">
                                                   -22%
                                                   </span>
                                                   <a href="#" target="_self" title="product">
                                                   <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/1.jpg" alt="Yutculpa ullamco" class="img-responsive">
                                                   </a>
                                                   <div class="button-group so-quickview">
                                                      <button class="btn-button addToCart" title="Add to Cart" type="button" onclick="cart.add('69');"><i class="fa fa-shopping-basket"></i>  <span>Add to Cart</span>
                                                      </button>                                                        
                                                      <button class="btn-button wishlist" type="button" title="Add to Wish List" onclick="wishlist.add('69');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                                      </button>
                                                      <button class="btn-button compare" type="button" title="Compare this Product" onclick="compare.add('69');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                                      </button>                                                    
                                                      <!--quickview-->                                                      
                                                      <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                                      <!--end quickview-->
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="item-right col-lg-6 col-md-7 col-sm-7 col-xs-12">
                                                <div class="caption">
                                                   <h4><a href="#" target="_self" title="Yutculpa ullamco">Yutculpa ullamco</a></h4>
                                                   <p class="price">   <span class="price-new">$60.00</span>
                                                      <span class="price-old">$77.00</span>
                                                   </p>
                                                   <p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore..</p>
                                                   <div class="item-available">
                                                      <div class="row">
                                                         <p class="col-xs-6 a1">Available: <b>98</b> 
                                                         </p>
                                                         <p class="col-xs-6 a2">Sold: <b>32</b> 
                                                         </p>
                                                      </div>
                                                      <div class="available"> <span class="color_width" data-title="75%" data-toggle="tooltip" title="75%" style="width: 75%"></span>
                                                      </div>
                                                   </div>
                                                   <!--countdown box-->
                                                   <!--  <div class="item-time-w">
                                                      <div class="time-title"><span>Hurry Up!</span> Offer ends in:</div>
                                                      <div class="item-time">
                                                         <div class="item-timer">
                                                            <div class="defaultCountdown-30"></div>
                                                         </div>
                                                      </div>
                                                      </div> -->
                                                   <!--end countdown box-->
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="item">
                                    <div class="product-thumb ">
                                       <div class="row">
                                          <div class="inner">
                                             <div class="item-left col-lg-6 col-md-5 col-sm-5 col-xs-12">
                                                <div class="image">
                                                   <span class="label-product label-product-sale">
                                                   -10%
                                                   </span>
                                                   <a href="#" target="_self" title="Xancetta bresao">
                                                   <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/2.jpg" alt="Xancetta bresao" class="img-responsive">
                                                   </a>
                                                   <div class="button-group so-quickview">
                                                      <button class="btn-button addToCart" title="Add to Cart" type="button" onclick="cart.add('75');"><i class="fa fa-shopping-basket"></i>  <span>Add to Cart</span>
                                                      </button>
                                                      <button class="btn-button wishlist" type="button" title="Add to Wish List" onclick="wishlist.add('75');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                                      </button>
                                                      <button class="btn-button compare" type="button" title="Compare this Product" onclick="compare.add('75');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                                      </button>
                                                      <!--quickview-->                                                      
                                                      <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                                      <!--end quickview-->
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="item-right col-lg-6 col-md-7 col-sm-7 col-xs-12">
                                                <div class="caption">
                                                   <h4><a href="#" target="_self" title="Xancetta bresao">Xancetta bresao</a></h4>
                                                   <p class="price">   <span class="price-new">$80.00</span>
                                                      <span class="price-old">$89.00</span>
                                                   </p>
                                                   <p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore..</p>
                                                   <div class="item-available">
                                                      <div class="row">
                                                         <p class="col-xs-6 a1">Available: <b>555</b> 
                                                         </p>
                                                         <p class="col-xs-6 a2">Sold: <b>0</b> 
                                                         </p>
                                                      </div>
                                                      <div class="available"> <span class="color_width" data-title="0%" data-toggle="tooltip" title="75%" style="width: 0%"></span>
                                                      </div>
                                                   </div>
                                                   <!--countdown box-->
                                                   <!-- <div class="item-time-w">
                                                      <div class="time-title"><span>Hurry Up!</span> Offer ends in:</div>
                                                      <div class="item-time">
                                                         <div class="item-timer">
                                                            <div class="defaultCountdown-30"></div>
                                                         </div>
                                                      </div>
                                                      </div> -->
                                                   <!--end countdown box-->
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="item">
                                    <div class="product-thumb transition ">
                                       <div class="row">
                                          <div class="inner">
                                             <div class="item-left col-lg-6 col-md-5 col-sm-5 col-xs-12">
                                                <div class="image">
                                                   <span class="label-product label-product-sale">-17%</span>
                                                   <a href="#" target="_self" title="Wamboudin ribeye">
                                                   <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/3.jpg" alt="Wamboudin ribeye" class="img-responsive">
                                                   </a>
                                                   <div class="button-group so-quickview">
                                                      <button class="btn-button addToCart" title="Add to Cart" type="button" onclick="cart.add('79');"><i class="fa fa-shopping-basket"></i>  <span>Add to Cart</span>
                                                      </button>
                                                      <button class="btn-button wishlist" type="button" title="Add to Wish List" onclick="wishlist.add('79');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                                      </button>
                                                      <button class="btn-button compare" type="button" title="Compare this Product" onclick="compare.add('79');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                                      </button>
                                                      <!--quickview-->                                                      
                                                      <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                                      <!--end quickview-->
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="item-right col-lg-6 col-md-7 col-sm-7 col-xs-12">
                                                <div class="caption">
                                                   <h4><a href="#" target="_self" title="Wamboudin ribeye">Wamboudin ribeye</a></h4>
                                                   <p class="price">   <span class="price-new">$70.00</span>
                                                      <span class="price-old">$84.00</span>
                                                   </p>
                                                   <p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore..</p>
                                                   <div class="item-available">
                                                      <div class="row">
                                                         <p class="col-xs-6 a1">Available: <b>100</b> 
                                                         </p>
                                                         <p class="col-xs-6 a2">Sold: <b>60</b> 
                                                         </p>
                                                      </div>
                                                      <div class="available"> <span class="color_width" data-title="63%" data-toggle="tooltip" title="63%" style="width: 63%"></span>
                                                      </div>
                                                   </div>
                                                   <!--countdown box-->
                                                   <!--  <div class="item-time-w">
                                                      <div class="time-title"><span>Hurry Up!</span> Offer ends in:</div>
                                                      <div class="item-time">
                                                         <div class="item-timer">
                                                            <div class="defaultCountdown-30"></div>
                                                         </div>
                                                      </div>
                                                      </div> -->
                                                   <!--end countdown box-->
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="item">
                                    <div class="product-thumb transition ">
                                       <div class="row">
                                          <div class="inner">
                                             <div class="item-left col-lg-6 col-md-5 col-sm-5 col-xs-12">
                                                <div class="image">
                                                   <span class="label-product label-product-sale">-16%</span>
                                                   <a href="#" target="_self" title="Proident leerkas">
                                                   <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/4.jpg" alt="Proident leerkas" class="img-responsive">
                                                   </a>
                                                   <div class="button-group so-quickview">
                                                      <button class="btn-button addToCart" title="Add to Cart" type="button" onclick="cart.add('55');"><i class="fa fa-shopping-basket"></i>  <span>Add to Cart</span>
                                                      </button>
                                                      <button class="btn-button wishlist" type="button" title="Add to Wish List" onclick="wishlist.add('55');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                                      </button>
                                                      <button class="btn-button compare" type="button" title="Compare this Product" onclick="compare.add('55');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                                      </button>
                                                      <!--quickview-->                                                      
                                                      <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                                      <!--end quickview-->
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="item-right col-lg-6 col-md-7 col-sm-7 col-xs-12">
                                                <div class="caption">
                                                   <h4><a href="#" target="_self" title="Wamboudin ribeye">Proident leerkas</a></h4>
                                                   <p class="price">   <span class="price-new">$46.00</span>
                                                      <span class="price-old">$55.00</span>
                                                   </p>
                                                   <p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore..</p>
                                                   <div class="item-available">
                                                      <div class="row">
                                                         <p class="col-xs-6 a1">Available: <b>310</b> 
                                                         </p>
                                                         <p class="col-xs-6 a2">Sold: <b>2</b> 
                                                         </p>
                                                      </div>
                                                      <div class="available"> <span class="color_width" data-title="99%" data-toggle="tooltip" title="99%" style="width: 99%"></span>
                                                      </div>
                                                   </div>
                                                   <!--countdown box-->
                                                   <!--  <div class="item-time-w">
                                                      <div class="time-title"><span>Hurry Up!</span> Offer ends in:</div>
                                                      <div class="item-time">
                                                         <div class="item-timer">
                                                            <div class="defaultCountdown-30"></div>
                                                         </div>
                                                      </div>
                                                      </div> -->
                                                   <!--end countdown box-->
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- End Deals -->
                     <!-- Listing tabs -->
                     <!-- end Listing tabs -->
                     <!--banners 7-->
                  </div>
                  <div class="slider-brands col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     <div class="related titleLine products-list grid module ">
                        <div class="releate-products yt-content-slider products-list" data-rtl="no" data-loop="yes" data-autoplay="no" data-autoheight="no" data-autowidth="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column0="5" data-items_column1="3" data-items_column2="3" data-items_column3="2" data-items_column4="1" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-hoverpause="yes">
                           <div class="item">
                              <div class="item-inner product-layout transition product-grid">
                                 <div class="product-item-container">
                                    <div class="left-block">
                                       <div class="product-image-container second_img">
                                          <a href="product.html" target="_self" title="Pastrami bacon">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/9.jpg" class="img-1 img-responsive" alt="Pastrami bacon">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/2.jpg" class="img-2 img-responsive" alt="Pastrami bacon">
                                          </a>
                                       </div>
                                       <div class="button-group so-quickview cartinfo--left">
                                          <button type="button" class="addToCart btn-button" title="Add to cart" onclick="cart.add('60 ');">  <i class="fa fa-shopping-basket"></i>
                                          <span>Add to cart </span>   
                                          </button>
                                          <button type="button" class="wishlist btn-button" title="Add to Wish List" onclick="wishlist.add('60');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                          </button>
                                          <button type="button" class="compare btn-button" title="Compare this Product " onclick="compare.add('60');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                          </button>
                                          <!--quickview-->                                                      
                                          <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                          <!--end quickview-->
                                       </div>
                                    </div>
                                    <div class="right-block">
                                       <div class="caption">
                                          <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                          </div>
                                          <h4><a href="product.html" title="Pastrami bacon" target="_self">Pastrami bacon</a></h4>
                                          <div class="price">$42.00</div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="item">
                              <div class="item-inner product-layout transition product-grid">
                                 <div class="product-item-container">
                                    <div class="left-block">
                                       <div class="product-image-container second_img">
                                          <a href="product.html" target="_self" title="Chicken swinesha">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/8.jpg" class="img-1 img-responsive" alt="image">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/3.jpg" class="img-2 img-responsive" alt="image">
                                          </a>
                                       </div>
                                       <div class="box-label"> <span class="label-product label-sale"> -16% </span></div>
                                       <div class="button-group so-quickview cartinfo--left">
                                          <button type="button" class="addToCart btn-button" title="Add to cart" onclick="cart.add('60 ');">  <i class="fa fa-shopping-basket"></i>
                                          <span>Add to cart </span>   
                                          </button>
                                          <button type="button" class="wishlist btn-button" title="Add to Wish List" onclick="wishlist.add('60');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                          </button>
                                          <button type="button" class="compare btn-button" title="Compare this Product " onclick="compare.add('60');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                          </button>
                                          <!--quickview-->                                                      
                                          <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                          <!--end quickview-->
                                       </div>
                                    </div>
                                    <div class="right-block">
                                       <div class="caption">
                                          <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                          </div>
                                          <div class="price"> <span class="price-new">$46.00</span>
                                             <span class="price-old">$55.00</span>
                                          </div>
                                          <h4><a href="product.html" title="Chicken swinesha" target="_self">Chicken swinesha</a></h4>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="item">
                              <div class="item-inner product-layout transition product-grid">
                                 <div class="product-item-container">
                                    <div class="left-block">
                                       <div class="product-image-container second_img">
                                          <a href="product.html" target="_self" title="Kielbasa hamburg">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/5.jpg" class="img-1 img-responsive" alt="Pastrami bacon">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/6.jpg" class="img-2 img-responsive" alt="Pastrami bacon">
                                          </a>
                                       </div>
                                       <div class="box-label"> <span class="label-product label-new"> New </span></div>
                                       <div class="button-group so-quickview cartinfo--left">
                                          <button type="button" class="addToCart btn-button" title="Add to cart" onclick="cart.add('60 ');">  <i class="fa fa-shopping-basket"></i>
                                          <span>Add to cart </span>   
                                          </button>
                                          <button type="button" class="wishlist btn-button" title="Add to Wish List" onclick="wishlist.add('60');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                          </button>
                                          <button type="button" class="compare btn-button" title="Compare this Product " onclick="compare.add('60');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                          </button>
                                          <!--quickview-->                                                      
                                          <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                          <!--end quickview-->
                                       </div>
                                    </div>
                                    <div class="right-block">
                                       <div class="caption">
                                          <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                          </div>
                                          <h4><a href="product.html" title="Kielbasa hamburg" target="_self">Kielbasa hamburg</a></h4>
                                          <div class="price">$55.00</div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="item">
                              <div class="item-inner product-layout transition product-grid">
                                 <div class="product-item-container">
                                    <div class="left-block">
                                       <div class="product-image-container second_img">
                                          <a href="product.html" target="_self" title="Sausage cowbee">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/7.jpg" class="img-1 img-responsive" alt="image">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/4.jpg" class="img-2 img-responsive" alt="image">
                                          </a>
                                       </div>
                                       <div class="button-group so-quickview cartinfo--left">
                                          <button type="button" class="addToCart btn-button" title="Add to cart" onclick="cart.add('60 ');">  <i class="fa fa-shopping-basket"></i>
                                          <span>Add to cart </span>   
                                          </button>
                                          <button type="button" class="wishlist btn-button" title="Add to Wish List" onclick="wishlist.add('60');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                          </button>
                                          <button type="button" class="compare btn-button" title="Compare this Product " onclick="compare.add('60');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                          </button>
                                          <!--quickview-->                                                      
                                          <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                          <!--end quickview-->
                                       </div>
                                    </div>
                                    <div class="right-block">
                                       <div class="caption">
                                          <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                          </div>
                                          <h4><a href="product.html" title="Sausage cowbeea" target="_self">Sausage cowbee</a></h4>
                                          <div class="price">$60.00</div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="item">
                              <div class="item-inner product-layout transition product-grid">
                                 <div class="product-item-container">
                                    <div class="left-block">
                                       <div class="product-image-container second_img">
                                          <a href="product.html" target="_self" title="Kielbasa hamburg">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/2.jpg" class="img-1 img-responsive" alt="Pastrami bacon">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/6.jpg" class="img-2 img-responsive" alt="Pastrami bacon">
                                          </a>
                                       </div>
                                       <div class="button-group so-quickview cartinfo--left">
                                          <button type="button" class="addToCart btn-button" title="Add to cart" onclick="cart.add('60 ');">  <i class="fa fa-shopping-basket"></i>
                                          <span>Add to cart </span>   
                                          </button>
                                          <button type="button" class="wishlist btn-button" title="Add to Wish List" onclick="wishlist.add('60');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                          </button>
                                          <button type="button" class="compare btn-button" title="Compare this Product " onclick="compare.add('60');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                          </button>
                                          <!--quickview-->                                                      
                                          <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                          <!--end quickview-->
                                       </div>
                                    </div>
                                    <div class="right-block">
                                       <div class="caption">
                                          <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                          </div>
                                          <h4><a href="product.html" title="Drumstick tempor" target="_self">Drumstick tempor</a></h4>
                                          <div class="price">$75.00</div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="item">
                              <div class="item-inner product-layout transition product-grid">
                                 <div class="product-item-container">
                                    <div class="left-block">
                                       <div class="product-image-container second_img">
                                          <a href="product.html" target="_self" title="Balltip nullaelit">
                                          <img src="image/catalog/demo/product/320/8.jpg" class="img-1 img-responsive" alt="image">
                                          <img src="image/catalog/demo/product/320/2.jpg" class="img-2 img-responsive" alt="image">
                                          </a>
                                       </div>
                                       <div class="box-label"> <span class="label-product label-new"> New </span></div>
                                       <div class="button-group so-quickview cartinfo--left">
                                          <button type="button" class="addToCart btn-button" title="Add to cart" onclick="cart.add('60 ');">  <i class="fa fa-shopping-basket"></i>
                                          <span>Add to cart </span>   
                                          </button>
                                          <button type="button" class="wishlist btn-button" title="Add to Wish List" onclick="wishlist.add('60');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                          </button>
                                          <button type="button" class="compare btn-button" title="Compare this Product " onclick="compare.add('60');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                          </button>
                                          <!--quickview-->                                                      
                                          <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                          <!--end quickview-->
                                       </div>
                                    </div>
                                    <div class="right-block">
                                       <div class="caption">
                                          <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                          </div>
                                          <h4><a href="product.html" title="Balltip nullaelit" target="_self">Balltip nullaelit</a></h4>
                                          <div class="price">$80.00</div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="item">
                              <div class="item-inner product-layout transition product-grid">
                                 <div class="product-item-container">
                                    <div class="left-block">
                                       <div class="product-image-container second_img">
                                          <a href="product.html" target="_self" title="Lamboudin ribeye">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/3.jpg" class="img-1 img-responsive" alt="image">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/9.jpg" class="img-2 img-responsive" alt="image">
                                          </a>
                                       </div>
                                       <div class="button-group so-quickview cartinfo--left">
                                          <button type="button" class="addToCart btn-button" title="Add to cart" onclick="cart.add('60 ');">  <i class="fa fa-shopping-basket"></i>
                                          <span>Add to cart </span>   
                                          </button>
                                          <button type="button" class="wishlist btn-button" title="Add to Wish List" onclick="wishlist.add('60');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                          </button>
                                          <button type="button" class="compare btn-button" title="Compare this Product " onclick="compare.add('60');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                          </button>
                                          <!--quickview-->                                                      
                                          <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                          <!--end quickview-->
                                       </div>
                                    </div>
                                    <div class="right-block">
                                       <div class="caption">
                                          <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                          </div>
                                          <h4><a href="product.html" title="Lamboudin ribeye" target="_self">Lamboudin ribeye</a></h4>
                                          <div class="price">$63.00</div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="slider-brands col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     <div class="related titleLine products-list grid module ">
                        <div class="releate-products yt-content-slider products-list" data-rtl="no" data-loop="yes" data-autoplay="no" data-autoheight="no" data-autowidth="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column0="5" data-items_column1="3" data-items_column2="3" data-items_column3="2" data-items_column4="1" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-hoverpause="yes">
                           <div class="item">
                              <div class="item-inner product-layout transition product-grid">
                                 <div class="product-item-container">
                                    <div class="left-block">
                                       <div class="product-image-container second_img">
                                          <a href="<?php echo base_url(); ?>Productdetails" target="_self" title="Pastrami bacon">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/9.jpg" class="img-1 img-responsive" alt="Pastrami bacon">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/2.jpg" class="img-2 img-responsive" alt="Pastrami bacon">
                                          </a>
                                       </div>
                                       <div class="button-group so-quickview cartinfo--left">
                                          <button type="button" class="addToCart btn-button" title="Add to cart" onclick="cart.add('60 ');">  <i class="fa fa-shopping-basket"></i>
                                          <span>Add to cart </span>   
                                          </button>
                                          <button type="button" class="wishlist btn-button" title="Add to Wish List" onclick="wishlist.add('60');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                          </button>
                                          <button type="button" class="compare btn-button" title="Compare this Product " onclick="compare.add('60');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                          </button>
                                          <!--quickview-->                                                      
                                          <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                          <!--end quickview-->
                                       </div>
                                    </div>
                                    <div class="right-block">
                                       <div class="caption">
                                          <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                          </div>
                                          <h4><a href="<?php echo base_url(); ?>Productdetails" title="Pastrami bacon" target="_self">Pastrami bacon</a></h4>
                                          <div class="price">$42.00</div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="item">
                              <div class="item-inner product-layout transition product-grid">
                                 <div class="product-item-container">
                                    <div class="left-block">
                                       <div class="product-image-container second_img">
                                          <a href="product.html" target="_self" title="Chicken swinesha">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/8.jpg" class="img-1 img-responsive" alt="image">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/3.jpg" class="img-2 img-responsive" alt="image">
                                          </a>
                                       </div>
                                       <div class="box-label"> <span class="label-product label-sale"> -16% </span></div>
                                       <div class="button-group so-quickview cartinfo--left">
                                          <button type="button" class="addToCart btn-button" title="Add to cart" onclick="cart.add('60 ');">  <i class="fa fa-shopping-basket"></i>
                                          <span>Add to cart </span>   
                                          </button>
                                          <button type="button" class="wishlist btn-button" title="Add to Wish List" onclick="wishlist.add('60');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                          </button>
                                          <button type="button" class="compare btn-button" title="Compare this Product " onclick="compare.add('60');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                          </button>
                                          <!--quickview-->                                                      
                                          <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                          <!--end quickview-->
                                       </div>
                                    </div>
                                    <div class="right-block">
                                       <div class="caption">
                                          <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                          </div>
                                          <div class="price"> <span class="price-new">$46.00</span>
                                             <span class="price-old">$55.00</span>
                                          </div>
                                          <h4><a href="product.html" title="Chicken swinesha" target="_self">Chicken swinesha</a></h4>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="item">
                              <div class="item-inner product-layout transition product-grid">
                                 <div class="product-item-container">
                                    <div class="left-block">
                                       <div class="product-image-container second_img">
                                          <a href="product.html" target="_self" title="Kielbasa hamburg">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/5.jpg" class="img-1 img-responsive" alt="Pastrami bacon">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/6.jpg" class="img-2 img-responsive" alt="Pastrami bacon">
                                          </a>
                                       </div>
                                       <div class="box-label"> <span class="label-product label-new"> New </span></div>
                                       <div class="button-group so-quickview cartinfo--left">
                                          <button type="button" class="addToCart btn-button" title="Add to cart" onclick="cart.add('60 ');">  <i class="fa fa-shopping-basket"></i>
                                          <span>Add to cart </span>   
                                          </button>
                                          <button type="button" class="wishlist btn-button" title="Add to Wish List" onclick="wishlist.add('60');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                          </button>
                                          <button type="button" class="compare btn-button" title="Compare this Product " onclick="compare.add('60');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                          </button>
                                          <!--quickview-->                                                      
                                          <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                          <!--end quickview-->
                                       </div>
                                    </div>
                                    <div class="right-block">
                                       <div class="caption">
                                          <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                          </div>
                                          <h4><a href="product.html" title="Kielbasa hamburg" target="_self">Kielbasa hamburg</a></h4>
                                          <div class="price">$55.00</div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="item">
                              <div class="item-inner product-layout transition product-grid">
                                 <div class="product-item-container">
                                    <div class="left-block">
                                       <div class="product-image-container second_img">
                                          <a href="product.html" target="_self" title="Sausage cowbee">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/7.jpg" class="img-1 img-responsive" alt="image">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/4.jpg" class="img-2 img-responsive" alt="image">
                                          </a>
                                       </div>
                                       <div class="button-group so-quickview cartinfo--left">
                                          <button type="button" class="addToCart btn-button" title="Add to cart" onclick="cart.add('60 ');">  <i class="fa fa-shopping-basket"></i>
                                          <span>Add to cart </span>   
                                          </button>
                                          <button type="button" class="wishlist btn-button" title="Add to Wish List" onclick="wishlist.add('60');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                          </button>
                                          <button type="button" class="compare btn-button" title="Compare this Product " onclick="compare.add('60');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                          </button>
                                          <!--quickview-->                                                      
                                          <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                          <!--end quickview-->
                                       </div>
                                    </div>
                                    <div class="right-block">
                                       <div class="caption">
                                          <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                          </div>
                                          <h4><a href="product.html" title="Sausage cowbeea" target="_self">Sausage cowbee</a></h4>
                                          <div class="price">$60.00</div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="item">
                              <div class="item-inner product-layout transition product-grid">
                                 <div class="product-item-container">
                                    <div class="left-block">
                                       <div class="product-image-container second_img">
                                          <a href="product.html" target="_self" title="Kielbasa hamburg">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/2.jpg" class="img-1 img-responsive" alt="Pastrami bacon">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/6.jpg" class="img-2 img-responsive" alt="Pastrami bacon">
                                          </a>
                                       </div>
                                       <div class="button-group so-quickview cartinfo--left">
                                          <button type="button" class="addToCart btn-button" title="Add to cart" onclick="cart.add('60 ');">  <i class="fa fa-shopping-basket"></i>
                                          <span>Add to cart </span>   
                                          </button>
                                          <button type="button" class="wishlist btn-button" title="Add to Wish List" onclick="wishlist.add('60');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                          </button>
                                          <button type="button" class="compare btn-button" title="Compare this Product " onclick="compare.add('60');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                          </button>
                                          <!--quickview-->                                                      
                                          <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                          <!--end quickview-->
                                       </div>
                                    </div>
                                    <div class="right-block">
                                       <div class="caption">
                                          <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                          </div>
                                          <h4><a href="product.html" title="Drumstick tempor" target="_self">Drumstick tempor</a></h4>
                                          <div class="price">$75.00</div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="item">
                              <div class="item-inner product-layout transition product-grid">
                                 <div class="product-item-container">
                                    <div class="left-block">
                                       <div class="product-image-container second_img">
                                          <a href="product.html" target="_self" title="Balltip nullaelit">
                                          <img src="image/catalog/demo/product/320/8.jpg" class="img-1 img-responsive" alt="image">
                                          <img src="image/catalog/demo/product/320/2.jpg" class="img-2 img-responsive" alt="image">
                                          </a>
                                       </div>
                                       <div class="box-label"> <span class="label-product label-new"> New </span></div>
                                       <div class="button-group so-quickview cartinfo--left">
                                          <button type="button" class="addToCart btn-button" title="Add to cart" onclick="cart.add('60 ');">  <i class="fa fa-shopping-basket"></i>
                                          <span>Add to cart </span>   
                                          </button>
                                          <button type="button" class="wishlist btn-button" title="Add to Wish List" onclick="wishlist.add('60');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                          </button>
                                          <button type="button" class="compare btn-button" title="Compare this Product " onclick="compare.add('60');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                          </button>
                                          <!--quickview-->                                                      
                                          <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                          <!--end quickview-->
                                       </div>
                                    </div>
                                    <div class="right-block">
                                       <div class="caption">
                                          <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                          </div>
                                          <h4><a href="product.html" title="Balltip nullaelit" target="_self">Balltip nullaelit</a></h4>
                                          <div class="price">$80.00</div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="item">
                              <div class="item-inner product-layout transition product-grid">
                                 <div class="product-item-container">
                                    <div class="left-block">
                                       <div class="product-image-container second_img">
                                          <a href="product.html" target="_self" title="Lamboudin ribeye">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/3.jpg" class="img-1 img-responsive" alt="image">
                                          <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/320/9.jpg" class="img-2 img-responsive" alt="image">
                                          </a>
                                       </div>
                                       <div class="button-group so-quickview cartinfo--left">
                                          <button type="button" class="addToCart btn-button" title="Add to cart" onclick="cart.add('60 ');">  <i class="fa fa-shopping-basket"></i>
                                          <span>Add to cart </span>   
                                          </button>
                                          <button type="button" class="wishlist btn-button" title="Add to Wish List" onclick="wishlist.add('60');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                          </button>
                                          <button type="button" class="compare btn-button" title="Compare this Product " onclick="compare.add('60');"><i class="fa fa-refresh"></i><span>Compare this Product</span>
                                          </button>
                                          <!--quickview-->                                                      
                                          <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                        
                                          <!--end quickview-->
                                       </div>
                                    </div>
                                    <div class="right-block">
                                       <div class="caption">
                                          <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                             <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                          </div>
                                          <h4><a href="product.html" title="Lamboudin ribeye" target="_self">Lamboudin ribeye</a></h4>
                                          <div class="price">$63.00</div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="slider-brands col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     <div class="yt-content-slider contentslider" data-autoplay="no" data-delay="4" data-speed="0.6" data-margin="0" data-items_column0="8" data-items_column1="6" data-items_column2="3" data-items_column3="2" data-items_column4="1" data-arrows="yes"
                        data-pagination="no" data-lazyload="yes" data-loop="no">
                        <div class="item">
                           <a href="#">
                           <img src="<?php echo base_url();?>assets_frontend/image/catalog/brands/b1.png" alt="brand">
                           </a>
                        </div>
                        <div class="item">
                           <a href="#">
                           <img src="<?php echo base_url();?>assets_frontend/image/catalog/brands/b2.png" alt="brand">
                           </a>
                        </div>
                        <div class="item">
                           <a href="#">
                           <img src="<?php echo base_url();?>assets_frontend/image/catalog/brands/b3.png" alt="brand">
                           </a>
                        </div>
                        <div class="item">
                           <a href="#">
                           <img src="<?php echo base_url();?>assets_frontend/image/catalog/brands/b4.png" alt="brand">
                           </a>
                        </div>
                        <div class="item">
                           <a href="#">
                           <img src="<?php echo base_url();?>assets_frontend/image/catalog/brands/b5.png" alt="brand">
                           </a>
                        </div>
                        <div class="item">
                           <a href="#">
                           <img src="<?php echo base_url();?>assets_frontend/image/catalog/brands/b6.png" alt="brand">
                           </a>
                        </div>
                        <div class="item">
                           <a href="#">
                           <img src="<?php echo base_url();?>assets_frontend/image/catalog/brands/b4.png" alt="brand">
                           </a>
                        </div>
                        <div class="item">
                           <a href="#">
                           <img src="<?php echo base_url();?>assets_frontend/image/catalog/brands/b5.png" alt="brand">
                           </a>
                        </div>
                        <div class="item">
                           <a href="#">
                           <img src="<?php echo base_url();?>assets_frontend/image/catalog/brands/b6.png" alt="brand">
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- //Main Container -->
         <!-- Footer Container -->
         <?php include('common/footer.php');?>
         <!-- //end Footer Container -->
      </div>
      <!-- Include Libs & Plugins
         ============================================ -->
      <?php include('common/jsfiles.php');?>
   </body>
</html>
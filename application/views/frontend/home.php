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
   <body class="common-home res layout-1">
      <div id="wrapper" class="wrapper-fluid banners-effect-5">
         <!--Header=======================-->
         <?php include('common/header.php');?>
         <!-- Main Container  -->
         <div class="main-container container">
            <div id="content">
               
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-8 col-xs-12">
                     <div class="slider-container row">
                        <div class="col-lg-12 col-md-8 col-sm-8 col-xs-12">
                           <div class="module sohomepage-slider ">
                              <div class="yt-content-slider"  data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="0" data-items_column0="1" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="no" data-pagination="yes" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                                 <?php foreach ($slider as $slider_key => $slider_row) { ?>
                                    <div class="yt-content-slide">
                                    <a href="#"><img src="<?=$slider_row['img_url']?>" alt="slider1" id="sliders" class="img-responsive sliders"></a>
                                 </div>
                                    
                                <?php }?>
                                 
                                
                              </div>
                              <div class="loadeding"></div>
                           </div>
                        </div>
                     </div>
                     <!-- Deals -->
                     
                     <div class="module deals-layout1" style="margin-top:50px;">
                        <!--  <h3 class="modtitle"><span>Daily Deals</span></h3> -->
                       
                        <div class="modcontent">
                      
                           <div id="so_deal_1" class="so-deal style2">
                           
                              <div class="extraslider-inner products-list yt-content-slider" data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column0="2" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="yes" data-pagination="yes" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                              <?php foreach ($product_data as $product_key => $product_row ) { ?>
                              <div class="item">
                                    <div class="product-thumb">
                                       <div class="row">
                                          <div class="inner">
                                             <div class="item-left col-lg-6 col-md-5 col-sm-5 col-xs-12">
                                                <div class="image">
                                                  
                                                   <a href="<?=base_url();?>Frontend/product_details?id=<?php echo base64_encode($product_row['product_id']) ?>" target="_self" title="product">
                                                   <img src="<?php echo $product_row['image_name'];?>" alt="<?php echo $product_row['product_name'];?>" class="img-responsive">
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
                                                   <h4><a href="<?=base_url();?>Frontend/product_details?id=<?php echo base64_encode($product_row['product_id']) ?>" target="_self" title="<?php echo $product_row['product_name'];?>"><?php echo $product_row['product_name'];?></a></h4>
                                                   <p class="price">   
                                                      <span class="price-new"><?php echo '$ '.$product_row['product_price'];?></span>
                                                   </p>
                                                   <p class="desc"><?php echo htmlspecialchars_decode($product_row['description']) ;?></p>
                                                   <div class="item-available">
                                                      
                                                   </div>
                                                   
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
                      
                     </div>
                     
                     <!-- End Deals -->
                     <!-- Listing tabs -->
                     <!-- end Listing tabs -->
                     <!--banners 7-->
                  </div>
                  
                  <!---populars -->
                  <div class="slider-brands col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <h3 class="modtitle"><span>Populars</span></h3>
                     <div class="related titleLine products-list grid module ">                    
                        <div class="releate-products yt-content-slider products-list" data-rtl="no" data-loop="yes" data-autoplay="no" data-autoheight="no" data-autowidth="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column0="5" data-items_column1="3" data-items_column2="3" data-items_column3="2" data-items_column4="1" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-hoverpause="yes">                      
                        <?php  foreach ($popular as $product_key => $product_row ) { ?>  
                        <div class="item">                       
                              <div class="item-inner product-layout transition product-grid">
                              
                                 <div class="product-item-container">
                                    <div class="left-block">
                                       <div class="product-image-container second_img">  
                                          <a href="<?=base_url();?>Frontend/product_details?id=<?php echo base64_encode($product_row['product_id']) ?>" target="_self" title="Pastrami bacon">
                                          <img src="<?php echo $product_row['image_name']?>" class="img-1 img-responsive" alt="<?php echo $product_row['image_name']?>">
                                          <img src="<?php echo $product_row['image_name']?>" class="img-2 img-responsive" alt="<?php echo $product_row['image_name']?>">
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
                                          <h4><a href="product.html" title="Pastrami bacon" target="_self"><?php echo $product_row['product_name']; ?></a></h4>
                                          <div class="price"><?php echo $product_row['product_price']; ?></div>
                                       </div>
                                    </div>
                                 </div>
                                
                              </div>
                           </div>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
                 
                  <!---Featured -->
                  <div class="slider-brands col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <h3 class="modtitle"><span>Featured</span></h3>
                     <div class="related titleLine products-list grid module ">                    
                        <div class="releate-products yt-content-slider products-list" data-rtl="no" data-loop="yes" data-autoplay="no" data-autoheight="no" data-autowidth="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column0="5" data-items_column1="3" data-items_column2="3" data-items_column3="2" data-items_column4="1" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-hoverpause="yes">                      
                        <?php  foreach ($featured as $product_key => $product_row ) { ?>  
                        <div class="item">                       
                              <div class="item-inner product-layout transition product-grid">
                              
                                 <div class="product-item-container">
                                    <div class="left-block">
                                       <div class="product-image-container second_img">  
                                          <a href="<?=base_url();?>Frontend/product_details?id=<?php echo base64_encode($product_row['product_id']) ?>" target="_self" title="Pastrami bacon">
                                          <img src="<?php echo $product_row['image_name']?>" class="img-1 img-responsive" alt="<?php echo $product_row['image_name']?>">
                                          <img src="<?php echo $product_row['image_name']?>" class="img-2 img-responsive" alt="<?php echo $product_row['image_name']?>">
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
                                          <h4><a href="product.html" title="Pastrami bacon" target="_self"><?php echo $product_row['product_name']; ?></a></h4>
                                          <div class="price"><?php echo $product_row['product_price']; ?></div>
                                       </div>
                                    </div>
                                 </div>
                                
                              </div>
                           </div>
                           <?php } ?>
                        </div>
                     </div>
                  </div>

                   <!---Best Selligs -->
                  <div class="slider-brands col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <h3 class="modtitle"><span>Best Sellings</span></h3>
                     <div class="related titleLine products-list grid module ">                    
                        <div class="releate-products yt-content-slider products-list" data-rtl="no" data-loop="yes" data-autoplay="no" data-autoheight="no" data-autowidth="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column0="5" data-items_column1="3" data-items_column2="3" data-items_column3="2" data-items_column4="1" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-hoverpause="yes">                      
                        <?php  foreach ($best_selling as $best_selling_key => $best_selling_row ) { ?>  
                        <div class="item">                       
                              <div class="item-inner product-layout transition product-grid">
                              
                                 <div class="product-item-container">
                                    <div class="left-block">
                                       <div class="product-image-container second_img">  
                                          <a href="<?=base_url();?>Frontend/product_details?id=<?php echo base64_encode($best_selling_row['product_id']) ?>" target="_self" title="Pastrami bacon">
                                          <img src="<?php echo $best_selling_row['image_name']?>" class="img-1 img-responsive" alt="<?php echo $best_selling_row['image_name']?>">
                                          <img src="<?php echo $best_selling_row['image_name']?>" class="img-2 img-responsive" alt="<?php echo $best_selling_row['image_name']?>">
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
                                          <h4><a href="<?=base_url();?>Frontend/product_details?id=<?php echo base64_encode($best_selling_row['product_id']) ?>" title="Pastrami bacon" target="_self"><?php echo $best_selling_row['product_name']; ?></a></h4>
                                          <div class="price"><?php echo $best_selling_row['product_price']; ?></div>
                                       </div>
                                    </div>
                                 </div>
                                
                              </div>
                           </div>
                           <?php } ?>
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

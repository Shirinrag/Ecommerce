<!DOCTYPE html>
<html lang="en">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <!-- /Added by HTTrack -->
   <head>
      <!-- css
         ============================================ -->
      <?php include('common/cssfiles.php');?>
      <style type="text/css">
         body{font-family:'Roboto', sans-serif}
      </style>
   </head>
   <body class="res layout-subpage layout-1 banners-effect-5">
      <div id="wrapper" class="wrapper-fluid">
         <!-- Header Container  -->
         <?php include('common/header.php');?>
         <!-- //Header Container  -->
         <!-- Main Container  -->
         <div class="main-container container">
            <ul class="breadcrumb">
               <li><a href="#"><i class="fa fa-home"></i></a></li>
               <li><a href="#"><?= $product_details['category_name'] ?></a></li>
               <li><a href="#"><?= $product_details['sub_category_name'] ?></a></li>
            </ul>
            <div class="row">
               <!--Left Part Start -->
               <aside class="col-sm-4 col-md-3 content-aside" id="column-left">
                  <div class="module category-style">
                     <h3 class="modtitle">Categories</h3>
                     <div class="modcontent">
                        <div class="box-category">
                           
                              
            
                           <ul id="cat_accordion" class="list-group">
                           <?php foreach($cat_data as $key => $value){ 
               
                              ?>
                              <li class="hadchild">
                                 <a href="<?php echo base_url().'Frontend/category?catid='.base64_encode($value['category_id']); ?>" class="cutom-parent"><?php echo $value['category_name']; ?></a>   <?php  if(!empty($value['sub_category_name'][0])){?><span class="button-view  fa fa-plus-square-o"></span><?php } ?>
                                 <ul style="display: none;">
                                 <?php foreach($value['sub_category_name'] as $key1 =>$value1){ ?>
                                    
                                    <li style="font-size:12px;"><a href="<?php echo base_url().'Frontend/sub_category?subcatid='.base64_encode($value1['sub_category_id']); ?>"><?php echo $value1; ?></a></li>
  
                                 <?php } ?>
                                                                   
                                 </ul>
                                 
                              </li>
                              
                              <?php } ?>
                           </ul>
                          
                        </div>
                     </div>
                  </div>
               </aside>
               <!--Left Part End -->
               <!--Middle Part Start-->
               <div id="content" class="col-md-9 col-sm-8">
                  <div class="product-view row">
                     <div class="left-content-product">
                        <div class="content-product-left class-honizol col-md-5 col-sm-12 col-xs-12">

                           <div class="large-image  ">
                              <img itemprop="image" class="product-image-zoom" src="<?= $product_details['image_name'] ?>" data-zoom-image="<?= $product_details['image_name'] ?>" title="<?= $product_details['product_name'] ?>" alt="<?= $product_details['product_name'] ?>">
                           </div>
                           <a class="thumb-video pull-left" href="<?=$product_details['video_url']?>"><i class="fa fa-youtube-play"></i></a>
                           <div id="thumb-slider" class="yt-content-slider full_slider owl-drag" data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column0="4" data-items_column1="3" data-items_column2="4"  data-items_column3="1" data-items_column4="1" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                            <?php 
                                $img_url = explode(",",$product_details['img_url']);
                                foreach ($img_url as $img_url_key => $img_url_row) { ?>
                                   
                               
                              <a data-index="0" class="img thumbnail " data-image="<?=$img_url_row?>" title="<?= $product_details['product_name'] ?>">
                              <img src="<?=$img_url_row?>" title="<?= $product_details['product_name'] ?>" alt="<?= $product_details['product_name'] ?>">
                              </a>
                              <?php }
                                 ?>
                             
                           </div>
                        </div>
                        <div class="content-product-right col-md-7 col-sm-12 col-xs-12">
                           <div class="title-product">
                           <input type="hidden" value="<?=$product_details['product_id']?>" id="<?=$product_details['product_id']?>">
                              <h1><?= $product_details['product_name'] ?></h1>
                           </div>
                           <!-- Review ---->
                           <div class="box-review form-group">
                             <!--  <div class="ratings">
                                 <div class="rating-box">
                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                 </div>
                              </div> -->
                             <!--  <a class="reviews_button" href="#" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">0 reviews</a>   |  -->
                              <a class="write_review_button" href="#" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">Write a review</a>
                           </div>
                           <div class="product-label form-group">
                              <div class="product_page_price price" itemprop="offerDetails" itemscope="" itemtype="http://data-vocabulary.org/Offer">
                                 <span class="price-new" itemprop="price">$ <?=$product_details['product_offer_price']?></span>
                                 <span class="price-old">$ <?=$product_details['product_price']?></span>
                              </div>
                              <!-- <div class="stock"><span>Availability:</span> <span class="status-stock">In Stock</span></div> -->
                           </div>
                          
                           <div id="product">
                              
                              <div class="form-group box-info-product">
                                
                                 <!-- <div class="option quantity">
                                    <div class="input-group quantity-control" unselectable="on" style="-webkit-user-select: none;">
                                       <label>Qty</label>
                                       <input class="form-control" type="text" name="quantity"
                                          value="1">
                                       <input type="hidden" name="product_id" value="50">
                                       <span class="input-group-addon product_quantity_down">−</span>
                                       <span class="input-group-addon product_quantity_up">+</span>
                                    </div>
                                 </div> -->
                                 <div class="cart">
                                    <input type="button" id="<?=$product_details['product_id'] ?>" data-toggle="tooltip" title="" value="Add to Cart" data-loading-text="Loading..."  class="btn btn-mega btn-lg addtocart" data-original-title="Add to Cart">
                                 </div>
                                 <div class="add-to-links wish_comp">
                                    <ul class="blank list-inline">
                                       <li class="wishlist">
                                          <a class="icon add_wishlist" data-toggle="tooltip" title="" id="<?=$product_details['product_id']?>"
                                              data-original-title="Add to Wish List"><i class="fa fa-heart"></i>
                                          </a>
                                       </li>
                                      <!--  <li class="compare">
                                          <a class="icon" data-toggle="tooltip" title=""
                                             onclick="compare.add('50');" data-original-title="Compare this Product"><i class="fa fa-exchange"></i>
                                          </a>
                                       </li> -->
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <!-- end box info product -->
                        </div>
                     </div>
                  </div>
                  <!-- Product Tabs -->
                  <div class="producttab ">
                     <div class="tabsslider  vertical-tabs col-xs-12">
                        <ul class="nav nav-tabs col-lg-2 col-sm-3">
                           <li class="active"><a data-toggle="tab" href="#tab-1">Description</a></li>
                           <li class="item_nonactive"><a data-toggle="tab" href="#tab-review">Reviews (1)</a></li>
                           <!-- <li class="item_nonactive"><a data-toggle="tab" href="#tab-4">Tags</a></li>
                           <li class="item_nonactive"><a data-toggle="tab" href="#tab-5">Custom Tab</a></li> -->
                        </ul>
                        <div class="tab-content col-lg-10 col-sm-9 col-xs-12">
                           <div id="tab-1" class="tab-pane fade active in">
                                <?=$product_details['description']?>
                           </div>
                           <div id="tab-review" class="tab-pane fade">
                              <form>
                                 <div id="review">
                                    <table class="table table-striped table-bordered">
                                       <tbody>
                                          <tr>
                                             <td style="width: 50%;"><strong>Super Administrator</strong></td>
                                             <td class="text-right">29/07/2015</td>
                                          </tr>
                                          <tr>
                                             <td colspan="2">
                                                <p>Best this product opencart</p>
                                                <div class="ratings">
                                                   <div class="rating-box">
                                                      <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                      <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                      <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                      <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <div class="text-right"></div>
                                 </div>
                                 <h2 id="review-title">Write a review</h2>
                                 <div class="contacts-form">
                                    <div class="form-group"> <span class="icon icon-user"></span>
                                       <input type="text" name="name" class="form-control" value="Your Name" onblur="if (this.value == '') {this.value = 'Your Name';}" onfocus="if(this.value == 'Your Name') {this.value = '';}"> 
                                    </div>
                                    <div class="form-group"> <span class="icon icon-bubbles-2"></span>
                                       <textarea class="form-control" name="text" onblur="if (this.value == '') {this.value = 'Your Review';}" onfocus="if(this.value == 'Your Review') {this.value = '';}">Your Review</textarea>
                                    </div>
                                    <span style="font-size: 11px;"><span class="text-danger">Note:</span>                       HTML is not translated!</span>
                                    <div class="form-group">
                                       <b>Rating</b> <span>Bad</span>&nbsp;
                                       <input type="radio" name="rating" value="1"> &nbsp;
                                       <input type="radio" name="rating"
                                          value="2"> &nbsp;
                                       <input type="radio" name="rating"
                                          value="3"> &nbsp;
                                       <input type="radio" name="rating"
                                          value="4"> &nbsp;
                                       <input type="radio" name="rating"
                                          value="5"> &nbsp;<span>Good</span>
                                    </div>
                                    <div class="buttons clearfix"><a id="button-review" class="btn buttonGray">Continue</a></div>
                                 </div>
                              </form>
                           </div>
                           <div id="tab-4" class="tab-pane fade">
                              <a href="#">Monitor</a>,
                              <a href="#">Apple</a>             
                           </div>
                           <!-- <div id="tab-5" class="tab-pane fade">
                              <h3 class="custom-color">Take a trivial example which of us ever undertakes</h3>
                              <p>Lorem ipsum dolor sit amet, consetetur
                                 sadipscing elitr, sed diam nonumy eirmod
                                 tempor invidunt ut labore et dolore
                                 magna aliquyam erat, sed diam voluptua.
                                 At vero eos et accusam et justo duo
                                 dolores et ea rebum. Stet clita kasd
                                 gubergren, no sea takimata sanctus est
                                 Lorem ipsum dolor sit amet. Lorem ipsum
                                 dolor sit amet, consetetur sadipscing
                                 elitr, sed diam nonumy eirmod tempor
                                 invidunt ut labore et dolore magna aliquyam
                                 erat, sed diam voluptua. 
                              </p>
                              <p>At vero eos et accusam et justo duo dolores
                                 et ea rebum. Stet clita kasd gubergren,
                                 no sea takimata sanctus est Lorem ipsum
                                 dolor sit amet. Lorem ipsum dolor sit
                                 amet, consetetur sadipscing elitr.
                              </p>
                              <ul class="marker-simple-list two-columns">
                                 <li>Nam liberempore</li>
                                 <li>Cumsoluta nobisest</li>
                                 <li>Eligendptio cumque</li>
                                 <li>Nam liberempore</li>
                                 <li>Cumsoluta nobisest</li>
                                 <li>Eligendptio cumque</li>
                              </ul>
                              <p>Sed diam nonumy eirmod tempor invidunt
                                 ut labore et dolore magna aliquyam erat,
                                 sed diam voluptua. At vero eos et accusam
                                 et justo duo dolores et ea rebum. Stet
                                 clita kasd gubergren, no sea takimata
                                 sanctus est Lorem ipsum dolor sit amet.
                              </p>
                           </div> -->
                        </div>
                     </div>
                  </div>
                  <!-- //Product Tabs -->
                  <!-- Related Products -->
                  <div class="related titleLine products-list grid module ">
                     <h3 class="modtitle">Related Products  </h3>
                     <div class="releate-products yt-content-slider products-list" data-rtl="no" data-loop="yes" data-autoplay="no" data-autoheight="no" data-autowidth="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column0="5" data-items_column1="3" data-items_column2="3" data-items_column3="2" data-items_column4="1" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-hoverpause="yes">
                        <?php 
                            foreach ($related_product_details as $related_product_details_key => $related_product_details_row) { ?>
                                
                         
                        <div class="item">
                           <div class="item-inner product-layout transition product-grid">
                              <div class="product-item-container">
                                 <div class="left-block">
                                    <div class="product-image-container second_img">
                                       <input type="hidden" name="product_id" id="product_id" value="<?php echo base64_decode($_GET['id']);?>">
                                       <a href="<?=base_url();?>Frontend/product_details?id=<?php echo base64_encode($related_product_details_row['product_id']) ?>" target="_self" title="Pastrami bacon">
                                       <img src="<?=$related_product_details_row['image_name']?>" class="img-1 img-responsive" alt="<?=$related_product_details_row['product_name']?>">
                                      
                                       </a>
                                    </div>
                                   <!--  <div class="button-group so-quickview cartinfo--left">
                                      
                                       <button type="button" class="wishlist btn-button" title="Add to Wish List" onclick="wishlist.add('60');"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                       </button>
                                      
                                      
                                    </div> -->
                                 </div>
                                 <div class="right-block">
                                    <div class="caption">
                                      <!--  <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                          <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                          <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                          <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                          <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                       </div> -->
                                       <h4><a href="product.html" title="Pastrami bacon" target="_self"><?=$related_product_details_row['product_name']?></a></h4>
                                       <div class="price">$<?=$related_product_details_row['product_offer_price']?></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                          <?php }
                        ?>
                       
                     </div>
                  </div>
                  <!-- end Related  Products-->
               </div>
            </div>
         </div>
         <!--Middle Part End-->
      </div>
      <!-- //Main Container -->
      <!-- Footer Container -->
      <?php include('common/footer.php');?>
      <!-- //end Footer Container -->
      </div>
      <!-- Include Libs & Plugins
         ============================================ -->
      <?php include('common/jsfiles.php');?>
      <script src="<?= base_url();?>assets_frontend/custom_js/wishlist.js"></script>
      <script src="<?= base_url();?>assets_frontend/custom_js/cart.js"></script>
   </body>
</html>
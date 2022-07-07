<style type="text/css">
   .carousel-control.right {
    right: -25px !important;
    left: auto;
    background-image: -webkit-linear-gradient(left,rgba(0,0,0,.0001) 0,rgba(0,0,0,0) 100%) !important;
    background-image: -o-linear-gradient(left,rgba(0,0,0,.0001) 0,rgba(0,0,0,.5) 100%) !important;
    background-image: -webkit-gradient(linear,left top,right top,from(rgba(0,0,0,.0001)),to(rgba(0,0,0,0)));
    background-image: linear-gradient(to right,rgba(0,0,0,.0001) 0,rgba(0,0,0,0) 100%) !important;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000', endColorstr='#80000000', GradientType=1);
    background-repeat: repeat-x;
}
.carousel-inner>.item>a>img, .carousel-inner>.item>img {
    line-height: 1;
    width: 100%;
}
.logo11{
  margin-top: 0px;
}
body{
  overflow-x: hidden !important;
}
.carousel-control.left {
    background-image: -webkit-linear-gradient(left,rgba(0,0,0,0) 0,rgba(0,0,0,.0001) 100%) !important;
    background-image: -o-linear-gradient(left,rgba(0,0,0,0) 0,rgba(0,0,0,.0001) 100%) !important;
    background-image: -webkit-gradient(linear,left top,right top,from(rgba(0,0,0,0)),to(rgba(0,0,0,.0001))) !important;
    background-image: linear-gradient(to right,rgba(0,0,0,0) 0,rgba(0,0,0,.0001) 100%) !important;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#80000000', endColorstr='#00000000', GradientType=1);
    background-repeat: repeat-x;
} 
.glyphicon-chevron-right:before {
    content: "\e080";
    margin-top: 5px;
    margin-left: -10px;
    position: absolute;
    font-size: 20px;
}
.glyphicon-chevron-left:before {
    content: "\e079";
    margin-top: 5px;
    margin-left: -10px;
    position: absolute;
    font-size: 20px;
} 
.carousel-control .glyphicon-chevron-right, .carousel-control .icon-next {
    margin-right: 5px;
    background:#000;
    opacity: 1;
    width: 40px;
    height: 40px;
    border-radius: 50%;
}
.carousel-control {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    width: 0%;
    font-size: 20px;
    color: #fff;
    text-align: center;
    text-shadow: 0 1px 2px rgba(0,0,0,1);
    background-color: rgba(0,0,0,0);
    filter: alpha(opacity=50);
    opacity: 1;
}
.carousel-control .glyphicon-chevron-left, .carousel-control .icon-prev {
    margin-left: 5px;
    background:#000;
    opacity: 1;
    width: 40px;
    height: 40px;
    border-radius: 50%;
}
.carousel-control .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right, .carousel-control .icon-next, .carousel-control .icon-prev {
    width: 30px;
    height: 30px;
    margin-top: -75px !important;
    font-size: 22px;
}

.trending-item .product .product-img, .deal-item .product .product-img {
    padding-bottom: 19px;
    padding-top: 19px;
 }
 .cuadro_intro_hover {
    -webkit-box-shadow: -1px 1px 10px 1px rgba(0,0,0,0.3);
    -moz-box-shadow: -1px 1px 10px 1px rgba(0,0,0,0.3);
    box-shadow: -1px 1px 10px 1px rgba(0,0,0,0.3);
    padding: 0px;
    position: relative;
    overflow: hidden;
    height: 343px;
    margin-bottom: 2em;
}
.cuadro_intro_hover .caption-text {
    z-index: 5;
    color: #fff;
    position: absolute;
    height: 50px;
    text-align: left;
    top: 120px;
    width: 100%;
}
.filtercaption {
    background: #000000a8;
    position: absolute;
    margin-top: -5.4em;
    width: 100%;
    padding: 10px;
}
.filtercaption1 {
    background: #000000a8;
    position: absolute;
    margin-top: -5.4em;
    width: 98.9%;
    padding: 10px;
}
.filtercaption2 {
    background: #000000a8;
    position: absolute;
    margin-top: -5.4em;
    width: 98.9%;
    padding: 10px;
}
.filtercaption3 {
    background: #000000a8;
    position: absolute;
    margin-top: -5.4em;
    width: 98.9%;
    padding: 10px;
}

.ratings {
  position: relative;
  vertical-align: middle;
  display: inline-block;
  color: #b1b1b1;
  overflow: hidden;
}

.full-stars{
  position: absolute;
  text-align: left;
  left: 0;
  top: 0;
  white-space: nowrap;
  overflow: hidden;
  color: orange;
}

.empty-stars:before,
.full-stars:before {
  content: "\2605\2605\2605\2605\2605";
  font-size: 14pt;
}

.empty-stars:before {
  -webkit-text-stroke: 0px #848484;
}

.full-stars:before {
  -webkit-text-stroke: 0px orange;
}
.hide-lg{
  display: none;
}
/*.full-stars{
  margin-left: -2.95em;
}*/
.fa-cart-plus{
    /*color: #76B51B;*/
    font-size: 20px;
    padding-right: 10px;
}
.product-short-info .p-action .btn .fa-cart-plus:hover {
    /*background-color: #00BFBF;*/
    color: #fff;
}
/*.item img{
  width: 100%;
  height: 350px !important;
}*/
@media all and (max-width: 1100px) and (min-width: 850px) {
  .hide-lg{
  display: block;
}

.hide-sm{
  display: none;
}
/*.full-stars{
  margin-left: -2.4em;
}*/
.product-short-info .product-img img {
    max-width: 130px;
    max-height: 160px;
}
}
@media only screen and (max-width: 767px) {
        .img-item {
            margin-top: 2em;
            width: 100%;
            height: 220px !important;
        }
        .team_columns_carousel_wrapper {
    padding: 0px !important;
    overflow: hidden;
}
.about-whey p {
    color: #515455;
    line-height: 21px;
    font-size: 13px;
    margin: 0;
    display: block;
    padding-left: 15px !important;
}
.cuadro_intro_hover .blur {
    background-color: rgb(0, 192, 243);
    height: 50px;
    z-index: 5;
    top: -48px;
    position: absolute;
    width: 100%;
}
.cuadro_intro_hover {
    -webkit-box-shadow: -1px 1px 10px 1px rgba(0,0,0,0.3);
    -moz-box-shadow: -1px 1px 10px 1px rgba(0,0,0,0.3);
    box-shadow: -1px 1px 10px 1px rgba(0,0,0,0.3);
    padding: 0px;
    position: relative;
    overflow: hidden;
    height: 163px;
    margin-bottom: 2em;
}
.cuadro_intro_hover .caption-text {
    z-index: 5;
    color: #fff;
    position: absolute;
    height: 50px;
    text-align: left;
    top: -65px;
    width: 100%;
}
.product-short-info .product-img img {
    max-width: 80px !important;
    max-height: 80px !important;
}
        .clearfix{
          margin-bottom: 34px;
        }
        #header .smart-search {
          width: 72% !important;
          /* max-width: 100%; */
          margin-top: 42px;
          position: absolute;
      }
      #header .logo {
    float: left;
    margin-top: -0em;
    position: relative;
    z-index: 1;
}
      #header .search {
        text-align: center;
        position: static;
        margin-left: 30px;
        margin-right: 90px;
    }
    #header .header-bottom {
      border-top: 1px solid #fff;
      margin: 16px 5px 3px 0px;
      text-align: center;
  }
  

.shop_a {
    float: right;
    background-color: #ffffff;
    color: #005598;
    padding: 3px 7px;
    margin: 7px 5px;
    border-radius: 5px;
    font-weight: 600;
    text-transform: uppercase;
}

.btn-primary1 {
    color: #000;
    background-color: #ffffff;
    border-color: #00C0F3;
    width: 90%;
    margin-bottom: 10px;
    border-radius: 0px;
}
#header .logo {
    float: left;
    margin-top: -0.5em !important;
    position: relative;
    z-index: 1;
}
.col-xs-4 {
    width: 33.333333%;
    padding-left: 0px !important;
    padding-right: 3px !important;
}
.supertop{
  padding-right: 5px !important;
  padding-left: 5px!important;
}
.product-short-info .p-action .btn.btn-add2cart-grey {
    font-weight: 600;
    padding-top: 9px;
    font-size: 11px !important;
    display: block;
}
.product-short-info .product-desc h4 {
    font-size: 12px !important;
    margin-bottom: -5px;
}


}

</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<div class="main-content">
  <div class="container-fluid">
   
  <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-top: 2.5em;">
    <!-- Indicators -->
    <!-- <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol> -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <?php foreach($banner_list as $bankey => $banner_lst){?>
      <div class="item <?php if($bankey == 0){echo "active";}?>">

        <a href="<?php echo $banner_lst['img_url'];?>"><img src="<?php echo base_url();?>uploads/botbanner/<?php echo $banner_lst['image_name'];?>" class="img-item" alt="Los Angeles" ></a>
      </div>
    <?php } ?>
      
    
      
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

   <!-- <div id="amazingslider-wrapper-1" style="display:block;position:relative;max-width:100%;margin-top:-5.2em;">
      <div id="amazingslider-1" style="display:block;position:relative;margin:-30px 0px;">
         <ul class="amazingslider-slides" style="display:none;">
            <?php foreach($banner_list as $banner_lst){?>
               <li><a href="<?php echo $banner_lst['img_url'];?>"><img src="<?php echo base_url();?>uploads/botbanner/<?php echo $banner_lst['image_name'];?>" alt=""  /></a>
               </li>
            <?php } ?>
          
         </ul>
         <ul class="amazingslider-thumbnails" style="display:none;">
            <?php foreach($banner_list as $banner_lst){?>
               <li><img src="<?php echo base_url();?>uploads/botbanner/<?php echo $banner_lst['image_name'];?>" alt="11" /></li>
            <?php } ?>
         
         </ul>
         
      </div>
   </div> -->
   <br>
   <br>
   <br>
   <!--Top Deals -->
   <div class="container-fluid hide-sm">
      <div class="row">
         <div class="col-md-12">
            <div class="row">
               <div class="col-md-8 col-xs-12 supertop">
                  <?php if(isset($supder_deal_products) && !empty($supder_deal_products)){ ?>
                  <div class="box_body">
                     <div class="box-body">
                      <div class="row">
                        <div class="col-md-8">
                          <h2 class="text-center" style="color:#fff;margin-top: 5px;margin-bottom: 0px;">Top Deals</h2>
                        </div>
                        <div class="col-md-4">
                          <h2 class="text-center" style="color:#fff;margin-top: 5px;margin-bottom: 0px;"><a href="<?php echo base_url();?>product/listing?listed_in_super_deal=1" style="color: #fff;"><button class="btn btn-primary1">VIEW ALL</button></a></h2>
                        </div>
                      </div>
                        
                        <!-- <a href="<?php //echo base_url();?>product/listing?listed_in_super_deal=1">view all</a> -->
                      </div>

                  </div>
                  <div id="adv_team_4_columns_carousel" class="carousel slide four_shows_one_move team_columns_carousel_wrapper" data-ride="carousel" data-interval="2000" data-pause="hover">
                     <!--========= Wrapper for slides =========-->
                     <div class="carousel-inner" role="listbox">
                        <?php foreach ($supder_deal_products as $pkey => $pvalue) { 
                           $su_product = array();
                           $su_product = array_chunk($supder_deal_products,3,true);?>
                        <?php foreach ($su_product as $sup_key => $sup_value) { ?>
                        <div class="carousel-item <?php if($pkey == 0){?> active <?php }?>">
                           <div class="row">
                              <?php foreach ($sup_value as $prokey => $proval) {
                                  $product_id = $proval['product_id'];
                                  if(!empty($product_id)){
                                    $allrating= $this->model->getData('product_review',array('product_id'=>$product_id,'status'=>'A'));
                                    
                                  }
                                  if(empty($allrating)){
                                    $allrating = array();
                                  }
                                  $ratings_count = count($allrating);
                                  $total_ratings = 0;
                                  foreach ($allrating as $key => $value) {
                                    $total_ratings += $value['rating'];
                                  }

                                  $data['average_rating'] = $total_ratings / $ratings_count;
                                  $ratings = round($total_ratings * 5)/($ratings_count * 5);
                                  $data['percent'] = ($ratings * 100)/5;
                                  $sup_value[$prokey]['average_rating'] = $data['percent'];
                                  $sup_value[$prokey]['count_rating'] = $ratings_count;
                                } ?>
                              <?php foreach ($sup_value as $pkey => $pvalue) { ?>
                                 
                              <div class="col-md-4 col-xs-4 col-sm-4">
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
                                             <div class="ratings" style="display: inline-flex;">
                                                <div class="empty-stars"></div>
                                                <div class="full-stars" style="width:<?php echo $pvalue['average_rating'].'%';?>" ></div>&nbsp;<div class="review-count" style="display: inline-flex;margin-top:3px;">(<?php echo $pvalue['count_rating'].'';?>)</div>
                                             </div>
                                             <br><input type="hidden" class="qty" value="1">
                                             <input type="hidden" class="price" value="<?php echo $pvalue['price'];?>">
                                             <div class="product-price "><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span><?php echo $pvalue['mrp'];?></span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span><span class="search_PSellingP"> <?php echo $pvalue['price'];?></span></span></ins></div>
                                          </div>
                                          <!-- <p class="text-center"></p> -->
                                          <br>
                                          <div class="p-action" >
                                             <!-- <a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart" style="color:#27313D;"></i>
                                             </a> -->
                                             <a href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '-',$pvalue['product_name'])).'-'.$pvalue['product_id'];?>" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus"></i>View Product</a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php }?>
                           </div>
                        </div>
                        <?php } ?>
                        <?php }?>
                     </div>
                     <!--======= Navigation Buttons =========-->
                     <a class="carousel-control-prev" href="#adv_team_4_columns_carousel" data-slide="prev">
                     <i class="fa fa-arrow-left"></i>
                     </a>
                     <a class="carousel-control-next" href="#adv_team_4_columns_carousel" data-slide="next">
                     <i class="fa fa-arrow-right"></i>
                     </a>
                  </div>
                  <?php } ?>
               </div>
               <div class="col-md-4">
                  <div class="box_body">
                     <div class="box-body">
                        <h2 class="text-center" style="color:#fff;margin-top: 5px;margin-bottom: 0px;">Trending Product</h2>
                        <!-- <a href="<?php //echo base_url();?>product/listing?listed_in_trending=1">view all</a> -->
                     </div>

                  </div>
                  <div id="myCarousel2" class="carousel slide" data-ride="carousel2" style="margin-top: 2em;">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                     <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
                     <li data-target="#myCarousel2" data-slide-to="1"></li>
                     <li data-target="#myCarousel2" data-slide-to="2"></li>
                  </ol>

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                    
                    <?php if(isset($trending_products) && !empty($trending_products)){
                      $trend_product = array();
                      $trend_product = array_chunk($trending_products,3,true); ?>  
                      <?php  foreach ($trend_product as $key => $prentval) { ?>
                       <div class="item <?php if($key==0){ echo "active";}?>">
                        <div class="trending-items carousel-item active">
                          <?php foreach ($prentval as $prokey => $proval) {
                                  $product_id = $proval['product_id'];
                                  if(!empty($product_id)){
                                    $allrating= $this->model->getData('product_review',array('product_id'=>$product_id,'status'=>'A'));
                                    
                                  }
                                  if(empty($allrating)){
                                    $allrating = array();
                                  }
                                  $ratings_count = count($allrating);
                                  $total_ratings = 0;
                                  foreach ($allrating as $key => $value) {
                                    $total_ratings += $value['rating'];
                                  }

                                  $data['average_rating'] = $total_ratings / $ratings_count;
                                  $ratings = round($total_ratings * 5)/($ratings_count * 5);
                                  $data['percent'] = ($ratings * 100)/5;
                                  $prentval[$prokey]['average_rating'] = $data['percent'];
                                  $prentval[$prokey]['count_rating'] = $ratings_count;
                                } ?>
                          
                            
                           <?php  foreach ($prentval as $traval) { ?>
                          <div class="trending-item ">
                            
                             <div class="product">
                                <div class="product-img">
                                   <a href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '-',$traval['product_name'])).'-'.$traval['product_id'];?>"><img width="90" height="90" src="<?php echo base_url();?>products/<?php echo $traval['image_name'];?>" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt="Myfitness-Peanut-Butter-Original-Smooth2">
                                   </a>
                                </div>
                                <div class="product-desc">
                                   <h4 class="text-truncate">
                                      <a href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '-',$traval['product_name'])).'-'.$traval['product_id'];?>"><?php echo $traval['product_name'];?></a>
                                   </h4>
                                   <div class="ratings" style="display: inline-flex;">
                                                <div class="empty-stars"></div>
                                                <div class="full-stars" style="width:<?php echo $pvalue['average_rating'].'%';?>"></div>&nbsp;<div class="review-count" style="margin-top: 3px;">(<?php echo $pvalue['count_rating'].'';?>)</div>
                                             </div><br>
                                   <div class="product-price c2">
                                      <span class="del">
                                         <span class="woocommerce-Price-amount amount">
                                            <span class="woocommerce-Price-currencySymbol">Rs.</span><?php echo $traval['mrp'];?></span></span>
                                            <span>
                                               <span class="woocommerce-Price-amount amount">
                                                  <span class="woocommerce-Price-currencySymbol">Rs.</span><?php echo $traval['price'];?></span>
                                               </span>
                                            </div>
                                         </div>
                                      </div>

                                   </div>
                                   <?php } ?>
                                  
                                
                                  
                                            </div>
                                         </div>
                                      <?php } ?>
                                      <?php } ?>
                                       
                                                                        </div>

                                                                        <!-- Left and right controls -->
                                                                        <a class="left carousel-control" href="#myCarousel2" data-slide="prev">
                                                                           <span class="glyphicon glyphicon-chevron-left"></span>
                                                                           <span class="sr-only">Previous</span>
                                                                        </a>
                                                                        <a class="right carousel-control" href="#myCarousel2" data-slide="next">
                                                                           <span class="glyphicon glyphicon-chevron-right"></span>
                                                                           <span class="sr-only">Next</span>
                                                                        </a>
                                                                     </div>

                                                                  </div>
            </div>
         </div>
      </div>
   </div>



   <div class="container-fluid hide-lg">
      <div class="row">
         <div class="col-md-12">
            <div class="row">
               <div class="col-md-8">
                  <?php if(isset($supder_deal_products) && !empty($supder_deal_products)){ ?>
                  <div class="box_body">
                     <div class="box-body">
                        <h2 class="text-center" style="color:#fff;">Top Deals</h2>
                     </div>
                  </div>
                  <div id="adv_team_4_columns_carousel" class="carousel slide four_shows_one_move team_columns_carousel_wrapper" data-ride="carousel" data-interval="2000" data-pause="hover">
                     <!--========= Wrapper for slides =========-->
                     <div class="carousel-inner" role="listbox">
                        <?php foreach ($supder_deal_products as $pkey => $pvalue) { 
                           $su_product = array();
                           $su_product = array_chunk($supder_deal_products,3,true);?>
                        <?php foreach ($su_product as $sup_key => $sup_value) { ?>
                        <div class="carousel-item <?php if($pkey == 0){?> active <?php }?>">
                           <div class="row">
                              <?php foreach ($sup_value as $prokey => $proval) {
                                  $product_id = $proval['product_id'];
                                  if(!empty($product_id)){
                                    $allrating= $this->model->getData('product_review',array('product_id'=>$product_id,'status'=>'A'));
                                    
                                  }
                                  if(empty($allrating)){
                                    $allrating = array();
                                  }
                                  $ratings_count = count($allrating);
                                  $total_ratings = 0;
                                  foreach ($allrating as $key => $value) {
                                    $total_ratings += $value['rating'];
                                  }

                                  $data['average_rating'] = $total_ratings / $ratings_count;
                                  $ratings = round($total_ratings * 5)/($ratings_count * 5);
                                  $data['percent'] = ($ratings * 100)/5;
                                  $sup_value[$prokey]['average_rating'] = $data['percent'];
                                  $sup_value[$prokey]['count_rating'] = $ratings_count;
                                } ?>
                              <?php foreach ($sup_value as $pkey => $pvalue) { ?>
                                 
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
                                             <div class="ratings" style="display: inline-flex;">
                                                <div class="empty-stars"></div>
                                                <div class="full-stars" style="width:<?php echo $pvalue['average_rating'].'%';?>" ></div>&nbsp;<div class="review-count" style="display: inline-flex;">(<?php echo $pvalue['count_rating'].' Reviews';?>)</div>
                                             </div>
                                             <br><input type="hidden" class="qty" value="1">
                                             <input type="hidden" class="price" value="<?php echo $pvalue['price'];?>">
                                             <div class="product-price "><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span><?php echo $pvalue['mrp'];?></span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span><span class="search_PSellingP"> <?php echo $pvalue['price'];?></span></span></ins></div>
                                          </div>
                                          <!-- <p class="text-center"></p> -->
                                          <br>
                                          <div class="p-action" >
                                             <!-- <a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart" style="color:#27313D;"></i>
                                             </a> -->
                                             <a href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '-',$pvalue['product_name'])).'-'.$pvalue['product_id'];?>" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #76B51B;font-size: 20px;padding-right: 10px;"></i>View Product</a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php }?>
                           </div>
                        </div>
                        <?php } ?>
                        <?php }?>
                     </div>
                     <!--======= Navigation Buttons =========-->
                     <a class="carousel-control-prev" href="#adv_team_4_columns_carousel" data-slide="prev">
                     <i class="fa fa-arrow-left"></i>
                     </a>
                     <a class="carousel-control-next" href="#adv_team_4_columns_carousel" data-slide="next">
                     <i class="fa fa-arrow-right"></i>
                     </a>
                  </div>
                  <?php } ?>
               </div>
               <div class="col-md-4">
                  <div class="box_body">
                     <div class="box-body">
                        <h2 class="text-center" style="color:#fff;">Trending Product</h2>
                        
                     </div>

                  </div>
                  <div id="myCarousel2" class="carousel slide" data-ride="carousel2" style="margin-top: 2em;">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                     <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
                     <li data-target="#myCarousel2" data-slide-to="1"></li>
                     <li data-target="#myCarousel2" data-slide-to="2"></li>
                  </ol>

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                    
                    <?php if(isset($trending_products) && !empty($trending_products)){
                      $trend_product = array();
                      $trend_product = array_chunk($trending_products,3,true); ?>  
                      <?php  foreach ($trend_product as $key => $prentval) { ?>
                       <div class="item <?php if($key==0){ echo "active";}?>">
                        <div class="trending-items carousel-item active">
                          <?php foreach ($prentval as $prokey => $proval) {
                                  $product_id = $proval['product_id'];
                                  if(!empty($product_id)){
                                    $allrating= $this->model->getData('product_review',array('product_id'=>$product_id,'status'=>'A'));
                                    
                                  }
                                  if(empty($allrating)){
                                    $allrating = array();
                                  }
                                  $ratings_count = count($allrating);
                                  $total_ratings = 0;
                                  foreach ($allrating as $key => $value) {
                                    $total_ratings += $value['rating'];
                                  }

                                  $data['average_rating'] = $total_ratings / $ratings_count;
                                  $ratings = round($total_ratings * 5)/($ratings_count * 5);
                                  $data['percent'] = ($ratings * 100)/5;
                                  $prentval[$prokey]['average_rating'] = $data['percent'];
                                  $prentval[$prokey]['count_rating'] = $ratings_count;
                                } ?>
                          
                            
                           <?php  foreach ($prentval as $traval) { ?>
                          <div class="trending-item ">
                            
                             <div class="product">
                                <div class="product-img">
                                   <a href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '-',$traval['product_name'])).'-'.$traval['product_id'];?>"><img width="90" height="90" src="<?php echo base_url();?>products/<?php echo $traval['image_name'];?>" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt="Myfitness-Peanut-Butter-Original-Smooth2">
                                   </a>
                                </div>
                                <div class="product-desc">
                                   <h4 class="text-truncate">
                                      <a href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '-',$traval['product_name'])).'-'.$traval['product_id'];?>"><?php echo $traval['product_name'];?></a>
                                   </h4>
                                   <div class="ratings" style="display: inline-flex;">
                                                <div class="empty-stars"></div>
                                                <div class="full-stars" style="width:<?php echo $pvalue['average_rating'].'%';?>"></div>&nbsp;<div class="review-count">(<?php echo $pvalue['count_rating'].'';?>)</div>
                                             </div><br>
                                   <div class="product-price c2">
                                      <span class="del">
                                         <span class="woocommerce-Price-amount amount">
                                            <span class="woocommerce-Price-currencySymbol">Rs.</span><?php echo $traval['mrp'];?></span></span>
                                            <span>
                                               <span class="woocommerce-Price-amount amount">
                                                  <span class="woocommerce-Price-currencySymbol">Rs.</span><?php echo $traval['price'];?></span>
                                               </span>
                                            </div>
                                         </div>
                                      </div>

                                   </div>
                                   <?php } ?>
                                  
                                
                                  
                                            </div>
                                         </div>
                                      <?php } ?>
                                      <?php } ?>
                                       
                                                                        </div>

                                                                        <!-- Left and right controls -->
                                                                        <a class="left carousel-control" href="#myCarousel2" data-slide="prev">
                                                                           <span class="glyphicon glyphicon-chevron-left"></span>
                                                                           <span class="sr-only">Previous</span>
                                                                        </a>
                                                                        <a class="right carousel-control" href="#myCarousel2" data-slide="next">
                                                                           <span class="glyphicon glyphicon-chevron-right"></span>
                                                                           <span class="sr-only">Next</span>
                                                                        </a>
                                                                     </div>

                                                                  </div>
            </div>
         </div>
      </div>
   </div>



   <!--End of Top Deals -->
   <!-- new -->
   <?php if(isset($child_banner_list) && !empty($child_banner_list)){ ?>
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h2 class="text-center">Shop By Category</h2>
            <br>
            <div class="row">
               <?php foreach($child_banner_list as $chkey => $chvalue){ ?>
                
               <div class="col-md-6 col-xs-6">
                  <a href="<?php echo $chvalue['img_url']; ?>">
                     <div class="cuadro_intro_hover " style="background-color:#fff;border:1px solid #ddd;padding: 10px;">
                        <p style="text-align:center;">
                        <div class="product-image">
                           <?php if(!empty($chvalue['image_name'])){?>
                           <img src="<?php echo base_url();?>uploads/childbanner/<?php echo $chvalue['image_name']; ?>" class="img-responsive"/>
                           <?php }else{?>
                           <img src="<?php echo base_url();?>assets/images/no-image.png" class="img-responsive">
                           <?php }?>
                        </div>
                        </p>
                        <div class="caption" style="opacity:1">
                           <div class="blur"></div>
                           <div class="caption-text">
                              <h3 class="text-center" style=" padding:10px;color: #fff;">Shop Now</h3>
                           </div>
                        </div>
                     </div>
                  </a>
               </div>
               <?php }?>
            </div>
         </div>
      </div>
   </div>
   <?php }?>
   <!-- <div class="container mt-4 mb-4">
      <div class="row">
         <div class="col-md-12">
            <div class="row">
               <div class="col-md-8" style="padding-left: 0px;padding-right: 0px;margin-left: -5px;">
                  <img src="<?php echo base_url();?>assets/images/b11.jpg" style="width: 100%;height:300px;">
                  <div class="abcimagetop">
                     <img src="<?php echo base_url();?>assets/images/discount.png" style="width:70%;">
                  </div>
                  <div class="filtercaption">
                     <h3 style="color: #fff;">Terms and Conditions</h3>
                  </div>
               </div>
               <div class="col-md-4" style="padding-left: 0px;padding-right: 0px;margin-left: 5px;">
                  <img src="<?php echo base_url();?>assets/images/b11.jpg" style="width: 100%;height:300px;">
                  <div class="abcimagetop">
                     <img src="<?php echo base_url();?>assets/images/badge.png" style="width:70%;">
                  </div>
                  <div class="filtercaption1">
                     <h3 style="color: #fff;">About Us</h3>
                  </div>
               </div>
            </div>
            <div class="row" style="margin-top:10px;">
               <div class="col-md-4" style="padding-left: 0px;padding-right: 0px;margin-left: -5px;">
                  <img src="<?php echo base_url();?>assets/images/b11.jpg" style="width: 100%;height:300px;">
                  <div class="abcimagetop">
                     <img src="<?php echo base_url();?>assets/images/user.png" style="width:70%;">
                  </div>
                  <div class="filtercaption1">
                     <h3 style="color: #fff;">Return and Refund</h3>
                  </div>
               </div>
               <div class="col-md-4" style="padding-left: 0px;padding-right: 5px;margin-left: 5px;">
                  <img src="<?php echo base_url();?>assets/images/b11.jpg" style="width: 100%;height:300px;">
                  <div class="abcimagetop">
                     <img src="<?php echo base_url();?>assets/images/quick.png" style="width:70%;">
                  </div>
                  <div class="filtercaption2">
                     <h3 style="color: #fff;">Shop By Brand</h3>
                  </div>
               </div>
               <div class="col-md-4" style="padding-left: 0px;padding-right: 0px;margin-left: 0px;">
                  <img src="<?php echo base_url();?>assets/images/b11.jpg" style="width: 100%;height:300px;">
                  <div class="abcimagetop">
                     <img src="<?php echo base_url();?>assets/images/discount.png" style="width:70%;">
                  </div>
                  <div class="filtercaption1">
                     <h3 style="color: #fff;">Vission</h3>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div> -->
   <!-- End of body container -->
   <?php include_once(APPPATH.'views/includes/footer.php'); ?>
   <script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
   <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
   <script src="<?php echo base_url();?>assets/sliderengine/jquery.js"></script>
   <script src="<?php echo base_url();?>assets/sliderengine/amazingslider.js"></script>
   <script src="<?php echo base_url();?>assets/sliderengine/initslider-1.js"></script>
   
   <script type="text/javascript" src="<?php echo base_url();?>assets/js/move-top.js"></script>
   <script src="<?php echo base_url();?>assets/js/minicart.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url();?>assets/js/easing.js"></script>
   </body>
   </html>
</div>
<style type="text/css">
   .list-item-size {
   border: 1px dotted #bdbebf;
   display: inline-block;
   padding: 3px 8px;
   cursor: pointer;
   margin-right: 5px;
   margin-bottom: 5px;
   color: #212121;
   }
   .list-item-size.selected {
   background-color: #005599;
   color: #fff;
   }
   .product-main .all-flavours .list .list-item-size .woocommerce-Price-currencySymbol {
   padding-right: 2px;
   }
   .nav-tabs { 
   border-bottom: 2px solid #DDD;
   padding-top: 15px;
   padding-bottom: 15px; 
   }
   .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover 
   { 
   border-width: 0; 
   }
   .nav-tabs > li > a { 
   border: none; color: #666; 
   }
   .nav-tabs > li.active > a, .nav-tabs > li > a:hover {
   border: none; color: #4285F4 !important; background: transparent; 
   }
   .nav-tabs > li > a::after {
   content: ""; 
   background: #4285F4; 
   height: 2px; 
   position: absolute; 
   width: 100%; 
   left: 0px; 
   bottom: -1px; 
   transition: all 250ms ease 0s; 
   transform: scale(0); 
   }
   .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { 
   transform: scale(1); 
   }
   .tab-nav > li > a::after { 
   background: #21527d none repeat scroll 0% 0%; 
   color: #fff; 
   }
   .tab-pane { 
   padding: 15px 0; 
   }
   .tab-content{
   padding:20px;
   }
   .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
   color: #FFF;
   background: #fff;
   border: 0px solid transparent;
   }
   .card {background: #FFF none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3); margin-bottom: 30px; }
   .nav-tabs > li {
   width: 25%;
   }
   .p-discount {
    display: inline-block;
    margin-left: 5px;
    background-color: #000;
    color: #fff;
    font-size: 10px;
    padding: 6px 0 0;
    line-height: 11px;
    vertical-align: middle;
    width: 35px;
    height: 35px;
    overflow: hidden;
    border-radius: 50%;
    position: absolute;
    top: 122px !important;
    left: 183px !important;
    text-align: center;
}
   body{ background: #EDECEC; padding:50px}
   .list-item {
   border: 1px dotted #bdbebf;
   display: inline-block;
   padding: 3px 8px;
   cursor: pointer;
   margin-right: 5px;
   margin-bottom: 5px;
   color: #212121;
   }
   .list-item-size.selected {
   background-color: #005599 !important;
   color: #fff;
   }
   .lbl {
   font-weight: 600;
   }
   .lbl span {
   color: #005599;
   display: inline-block;
   margin-left: 5px;
   }
   label {
   display: inline-block;
   margin-bottom: .5rem;
   }
   #header {
   margin-left: -3.1em;
   z-index: 9999;
   }
   img{display: block;}
   .imgBox{width: 470px;height: 470px;border: 1px solid #222;}
   .description.rte {
   overflow: hidden;
   -webkit-transition: height 1s linear;
   -moz-transition: height 1s linear;
   -ms-transition: height 1s linear;
   -o-transition: height 1s linear;
   transition: height 1s linear;
   }
   aside.product-aside .description p, aside.product-aside .description ul {
   font-size: 0.875em;
   }
   .rte ul {
   list-style-type: disc;
   margin: 0 0 1em 0em;
   }
   .rte {
   overflow-wrap: break-word;
   word-wrap: break-word;
   word-break: break-word;
   }

</style>
<link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
<link href="<?php echo base_url()?>assets/css/detailing.css" rel="stylesheet">
<div class="main-content">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="row">
               <div class="col-md-6">
                  <div class="imgBox" style="display: block;" id="theDiv">
                     <img src="<?php echo base_url();?>products/<?php echo $product_data[0]['image_name'];?>" data-origin="<?php echo base_url();?>products/<?php echo $product_data[0]['image_name'];?>" style="width:100%;height:100%;">
                  </div>
                  <div class="xzoom-thumbs">
                     <?php foreach($product_data[0]['banner_images'] as $bnner_img) { ?>
                     <a href="#!" style="display: inline-flex;" onclick="imageBox('<?php echo $bnner_img;?>')"><img class="xzoom-gallery" width="80" src="<?php echo base_url();?>uploads/product_banners/<?php echo $bnner_img;?>"  xpreview="<?php echo base_url();?>uploads/product_banners/<?php echo $bnner_img;?>" title="The description goes here" style="display: inline-flex;width: 100px;height:100px;">
                     </a>
                     <?php } ?>
                     <!-- <a href="<?php //echo base_url();?>products/<?php //echo $product_data[0]['image_name'];?>" style="display: inline-flex;"><img class="xzoom-gallery" width="80" src="<?php //echo base_url();?>products/<?php //echo $product_data[0]['image_name'];?>" title="The description goes here" style="display: inline-flex;width: 100px;height:100px;"></a> -->
                     <!-- <a href="images/gallery/original/03_r_car.jpg" style="display: inline-flex;"><img class="xzoom-gallery" width="80" src="images/gallery/preview/03_r_car.jpg" title="The description goes here" style="display: inline-flex;"></a>
                        <a href="images/gallery/original/04_g_car.jpg" style="display: inline-flex;"><img class="xzoom-gallery" width="80" src="images/gallery/preview/04_g_car.jpg" title="The description goes here" style="display: inline-flex;"></a> -->
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="col-md-12 products">
                     <div class="product-info">
                        <div class="row">
                           <div class="col-md-5">
                              <span class="fa fa-star checked" style="font-size: 26px;"></span>
                              <span class="fa fa-star checked" style="font-size: 26px;"></span>
                              <span class="fa fa-star checked" style="font-size: 26px;"></span>
                              <span class="fa fa-star checked" style="font-size: 26px;"></span>
                              <span class="fa fa-star" style="font-size: 26px;"></span>

                           </div>
                           <div class="col-md-7">
                              <h5 style="color: #005599;font-size: 15px;font-weight: lighter;">Have 10 Reviews / <a onclick="setReviewData()" data-toggle="modal" data-target="#addReview" href="javascript:void(0)">Add New Review</a></h5>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <h3 style="color: #005599;line-height: 30px;font-size: 18px;"><?php echo $product_data[0]['brand_name'];?></h3>
                              <h4 style="color: #474747;line-height: 40px;font-size: 18px;margin-top: -11px;" id="pdname"><?php echo ucwords($product_data[0]['product_name']);?></h4>
                              <?php if($product_data[0]['stock_qty']) { ?>
                                 <h4 style="color: #005599;line-height: 40px;font-size: 18px;margin-top: -11px;">Units Left :<?php echo $product_data[0]['stock_qty'];?></h4>
                              <?php } ?>
                              <!-- <p><span><strike>Rs.1200</strike> </span>&nbsp;&nbsp;<span style="color: #005599;font-size: 16px;">Rs.1100</span> &nbsp;&nbsp;</p> -->
                           </div>
                        </div>
                        <div class="row">
                        <div class="tbottom">
                           <div class="product-price c2">
                              <span class="price" id="pdprice">
                                 <del>
                                    <span class="woocommerce-Price-amount amount">
                                       <span class="woocommerce-Price-currencySymbol">Rs.</span>
                                       <?php echo $product_data[0]['mrp'];?>
                                    </span>
                                 </del> 
                                 <ins>
                                    <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span><?php echo (float)$product_data[0]['price']; ?>
                                    </span>
                                 </ins>
                              </span>
                           </div>
                        <?php// $minus = $product_data[0]['mrp'] - $product_data[0]['price']; ?>
                        <?php //$divide   = $minus/$product_data[0]['mrp']*100; ?>
                        <!-- <div class="p-discount"><?php //echo round($divide).'% off'?>30%</div></div></div> -->

                        
                        <div class="row">
                           <div class="col-md-12" >
                              <div class="form-group">
                                 <select name="pack_size" class="form-control" onchange="set_pack_price(this)">
                                    <?php foreach( $product_data[0]['pack_sizes'] as $key1 => $value){?>
                                    <option value="<?php echo $value['pack_size'].",".$value['price'].",".$value['mrp'];?>"><?php echo $value['pack_size']." ".$product_data[0]['unit_name'];?></option>
                                    <?php }?>
                                 </select>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="input-group">
                                 <span class="input-group-btn">
                                 <button type="button" onclick="reduceQty(this)" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                 <span class="glyphicon glyphicon-minus"></span>
                                 </button>
                                 </span>
                                 <input type="text" onkeyup="set_qty_price(this)" style="text-align: center;" name="quant[2]" class="form-control input-number qty" value="1" min="1" max="100">
                                 <span class="input-group-btn">
                                 <button type="button" onclick="addQty(this)" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                 <span class="glyphicon glyphicon-plus"></span>
                                 </button>
                                 </span>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <?php if(!empty($product_data[0]['sold_by'])){ ?>
                              <div class="vendor d-i-b" style="margin-left: 16px;">
                                 <span>Sold By:</span> <?php echo $product_data[0]['sold_by'];?>
                              </div>
                           <?php } ?>
                        </div>
                        <div class="row mt-4">
                           <div class="col-md-12">
                              <a >
                              <?php if($product_data[0]['stock_status']=='1'){ ?>
                              <button class="btn btn-primary3" onclick="return addItemToCart(this,<?php echo $product_data[0]['product_id']; ?>,'1');"><i class="fa fa-cart-plus"></i>&nbsp;&nbsp;&nbsp;Add To Cart</button>
                              <?php }else{?>
                              <a class="addcart-link btn btn-danger" href="javascript:void(0);"><i class="fa fa-shopping-cart"></i> OUT OF STOCK </a>
                              <?php } ?>
                              </a>
                              <div class="list" style="margin-top: 1em;">
                                 <?php foreach ($product_details as $key => $product_det) { ?>
                                 <div class="list-item-size selected" onclick="myFunction('<?php echo $product_det['id'];?>')"><?php echo round($product_det['pack_size']);?><br>
                                    <span class="woocommerce-Price-amount amount">
                                    <span class="woocommerce-Price-currencySymbol">Rs.</span><?php echo $product_det['price'];?></span>
                                 </div>
                                 <?php } ?>
                              </div>
                           </div>
                        </div>
                        <div class="lbl">
                           <label>Flavour : </label>
                           <span id="flvr"><?php echo $flavours[0];?></span>
                        </div>
                        <div class="list" style="margin-top: 1em;">
                           <?php foreach ($flavours as $key => $fval) { ?>
                           <div class="list-item-size <?php if($key== 0){ echo "selected"; } ?>" id="flav<?php echo $fval;?>" data-variation="pa_flavour" data-variation-id="13508" data-key="delicious-strawberry" onclick="changeFlavour('<?php echo $fval;?>');"><?php echo $fval;?></div>
                           <?php } ?>
                        </div>
                        <br>
                        <div class="description rte" itemprop="description">
                           <div>
                              <ul>
                                 <?php echo $product_data[0]['highlights'];?>
                              </ul>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="mt-4">
                                 <div class="share share-link ddrop " data-share-link="" data-link="#">
                                    <i class="fa fa-share-alt"></i> <span>Share</span>
                                    <div class="dpopup share-dropdown brand" style="width:200px;">
                                       <div class="dpopup share-dropdown brand" style="width:200px;">
                                          <div class="list-group social-icons">
                                             <a class="list-group-item list-group-item-action" target="_blank" href="#"><i class="fab fa-whatsapp" style="color:#000;font-size: 16px;text-align: center;line-height: 34px;"></i> Whatsapp</a>
                                             <a class="list-group-item list-group-item-action" target="_blank" href="#"><i class="fab fa-facebook-f" style="color:#000;font-size: 16px;text-align: center;line-height: 32px;"></i> Facebook</a>
                                             <a class="list-group-item list-group-item-action" target="_blank" href="#"><i class="fab fa-twitter" style="color:#000;font-size: 16px;text-align: center;line-height: 32px;"></i> Twitter</a>
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
            </div>
         </div>
      </div>
   </div>
   <div class="container">
      <div class="row mt-4">
         <?php if(!empty($product_data[0]['banner_images'])) {?>
         <!-- <div class="col-md-12">
            <div id="amazingslider-wrapper-1" style="display:block;position:relative;max-width:900px;margin:20px auto 56px;">
               <div id="amazingslider-1" style="display:block;position:relative;margin:0 auto;">
                  <ul class="amazingslider-slides" style="display:none;">
                     <?php foreach($product_data[0]['banner_images'] as $img){?>
                     <li><a href="" class="html5lightbox"><img src="<?php echo base_url();?>uploads/product_banners/<?php echo $img;?>" alt="11"  /></a>
                     </li>
                     <?php }?>
                  </ul>
                  <ul class="amazingslider-thumbnails" style="display:none;">
                     <li><img src="<?php echo base_url();?>assets/images/1.png" alt="11" /></li>
                     <li><img src="<?php echo base_url();?>assets/images/4.png" alt="44" /></li>
                     <li><img src="<?php echo base_url();?>assets/images/5.png" alt="b11" /></li>
                  </ul>
                   <div class="amazingslider-engine"><a href="#" title="jQuery Slider">jQuery Slider</a></div>
               </div>
            </div>
            </div> -->
         <?php }?>
      </div>
   </div>
   <hr>
   <!--  <?php //if(!empty($product_data[0]['description'])){?>
      <div class="container mt-3">
          <div class="row">
              <div class="col-md-12">
                  <div class="product-description">
                      <h2><span>Description</span></h2>
                      <hr align="left" style="border-top:3px solid #005599;width:9%;margin-top: 5px;">
                      <?php //echo $product_data[0]['description']; ?>
                  </div>
              </div>
          </div>
      </div>
      <?php //}?> -->
   <?php if(!empty($reviews)){?>
   <div class="container mt-3">
      <div class="row">
         <div class="col-md-12">
            <div class="reviewspd">
               <h2><span>Reviews</span></h2>
               <hr align="left" style="border-top:3px solid #005599;width:8.2%;margin-top: 5px;">
            </div>
            <?php if(!empty($rating)){?>
            <div class="review-stat">
               <div class="main"><span>5<i class="fas fa-star"></i></span>Ratings</div>
               <div class="chart">
                  <ul>
                     <li style="line-height: 23px;">
                        <span>5</span> <i class="fas fa-star" style="color:#00B5EA;"></i>
                        <div class="rbar">
                           <div class="green" style="width:<?php echo $rating[5]['percent']?>%"></div>
                        </div>
                        <span class="ttt"><?php echo $rating[5]['rating']?></span>
                     </li>
                     <li style="line-height: 23px;">
                        <span>4</span> <i class="fas fa-star" style="color:#00B5EA;"></i>
                        <div class="rbar">
                           <div class="green" style="width:<?php echo $rating[4]['percent']?>%"></div>
                        </div>
                        <span class="ttt"><?php echo $rating[4]['rating']?></span>
                     </li>
                     <li style="line-height: 23px;">
                        <span>3</span> <i class="fas fa-star" style="color:#00B5EA;"></i>
                        <div class="rbar">
                           <div class="green" style="width:<?php echo $rating[3]['percent']?>%"></div>
                        </div>
                        <span class="ttt"><?php echo $rating[3]['rating']?></span>
                     </li>
                     <li style="line-height: 23px;">
                        <span>2</span> <i class="fas fa-star" style="color:#00B5EA;"></i>
                        <div class="rbar">
                           <div class="orange" style="width:<?php echo $rating[2]['percent']?>%"></div>
                        </div>
                        <span class="ttt"><?php echo $rating[2]['rating']?></span>
                     </li>
                     <li style="line-height: 23px;">
                        <span>1</span> <i class="fas fa-star" style="color:#00B5EA;"></i>
                        <div class="rbar">
                           <div class="red" style="width:<?php echo $rating[1]['percent']?>%"></div>
                        </div>
                        <span class="ttt"><?php echo $rating[1]['rating']?></span>
                     </li>
                  </ul>
               </div>
            </div>
            <?php }?>
         </div>
      </div>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <?php foreach($reviews as $review){?>
            <div class="row reviewb11 mt-4">
               <div class="col-md-9">
                  <p><?php echo $review['user_name']?> &nbsp;&nbsp;<span><?php echo $review['added_on']?></span></p>
                  <h4 style="line-height: 30px;font-weight: lighter;"><?php echo $review['review']?></h4>
               </div>
               <div class="col-md-3">
                  <h4 style="text-align: right;">
                     <span class="fa fa-star <?php if($review['rating'] >= 1){?>checked1<?php }?>"></span>
                     <span class="fa fa-star <?php if($review['rating'] >= 2){?>checked1<?php }?>"></span>
                     <span class="fa fa-star <?php if($review['rating'] >= 3){?>checked1<?php }?>"></span>
                     <span class="fa fa-star <?php if($review['rating'] >= 4){?>checked1<?php }?>"></span>
                     <span class="fa fa-star <?php if($review['rating'] >= 5){?>checked1<?php }?>"></span>
                  </h4>
               </div>
            </div>
            <?php }?>
         </div>
      </div>
   </div>
   <?php }?>
   <!-- <div class="container mt-3 mb-3"  >
      <div class="row">
          <div class="col-md-12">
              <h2><span>Additional Features</span></h2>
              <hr align="left" style="border-top:3px solid #005599;width:16%;margin-top: 5px;">
              <table class="table table-striped">
                  <tbody>
                      <tr>
                          <th>Brand</th>
                          <td><?php //echo ucwords($product_data[0]['brand_name']) ?></td>
                      </tr>
                      <tr>
                          <th>Flavour</th>
                          <td><?php //echo ucwords($product_data[0]['flavour']) ?></td>
                      </tr>
                      <tr>
                          <th>Number of serving</th>
                          <td><?php //echo ucwords($product_data[0]['no_of_serving']) ?></td>
                      </tr>
                      <tr>
                          <th>Serving size</th>
                          <td><?php //echo ucwords($product_data[0]['serving_size']) ?></td>
                      </tr>
                      <tr>
                          <th>Packaging</th>
                          <td><?php //echo ucwords($product_data[0]['packaging']) ?></td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
      </div> -->
   <div class="modal" id="addReview">
      <div class="modal-dialog">
         <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
               <h4 class="modal-title">Add New Review For <span class="review_product_name"></span></h4>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?php echo base_url()?>product/add_product_review" method="post">
               <!-- Modal body -->
               <div class="modal-body">
                  <input type="hidden" name="product_id" id="review_product_id">
                  <input type="hidden" name="user_id" id="review_user_id">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Rating</label>
                           <input id="input-21b" type="text" name="rating" class="rating" data-min=0 data-max=5 data-step=1 data-size="md" required title="">
                        </div>
                     </div>
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>Review</label>
                           <textarea id="" name="review" class="form-control" rows="5" style="border-radius: 0px;"></textarea>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Modal footer -->
               <div class="modal-footer">
                  <button class="btn btn-success" >Add Review</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <!-- Nav tabs -->
         <div class="card">
            <ul class="nav nav-tabs" role="tablist">
               <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Features</a></li>
               <!-- <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li> -->
               <!--  <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li> -->
               <li role="presentation"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Description</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div role="tabpanel" class="tab-pane active" id="home">
                  <div class="container mt-3 mb-3">
                     <div class="row">
                        <div class="col-md-12">
                           <!--  <h3><span>Additional Features</span></h3> -->
                           <!--  <hr align="left" style="border-top:3px solid #005599;width:16%;margin-top: 5px;"> -->
                           <table class="table table-striped">
                              <tbody>
                                 <tr>
                                    <th>Brand</th>
                                    <td><?php echo ucwords($product_data[0]['brand_name']) ?></td>
                                 </tr>
                                 <tr>
                                    <th>Flavour</th>
                                    <td><?php echo ucwords($product_data[0]['flavour']) ?></td>
                                 </tr>
                                 <tr>
                                    <th>Number of serving</th>
                                    <td><?php echo ucwords($product_data[0]['no_of_serving']) ?></td>
                                 </tr>
                                 <tr>
                                    <th>Serving size</th>
                                    <td><?php echo ucwords($product_data[0]['serving_size']) ?></td>
                                 </tr>
                                 <tr>
                                    <th>Packaging</th>
                                    <td><?php echo ucwords($product_data[0]['packaging']) ?></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               <!--  <div role="tabpanel" class="tab-pane" id="profile">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
                  <div role="tabpanel" class="tab-pane" id="messages">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div> -->
               <?php if(!empty($product_data[0]['description'])){?>
               <div role="tabpanel" class="tab-pane" id="description"><?php echo $product_data[0]['description']; ?></div>
               <?php } ?>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include_once(APPPATH.'views/includes/footer.php'); ?>
<!-- //footer -->
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/sliderengine/amazingslider.js"></script>
<script src="<?php echo base_url();?>assets/sliderengine/initslider-1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/move-top.js"></script>
<script src="<?php echo base_url();?>assets/js/minicart.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/easing.js"></script>
<script src="<?php echo base_url();?>assets/peekABar/js/jquery.peekabar.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/front.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.imgzoom.js"></script>
<!-- Custom js -->
<script src="<?php echo base_url();?>/assets/js/star-rating.js"></script>
<script type="text/javascript">
   function changeFlavour(val)
   {
      $("#flav"+val).addClass("selected").siblings().removeClass("selected");
   
      $("#flvr").html(val);
      
      
   }
</script>
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
<script type="text/javascript">
   $('.imgBox').imgZoom({
       boxWidth: 600,
       boxHeight: 600,
       marginLeft: 5,
       origin: 'data-origin'
   });
</script>
<script type="text/javascript">
   function imageBox(img)
   {
      //alert(img);
      // $('#theDiv').prepend('<img class="desktop-image-zoom-primary-image" src="'.base_url().'uploads/products/'.$img'">')
      var simage = img;
      var imgSource = '<?php echo base_url();?>uploads/product_banners/'+simage;
    //alert(imgSource);
      $('#theDiv').empty();
   
      var html = '';
      html +='<img src="'+imgSource+'" data-origin="'+imgSource+'" style="width:100%;height:100%;">';
     // html +='<img class="desktop-image-zoom-primary-image" src="'+imgSource+'">';
   
      // $('#theDiv').html('<img class="desktop-image-zoom-primary-image"  src="<?php// echo base_url('uploads/products/'+simage+);?>">');
   
      
      $('#theDiv').append(html);
   
       $('.imgBox').imgZoom({
            boxWidth: 600,
            boxHeight: 600,
            marginLeft: 5,
            origin: 'data-origin'
        });
      
       
      
   }
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
<!-- main slider-banner -->
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
<script type="text/javascript">
   function setReviewData(){
       var product_id= '<?php echo $product_data[0]['product_id']?>';
       var user_id= '<?php echo $this->session->userdata('user_id');?>';
       $('#review_product_id').val(product_id);
       $('#review_user_id').val(user_id);
   }
</script>
<script type="text/javascript">
   function myFunction(pid)
   {
      var prod_det = pid;

      var postData = {
   
         'product_det': prod_det,
         
      }

      jQuery.ajax({
         dataType: 'json',
         type: "POST",
         url: jsBaseUrl+"product/getProductDetails",
         // data: 'product_id='+product_id+'&purchase_qty='+qty,
         data: postData,
         cache: false,
         success: function(data){
            //$("#delivery").hide();
            $("#theDiv").empty();
            $("#pdprice").empty();
            if(data)
            {

               var imagename = data.image_name;
               var imgSource = '<?php echo base_url();?>uploads/products/'+imagename;
               var html = '';
               html +='<img src="'+imgSource+'" data-origin="'+imgSource+'" style="width:100%;height:100%;">';
               $("#theDiv").append(html);

               var price = data.price;
               var mrp   = data.mrp;

               var phtml =''
               phtml +='<del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>'+mrp+'</span></del><ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>'+price+'</span></ins>';

               $("#pdprice").append(phtml);

               //var product_name = $("#pdname").text();
               //var dname = product_name+'('+data.pack_size+')';
               //alert(dname);
              // $("#pdname").val(Math.round(dname));

               //alert(product_name);


               
            }


           
           // jQuery('.basket-item-count .count').html(res.total_cart_item);
            //jQuery('.total-price-basket .value').html(res.total_amount);
            //window.location.href = jsBaseUrl+"account/view_my_cart";
         },


   
         // error:function(error,message){
         //    console.log(error,message);
         // }

      });

    $('.imgBox').imgZoom({
         boxWidth: 600,
         boxHeight: 600,
         marginLeft: 5,
         origin: 'data-origin'
     });  
     
   }
</script>
<!-- //main slider-banner -->
</body>
</html>
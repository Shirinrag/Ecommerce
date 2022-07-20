<!DOCTYPE html>
<html lang="en">
   <!-- Added by HTTrack -->
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <!-- css
         ============================================ -->
      <?php include('common/cssfiles.php');?>
      <style type="text/css">
         body {
         font-family: 'Roboto', sans-serif
         }
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
               <li><a href="#">Smartphone & Tablets</a></li>
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
                                 <a href="<?php echo base_url().'Frontend/category?catid='.base64_encode($value['category_id']); ?>"
                                    class="cutom-parent"><?php echo $value['category_name']; ?></a>
                                 <?php  if(!empty($value['sub_category_name'][0])){?><span
                                    class="button-view  fa fa-plus-square-o"></span><?php } ?>
                                 <ul style="display: none;">
                                    <?php foreach($value['sub_category_name'] as $key1 =>$value1){ ?>
                                    <li style="font-size:12px;"><a
                                       href="<?php echo base_url().'Frontend/sub_category?subcatid='.base64_encode($value1['sub_category_id']); ?>"><?php echo $value1; ?></a>
                                    </li>
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
                  <div class="products-category">
                     <h3 class="title-category ">Accessories</h3>
                     <!-- Filters -->
                     <div class="product-filter product-filter-top filters-panel">
                        <div class="row">
                           <div class="col-md-5 col-sm-3 col-xs-12 view-mode">
                              <div class="list-view">
                                 <button class="btn btn-default grid active" data-view="grid"
                                    data-toggle="tooltip" data-original-title="Grid"><i
                                    class="fa fa-th"></i></button>
                                 <button class="btn btn-default list" data-view="list" data-toggle="tooltip"
                                    data-original-title="List"><i class="fa fa-th-list"></i></button>
                              </div>
                           </div>
                           <div class="short-by-show form-inline text-right col-md-7 col-sm-9 col-xs-12">
                              <div class="form-group short-by">
                                 <label class="control-label" for="input-sort">Sort By:</label>
                                 <select id="input-sort" class="form-control" onchange="location = this.value;">
                                    <option value="" selected="selected">Default</option>
                                    <option value="">Name (A - Z)</option>
                                    <option value="">Name (Z - A)</option>
                                    <option value="">Price (Low &gt; High)</option>
                                    <option value="">Price (High &gt; Low)</option>
                                    <option value="">Rating (Highest)</option>
                                    <option value="">Rating (Lowest)</option>
                                    <option value="">Model (A - Z)</option>
                                    <option value="">Model (Z - A)</option>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label class="control-label" for="input-limit">Show:</label>
                                 <select id="input-limit" class="form-control" onchange="location = this.value;">
                                    <option value="" selected="selected">15</option>
                                    <option value="">25</option>
                                    <option value="">50</option>
                                    <option value="">75</option>
                                    <option value="">100</option>
                                 </select>
                              </div>
                           </div>
                           <!-- <div class="box-pagination col-md-3 col-sm-4 col-xs-12 text-right">
                              <ul class="pagination">
                                  <li class="active"><span>1</span></li>
                                  <li><a href="">2</a></li><li><a href="">&gt;</a></li>
                                  <li><a href="">&gt;|</a></li>
                              </ul>
                              </div> -->
                        </div>
                     </div>
                     <!-- //end Filters -->
                     <!--changed listings-->
                     <div class="products-list row nopadding-xs so-filter-gird">
                        <?php if(count($product_data) > 0) {?>
                        <?php   foreach($product_data as $key => $value){ ?>                 
                        <div class="product-layout col-lg-15 col-md-4 col-sm-6 col-xs-12">
                           <div class="product-item-container">
                              <div class="left-block">
                                 <div class="product-image-container second_img">
                                    <a href="product.html" target="_self" title="<?php echo $value['product_name'];?>">
                                    <img src="<?php echo $value['image_name'];?>" class="img-1 img-responsive" alt="<?php echo $value['imagename'];?> ?>">
                                    </a>
                                 </div>
                              </div>
                              <div class="right-block">
                                 <div class="caption">
                                    <div class="rating">    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                       <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                       <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                       <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                       <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                    </div>
                                    <h4><a href="" class="textellipse" title="<?php echo $value['product_name'];?>" target="_self"><?php echo $value['product_name'];?></a></h4>
                                    <div class="price"> <span class="price-new"><?php echo $value['currency_in_english'];?> <?php echo $value['product_offer_price'];?></span>
                                       <span class="price-old"><?php echo $value['currency_in_english'];?> <?php echo $value['product_purchase_price'];?></span>
                                    </div>
                                    <div class="description item-desc">
                                       <!-- <p><?php echo $value['description'];?></p> -->
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php } ?>
                        <?php }else{ ?>
                        <div class="product-layout col-lg-15 col-md-4 col-sm-6 col-xs-12">
                           <b>
                              <p  style="color:red;">Products are Unavaiable.</p>
                           </b>
                        </div>
                        <?php  }?>
                     </div>
                     <!--// End Changed listings-->
                  </div>
               </div>
            </div>
            <?php //} ?>
         </div>
         <!--// End Changed listings-->
         <!-- Filters -->
         <div class="product-filter product-filter-bottom filters-panel">
            <div class="row">
               <div class="col-sm-6 text-left"></div>
               <div class="col-sm-6 text-right">Showing 1 to 15 of 15 (1 Pages)</div>
            </div>
         </div>
         <!-- //end Filters -->
      </div>
      </div>
      <!--Middle Part End-->
      </div>
      </div>
      <!-- //Main Container -->
      <!-- Footer Container -->
      <?php include('common/footer.php');?>
      <!-- //end Footer Container -->
      </div>
      <!-- Cpanel Block -->
      <div id="sp-cpanel_btn" class="isDown visible-lg">
         <i class="fa fa-cog"></i>
      </div>
      <!-- Include Libs & Plugins
         ============================================ -->
      <!-- Placed at the end of the document so the pages load faster -->
      <?php include('common/jsfiles.php');?>
      <script type="text/javascript">
         <!--
         // Check if Cookie exists
         if ($.cookie('display')) {
             view = $.cookie('display');
         } else {
             view = 'grid';
         }
         if (view) display(view);
         //
         -->
      </script>
   </body>
</html>
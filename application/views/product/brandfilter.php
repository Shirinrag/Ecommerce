
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

.ratings {
  position: relative;
  vertical-align: middle;
  display: inline-block;
  color: #b1b1b1;
  overflow: hidden;
}

.full-stars{
  position: absolute;
  left: 0;
  top: 0;
  white-space: nowrap;
  overflow: hidden;
  color: #fde16d;
}

.empty-stars:before,
.full-stars:before {
  content: "\2605\2605\2605\2605\2605";
  font-size: 14pt;
}

.empty-stars:before {
  -webkit-text-stroke: 1px #848484;
}

.full-stars:before {
  -webkit-text-stroke: 1px orange;
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

            <div id="main-content" class="shop-content position-relative" data-max-page="3">
                <div class="ajsearch-loading d-none">
                    <div class="loading-stat"><i class="icon icon-loading"></i> Loading...</div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-3 order-1">
                            <div class="cat-sidebar b1 box1">
                                <div class="cat-sidebar-title bb1">Filter By</div>
                                <div class="desc">
                                    <div class="shop-sidebar-widget">
                                        <h2 class="widgettitle"><i class="icon icon-angle-right"></i>Categories</h2>
                                        <div class="desc">
                                           <!--  <div class="search-container">
                                                <form action="/action_page.php">
                                                    <input type="text" placeholder="Search.." name="search" style="height:34px;width:180px;">
                                                    <button type="submit" style="margin-left:-1em;height:34px;line-height: 1px;"><i class="fa fa-search"></i></button>
                                                </form>
                                            </div> -->
                                            <ul>
                                                <?php foreach ($category_list as $catkey => $catval) { ?>
                                                    <li class="" style="margin-left: -34px;">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" id="prod_catg" value="<?php echo $catval['category_id'];?>" class="common_selector prod_catg">
                                                            <label class="" for="prod_catg"><?php echo $catval['category_name'];?></label>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                                <!-- <li class="active">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="_ccat1" value="1197" checked="checked" class="aj-click custom-control-input" data-field-id="catids" disabled="">
                                                        <label class="custom-control-label" for="_ccat1">BOGO Offer</label>
                                                    </div>
                                                </li> -->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="shop-sidebar-widget">
                                        <h2 class="widgettitle"><i class="icon icon-angle-right"></i>Brands</h2>
                                        <div class="desc">
                                            <!-- <div class="widget-search m-b-10">
                                                <input type="text" class="search-brand-input form-control form-control-sm" placeholder="Search By Brand"><i class="icon icon-search"></i></div> -->
                                            <ul>
                                                <?php foreach ($brand_data as $brdkey => $brdval) { ?>
                                                    <li class="" style="margin-left: -34px;">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" id="_cbrand0" value="<?php echo $brdval['brand_id'];?>" class="common_selector prod_brand">
                                                            <label class="" for="_cbrand0"><?php echo $brdval['brand_name'];?></label>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 order-2 product-view">
                            <!-- <header class="row1">
                                <h1 class="woocommerce-products-header__title page-title">BOGO Offer</h1>
                            </header> -->
                            <div class="cat-search-bar">
                                <div class="div-orderby float-left label-field">
                                    <label>Sort By:</label>
                                    <select name="orderby" class="orderby aj-select form-control form-control-sm" data-field-id="orderby">
                                        <option value="featured">Featured</option>
                                        <option value="popularity">Popularity</option>
                                        <option value="rating">Average Rating</option>
                                        <option value="date">Newness</option>
                                        <option value="price">Price: Low to High</option>
                                        <option value="price-desc">Price: High to Low</option>
                                        <option value="trending">Trending</option>
                                    </select>
                                </div>
                                <div class="div-nop float-right label-field">
                                    <label>Show:</label>
                                    <select name="nop" class="nop aj-select form-control form-control-sm" data-field-id="nop">
                                        <option value="12" selected="selected">12</option>
                                        <option value="24">24</option>
                                        <option value="48">48</option>
                                        <option value="72">72</option>
                                    </select>
                                </div>
                                <div class="div-page-total float-right m-r-15">
                                    <label><strong>Total:</strong> <?php echo count($product_data);?></label>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row">
                                <?php if(isset($product_data) && !empty($product_data)){ 
                                    foreach ($product_data as $key => $pvalue) {?>
                                    <div class="col-4">
                                        <div class="products">
                                            <div class="product-short-info product-info">
                                                <div>
                                                <?php $minus = (float)$pvalue['mrp'] - (float)$pvalue['price']; 
                                                      $divide   = $minus/(float)$pvalue['mrp']*100; ?>
                                                <div class="p-discount" style="background-color: #00bfbf;"><?php echo round($divide);?>%<br></div>
                                                    <?php if($pvalue['stock_status']=='0'){ ?>
                                                         <div class="out-of-stock-label ab11">SOLD OUT</div>
                                                    <?php } ?>
                                                    <div class="product-img">
                                                        <a href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '-',$pvalue['product_name'])).'-'.$pvalue['product_id'];?>">
                                                            <?php if(!empty($pvalue['image_name'])){ ?>
                                                                <img width="370" height="370" src="<?php echo base_url();?>products/<?php echo $pvalue['image_name'];?>" class="attachment-shop_single size-shop_single wp-post-image" alt="<?php echo $pvalue['image_name'];?>">
                                                            <?php }else{ ?>

                                                                <img width="370" height="370" class="attachment-shop_single size-shop_single wp-post-image" src="<?php echo base_url();?>assets/images/no-image.png">
                                                            <?php } ?>
                                                        </a>
                                                    </div>
                                                    <div class="product-desc">
                                                     <h4 class="text-truncate">
                                                     <a href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '-',$pvalue['product_name'])).'-'.$pvalue['product_id'];?>">
                                                            <?php echo ucwords($pvalue['product_name']);?>
                                                          </a>
                                                    </h4>
                                                    <br>
                                                    <div class="ratings">
                                                      <div class="empty-stars"></div>
                                                      <div class="full-stars" style="width:<?php echo $pvalue['average_rating'];?>%"></div>
                                                    </div><div class="review-count">(<?php echo $pvalue['count_rating'];?> Reviews)</div><br>
                                                    

                                                       <input type="hidden" class="qty" value="1">
                                                        
                                                        <input type="hidden" class="price" value="<?php echo (float)$pvalue['price'];?>">
                                                        <div class="product-price "><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span><?php echo $pvalue['mrp'];?></span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span><span class="search_PSellingP"> <?php echo $pvalue['price'];?></span></span></ins></div>
                                                    </div>
                                                    
                                                    <br>
                                                   <div class="p-action">
                                                   <a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart" style="color:#27313D;"></i>
                                                   </a>
                                                   <a href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '-',$pvalue['product_name'])).'-'.$pvalue['product_id'];?>" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #76B51B;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                }else{ ?>
                                    <div class="col-12"> 
                                        <img class="img-responsive" src="<?php echo base_url();?>assets/images/coming-soon-page-large.png">
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

        <!-- //footer -->
        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
        <script type="<?php echo base_url();?>assets/text/javascript" src="js/move-top.js"></script>
        <script src="<?php echo base_url();?>assets/js/minicart.min.js"></script>
        <script src="<?php echo base_url();?>assets/peekABar/js/jquery.peekabar.js"></script>
        <script src="<?php echo base_url();?>assets/js/front.js"></script>


<script type="text/javascript">
    $(document).ready(function(){

        filter_data();

        function filter_data()
        {
            $('.filter_data').html('<div id="loading" style="" ></div>');
            var action = 'fetch_data';
            //var minimum_price = $('#hidden_minimum_price').val();
           // var maximum_price = $('#hidden_maximum_price').val();
            var category = get_filter('prod_catg');
            //var size = get_filter('prod_size');
            //var pattern = get_filter('prod_pattern');
            var brand = get_filter('prod_brand');
           // var color = get_filter('prod_color');
            //var availability = get_filter('prod_availble');

            $.ajax({
                url: jsBaseUrl+"product/fetch_data",
                method:"POST",
                data:{action:action,category:category,brand:brand},
               // data:{action:action,minimum_price:minimum_price, maximum_price:maximum_price,category:category,size:size,pattern:pattern,brand:brand,color:color,availability:availability},
                success:function(data){
                    
                    $('.loader').css('display','none');
                    $('.filter_data').html(data);
                }
            });

            
            // var ram = get_filter('ram');
            //var storage = get_filter('storage');
        }
       // var// max_price = Math.round('<?php //echo $max_data['max'];?>');
        //max_price = round(max_price);
        //var //min_price = Math.round('<?php //echo $min_data['min'];?>');
        //min_price = round(min_price);
         
        

        function get_filter(class_name)
        {
           
            var filter = [];
            $('.'+class_name+':checked').each(function(){

                filter.push($(this).val());
            });
            return filter;
        }


        $('.common_selector').click(function()
        {
            filter_data();
        });


        $('#slider-range').slider({
        range:true,
        min:min_price,
        max:max_price,
        values:[min_price, max_price],
        step:50,
        stop:function(event, ui)
        {
            console.log(ui.values);
            $('#price_show').val(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

    

        

    });
</script>
        
        <!-- <script type="text/javascript" src="js/easing.js"></script> -->
        <!-- <script type="text/javascript">
         jQuery(document).ready(function($) {
            $(".scroll").click(function(event){    
               event.preventDefault();
               $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
         });
      </script> -->
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
        <!-- <script src="js/skdslider.min.js"></script> -->
        <!-- <link href="css/skdslider.css" rel="stylesheet"> -->
        <!-- <script type="text/javascript">
         jQuery(document).ready(function(){
            jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});

            jQuery('#responsive').change(function(){
               $('#responsive_wrapper').width(jQuery(this).val());
            });

         });
      </script> -->
        <!-- <script type="text/javascript">
         $(document).ready(function(){

            $('#itemslider').carousel({ interval: 3000 });

            $('.carousel-showmanymoveone .item').each(function(){
               var itemToClone = $(this);

               for (var i=1;i<6;i++) {
                  itemToClone = itemToClone.next();

                  if (!itemToClone.length) {
                     itemToClone = $(this).siblings(':first');
                  }

                  itemToClone.children(':first-child').clone()
                  .addClass("cloneditem-"+(i))
                  .appendTo($(this));
               }
            });
         });
      </script> -->
        <!-- //main slider-banner -->
</body>

</html>
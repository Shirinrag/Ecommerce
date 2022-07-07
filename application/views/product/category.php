<style>
.checked {
  color: orange;
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
  color: #ffcd00;
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

/* Webkit-text-stroke is not supported on firefox or IE */
/* Firefox */
@-moz-document url-prefix() {
  .full-stars{
    color: #ECBE24;
  }
}

.variant-rating-count {
    margin-top: 25px;
    position: absolute;
    z-index: 1;
}
/*.review-stars {
    display: inline-block;
    width: 70px;
    height: 14px;
    background-image: url(https://img3.hkrtcdn.com/react/static/media/common/misc/star-empty.svg);
    background-repeat: repeat-x;
    margin-right: 6px;
}*/

.ui-widget.ui-widget-content {
    border: 1px solid #c5c5c5;
}

.ui-widget.ui-widget-content {
    z-index: 99999;
}
.ui-slider-horizontal {
    height: 10px;
}

.ui-corner-all, .ui-corner-bottom, .ui-corner-right, .ui-corner-br {
    border-bottom-right-radius: 5px;
}

.ui-corner-all, .ui-corner-bottom, .ui-corner-left, .ui-corner-bl {
    border-bottom-left-radius: 5px;
}
.ui-corner-all, .ui-corner-top, .ui-corner-right, .ui-corner-tr {
    border-top-right-radius: 5px;
}
.ui-corner-all, .ui-corner-top, .ui-corner-left, .ui-corner-tl {
    border-top-left-radius: 5px;
}

.ui-widget-content {
    border: 1px solid #a6c9e2;
    color: #222222;
}
.ui-widget {
    font-family: Lucida Grande,Lucida Sans,Arial,sans-serif;
    font-size: 1.1em;
}
.ui-slider-horizontal {
    height: .8em;
}

.ui-slider {
    position: relative;
    text-align: left;
}

.ui-corner-all, .ui-corner-bottom, .ui-corner-right, .ui-corner-br {
    border-bottom-right-radius: 3px;
}

.ui-corner-all, .ui-corner-bottom, .ui-corner-left, .ui-corner-bl {
    border-bottom-left-radius: 3px;
}
.ui-corner-all, .ui-corner-top, .ui-corner-right, .ui-corner-tr {
    border-top-right-radius: 3px;
}
.ui-corner-all, .ui-corner-top, .ui-corner-left, .ui-corner-tl {
    border-top-left-radius: 3px;
}
.ui-widget-content {
    border: 1px solid #dddddd;
    background: #ffffff;
    color: #333333;
}
.ui-widget {
    font-family: Arial,Helvetica,sans-serif;
    font-size: 1em;
}
.ui-slider-horizontal {
    height: .8em;
}

.ui-slider {
    position: relative;
    text-align: left;
}
.fa-cart-plus{
    /*color: #76B51B;*/
    font-size: 20px;
    padding-right: 10px;
}
.product-short-info .p-action .btn .fa-cart-plus:hover {
    /*background-color: #00BFBF;*/
    color: #fff;
}

/*.widget_price_filter .ui-slider-horizontal {
    height: 2px;
}
.widget_price_filter .ui-slider {
    position: relative;
    text-align: left;
}
.widget_price_filter .price_slider {
    margin-bottom: 30px;
}
.ui-slider-horizontal {
    height: 5px;
}
.ui-slider-horizontal .ui-slider-handle {
    top: -0.6em;
    margin-left: -0.1em;
}
.ui-slider .ui-slider-handle {
    position: absolute;
    z-index: 2;
    width: 5px;
    height: 17px;
    cursor: default;
    -ms-touch-action: none;
    touch-action: none;
}*/

@media all and (max-width: 1100px) and (min-width: 850px) {
    .product-short-info .product-img img 
    {
    max-width: 130px;
    max-height: 160px;
    }
}
@media only screen and (max-width: 767px) {
    #header .logo {
    float: left;
    margin-top: 0em;
    margin-bottom: 1em;
    position: relative;
    z-index: 1;
}
}
</style>
<!-- <link rel="stylesheet" href="<?php //echo base_url()?>assets/css/jquery-ui-1.12.0.css"/> -->

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
                    <a href="<?php echo base_url();?>">Home
                     <i class="icon icon-breadcrubm-delimiter"></i>
                     <a href="<?php echo base_url();?>product/listing/<?php echo strtolower(preg_replace('/\s+/', '-',$category_data[0]['category_name'])).'-'.$category_data[0]['category_id'];?>"><?= ucfirst($category_data[0]['category_name']);?></a>
                     <i class="icon icon-breadcrubm-delimiter"></i>
                     <a href="<?php echo base_url();?>product/listing/<?php echo strtolower(preg_replace('/\s+/', '-',$category_data[0]['category_name'])).'-'.$category_data[0]['category_id'];?>/<?php echo strtolower(preg_replace('/\s+/', '-',$sub_category_data[0]['sub_category_name'])).'-'.$sub_category_data[0]['sub_category_id'];?>"><?= ucfirst($sub_category_data[0]['sub_category_name']);?></a>
                     
                     <i class="icon icon-breadcrubm-delimiter"></i><?php echo ucwords($child_category_data[0]['child_category_name']);?>
               </div>
            </nav>

            <input type="hidden" id="hidden_category_id" value="<?php echo $hidden_category_id;?>" />
            <input type="hidden" id="hidden_subcategory_id" value="<?php echo $hidden_subcategory_id;?>" />
            <input type="hidden" id="hidden_childcategory_id" value="<?php echo $hidden_childcategory_id;?>" />

            <div id="main-content" class="shop-content position-relative" data-max-page="3">
                <div class="ajsearch-loading d-none">
                    <div class="loading-stat"><i class="icon icon-loading"></i> Loading...</div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 order-1">
                            <div class="cat-sidebar b1 box1">
                                <div class="cat-sidebar-title bb1">Filter By</div>
                                <div class="desc">
                                   <div class="shop-sidebar-widget"> 
                                    
                                    <p>
                                        <label class="widgettitle" for="amount"><i class="icon icon-angle-right"></i>Price range:</label>
                                        <input type="hidden" id="hidden_minimum_price" value="<?php echo $price_slider_data['min_price'];?>" />
                                        <input type="hidden" id="hidden_maximum_price" value="<?php echo $price_slider_data['max_price'];?>" />
                                        <input type="text" id="amount" value="<?php echo $price_slider_data['min_price'];?> - <?php echo $price_slider_data['max_price'];?>" readonly style="border:0; color:#f6931f; font-weight:bold;">
                                    </p>
                                    <div id="slider-range" style="z-index: 0;"></div>
                                    </div>
                                    <div class="shop-sidebar-widget">
                                        <h2 class="widgettitle"><i class="icon icon-angle-right"></i>Categories</h2>
                                        <div class="desc">
                                            <!-- <div class="search-container">
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
                        <div class="col-md-9 order-2 product-view">
                            <!-- <header class="row1">
                                <h1 class="woocommerce-products-header__title page-title">BOGO Offer</h1>
                            </header> -->
                            <?php if(!empty($child_category_data[0]['image_name'])){ ?>
                                <img src="<?php echo base_url();?>uploads/childbanerimg/<?php echo $child_category_data[0]['image_name'];?>" style="width:100%;">
                            <?php } ?>
                            <div class="cat-search-bar">
                                <div class="div-orderby float-left label-field">
                                    <label>Sort By:</label>
                                    <select name="orderby" id="short_by" class="orderby aj-select form-control form-control-sm" data-field-id="orderby" onchange="changePopularity()">
                                        <option>Select One</option>
                                        <option value="popular">Popularity</option>
                                        <!-- <option value="rating">Average Rating</option> -->
                                        <option value="date">Newness</option>
                                        <option value="ASC">Price: Low to High</option>
                                        <option value="DESC">Price: High to Low</option>
                                        <option value="trending">Trending</option>
                                    </select>
                                </div>
                                <!-- <div class="div-nop float-right label-field">
                                    <label>Show:</label>
                                    <select name="nop" class="nop aj-select form-control form-control-sm" data-field-id="nop">
                                        <option value="12" selected="selected">12</option>
                                        <option value="24">24</option>
                                        <option value="48">48</option>
                                        <option value="72">72</option>
                                    </select>
                                </div> -->
                                <!-- <div class="div-page-total float-right m-r-15">
                                    <label class="count_product"><strong>Total:</strong>3</label>
                                </div> -->
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row filter_data">
                                
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

        <script src="<?php echo base_url();?>assets/js/jquery-ui.1.12.0.js"></script>


        <script type="text/javascript">
    $(document).ready(function(){

        filter_data('<?php echo $brand_id;?>','<?php echo $keyword;?>','<?php echo $top_fif;?>','<?php echo $product_super_deal;?>','<?php echo $product_trending;?>');

        function filter_data(b_id,keyword,top_fifty,super_deal,trend_prod)
        {
            var brandid = b_id;
            var kword = keyword;
            var top_fif = top_fifty;
            
            
           $('.filter_data').html('<div id="loading" style="" ></div>');
            var action = 'fetch_data';
            //var minimum_price = $('#hidden_minimum_price').val();
            //var maximum_price = $('#hidden_maximum_price').val();
            var category_id       = $('#hidden_category_id').val();
            var sub_category_id   = $('#hidden_subcategory_id').val();
            var child_category_id = $('#hidden_childcategory_id').val();
            var price_range = $('#amount').val();
            //alert(price_range);
            var category = get_filter('prod_catg');
            //var size = get_filter('prod_size');
            //var pattern = get_filter('prod_pattern');
           
            var brand = get_filter('prod_brand');
            var brand_id = brandid;
            var keyword = kword;
            var sup_deal = super_deal;
            var trending_prod = trend_prod;
           // var color = get_filter('prod_color');
            //var availability = get_filter('prod_availble');

            $.ajax({
                url: jsBaseUrl+"product/fetch_data",
                method:"POST",
                data:{action:action,category:category,brand:brand,brand_id:brand_id,keyword:keyword,top_fifty:top_fifty,super_deals:sup_deal,trend_p:trending_prod,category_id:category_id,sub_category_id:sub_category_id,child_category_id:child_category_id,price_range:price_range},
               //data:{action:action,minimum_price:minimum_price, maximum_price:maximum_price,category:category,brand:brand},
                success:function(data){
                    //alert(data);
                    $('.loader').css('display','none');
                    $('.filter_data').html(data);
                    $('.count_product').html(data.total);
                }
            });

            
            // var ram = get_filter('ram');
            //var storage = get_filter('storage');
        }
        //var max_price = Math.round('<?php //echo $max_data['max'];?>');
        //max_price = round(max_price);
        //var min_price = Math.round('<?php //echo $min_data['min'];?>');
        //min_price = round(min_price);
         
        //console.log(max_price);

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
        min:<?php echo round($price_slider_data['min_price'])?>,
        max:<?php echo round($price_slider_data['max_price'])?>,
        values:[<?php echo round($price_slider_data['min_price'])?>, <?php echo round($price_slider_data['max_price'])?>],
        //step:50,
        stop:function(event, ui)
        {
            //console.log(ui.values);
            $('#amount').val(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

    

        

    });
</script>

<script type="text/javascript">
    function changePopularity()
    {

        var svalue = $("#short_by").val();
        var postData= {
            short:svalue,
            
        };
        $.post('<?php echo base_url()?>product/sort_data',postData,function(res){

            $('.loader').css('display','none');
            $('.filter_data').html(res);
            //$('.search-result-container').html(res);
        })
        
    }
</script>
<!-- <script type="text/javascript">
    
    $( function() {
        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 500,
            values: [ 75, 300 ],
            slide: function( event, ui ) {
                $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            }
        });
        $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
            " - $" + $( "#slider-range" ).slider( "values", 1 ) );
    } );
    </script> -->

        
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
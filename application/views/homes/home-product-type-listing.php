
<div class="content-page">
    <div class="container">
    <?php $product_type_list = $this->model->getAllData('km_product_type'); ?>
        <!-- featured category fashion -->
        <?php foreach ($product_type_list as $catkey => $product_type_value) {?>
        <div class="category-featured">
            <nav class="navbar nav-menu nav-menu-red show-brand">
              <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-brand"><a href="#"><img alt="fashion" src="<?php echo base_url();?>assets/data/fashion.png" /><?php echo $product_type_value['product_type_name']; ?></a></div>
                  <span class="toggle-menu"></span>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse">           
                  <ul class="nav navbar-nav">
                    <li class="active"><a data-toggle="tab" href="#tab-4">Best Seller</a></li>
                    <li><a data-toggle="tab" href="#tab-5">Most Viewed</a></li>
                    
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
              <div id="elevator-<?php echo $catkey; ?>" class="floor-elevator">
                    <a href="#elevator-<?php echo --$catkey-1; ?>" class="btn-elevator up disabled fa fa-angle-up"></a>
                    <a href="#elevator-<?php echo ++$catkey; ?>" class="btn-elevator down fa fa-angle-down"></a>
              </div>
            </nav>
          
           <div class="product-featured clearfix">
                
                <div class="product-featured-content">
                    <div class="product-featured-list">
                        <div class="tab-container">
                            <!-- tab product -->
                            <div class="tab-panel active" id="tab-4">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    
                                <?php 
                                    $CatProductList = $this->model->getData('km_product',array('product_type'=>$product_type_value['product_type_id'],'best_seller'=>'Y'));
                                    if(isset($CatProductList) && !empty($CatProductList)){

                                        foreach ($CatProductList as $cpkey => $best_seller_product) { ?>
                                            <li>
                                                <div class="left-block">
                                                    <?php $productImageUrl = FindImageURL($image_url,$best_seller_product['image1_link']);?> 
                                                    <a href="<?php echo base_url();?>product/description?id=<?php echo $best_seller_product['product_id']; ?>">
                                                        <img class="img-responsive" alt="product" src="<?php echo $productImageUrl;?>" />
                                                    </a>
                                                    <div class="quick-view">
                                                            <a title="Add to my wishlist" class="heart" href="#"></a>
                                                            <a title="Add to compare" class="compare" href="#"></a>
                                                            <a title="Quick view" class="search" href="#"></a>
                                                    </div>
                                                    <div class="add-to-cart" onclick="return addItemToCart(<?php echo $best_seller_product['product_id']; ?>);">
                                                        <a title="Add to Cart" href="javascript:void(0);">Add to Cart</a>
                                                    </div>
                                                </div>
                                                <div class="right-block">
                                                    <h5 class="product-name"><?php echo $best_seller_product['title']; ?></h5>
                                                    <div class="content_price">
                                                        <span class="price product-price"><?php echo ($best_seller_product['final_price']!='') ? '$'. number_format($best_seller_product['final_price'],2) : ''; ?></span>
                                                        <span class="price old-price"><?php echo ($best_seller_product['price']!='') ? '$'.$best_seller_product['price'] : ''; ?></span>
                                                    </div>
                                                    <div class="product-star">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </div>
                                            </li>
                                    <?php } 
                                    }else{ ?>

                                            <div class="left-block">
                                                <a href="javascript:void(0);">
                                                    <?php $product_img = base_url('assets/images').'/default_img.gif'; ?>
                                                    <img class="img-responsive" alt="product" src="<?php echo $product_img; ?>" />
                                                </a>
                                            </div>

                                    <?php } ?>
                                </ul>
                            </div>
                            <!-- tab product -->
                            <div class="tab-panel" id="tab-5">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                    
                                    <?php 
                                        $most_viewed_product_list = $this->model->getData('km_product',array('product_type'=>$product_type_value['product_type_id'],'most_viewed'=>'Y'));
                                        if(isset($most_viewed_product_list) && !empty($most_viewed_product_list)){

                                        foreach ($most_viewed_product_list as $cpkey => $most_viewed_product) { ?>
                                            <li>
                                                <div class="left-block">
                                                    <?php $productImageUrl = FindImageURL($image_url,$most_viewed_product['image1_link']);?> 
                                                    <a href="<?php echo base_url();?>product/description?id=<?php echo $most_viewed_product['product_id']; ?>">
                                                        <img class="img-responsive" alt="product" src="<?php echo $productImageUrl;?>" />
                                                    </a>
                                                    <div class="quick-view">
                                                            <a title="Add to my wishlist" class="heart" href="#"></a>
                                                            <a title="Add to compare" class="compare" href="#"></a>
                                                            <a title="Quick view" class="search" href="#"></a>
                                                    </div>
                                                    <div class="add-to-cart" onclick="return addItemToCart(<?php echo $most_viewed_product['product_id']; ?>);">
                                                        <a title="Add to Cart" href="javascript:void(0);">Add to Cart</a>
                                                    </div>
                                                </div>
                                                <div class="right-block">
                                                    <h5 class="product-name"><?php echo $most_viewed_product['title']; ?></h5>
                                                    <div class="content_price">
                                                        <span class="price product-price"><?php echo ($most_viewed_product['final_price']!='') ? '$'. number_format($most_viewed_product['final_price'],2) : ''; ?></span>
                                                    <span class="price old-price"><?php echo ($most_viewed_product['price']!='') ? '$'.$most_viewed_product['price'] : ''; ?></span>
                                                    </div>
                                                    <div class="product-star">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </div>
                                            </li>
                                    <?php } 

                                    }else{?>

                                            <div class="left-block">
                                                <a href="#">
                                                    <?php $product_img = base_url('assets/images').'/default_img.gif'; ?>
                                                    <img class="img-responsive" alt="product" src="<?php echo $product_img; ?>" />
                                                </a>
                                            </div>

                                    <?php } ?>

                                </ul>
                            </div>

                        </div>
                        
                    </div>
                </div>
           </div>
        </div>
        <?php } ?>
        <!-- end featured category fashion -->
        
    </div>
</div>
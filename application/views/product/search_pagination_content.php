<div class="row">
    <?php if(isset($get_fresh_product) && !empty($get_fresh_product)){
        foreach ($get_fresh_product as $pkey => $pvalue) { 
            $image_link = $this->model->getData('product_image',array('image_id'=>$pvalue['image_id'])); ?>
            <div class="col-md-2 col-sm-4 col-xs-12">
                <div class="item-product-filter">
                    <div class="product-thumb product-thumb6">
                        <div class="inner-product-thumb">
                            <a class="product-thumb-link" href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '_',$pvalue['product_name'])).'-'.$pvalue['product_id']; ?>">
                                <img alt="" src="<?php echo base_url();?>products/<?php echo $image_link[0]['image_name']; ?>" class="first-thumb">
                            </a>
                            <div class="product-info-cart">
                                <a class="addcart-link" href="javascript:void(0);" onclick="return addItemToCart(<?php echo $pvalue['product_id']; ?>,'1');"><i class="fa fa-shopping-cart"></i> Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="product-info6">
                        <h3 class="title-product"><a href="javascript:void(0);"><?php echo $pvalue['product_name']; ?></a></h3>
                        <div class="info-price">
                            <span>Rs. <?php echo $pvalue['price']; ?></span>
                            <?php if($pvalue['old_price']!=""){ ?><del>Rs. <?php echo $pvalue['old_price']; ?></del><?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    } ?>
</div>
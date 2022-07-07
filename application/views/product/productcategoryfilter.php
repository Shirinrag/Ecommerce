<?php if(isset($product_data) && !empty($product_data)){ 
                                    foreach ($product_data as $key => $pvalue) {?>
                                    <div class="col-4">
                                        <div class="products">
                                            <div class="product-short-info product-info">
                                                <div>
                                                    <?php $minus = (float)$product_data[0]['mrp'] - (float)$product_data[0]['price']; ?>
                                                    <?php $divide   = $minus/(float)$product_data[0]['mrp']*100; ?>
                                                    <div class="p-discount" style="background-color: #00bfbf;"><?php echo round($divide);?>% OFF</div>
                                                    <?php if($pvalue['stock_status']=='0'){ ?>
                                                        <div class="out-of-stock-label ab11">SOLD OUT</div>
                                                    <?php } ?>
                                                    <div class="product-img">
                                                        <a href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '-',$pvalue['product_name'])).'-'.$pvalue['product_id']; ?>">
                                                            <?php if(!empty($pvalue['image_name'])){?>
                                                                <img width="370" height="370" src="<?php echo base_url();?>products/<?php echo $pvalue['image_name']; ?>" class="attachment-shop_single size-shop_single wp-post-image" alt="<?php echo $pvalue['product_name']; ?>">
                                                            <?php }else{?> 
                                                                <img width="370" height="370" class="attachment-shop_single size-shop_single wp-post-image" src="<?php echo base_url();?>assets/images/no-image.png">
                                                            <?php }?>
                                                        </a>
                                                    </div>
                                                    <div class="product-desc">
                                                        <h4 class="text-truncate">
                                                            <a href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '-',$pvalue['product_name'])).'-'.$pvalue['product_id']; ?>">
                                                                <?php echo ucwords($pvalue['product_name']); ?>
                                                            </a>
                                                        </h4>
                                                        <br>
                                                        <span class="variant-rating-count" style="display: block;"><div class="review-stars"><div class="rtng-usr"></div></div><div class="review-count">(No Ratings)</div></span>
                                                        <input type="hidden" class="qty" value="1">
                                                        <input type="hidden" class="pack_size" value="<?php echo $pvalue['pack_sizes'][0]['pack_size']; ?>">
                                                        <input type="hidden" class="price" value="<?php echo (float)$pvalue['price']; ?>">
                                                        <div class="product-price "><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span> <?php echo $pvalue['mrp']; ?></span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span><span class="search_PSellingP"> <?php echo $pvalue['price']; ?></span></span></ins></div>
                                                    </div>
                                                    <p class="text-center">
                                                        <?php if($pvalue['stock_status']=='1'){ ?>
                                                                <a href="javascript:void(0)">
                                                                    <button class="btn btn-primary3" style="color:#fff;" onclick="return addItemToCart(this,<?php echo $pvalue['product_id']; ?>,1);">Add To Cart</button>
                                                                </a>&nbsp;&nbsp;
                                                        <?php } else { ?>

                                                            <a href="javascript:void(0)">
                                                                <button class="btn btn-primary3" style="color:#fff;">OUT OF STOCK</button>
                                                            </a>

                                                        <?php } ?>
                                                            <a href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '-',$pvalue['product_name'])).'-'.$pvalue['product_id']; ?>">
                                                                <button class="btn btn-primary3" style="color:#fff;">View More</button>
                                                            </a>

                                                    </p>
                                                    <br>
                                                    <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
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
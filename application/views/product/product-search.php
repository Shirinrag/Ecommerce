<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li>Searched for: <?php echo $product_name; ?></li>
            </ul>
        </div>
    </div>
</div>
<div class="body-content outer-top-xs outer-bottom-xs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-12'>
                 <div class="search-result-container ">
                    <div id="myTabContent" class="tab-content category-list">
                        <div class="tab-pane active " id="grid-container">
                            <div class="category-product">
                                <div class="row">
                                    <?php if(isset($product_data) && !empty($product_data)){ 
                                        foreach ($product_data as $key => $pvalue) {?>
                                            <div class="col-sm-6 col-md-3 wow fadeInUp clearfix">
                                                <div class="products">
                                                    <div class="product">       
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '-',$pvalue['product_name'])).'-'.$pvalue['product_id']; ?>">
                                                                    <img src="<?php echo base_url();?>products/<?php echo $pvalue['image_name']; ?>" alt="<?php echo $pvalue['product_name']; ?>">
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="product-info text-left">
                                                            <h3 class="name">
                                                                <a href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '-',$pvalue['product_name'])).'-'.$pvalue['product_id']; ?>">
                                                                    <?php echo ucwords($pvalue['product_name']); ?>
                                                                </a>
                                                            </h3>
                                                            <div class="description"></div>
                                                            <div class="product-price" style="text-align: center;">
                                                                <!-- <select class="form-control qty" data-placeholder="select Qty" name="pqty" onchange="return qty_price(this,'<?php echo $pvalue['unit_id'];?>','<?php echo $pvalue['price']; ?>');">
                                                                   <?php echo get_product_drpdwn_qty($pvalue['unit_id']); ?>
                                                                </select> -->
                                                                <select name="pack_size" class="form-control" onchange="set_pack_price(this)">
                                                                    <?php foreach($pvalue['pack_sizes'] as $key1 => $value){?>
                                                                        <option value="<?php echo $value['pack_size'].",".$value['price'];?>"><?php echo $value['pack_size']." ".$pvalue['unit_name'];?></option>
                                                                    <?php }?>
                                                                </select>
                                                                <!-- <input type="number" class="form-control qty" onchange="set_qty_price(this)" value="1"> -->
                                                                <input type="hidden" class="pack_size" value="<?php echo $pvalue['pack_sizes'][0]['pack_size']; ?>">
                                                                <input type="hidden" class="price" value="<?php echo (float)$pvalue['price']; ?>">
                                                            </div> <br>
                                                            <div class="qty_row">
                                                                <a><i class="fa fa-plus" onclick="addQty(this)"></i></a>
                                                                <input type="text" class="qty" value="1" onkeyup="set_qty_price(this)" value="1">
                                                                <a><i class="fa fa-minus" onclick="reduceQty(this)"></i></a>
                                                            </div>
                                                            <div class="productvariantdiv">
                                                                <span class="WebRupee">Rs </span> <span class="search_PSellingP"> <?php echo (float)$pvalue['price']; ?></span>
                                                            </div>
                                                        </div>

                                                        <?php if($pvalue['stock_status']=='1'){ ?>
                                                            <div align="left" class="productlist-price">
                                                                <a href="javascript:void(0);" class="btn btn-primary" onclick="return addItemToCart(this,<?php echo $pvalue['product_id']; ?>,'1');"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>
                                                            </div>
                                                        <?php }else{?>
                                                            <div class="product-info-cart">
                                                                <a class="addcart-link btn btn-primary bgred" href="javascript:void(0);"><i class="fa fa-shopping-cart"></i> OUT OF STOCK</a>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php }
                                    }else{ ?>
                                        <div class="col-sm-12"> 
                                          
                                            <img class="img-responsive" src="<?php echo base_url();?>assets/images/coming-soon-page-large.png">
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>


                    </div>                           
                </div>

            </div>
        </div>
    </div>
</div>
<?php include_once(APPPATH.'views/includes/footer.php'); ?>


<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-hover-dropdown.min.js"></script>
<script src="<?php echo base_url();?>assets/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url();?>assets/js/echo.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.easing-1.3.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-slider.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.rateit.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/lightbox.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
<script src="<?php echo base_url();?>assets/js/scripts.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/peekABar/js/jquery.peekabar.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/direct_farm.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/google_tracker.js"></script>

</body>
</html>
 <div class="col-xs-12 col-sm-12 col-md-4 sidebar">

    <!-- <div class=" outer-bottom-xs">
        <img src="<?php echo base_url();?>assets/images/banners/LHS-banner.jpg" alt="Image">
    </div> -->
                 
    <?php 
    $supder_deal_products = $this->model->getData('product',array('listed_in_super_deal'=>'1','status'=>'1'));
        foreach ($supder_deal_products as $key => $value) {
            if(empty($value['pack_size'])) {
                $value['pack_size'] = "1";
            }
            $pack_sizes = explode(',', $value['pack_size']);
            $prices = explode(',', $value['price']);
            $unit_name = $this->model->getValue('product_unit','unit_name',array('unit_id'=>$value['unit_id']));

            $pack_sizes2 = [];
            foreach ($pack_sizes as $key1 => $value1) {
                if(isset($prices[$key1])){
                    $pack_sizes2[] = array(
                        'pack_size'=> $value1,
                        'price'=> $prices[$key1]
                    );
                }
            }
            $supder_deal_products[$key]['pack_sizes']= $pack_sizes2;
            $supder_deal_products[$key]['unit_name']= $unit_name;
        }

    if(isset($supder_deal_products) && !empty($supder_deal_products)){ 
        $su_product = array();
        $su_product = array_chunk($supder_deal_products,3,true); ?>                
        <div class="sidebar-widget outer-bottom-small wow fadeInUp">
            <h3 class="section-title">Super Deal</h3>
            <div class="sidebar-widget-body outer-top-xs">
                <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                    
                <?php foreach ($su_product as $sup_key => $sup_value) { ?>
                    <div class="item">
                        
                        <?php foreach ($sup_value as $pkey => $pvalue) { ?>
                            <div class="products special-product">
                                <div class="product">
                                    <div class="product-micro">
                                        <div class="row product-micro-row">
                                            <div class="col col-xs-5">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="<?php echo base_url();?>product/detailing/<?php echo strtolower(preg_replace('/\s+/', '-',$pvalue['product_name'])).'-'.$pvalue['product_id']; ?>">
                                                            <img  style="height:90px;" src="<?php echo base_url();?>products/<?php echo $pvalue['image_name']; ?>" alt="<?php echo $pvalue['product_name']; ?>">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col col-xs-6">
                                                <div class="product-info">
                                                    <h3 class="name"><a href="#"><?php echo $pvalue['product_name']; ?></a></h3>
                                                    <div class="product-price">
                                                       <!--  <select class="form-control qty" data-placeholder="select Qty" name="pqty" onchange="return qty_price(this,'<?php echo $pvalue['unit_id'];?>','<?php echo $pvalue['price']; ?>');">
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
                                                    </div> 
                                                     <br>
                                                    <div class="qty_row">
                                                        <a><i class="fa fa-plus" onclick="addQty(this)"></i></a>
                                                        <input type="text" class="qty" value="1" onkeyup="set_qty_price(this)" value="1">
                                                        <a><i class="fa fa-minus" onclick="reduceQty(this)"></i></a>
                                                    </div>
                                                    <div class="productvariantdiv">
                                                        <span class="WebRupee">Rs </span> <span class="search_PSellingP"> <?php echo $pvalue['price']; ?></span>
                                                    </div>
                                                </div>

                                                <?php if($pvalue['stock_status']=='1'){ ?>
                                                    <a href="javascript:void(0);" class="btn btn-primary" onclick="return addItemToCart(this,<?php echo $pvalue['product_id']; ?>,'1');"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>
                                                <?php }else{?>
                                                    <a class="btn btn-danger" href="javascript:void(0);"><i class="fa fa-shopping-cart inner-right-vs"></i> OUT OF STOCK</a>
                                                    
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                 <?php } ?>
                   
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
        <h3 class="section-title">Newsletters</h3>
        <div class="sidebar-widget-body outer-top-xs">
            <p>Sign Up for Our Newsletter!</p>
            <form role="form" name="frm_subsription" id="frm_subsription" onsubmit="return subscribe_me(this);">
                <div class="form-group">
                    <div class="alert alert-success" style="display:none;text-align: center;"></div>
                    <div class="alert alert-danger" style="display:none;text-align: center;"></div>
                    <label class="sr-only" for="exampleInputEmail1">Enter Email address</label>
                    <input type="text" class="form-control" name="subscription_id" id="subscription_id" placeholder="">
                </div>
                <button class="btn btn-primary">Subscribe</button>
            </form>
        </div>
    </div>

    
</div>
<?php
      $curl=$this->link->hits('get-language',array(),'',0,'',0);
      $curl = json_decode($curl,true);
      $lang_name = $curl['lang_name'];

      $curl1=$this->link->hits('get_dynamic_menu','1');
      $curl1 = json_decode($curl1,true);
      $data['cat_data'] = $curl1['cat_data'];
?>
<header id="header" class=" typeheader-1">
   <!-- Header Top -->
   <div class="header-top hidden-compact">
      <div class="container">
         <div class="row">
            <div class="header-top-left col-lg-12 col-md-8 col-sm-6 col-xs-4">
               <ul class="top-link list-inline hidden-lg hidden-md">
                  <li class="account" id="my_account">
                     <a href="#" title="My Account " class="btn-xs dropdown-toggle" data-toggle="dropdown"> <span class="hidden-xs">My Account </span>  <span class="fa fa-caret-down"></span>
                     </a>
                     <ul class="dropdown-menu ">
                        <li><a href="Account/registration"><i class="fa fa-user"></i> Register</a></li>
                        <li><a href="<?php echo base_url();?>Account/login"><i class="fa fa-pencil-square-o"></i> Login</a></li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="header-top-right collapsed-block col-lg-5 col-md-4 col-sm-6 col-xs-8">
               <ul class="top-link list-inline lang-curr">
                  <li class="language">
                     <div class="btn-group languages-block ">                       
                              <select class="form-control select2" id="fk_lang_id"><?php 
                                    foreach ($lang_name as $lang_name_key => $lang_name_row) { ?>
                                       <option value="<?= $lang_name_row['id']?>"><?= $lang_name_row['lang_name']?></option>
                                    <?php } ?>
                              </select>                           
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <!-- //Header Top -->
   <!-- Header center -->
   <div class="header-middle">
      <div class="container">
         <div class="row">
            <!-- Logo -->
            <div class="navbar-logo col-lg-2 col-md-2 col-sm-12 col-xs-12">
               <div class="logo"><a href="index-2.html"><img src="<?php echo base_url();?>assets_frontend/image/logo.png" title="Your Store" alt="Your Store" style="margin-top: -40px !important;" /></a></div>
            </div>
            <!-- //end Logo -->
            <!-- Main menu -->
            <div class="main-menu col-lg-6 col-md-7 ">
               <div class="responsive so-megamenu megamenu-style-dev">
                  <nav class="navbar-default">
                     <div class=" container-megamenu  horizontal open ">
                        <div class="navbar-header">
                           <button type="button" id="show-megamenu" data-toggle="collapse" class="navbar-toggle">
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           </button>
                        </div>
                        <div class="megamenu-wrapper">
                           <span id="remove-megamenu" class="fa fa-times"></span>
                           <div class="megamenu-pattern">
                              <div class="container-mega">
                                 <ul class="megamenu" data-transition="slide" data-animationtime="250">
                                    <li class="home ">
                                       <a href="<?php echo base_url(); ?>">
                                          Home <!-- <b class="caret"></b> -->
                                       </a>
                                       <div class="sub-menu" style="width:100%;" >
                                          <div class="content" >
                                             <div class="row">
                                                <div class="col-md-3">
                                                   <a href="index-2.html" class="image-link">
                                                      <span class="thumbnail">
                                                      <img class="img-responsive img-border" src="<?php echo base_url();?>assets_frontend/image/catalog/menu/home-1.jpg" alt="">
                                                      </span> 
                                                      <h3 class="figcaption">Home page - (Default)</h3>
                                                   </a>
                                                </div>
                                                <div class="col-md-3">
                                                   <a href="home2.html" class="image-link">
                                                      <span class="thumbnail">
                                                      <img class="img-responsive img-border" src="<?php echo base_url();?>assets_frontend/image/catalog/menu/home-2.jpg" alt="">
                                                      </span> 
                                                      <h3 class="figcaption">Home page - Layout 2</h3>
                                                   </a>
                                                </div>
                                                <div class="col-md-3">
                                                   <a href="home3.html" class="image-link">
                                                      <span class="thumbnail">
                                                      <img class="img-responsive img-border" src="<?php echo base_url();?>assets_frontend/image/catalog/menu/home-3.jpg" alt="">
                                                      </span> 
                                                      <h3 class="figcaption">Home page - Layout 3</h3>
                                                   </a>
                                                </div>
                                                <div class="col-md-3">
                                                   <a href="home4.html" class="image-link">
                                                      <span class="thumbnail">
                                                      <img class="img-responsive img-border" src="<?php echo base_url();?>assets_frontend/image/catalog/menu/home-4.jpg" alt="">
                                                      </span> 
                                                      <h3 class="figcaption">Home page - Layout 4</h3>
                                                   </a>
                                                </div>
                                                <!-- <div class="col-md-15">
                                                   <a href="#" class="image-link"> 
                                                       <span class="thumbnail">
                                                           <img class="img-responsive img-border" src="image/demo/feature/comming-soon.png" alt="">
                                                           
                                                       </span> 
                                                       <h3 class="figcaption">Comming soon</h3> 
                                                   </a> 
                                                   
                                                   </div> -->
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                    <li class="with-sub-menu hover">
                                       <p class="close-menu"></p>
                                      <a href="#" class="clearfix">
                                          <strong>Features</strong>
                                          <img class="label-hot" src="<?php echo base_url();?>assets_frontend/image/catalog/menu/new-icon.png" alt="icon items">
                                          <b class="caret"></b>
                                          </a> 
                                       <div class="sub-menu" style="width: 100%; right: auto;">
                                          <div class="content" >
                                             <div class="row">
                                                <div class="col-md-3">
                                                   <div class="column">
                                                      <a href="#" class="title-submenu">Listing pages</a>
                                                      <div>
                                                         <ul class="row-list">
                                                            <li><a href="<?php echo base_url(); ?>Category">Category Page 1 </a></li>
                                                           <!--  <li><a href="category-v2.html">Category Page 2</a></li>
                                                            <li><a href="category-v3.html">Category Page 3</a></li> -->
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-md-3">
                                                   <div class="column">
                                                      <a href="#" class="title-submenu">Product pages</a>
                                                      <div>
                                                         <ul class="row-list">
                                                            <li><a href="<?php echo base_url();?>Productdetails">Product page 1</a></li>
                                                           <!--  <li><a href="product-v2.html">Product page 2</a></li> -->
                                                            <!-- <li><a href="product-v3.html">Image size - small</a></li> -->
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-md-3">
                                                   <div class="column">
                                                      <a href="#" class="title-submenu">Shopping pages</a>
                                                      <div>
                                                         <ul class="row-list">
                                                            <li><a href="<?php echo base_url();?>Cart">Shopping Cart Page</a></li>
                                                            <li><a href="<?php echo base_url();?>Checkout">Checkout Page</a></li>
                                                            <!-- <li><a href="compare.html">Compare Page</a></li> -->
                                                            <li><a href="<?php echo base_url();?>Wishlist">Wishlist Page</a></li>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-md-3">
                                                   <div class="column">
                                                      <a href="#" class="title-submenu">My Account pages</a>
                                                      <div>
                                                         <ul class="row-list">
                                                            <li><a href="<?php echo base_url(); ?>Account/login">Login Page</a></li>
                                                            <li><a href="<?php echo base_url(); ?>Account/registration">Register Page</a></li>
                                                            <li><a href="<?php echo base_url(); ?>Account">My Account</a></li>
                                                            <li><a href="<?php echo base_url(); ?>Orderhistory">Order History</a></li>
                                                            <li><a href="<?php echo base_url(); ?>Orderhistory/orderinfo">Order Information</a></li>
                                                          <!--   <li><a href="return.html">Product Returns</a></li>
                                                            <li><a href="gift-voucher.html">Gift Voucher</a></li> -->
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                    <li class="with-sub-menu hover">
                                       <p class="close-menu"></p>
                                       <!--  <a href="#" class="clearfix">
                                          <strong>Pages</strong>
                                          <b class="caret"></b>
                                          </a> -->
                                       <div class="sub-menu" style="width: 40%; ">
                                          <div class="content" >
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <ul class="row-list">
                                                      <li><a class="subcategory_item" href="faq.html">FAQ</a></li>
                                                      <li><a class="subcategory_item" href="sitemap.html">Site Map</a></li>
                                                      <li><a class="subcategory_item" href="contact.html">Contact us</a></li>
                                                      <li><a class="subcategory_item" href="banner-effect.html">Banner Effect</a></li>
                                                   </ul>
                                                </div>
                                                <div class="col-md-6">
                                                   <ul class="row-list">
                                                      <li><a class="subcategory_item" href="about-us.html">About Us 1</a></li>
                                                      <li><a class="subcategory_item" href="about-us-2.html">About Us 2</a></li>
                                                      <li><a class="subcategory_item" href="about-us-3.html">About Us 3</a></li>
                                                      <li><a class="subcategory_item" href="about-us-4.html">About Us 4</a></li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                    <li class="with-sub-menu hover">
                                       <p class="close-menu"></p>
                                       <a href="#" class="clearfix">
                                       <strong>Categories</strong>
                                       <img class="label-hot" src="<?php echo base_url();?>assets_frontend/image/catalog/menu/hot-icon.png" alt="icon items">
                                       <b class="caret"></b>
                                       </a>
                                       <div class="sub-menu" style="width: 100%; display: none;">
                                          <div class="content">
                                             
                                             <div class="row">
                                              
                                                <div class="col-md-3">
                                                   <a href="#" class="title-submenu">Electronics</a>
                                                   <div class="row">
                                                      <div class="col-md-12 hover-menu">
                                                         <div class="menu">
                                                            <ul>
                                                               <li><a href="#"  class="main-menu">Car Alarms and Security</a></li>
                                                               <li><a href="#"  class="main-menu">Car Audio &amp; Speakers</a></li>
                                                               <li><a href="#"  class="main-menu">Gadgets &amp; Auto Parts</a></li>
                                                               <li><a href="#"  class="main-menu">More Car Accessories</a></li>
                                                            </ul>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                               
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                    <li class="">
                                       <p class="close-menu"></p>
                                       <!-- <a href="#" class="clearfix">
                                       <strong>Accessories</strong>
                                       </a> -->
                                    </li>
                                    <li class="">
                                       <p class="close-menu"></p>
                                       <a href="<?php echo base_url(); ?>Blog" class="clearfix">
                                       <strong>Blog</strong>
                                       <span class="label"></span>
                                       </a>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </nav>
               </div>
            </div>
            <!-- //end Main menu -->
            <div class="middle-right col-lg-4 col-md-3 col-sm-6 col-xs-8">
               <div class="signin-w  hidden-sm hidden-xs">
                  <ul class="signin-link blank">
                     <li class="log login"><i class="fa fa-lock"></i> <a class="link-lg" href="<?php echo base_url(); ?>Account/login">Login </a> or <a href="<?php echo base_url(); ?>Account/registration">Register</a></li>
                  </ul>
               </div>
               <div class="telephone hidden-xs hidden-sm hidden-md">
                  <ul class="blank">
                     <li><a href="#"><i class="fa fa-truck"></i>track your order</a></li>
                     <li><a href="#"><i class="fa fa-phone-square"></i>Hotline 66655674</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- //Header center -->
   <!-- Header Bottom -->
   <div class="header-bottom hidden-compact">
      <div class="container">
         <div class="row">
            <!-- Search -->
            <div class="bottom2 col-lg-7 col-md-6 col-sm-6">
               <div class="search-header-w">
                  <div class="icon-search hidden-lg hidden-md hidden-sm"><i class="fa fa-search"></i></div>
                  <div id="sosearchpro" class="sosearchpro-wrapper so-search ">
                     <form method="GET" action="https://demo.smartaddons.com/templates/html/emarket/index.html">
                        <div id="search0" class="search input-group form-group">
                           <!-- <div class="select_category filter_type  icon-select hidden-sm hidden-xs">
                              <select class="no-border" name="category_id">
                                 <option value="0">All Categories</option>
                                 <option value="78">Apparel</option>
                                 <option value="77">Cables &amp; Connectors</option>
                                 <option value="82">Cameras &amp; Photo</option>
                                 <option value="80">Flashlights &amp; Lamps</option>
                                 <option value="81">Mobile Accessories</option>
                                 <option value="79">Video Games</option>
                                 <option value="20">Jewelry &amp; Watches</option>
                                 <option value="76">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Earings</option>
                                 <option value="26">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Wedding Rings</option>
                                 <option value="27">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Men Watches</option>
                              </select>
                           </div> -->
                           <input class="autosearch-input form-control" type="text" value="" size="50" autocomplete="off" placeholder="Keyword here..." name="search">
                           <span class="input-group-btn">
                           <button type="submit" class="button-search btn btn-primary" name="submit_search"><i class="fa fa-search"></i></button>
                           </span>
                        </div>
                        <input type="hidden" name="route" value="product/search" />
                     </form>
                  </div>
               </div>
            </div>
            <!-- //end Search -->
            <!-- Secondary menu -->
            <div class="bottom3 col-lg-3 col-md-3 col-sm-3">
               <!--cart-->
               <div class="shopping_cart">
                  <div id="cart" class="btn-shopping-cart">
                     <a data-loading-text="Loading... " class="btn-group top_cart dropdown-toggle" data-toggle="dropdown" aria-expanded="true" >
                        <div class="shopcart">
                           <span class="icon-c">
                           <i class="fa fa-shopping-bag"></i>
                           </span>
                           <div class="shopcart-inner">
                              <p class="text-shopping-cart">
                                 My cart
                              </p>
                              <span class="total-shopping-cart cart-total-full">
                              <span class="items_cart">02</span><span class="items_cart2"> item(s)</span><span class="items_carts"> - $162.00 </span>
                              </span>
                           </div>
                        </div>
                     </a>
                     <ul class="dropdown-menu pull-right shoppingcart-box" role="menu">
                        <li>
                           <table class="table table-striped">
                              <tbody>
                                 <tr>
                                    <td class="text-center" style="width:70px">
                                       <a href="product.html">
                                       <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/80/1.jpg" style="width:70px" alt="Yutculpa ullamcon" title="Yutculpa ullamco" class="preview">
                                       </a>
                                    </td>
                                    <td class="text-left"> <a class="cart_product_name" href="product.html">Yutculpa ullamco</a> 
                                    </td>
                                    <td class="text-center">x1</td>
                                    <td class="text-center">$80.00</td>
                                    <td class="text-right">
                                       <a href="product.html" class="fa fa-edit"></a>
                                    </td>
                                    <td class="text-right">
                                       <a onclick="cart.remove('2');" class="fa fa-times fa-delete"></a>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="text-center" style="width:70px">
                                       <a href="product.html">
                                       <img src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/80/2.jpg" style="width:70px" alt="Xancetta bresao" title="Xancetta bresao" class="preview">
                                       </a>
                                    </td>
                                    <td class="text-left"> <a class="cart_product_name" href="product.html">Xancetta bresao</a> 
                                    </td>
                                    <td class="text-center">x1</td>
                                    <td class="text-center">$60.00</td>
                                    <td class="text-right">
                                       <a href="product.html" class="fa fa-edit"></a>
                                    </td>
                                    <td class="text-right">
                                       <a onclick="cart.remove('1');" class="fa fa-times fa-delete"></a>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </li>
                        <li>
                           <div>
                              <table class="table table-bordered">
                                 <tbody>
                                    <tr>
                                       <td class="text-left"><strong>Sub-Total</strong>
                                       </td>
                                       <td class="text-right">$140.00</td>
                                    </tr>
                                    <tr>
                                       <td class="text-left"><strong>Eco Tax (-2.00)</strong>
                                       </td>
                                       <td class="text-right">$2.00</td>
                                    </tr>
                                    <tr>
                                       <td class="text-left"><strong>VAT (20%)</strong>
                                       </td>
                                       <td class="text-right">$20.00</td>
                                    </tr>
                                    <tr>
                                       <td class="text-left"><strong>Total</strong>
                                       </td>
                                       <td class="text-right">$162.00</td>
                                    </tr>
                                 </tbody>
                              </table>
                              <p class="text-right"> <a class="btn view-cart" href="<?php echo base_url();?>Cart"><i class="fa fa-shopping-cart"></i>View Cart</a>&nbsp;&nbsp;&nbsp; <a class="btn btn-mega checkout-cart" href="checkout.html"><i class="fa fa-share"></i>Checkout</a> 
                              </p>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
               <!--//cart-->
               <ul class="wishlist-comp hidden-md hidden-sm hidden-xs">
                  <li class="compare hidden-xs"><a href="#" class="top-link-compare" title="Compare "><i class="fa fa-refresh"></i></a>
                  </li>
                  <li class="wishlist hidden-xs"><a href="#" id="wishlist-total" class="top-link-wishlist" title="Wish List (0) "><i class="fa fa-heart"></i></a>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</header>
<!-- //Header Container 
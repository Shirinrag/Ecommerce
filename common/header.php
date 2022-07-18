<?php
   $curl=$this->link->hits('get-language',array(),'',0,'',0);
   $curl = json_decode($curl,true);
   $lang_name = $curl['lang_name'];
   
   $session_data = $this->session->userdata('logged_in');
   $user_id=$this->session->userdata('user_logged_in')['op_user_id'];  
   $curl_data = array('fk_lang_id' =>$session_data['lang_id'],'user_id'=>$user_id);
   $curl1=$this->link->hits('get-dynamic-menu',$curl_data);
   $curl1 = json_decode($curl1,true);
   $cat_data = $curl1['cat_data'];
   $wishlist_count=$curl1['wishlist_count'];
   $cart_count=$curl1['cart_count'];
   
   $curldata=array('user_id'=>$user_id,'fk_lang_id'=>$session_data['lang_id']);
   $curl=$this->link->hits('get-all-user-cart',$curldata); 
   $curls_data=json_decode($curl,true);
   $cart_data=$curls_data['cart_data'];
   $cart_total_sum=$curls_data['sub_total'];
   //  echo "<pre>";
   //  print_r($cart_data);die();
   ?>
<header id="header" class=" typeheader-1">
   <!-- Header Top -->
   <div class="header-top hidden-compact">
      <div class="container">
         <div class="row">
            <div class="header-top-left col-lg-12 col-md-8 col-sm-6 col-xs-4">
               <ul class="top-link list-inline hidden-lg hidden-md">
                  <li class="account" id="my_a  ccount">
                     <a href="#" title="My Account " class="btn-xs dropdown-toggle" data-toggle="dropdown"> <span class="hidden-xs">My Account </span>  <span class="fa fa-caret-down"></span>
                     </a>
                     <ul class="dropdown-menu ">
                        <li><a href="Frontend/registration"><i class="fa fa-user"></i> Register</a></li>
                        <li><a href="<?php echo base_url();?>Frontend/login"><i class="fa fa-pencil-square-o"></i> Login</a></li>
                     </ul>
                  </li>
               </ul>
            </div>
            <div class="header-top-right collapsed-block col-lg-5 col-md-4 col-sm-6 col-xs-8">
               <ul class="top-link list-inline lang-curr">
                  <li class="language">
                     <div class="btn-group languages-block ">
                        <select class="form-control select2" id="fk_lang_id">
                           <?php 
                              foreach ($lang_name as $lang_name_key => $lang_name_row) { ?>
                           <option value="<?= $lang_name_row['id']?>" <?php $session_data=$this->session->userdata('logged_in'); if($session_data['lang_id'] == $lang_name_row['id']){ ?> selected=selected <?php } ?>><?= $lang_name_row['lang_name']?></option>
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
            <div class="logo"><a href="<?php echo base_url(); ?>Frontend"><img src="<?php echo base_url();?>assets_frontend/image/logo.png" title="Your Store" alt="Your Store" style="margin-top: -40px !important;" /></a></div>
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
                                    <a href="<?php echo base_url(); ?>Frontend">
                                       Home <!-- <b class="caret"></b> -->
                                    </a>
                                    <div class="sub-menu" style="width:100%;left:-100px !important" >
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
                                 <li class="with-sub-menu hover" >
                                    <p class="close-menu"></p>
                                    <!--  <a href="#" class="clearfix">
                                       <strong>Pages</strong>
                                       <b class="caret"></b>
                                       </a> -->
                                    <div class="sub-menu" style="width: 40%;">
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
                                 <li class="with-sub-menu hover" style="left:-100px !important">
                                    <p class="close-menu"></p>
                                    <a href="#" class="clearfix">
                                    <strong>Categories</strong>
                                    <img class="label-hot" src="<?php echo base_url();?>assets_frontend/image/catalog/menu/hot-icon.png" alt="icon items">
                                    <b class="caret"></b>
                                    </a>
                                    <div class="sub-menu" style="width: 100%; display: none;left:-150px !important">
                                       <div class="content">
                                          <div class="row">
                                             <?php  foreach($cat_data as $cat_data_key => $cat_data_row){?>
                                             <div class="col-md-3">
                                                <a href="<?php echo base_url().'Frontend/category?catid='.$cat_data_row['category_id']; ?>" class="title-submenu"><?php echo $cat_data_row['category_name'] ?></a>
                                                <div class="row">
                                                   <div class="col-md-12 hover-menu">
                                                      <div class="menu">
                                                         <ul>
                                                            <?php 
                                                               $dump_key=0;
                                                               
                                                               foreach($cat_data_row['child_name'] as $key1 => $ch){
                                                               
                                                               $dump_key=$dump_key+1;
                                                               $sub_id=explode('_',$key1);
                                                               // echo "<pre>";print_r($sub_id);
                                                               
                                                               //    if(!empty($cat_data_row['child_name'][$key1])){
                                                               //       $class_name ='menu-item-has-children';
                                                               //   }else{
                                                               //       $class_name ="";
                                                               //   }
                                                               
                                                               ?>
                                                            <li>
                                                               <?php if ($dump_key==1) { ?>
                                                               <?php } ?>
                                                               <a href=""><?=$sub_id[0];?></a>
                                                               <ul class="sub-menu">
                                                                  <?php  foreach($cat_data_row['child_name'][$key1] as $s){?>
                                                                  <li class="menu-item-has-children"><a href=""><?=$s['child_category_name'];?></a>
                                                                  </li>
                                                                  <?php }?>
                                                               </ul>
                                                            </li>
                                                            <?php }?>
                                                         </ul>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <?php } ?>
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
                  <?php 
                     $user_session_data=$this->session->userdata('user_logged_in'); 
                     if(empty($user_session_data)){ ?>
                  <li class="log login"><i class="fa fa-lock"></i> <a class="link-lg" href="<?php echo base_url(); ?>Frontend/login">Login </a> or <a href="<?php echo base_url(); ?>Frontend/registration">Register</a></li>
                  <?php }else{ ?>
                  <span><strong><?=$user_session_data['user_name']?></strong></span> | <a href="<?php echo base_url();?>Frontend/logout" style="font-size: 15px; color: #fd7e14; width: 20% !important;"><span ><strong>Logout</strong></span></a>
                  <?php }
                     ?>
                  <li class="nav-item dropdown">
                     <?php if(!empty($user_session_data)){ ?>
                     <a href="#" class="nav-link dropdown-toggle newdrop" data-bs-toggle="dropdown">
                        <div class="cart-block">
                           <div class="cart-icon" style="margin-top: -30px !important;margin-left: -30px;!important">
                              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="Icon-sc-1iwi4w1-0 cHrYdI hover" mr="8" iconsize="20" style="width: 25px !important;">
                                 <g clip-path="url(#user_svg__clip0)">
                                    <path d="M15.316 13.016c1.512-1.058 2.516-2.797 2.516-4.784A5.835 5.835 0 0012 2.4a5.835 5.835 0 00-5.832 5.832 5.79 5.79 0 002.517 4.784C4.343 14.291 1.2 17.996 1.2 22.37v.022c0 .896.843 1.609 1.825 1.609h17.95c.983 0 1.825-.713 1.825-1.61v-.02c0-4.375-3.143-8.08-7.484-9.354zM7.853 8.232a4.148 4.148 0 018.294 0 4.148 4.148 0 01-8.294 0zm13.122 14.083H3.025a.245.245 0 01-.14-.032c.054-4.45 4.126-8.057 9.115-8.057 4.99 0 9.05 3.596 9.115 8.057a.245.245 0 01-.14.032z" fill="#333"></path>
                                 </g>
                                 <defs>
                                    <clipPath id="user_svg__clip0">
                                       <path fill="#fff" transform="translate(1.2 2.4)" d="M0 0h21.6v21.6H0z"></path>
                                    </clipPath>
                                 </defs>
                              </svg>
                           </div>
                           <?php //if ($this->session->userdata('user_data')!="") {?>
                           <div class="cart-item" style="width: 80px;white-space: nowrap;
                              overflow: hidden;
                              text-overflow: ellipsis;"><?php echo $admin_rs[0]['firstname']; ?></div>
                           <?php //}else{ ?>
                           <?php// } ?>
                        </div>
                     </a>
                     <?php }
                        ?>
                     <div class="dropdown-menu" >
                        <ul class="blank">
                           <?php if ($user_id != "") {?>
                           <li><a href="<?php echo base_url(); ?>Frontend/my_account" class="dropdown-item">My Account</a></li>
                           <li><a href="<?php echo base_url(); ?>Frontend/orders" class="dropdown-item">My Orders</a></li>
                           <?php } ?>
                        </ul>
                  </li>
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
                           <input class="autosearch-input form-control" type="search"size="50" autocomplete="on" placeholder="Keyword here..." name="search" id="autouser">
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
                     <a data-loading-text="Loading... " class="btn-group top_cart dropdown-toggle" data-toggle="dropdown" aria-expanded="true"  >
                        <div class="shopcart">
                           <span class="icon-c">
                           <i class="fa fa-shopping-bag"></i>
                           </span>
                           <div class="shopcart-inner refesh1">
                              <span class="total-shopping-cart cart-total-full">
                              <span class="items_cart"><?php if($cart_count > 0){ echo $cart_count; }else{ echo '0';} ?></span>
                              </span>
                           </div>
                        </div>
                     </a>
                     <div class="refeshlist">
                        <ul class="dropdown-menu pull-right shoppingcart-box " role="menu">
                           <li>
                              <table class="table table-striped">
                                 <tbody>
                                    <?php   if(count($cart_data > 0)){
                                       foreach($cart_data as $key => $value){ ?>
                                    <tr>
                                       <td class="text-center" style="width:70px">
                                          <a href="product.html">
                                          <img src="<?php  echo $value['image_name'] ?>" style="width:70px" alt="Yutculpa ullamcon" title="Yutculpa ullamco" class="preview">
                                          </a>
                                       </td>
                                       <td class="text-left"> <a class="cart_product_name" href="product.html"><?php echo $value['product_name'] ?></a> 
                                       </td>
                                       <td class="text-center"><?php echo $value['cart_qty'] ?></td>
                                       <td class="text-center"><?php echo $value['product_offer_price'] ?></td>
                                       <td class="text-right">
                                          <a href="product.html" class="fa fa-edit"></a>
                                       </td>
                                       <td class="text-right">
                                          <a id="<?=$value['cart_id'];?>" type="button" class="fa fa-times fa-delete romove_cart_details"></a>
                                       </td>
                                    </tr>
                                    <?php }
                                       } ?>
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
                                          <td class="text-right">$ <?php echo $cart_total_sum; ?></td>
                                       </tr>
                                       <tr>
                                          <td class="text-left"><strong>Eco Tax (-2.00)</strong>
                                          </td>
                                          <td class="text-right">$0</td>
                                       </tr>
                                       <tr>
                                          <td class="text-left"><strong>VAT (20%)</strong>
                                          </td>
                                          <td class="text-right">$0</td>
                                       </tr>
                                       <tr>
                                          <td class="text-left"><strong>Total</strong>
                                          </td>
                                          <td class="text-right">$0</td>
                                       </tr>
                                    </tbody>
                                 </table>
                                 <p class="text-right"> <a class="btn view-cart" href="<?php echo base_url();?>Frontend/cart"><i class="fa fa-shopping-cart"></i>View Cart</a>&nbsp;&nbsp;&nbsp; <a class="btn btn-mega checkout-cart" href="checkout.html"><i class="fa fa-share"></i>Checkout</a> 
                                 </p>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="shopping_cart">
                  <div id="cart" class="btn-shopping-cart">
                     <a  class="btn-group top_cart dropdown-toggle" aria-expanded="true"href="<?php echo base_url();?>Frontend/wishlist_list" >
                        <div class="shopcart">
                           <span class="icon-c">
                           <i class="fa fa-heart"></i>
                           </span>
                           <div class="shopcart-inner refesh">
                              <span class="total-shopping-cart cart-total-full">
                              <span class="items_cart "><?php if($wishlist_count > 0){ echo $wishlist_count; }else{ echo '0';} ?></span>
                              </span>
                           </div>
                        </div>
                     </a>
                  </div>
               </div>
               <!--//cart-->
               <!-- <ul class="wishlist-comp hidden-md hidden-sm hidden-xs"> -->
               <!--  <li class="compare hidden-xs"><a href="#" class="top-link-compare" title="Compare "><i class="fa fa-refresh"></i></a>
                  </li> -->
               <!-- <li class="wishlist hidden-xs"><a href="<?php //echo base_url();?>Frontend/wishlist_list" id="wishlist-total" class="top-link-wishlist" title="Wish List (0) "><i class="fa fa-heart"></i></a>
                  </li>
                  
                  </ul> -->
            </div>
         </div>
      </div>
   </div>
</header>
<!-- //Header Container
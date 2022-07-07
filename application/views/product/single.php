<link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
<style>
          .main-nav ul {
           margin: 0;
           padding: 0;
           list-style: none;
          }
          .main-nav>ul {
           position: relative;    
           text-align: center;
          }
          .main-nav>ul>li a{
           color: #666;
           font-weight: 600;
           font-size: 14px;
          }
          .main-nav>ul>li > a{
           color: #fff;
           font-weight: 600;
           font-size: 14px;
           text-transform: uppercase;
          }
          .main-nav>ul>li {
           display: inline-block;
           margin: 0px 5px;
           padding: 5px 10px;
           position: relative;
          }
          .main-nav>ul>li:hover > a,
          .main-nav>ul>li:hover a:hover{
           color: #fff;
           text-decoration: none;
          }
          ul.sub-menu {
           position: absolute;
           display: none;
           text-align: left;
           background-color: #fff;
           z-index: 1;
          }
          .main-nav>ul>li:hover > ul.sub-menu{
           display: block;
           left:0;
          }
          .main-nav>ul>li:hover > ul.sub-menu{
           display: block;
           left:0;
          }
          .main-nav>ul>li>ul>li:hover > ul.sub-menu{
           display: block;
           left:101%;
           top: 0;
          }
          ul.sub-menu li {
           padding: 5px 24px;
          }
          ul.sub-menu li:hover a:hover {
           color: #000;
          }
          .main-nav>ul>li.has-mega-menu2.menu-item-has-children {
           position: initial;
          }
          .main-nav>ul>li.menu-item-has-children > a {
           position: relative;
          }
          .main-nav>ul>li.menu-item-has-children > a::after {
           content: "";
           background-image: url(../imgs/sprite.png);
           background-repeat: no-repeat;
           background-position: -304px -68px;
           width: 7px;
           height: 4px;
           position: absolute;
           right: -12px;
           margin-top: -2px;
           top: 50%;
          }
          .main-nav>ul>li.has-mega-menu2 .sub-menu {
           width: 250px;
           text-align: left;
           min-height: 350px;
           z-index: 1;
          }
          .main-nav>ul>li.has-mega-menu2 .sub-menu {
           width: 100%;
           text-align: left;
           min-height: 350px;
           background-color: #faf9f8;
          }
          .main-nav>ul>li.has-mega-menu2 .sub-menu>li>a {
           border-top: 0px;
          }
          .main-nav>ul>li.has-mega-menu2>.sub-menu>li>a {
           width: 250px;
           padding: 5px 24px;
           display: block;
           border-bottom: 1px solid #faf9f8;
           border-top: 1px solid #faf9f8;
          }
          .main-nav>ul>li.has-mega-menu2>.sub-menu>li.active>a,
          .main-nav>ul>li.has-mega-menu2>.sub-menu>li:hover>a {
           z-index: 9999;
           background-color: #fff;
           border-bottom: 1px solid #d3d4d5;
           border-top: 1px solid #d3d4d5;
           width: 251px;
           position: relative;
          }
          .main-nav>ul>li.has-mega-menu2>.sub-menu>li {
           position: initial;
           padding: 0;
          }
          .main-nav>ul>li.has-mega-menu2>.sub-menu>li.active,
          .main-nav>ul>li.has-mega-menu2>.sub-menu>li a:hover {
           background-color: #fff;
          }
          .main-nav>ul>li.has-mega-menu2>.sub-menu>li.active>ul {
           display: block;
           opacity: 1;
           visibility: visible;
           margin-top: 0;
           top:0;
          }
          .main-nav>ul>li.has-mega-menu2 .sub-sub-menu {
           -webkit-width: calc(100% - 250px);
           -o-width: calc(100% - 250px);
           -ms-width: calc(100% - 250px);
           width: calc(100% - 250px);
           position: absolute;
           left: 250px !important;
           min-height: 349px;
           box-shadow: none;
           background-color: #fff;
           border-left: 1px solid #e9e9e9;
           border-radius: 0 4px 4px 0;
           border-width: 0 0 0 1px;
          }
          .main-nav>ul>li.has-mega-menu2 .sub-sub-menu>li {
           float: left;
           width: 25%;
           padding: 0;
          }
          .main-nav>ul>li.has-mega-menu2 .sub-sub-menu>li:nth-child(5n) {
           clear: both;
          }
          .main-nav>ul>li.has-mega-menu2 .sub-sub-menu>li>a {
           border-bottom: 0;
           font-weight: bold;
          }
          .main-nav>ul>li.has-mega-menu2 .sub-menu>li.menu-item-has-children>a::after {
           right: 30px;
          }
          .main-nav>ul>li.has-mega-menu2 .menu-depth-3 {
           position: initial;
           visibility: visible;
           opacity: 1;
           margin: 0px;
           border: 0px;
           width: 100%;
           margin-top: 0px;
           min-height: auto;
           display: block;
           margin-left: 10px;
          }
          .main-nav>ul>li.has-mega-menu2 .sub-sub-menu.menu-depth-3>li {
           float: left;
           width: 100%;
           display: block;
           padding: 0 0 0 15px;
          }
          .main-nav>ul>li.has-mega-menu2 .sub-sub-menu.menu-depth-3>li>a {
           font-weight: normal;
           padding: 0px;
          }
          .main-nav>ul>li .sub-menu>li.menu-item-has-children>a::after {
           background-image: url(../imgs/sprite.png);
           position: absolute;
           right: 0;
           top: 11px;
           width: 10px;
           height: 10px;
           content: " ";
           background-position: -481px -61px;
          }
          .main-nav>ul>li .sub-sub-menu.menu-depth-2>li.menu-item-has-children a::after {
           background: none;
          }
          .main-nav>ul>li.has-mega-menu2 .sub-sub-menu.menu-depth-3>li>a::after {
           top: 2px;
           right: 34px;
          }
          .main-nav>ul>li.has-mega-menu2 .menu-depth-3 ul {
           min-height: auto;
           border: 1px solid #ccc;
           width: auto;
           left: 163px !important;
           box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.2);
          }
          .main-nav>ul>li.has-mega-menu2 .menu-depth-3 ul li {
           float: none;
           width: 100%;
           min-width: 200px;
          }
          .main-nav>ul>li.has-mega-menu2 .menu-depth-3 ul li a {
           font-weight: normal;
           border-top: 1px solid #e5e5e5;
          }
          .main-nav>ul>li.has-mega-menu2 .menu-depth-3 ul li:first-child>a {
           border-top: 0px solid #e5e5e5;
          }
          .main-nav>ul>li .sub-menu>li.menu-item-has-children a{
           position: relative;
           display: block;
           padding: 5px 12px;
          }
          .skdslider{
           margin-top: 10.2em;
          }
          .btn-default:hover {
            background-color: #005599;
            color: #fff;
            border: none;
          }
          .btn-default {
            background-color: #005599;
            border: none;
            color: #fff;
          }
          input[type=number]::-webkit-inner-spin-button, 
          input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
          }
          ul, li {
            padding: 0;
            margin: 0px;
            list-style: inherit;
          }
          .carousel-control.left {
           background-image: -webkit-linear-gradient(left, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 100%); 
           background-image: -o-linear-gradient(left, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 100%);
           background-image: -webkit-gradient(linear, left top, right top, from(rgba(0, 0, 0, .5)), to(rgba(0, 0, 0, .0001))); 
           background-image: linear-gradient(to right, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 100%); 
           filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#80000000', endColorstr='#00000000', GradientType=1);
           /* background-repeat: repeat-x; */
          }
          .carousel-control.right {
            right: 0;
            left: auto;
            background-image: -webkit-linear-gradient(left, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 100%);
            background-image: -o-linear-gradient(left, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 100%);
            background-image: -webkit-gradient(linear, left top, right top, from(rgba(0, 0, 0, 0)), to(rgba(0, 0, 0, 0)));
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00000000', endColorstr='#80000000', GradientType=1);
            background-repeat: repeat-x;
          }
          .carousel-indicators {
            position: absolute;
            bottom: 6px;
            left: 48%;
            z-index: 15;
            width: auto;
            padding-left: 0;
            margin: 0;
            text-align: center;
            list-style: none;
          }
          .carousel-control .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right, .carousel-control .icon-prev, .carousel-control .icon-next {
            width: 30px;
            height: 30px;
            margin-top: -60px;
            font-size: 30px;
          }
          .checked {
            color: #00B5EA;
          }
          .p-discount {
            display: inline-block;
            margin-left: 5px;
            background-color: #000;
            color: #fff;
            font-size: 10px;
            padding: 6px 0 0;
            line-height: 11px;
            vertical-align: middle;
            width: 35px;
            height: 35px;
            overflow: hidden;
            border-radius: 50%;
            position: absolute;
            top: -5px;
            left: 0px;
            text-align: center;
          }
          .product-price.c2 {
            color: #005599;
          }
          .product-price del, .product-price span.del {
            font-size: 14px;
            color: #565555;
            text-decoration: line-through;
            margin-right: 5px;
          }
          .product-price ins {
            text-decoration: none;
          }
          .product-main .product-desc .p-discount {
            left: auto;
            top: auto;
            position: relative;
            display: inline-block;
            margin-left: 25px;
            margin-top: -3px;
          }
          .product-main .p-discount {
            top: 57px;
            right: 10px;
          }
          .authenticity-check {
            display: inline-block;
            position: absolute;
            /* right: 0; */
            top: -24px;
            margin-left: 115px;
          }
          .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding: 20px;
          }
          .product-price {
            font-size: 15px;
            font-weight: 600;
            color: #33b0f0;
            display: inline-block;
            position: relative;
            padding: 15px;
          }
          .btn-primary3 {
            color: #fff;
            background-color: #005599;
            border-color: #005599;
            border-radius: 0px;
          }
          .btn-primary3:hover {
            color: #005599;
            background-color: #fff;
            border-color: #005599;
            border-radius: 0px;
          }
          .glyphicon {
            position: relative;
            top: 1px;
            display: inline-block;
            font-family: 'Glyphicons Halflings';
            font-style: normal;
            font-weight: 400;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            color: #fff;
          }
          .product-description h2 {
            margin-top: 10px;
            padding-top: 10px;
            color: #005599;
            font-size: 19px;
            font-weight: 600;
            margin-bottom: 5px;
          }
          .vendor {
            margin: 30px -15px;
            border: 1px solid #cfcfcf;
            padding: 7px 15px;
            font-size: 13px;
            font-weight: 600;
            color: #005599;
          }
          .vendor1 {
            margin: 30px -15px;

          }
          .vendor span {
            color: #737373;
          }
          .abcshare:hover+.dpopup{
            display: block;
          }
          .dpopup {
          	display: none;
          }
          .share-link {
            margin-left: 0px;
            border: 1px solid #005599;
            display: inline-block;
            padding: 5px;
            color: #005599;
          }
          .share-link > i {
            vertical-align: middle;
            margin-left: 10px;
          }
          .share-link .social-icons {
            font-size: 14px;
            margin-left: -6px;
          }
          .review-stat {
            margin-bottom: 15px;
          }
          .review-stat .main {
            font-size: 13px;
            color: #878787;
            text-align: center;
          }
          .review-stat > div {
            display: inline-block;
            vertical-align: middle;
            margin-left: 15px;
          }
          .review-stat .main span {
            display: block;
            font-size: 30px;
            color: #00b5ea;
          }
          .review-stat .chart ul {
            list-style: none;
          }
          .review-stat .chart ul .rbar {
            width: 200px;
            height: 5px;
            background-color: #f0f0f0;
            display: inline-block;
            vertical-align: middle;
          }
          .review-stat .chart ul .rbar .green {
            background-color: #388e3c;
            height: 5px;
          }
          .review-stat .chart ul span.ttt {
            color: #666;
            font-size: 12px;
          }
          .reviewb11{
            border: 1px solid #ddd;
            padding: 10px;
          }
          .checked1{
            color: #00B5EA;
          }
          .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
          }
          .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0,0,0,.05);
          }
          .table td, .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
          }
          .carousel-control.right {
            margin-top: 6em;
            margin-left: 51em;
          }

</style>

<body>
   



   <br><br><br><br><br><br><br><br><br>

   
<div id="amazingslider-wrapper-1" style="display:block;position:relative;max-width:900px;margin:20px auto 56px;">
        <div id="amazingslider-1" style="display:block;position:relative;margin:0 auto;">
            <ul class="amazingslider-slides" style="display:none;">
                <li><a href="<?php echo base_url();?>assets/images/1.png" class="html5lightbox"><img src="<?php echo base_url();?>assets/images/1.png" alt="11"  /></a>
                </li>
                <li><a href="<?php echo base_url();?>assets/images/4.png" class="html5lightbox"><img src="<?php echo base_url();?>assets/images/4.png" alt="44"  /></a>
                </li>
                <li><a href="<?php echo base_url();?>assets/images/5.png" class="html5lightbox"><img src="<?php echo base_url();?>assets/images/5.png" alt="b11"  /></a>
                </li>
            </ul>
            <ul class="amazingslider-thumbnails" style="display:none;">
                <li><img src="<?php echo base_url();?>assets/images/1.png" alt="11" /></li>
                <li><img src="<?php echo base_url();?>assets/images/4.png" alt="44" /></li>
                <li><img src="<?php echo base_url();?>assets/images/5.png" alt="b11" /></li>
            </ul>
        <!-- <div class="amazingslider-engine"><a href="#" title="jQuery Slider">jQuery Slider</a></div> -->
        </div>
    </div>
  <br><br>
  <hr>
  <br>
  <div class="container">
     <div class="row">
        <div class="col-md-12">
            <div class="row">
               <div class="col-md-2">
                  <span class="fa fa-star checked" style="font-size: 26px;"></span>
                  <span class="fa fa-star checked" style="font-size: 26px;"></span>
                  <span class="fa fa-star checked" style="font-size: 26px;"></span>
                  <span class="fa fa-star checked" style="font-size: 26px;"></span>
                  <span class="fa fa-star" style="font-size: 26px;"></span>
               </div>
               <div class="col-md-10">
                  <h5 style="color: #005599;font-size: 18px;font-weight: lighter;">Have 10 Reviews / Add New Review</h5>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <h4 style="color: #005599;line-height: 40px;font-size: 18px;">Nature Best Isopure 1 lbs</h4>
                  <h4 style="color: #005599;line-height: 40px;font-size: 18px;">Units Left :20</h4>
                  <!-- <p><span><strike>Rs.1200</strike> </span>&nbsp;&nbsp;<span style="color: #005599;font-size: 16px;">Rs.1100</span> &nbsp;&nbsp;</p> -->
               </div>
               
               
            </div>
           <br>
            <div class="row">
               <div class="col-md-3">
                  <h4 style="color: #005599;line-height: 40px;font-size: 18px;">Price : <span style="color:#005599;">Rs.700</span>&nbsp;&nbsp; <strike style="color: #000;">Rs. 1400</strike></h4>
                  
                  <!-- <p><span><strike>Rs.1200</strike> </span>&nbsp;&nbsp;<span style="color: #005599;font-size: 16px;">Rs.1100</span> &nbsp;&nbsp;</p> -->
               </div>
               <div class="col-md-3">
                 <div class="p-discount">50% OFF</div>
               </div>
               
               
            </div>
           <br> 
        </div>
            <div class="row">
                      <div class="col-md-4" >
                           <div class="input-group">
                                 <span class="input-group-btn">
                                    <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                       <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                 </span>
                                 <input type="text" name="quant[2]" class="form-control input-number" value="1" min="1" max="100">
                                 <span class="input-group-btn">
                                    <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                       <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                 </span>
                           </div>
                        </div>
                        <div class="col-md-8">
                          <a href="<?php echo base_url();?>account/view_my_cart"><button class="btn btn-primary3" ><i class="fa fa-cart-plus"></i>&nbsp;&nbsp;&nbsp;Add To Cart</button></a>
                        </div>
                      </div>
                      <br>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-3">
                            <div class="vendor d-i-b">
                              <span>Sold By:</span> Xpresshop Online Store</div>
                          </div>
                          <div class="col-md-9">
                              <div class="vendor1">
                                <div class="share share-link ddrop " data-share-link="" data-link="#"><i class="fa fa-share-alt"></i> <span>Share</span><div class="dpopup share-dropdown brand" style="width:200px;">
                                 <div class="dpopup share-dropdown brand" style="width:200px;">
                                    <div class="list-group social-icons">
	                                        <a class="list-group-item list-group-item-action" target="_blank" href="#"><i class="fab fa-whatsapp" style="color:#000;font-size: 16px;text-align: center;line-height: 34px;"></i> Whatsapp</a>
	                                        <a class="list-group-item list-group-item-action" target="_blank" href="#"><i class="fab fa-facebook-f" style="color:#000;font-size: 16px;text-align: center;line-height: 32px;"></i> Facebook</a>
	                                        <a class="list-group-item list-group-item-action" target="_blank" href="#"><i class="fab fa-twitter" style="color:#000;font-size: 16px;text-align: center;line-height: 32px;"></i> Twitter</a>
                                    </div>
                                </div>
                              </div>
                        </div>
                        </div>
                      </div>
                      
                      
     </div>
  </div>
</div>
</div>

  
  <hr><br><br>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="product-description">
        <h2><span>Description</span></h2><hr align="left" style="border-top:3px solid #005599;width:9%;margin-top: 5px;">
        <p>Protein is probably the most important supplement for all athletes, but it is especially indispensable for those involved in long-term, high intensity endurance training. It is the fuel for the build-up, mass and toning of the muscle. In fact, protein is essential for growth and development. The proteins that make up the human body are not obtained directly from the diet; rather, dietary protein is broken down into its constituent parts known as amino acids, which are the basic building blocks of life. That means that it is the amino acids, and not protein per se, which are essential nutrients.</p>
<p>Of the 20 amino acids that the body needs to make protein, eleven are designated as nonessential amino acids because they can be produced by the human body from other amino acids and do not need to be obtained from the diet. The remaining nine amino acids cannot be synthesized by the body and are, therefore, called essential amino acids. These amino acids must be obtained by degradation of the dietary protein. All of these essential amino acids must be present in the body in order for it to build and repair muscle.</p>
<p>The manner in which the body uses protein during and after exercise is quite different from the way it utilizes carbohydrates or fat for energy. In the hours after exercise, the body begins to build the so-called structural proteins from amino acids for muscle repair and growth, and remodeling the tissues needed for performance. This is one of the reasons that athletes should pay particular heed to nutrition for fast and complete recovery and make it an integral part of their workout regimen.</p>
<p>Exercise duration and intensity are important factors in determining which of the nutrient fuels are burned to gain energy. An exercise regimen comprising low-to-moderate intensity and long duration necessitates large quantities of fuel, oftentimes more than carbohydrates and fat reserves in the body can provide. Therefore, the body begins to utilize structural and functional proteins during long-term aerobic exercise. In contrast, high-intensity exercise of short duration mostly uses glucose, which spares the protein reservoir of the body. To meet the needs of athletes, Ultimate Nutrition has designed 100% Prostar<sup>®</sup>&nbsp;Whey Protein to include all the essential and nonessential amino acids to build the muscle after intense exercise of both short and long duration. It is a customized blend of all the nutrients, including immune enhancing factors from whey protein by a specialized process. Since exercise can take a toll on the immune system, 100% Prostar<sup>®</sup>&nbsp;Whey Protein is the nutritional supplement of choice for those who lead an active lifestyle. 100% Prostar<sup>®</sup>&nbsp;Whey Protein is not just for the athlete however. It supports the muscle maintenance, buildup and toning among individuals who are merely “weekend warriors.” Ultimate Nutrition<sup>®</sup>‘s 100% Prostar<sup>®</sup>&nbsp;Whey Protein is, indeed, the nutrition for the champions!</p>
</div>
    </div>
  </div>
</div>
<br><br>
<div class="container">
  <div class="row">
    <div class="col-md-12">
        <div class="reviewspd">
          <h2><span>Reviews</span></h2><hr align="left" style="border-top:3px solid #005599;width:8.2%;margin-top: 5px;">
        </div>
        <div class="review-stat">
   <div class="main"><span>5<i class="fas fa-star"></i></span>Ratings</div>
   <div class="chart">
      <ul>
         <li style="line-height: 23px;">
            <span>5</span> <i class="fas fa-star" style="color:#00B5EA;"></i> 
            <div class="rbar">
               <div class="green" style="width:100%"></div>
            </div>
            <span class="ttt">15</span>
         </li>
         <li style="line-height: 23px;">
            <span>4</span> <i class="fas fa-star" style="color:#00B5EA;"></i> 
            <div class="rbar">
               <div class="green" style="width:0%"></div>
            </div>
            <span class="ttt">0</span>
         </li>
         <li style="line-height: 23px;">
            <span>3</span> <i class="fas fa-star" style="color:#00B5EA;"></i> 
            <div class="rbar">
               <div class="green" style="width:0%"></div>
            </div>
            <span class="ttt">0</span>
         </li>
         <li style="line-height: 23px;">
            <span>2</span> <i class="fas fa-star" style="color:#00B5EA;"></i> 
            <div class="rbar">
               <div class="orange" style="width:0%"></div>
            </div>
            <span class="ttt">0</span>
         </li>
         <li style="line-height: 23px;">
            <span>1</span> <i class="fas fa-star" style="color:#00B5EA;"></i> 
            <div class="rbar">
               <div class="red" style="width:0%"></div>
            </div>
            <span class="ttt">0</span>
         </li>
      </ul>
   </div>
</div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="row reviewb11">
          
              <div class="col-md-9">
                <p>Dev &nbsp;&nbsp;<span>28 June, 2018</span></p>
                <h4 style="line-height: 30px;font-weight: lighter;">Great product with best quality and value for money.</h4>
              </div>
              <div class="col-md-3">
                <h4 style="text-align: right;">
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                </h4>
              </div>
          
      </div><br>
      <div class="row reviewb11">
          
              <div class="col-md-9">
                <p>Abhishek &nbsp;&nbsp;<span>25 June, 2018</span></p>
                <h4 style="line-height: 30px;font-weight: lighter;">Great product with best quality and value for money.</h4>
              </div>
              <div class="col-md-3">
                <h4 style="text-align: right;">
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                </h4>
              </div>
          
      </div><br>
      <div class="row reviewb11">
          
              <div class="col-md-9">
                <p>John &nbsp;&nbsp;<span>20 June, 2018</span></p>
                <h4 style="line-height: 30px;font-weight: lighter;">Great product with best quality and value for money.</h4>
              </div>
              <div class="col-md-3">
                <h4 style="text-align: right;">
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                </h4>
              </div>
          
      </div><br>
      <div class="row reviewb11">
          
              <div class="col-md-9">
                <p>Manoj &nbsp;&nbsp;<span>30 May, 2018</span></p>
                <h4 style="line-height: 30px;font-weight: lighter;">Great product with best quality and value for money.</h4>
              </div>
              <div class="col-md-3">
                <h4 style="text-align: right;">
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                </h4>
              </div>
          
      </div>
      <br>
      <div class="row reviewb11">
          
              <div class="col-md-9">
                <p>Babu &nbsp;&nbsp;<span>2 May, 2018</span></p>
                <h4 style="line-height: 30px;font-weight: lighter;">Great product with best quality and value for money.</h4>
              </div>
              <div class="col-md-3">
                <h4 style="text-align: right;">
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                  <span class="fa fa-star checked1"></span>
                </h4>
              </div>
          
      </div>
    </div>
  </div>
</div>
<br><br>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2><span>Additional Features</span></h2><hr align="left" style="border-top:3px solid #005599;width:16%;margin-top: 5px;">
      <table class="table table-striped">
        <tbody>
          <tr>
            <th>Brand</th>
            <td>The Vitamin Shoppe</td>
          </tr>
          <tr>
            <th>Flavour</th>
            <td>Unflavoured</td>
          </tr>
          <tr>
            <th>Number of serving</th>
            <td>32</td>
          </tr>
          <tr>
            <th>Serving size</th>
            <td>15ml</td>
          </tr>
          <tr>
            <th>Packaging</th>
            <td>Bottle</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<br>
<!-- //n -->
<!-- footer -->




<?php include_once(APPPATH.'views/includes/footer.php'); ?>
<!-- //footer -->	
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/sliderengine/jquery.js"></script>
    <script src="<?php echo base_url();?>assets/sliderengine/amazingslider.js"></script>
    <script src="<?php echo base_url();?>assets/sliderengine/initslider-1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/move-top.js"></script>
<script src="<?php echo base_url();?>assets/js/minicart.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/easing.js"></script>
<script type="text/javascript">
   jQuery(document).ready(function($) {
     $(".scroll").click(function(event){		
       event.preventDefault();
       $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
    });
  });
</script>
<script>
        //plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
      </script>

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
         
         $().UItoTop({ easingType: 'easeOutQuart' });
         
      });
   </script>
   <!-- //here ends scrolling icon -->
  
      <!-- main slider-banner -->
      
      <script type="text/javascript">
         jQuery(document).ready(function(){
         	jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});
         	
         	jQuery('#responsive').change(function(){
         		$('#responsive_wrapper').width(jQuery(this).val());
         	});
         	
         });
      </script>
      <script type="text/javascript">
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
      </script>	
      <!-- //main slider-banner --> 
   </body>
   </html>
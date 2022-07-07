
<!-- start-smoth-scrolling -->
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
</style>
<!-- start-smoth-scrolling -->
</head>
<body>
   <!-- header -->
   <!-- //header -->
   <!-- navigation -->
 
   <!-- //navigation -->
   <!-- main-slider -->

   <!--Top Deals -->

   <!--End of Top Deals -->
   <!-- new -->



   <br><br><br><br><br><br><br>

   <div class="container" style="margin-top: -0.2em;">
      <div class="row">
         <div class="col-md-12">
            <img src="<?php echo base_url();?>assets/images/bulk_buy.jpg" style="width:100%;">

         </div>


      </div>
      <div class="col-md-12">
         <h3 style="line-height: 55px;">Bulk Purchase with GST</h3>
         <div class="row">
            <form class="form-horizontal" action="/action_page.php" style="width:100%;">
             <div class="form-group">
               <label class="control-label col-md-3" for="companyname">Company Name<span style="color: red;">*</span> :</label>
               <div class="col-md-9">
                 <input type="text" class="form-control" id="cname" placeholder="Company Name" name="company name">
              </div>
           </div>
            <div class="form-group">
               <label class="control-label col-md-3" for="gst">GST Number<span style="color: red;">*</span> :</label>
               <div class="col-md-9">          
                 <input type="text" class="form-control" id="gst" placeholder="Enter GST Number" name="gst">
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-md-3" for="nmb">Address<span style="color: red;">*</span> :</label>
               <div class="col-md-9">          
                 <textarea class="form-control" rows="5" id="address" style="resize: none;"></textarea>
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-md-3" for="nmb">Phone Number<span style="color: red;">*</span> :</label>
               <div class="col-md-9">          
                 <input type="number" class="form-control" id="nmb" placeholder="Enter Phone Number" name="nmb">
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-md-3" for="nmb">Email<span style="color: red;">*</span> :</label>
               <div class="col-md-9">          
                 <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
               </div>
            </div>
            <div class="form-group">
            <label class="control-label col-md-3" for="product">Select Product<span style="color: red;">*</span> :</label>
            <div class="col-md-9">
              <input type="text" name="product_title" placeholder="Search Product here" class="form-control bulk_product_select ui-autocomplete-input" autocomplete="off">
            </div>
          </div>
          <div class="form-group">        
            <div class="col-md-offset-3 col-sm-6">
              <button type="submit" class="btn btn-default">Request Bulky Buy</button>
           </div>
        </div>
      </form>
</div><br><br>
</div>
<br><br>
</div>
<div class="container">
   <div class="row">
      <div class="col-md-12">
      <ul>
         <li>100% Advance for the order ( Bank Transfer Only)</li>
         <li>Shipping will be done via Logistic like VRL and GST Number will be needed if shipment is above 50K for Eway Bill.</li>
         <li>Shipping Charges Additional Rs.8/ KG will be charged.</li>
         <li>Products with Special Promotional offer are not applicable.</li>
         <li>Orders will be Processed within 48 hours.</li>
      </ul>
   </div>
   </div>
   <div class="row">
      <div class="col-md-12">
      <p style="line-height: 50px;"><b>Bank Details Mentioned Below.</b></p>
      <ul>
         <li>Account Name:- Xpresshop Online Store</li>
         <li>Bank A/C Number :- 641905500264</li>
         <li>IFSC Code:- ICIC0006419</li>
      </ul>
   </div>
   </div>
   <div class="row">
      <p style="line-height: 30px;"><b>For any other concern, Kindly email it to care@healthxp.in</b></p>
   </div>
</div>

<!-- //n -->
<!-- footer -->

<div id="footer">
   <div class="container">
     <div class="brand row align-items-center">
       <div class="logo col-2"><img src="https://healthxp.in/wp-content/themes/healthxp/assets/imgs/logo-1.png" alt="HealthXP"></div>
       <div class="description col">We are Healthxp.in. Your transformation goal is our mission. We are your personal fitness trainer. We will suffice you with the entire necessary dietary supplement to help you achieve your goal and in the process, accomplish our mission.</div>
       <div class="social-icons col-3">
         <a href="#" style="border-radius: 50px;background:#3A589B;"><i class=" fa fa-facebook"></i></a>
         <a href="#" style="border-radius: 50px;background:#598DCA;"><i class="fa fa-twitter"></i></a>
         <a href="#" style="border-radius: 50px;background:#007AB9;"><i class="fa fa-linkedin"></i></a>
         <a href="#" style="border-radius: 50px;background:#CA4638;"><i class="fa fa-pinterest"></i></a>
         <a href="#" style="border-radius: 50px;background:#CF3427;"><i class="fa fa-youtube"></i></a>
         <a href="#" style="border-radius: 50px;background:#517FA6;"><i class="fa fa-instagram"></i></a>
         <a href="#" style="border-radius: 50px;background:#DD4B39;"><i class="fa fa-google"></i></a>
      </div>    
   </div>
   <div class="links row">
     <div class="links-item col-3">
      <h4>HELP &amp; SUPPORT</h4>
      <div class="links-link">
        <a href="#">Contacts</a><br><a href="#">FAQ</a><br><a href="#">Privacy Policy</a><br><a href="#">Shipping &amp; Return</a><br><a href="#">Terms &amp; Conditions</a><br>                                                    </div>
     </div>
     <div class="links-item col-3">
      <h4>MY ACCOUNT</h4>
      <div class="links-link">
        <a href="#">My Account</a><br><a href="#">My Orders</a><br><a href="#">My Addresses</a><br><a href="#">Account Info</a><br>                                                    </div>
     </div>
     <div class="links-item col-3">
      <h4>HealthXP</h4>
      <div class="links-link">
        <a href="#">About Us</a><br><a href="#">Authenticity Check</a><br><a href="#">Delivery</a><br><a href="#">Store Locator</a><br><a href="#">Sell on HealthXP</a><br><a href="#">Franchise</a><br><a href="#">Sitemap</a><br><a href="#">Bulk Buy</a><br><a href="#">Unboxing Videos</a><br>                                                    </div>
     </div>
     <!-- <div class="links-item col"></div> -->
     <div class="links-item col-3 ml-auto">
      <h4>CONTACT US</h4>
      <div class="foot-contacts">
        <!-- <div class="hotline"><a href="tel:02245420300"><i class="icon icon-call"></i> Phone: 022-45420300</a></div> -->
        <div class="hotline"><a href="mailto:abc@gmail.in"><i class="fa fa-envelope" style="color:#ddd;font-size: 20px;"></i> Email: abc@gmail.in</a></div>
        424, Neo Corporate Plaza,<br>Ramchandra Lane Ext,<br>Kanchpada, Malad West.<br>Mumbai 400064. Maharashtra. India
     </div>
  </div>
</div> 
</div>
</div>

<!-- //footer -->	
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script src="js/minicart.min.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
   jQuery(document).ready(function($) {
     $(".scroll").click(function(event){		
       event.preventDefault();
       $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
    });
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
      <script src="js/skdslider.min.js"></script>
      <link href="css/skdslider.css" rel="stylesheet">
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
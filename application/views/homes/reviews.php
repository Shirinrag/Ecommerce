
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
         iframe{
            margin-bottom: 20px;
         }
      </style>
     
   <body>
     
      <!-- //navigation -->
      <!-- main-slider -->
      
      <!--Top Deals -->
      
      <!--End of Top Deals -->
      <!-- new -->
      
      
      
      <br><br><br><br><br><br><br>
      <br>
	    <h3>UNBOXING AND REVIEW VIDEOS</h3><br>
      <div class="container">
         <?php $su_video = array();
                  $su_video = array_chunk($videos,3,true);?>
            <?php foreach ($su_video as $vdo_key => $vdo_value) { ?>
         <div class="row">
            <div class="col-md-12">
           
            
               <div class="row">
                  <?php foreach ($vdo_value as $v_key => $v_value) { ?>
                     <div class="col-md-4">
                        <iframe width="100%" height="200" src="<?php echo $v_value['link'];?>">
                        </iframe>
                     </div>
                  <?php } ?>
               </div>
            
         </div>
      </div>
      <?php } ?>
      
      </div>
      
      <!-- //n -->
      <!-- footer -->
      		
      		
      	 <?php include_once(APPPATH.'views/includes/footer.php'); ?>	
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
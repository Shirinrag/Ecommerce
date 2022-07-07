
   
      
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
         background-image: url(../images/sprite.png);
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
         .btn-primary3 {
    color: #fff;
    background-color: #005599;
    border-color: #005599;
    border-radius: 0px;
}
.col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    position: relative;
    width: 100%;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
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
      <div id="main-content-wrap" style="margin-top:9.5em;">
         <div id="container">
            <div id="content" role="main">
               <div class="scp-breadcrumb">
                 <ul class="breadcrumb">
                   <li><a href="#">HOME</a></li>
                   <li><a href="#">BOGO OFFER</a></li>
                   
                </ul>
               </div>

                  <div id="main-content" class="shop-content main-content position-relative" data-max-page="3">
   <div class="ajsearch-loading d-none">
      <div class="loading-stat"><i class="icon icon-loading"></i> Loading...</div>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-3 order-1">
            <div class="cat-sidebar b1 box1">
               <div class="cat-sidebar-title bb1">Filter By</div>
               <div class="desc">
                  <div class="shop-sidebar-widget">
                     <h2 class="widgettitle"><i class="icon icon-angle-right"></i>Categories</h2>
                     <div class="desc">
                        <div class="search-container">
                          <form action="/action_page.php">
                              <input type="text" placeholder="Search.." name="search" style="height:34px;width:180px;">
                              <button type="submit" style="margin-left:-1em;height:34px;line-height: 1px;"><i class="fa fa-search"></i></button>
                           </form>
                        </div>
                        <ul>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_ccat0" value="436" class="aj-click custom-control-input" data-field-id="catids"><label class="custom-control-label" for="_ccat0">Amino Acids/BCAAs</label></div>
                           </li>
                           <li class="active">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_ccat1" value="1197" checked="checked" class="aj-click custom-control-input" data-field-id="catids" disabled=""><label class="custom-control-label" for="_ccat1">BOGO Offer</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_ccat2" value="440" class="aj-click custom-control-input" data-field-id="catids"><label class="custom-control-label" for="_ccat2">Casein</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_ccat3" value="778" class="aj-click custom-control-input" data-field-id="catids"><label class="custom-control-label" for="_ccat3">Fitness Accessories</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_ccat7" value="441" class="aj-click custom-control-input" data-field-id="catids"><label class="custom-control-label" for="_ccat7">Lean Body Products</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_ccat8" value="351" class="aj-click custom-control-input" data-field-id="catids"><label class="custom-control-label" for="_ccat8">Protein Bars</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_ccat9" value="567" class="aj-click custom-control-input" data-field-id="catids"><label class="custom-control-label" for="_ccat9">Workout Essentials</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_ccat10" value="73" class="aj-click custom-control-input" data-field-id="catids"><label class="custom-control-label" for="_ccat10">Creatine</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_ccat11" value="75" class="aj-click custom-control-input" data-field-id="catids"><label class="custom-control-label" for="_ccat11">Fat Burner</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_ccat12" value="74" class="aj-click custom-control-input" data-field-id="catids"><label class="custom-control-label" for="_ccat12">Glutamine</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_ccat13" value="38" class="aj-click custom-control-input" data-field-id="catids"><label class="custom-control-label" for="_ccat13">Mass Gainer</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_ccat15" value="36" class="aj-click custom-control-input" data-field-id="catids"><label class="custom-control-label" for="_ccat15">Pre-workout</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_ccat16" value="199" class="aj-click custom-control-input" data-field-id="catids"><label class="custom-control-label" for="_ccat16">Shakers/Gym Bottles</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_ccat17" value="37" class="aj-click custom-control-input" data-field-id="catids"><label class="custom-control-label" for="_ccat17">Whey Protein</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_ccat18" value="72" class="aj-click custom-control-input" data-field-id="catids"><label class="custom-control-label" for="_ccat18">Whey Protein Isolate</label></div>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="shop-sidebar-widget">
                     <h2 class="widgettitle"><i class="icon icon-angle-right"></i>Brands</h2>
                     <div class="desc">
                        <div class="widget-search m-b-10"><input type="text" class="search-brand-input form-control form-control-sm" placeholder="Search By Brand"><i class="icon icon-search"></i></div>
                        <ul>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand0" value="571" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand0">Allmax</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand1" value="620" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand1">Amway</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand2" value="816" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand2">Avvatar</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand3" value="756" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand3">Big Muscles</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand4" value="975" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand4">Biofit</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand5" value="326" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand5">Biox</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand6" value="332" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand6">BPI Sports</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand7" value="426" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand7">BSN</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand8" value="964" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand8">EAS</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand9" value="667" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand9">ESN</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand10" value="889" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand10">GASPARI</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand11" value="646" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand11">GAT Sports</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand12" value="331" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand12">Giant Sports</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand13" value="819" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand13">HealthAid</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand14" value="1008" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand14">Healthvit</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand15" value="621" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand15">Herbalife</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand16" value="1296" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand16">IN2</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand17" value="1317" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand17">MuscleBlaze</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand18" value="477" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand18">MyProtein</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand19" value="428" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand19">Nutrex</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand20" value="482" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand20">Proburst</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand21" value="345" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand21">Prosupps</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand22" value="1328" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand22">PVL</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand23" value="483" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand23">Quest Bar</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand24" value="1751" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand24">RiteBite</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand25" value="534" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand25">Rivalus</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand26" value="485" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand26">RSP</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand27" value="484" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand27">SAN</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand28" value="341" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand28">Scivation</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand29" value="465" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand29">The Vitamin Shoppe</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand31" value="78" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand31">Dymatize</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand32" value="102" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand32">Isopure</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand33" value="169" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand33">Labrada</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand34" value="79" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand34">Muscletech</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand35" value="198" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand35">Mutant</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand36" value="184" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand36">Vitrovea</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand37" value="77" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand37">Optimum Nutrition</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand38" value="236" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand38">Scitec</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand39" value="171" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand39">SSN</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand40" value="170" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand40">Ultimate Nutrition</label></div>
                           </li>
                           <li class="">
                              <div class="custom-control custom-checkbox"><input type="checkbox" id="_cbrand41" value="230" class="aj-click custom-control-input" data-field-id="bds"><label class="custom-control-label" for="_cbrand41">Universal Nutrition</label></div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-9 order-2 product-view">
            <header class="row1">
               <h1 class="woocommerce-products-header__title page-title">BOGO Offer</h1>
            </header>
            <div class="cat-search-bar">
               <div class="div-orderby float-left label-field">
                  <label>Sort By:</label>
                  <select name="orderby" class="orderby aj-select form-control form-control-sm" data-field-id="orderby">
                     <option value="featured">Featured</option>
                     <option value="popularity">Popularity</option>
                     <option value="rating">Average Rating</option>
                     <option value="date">Newness</option>
                     <option value="price">Price: Low to High</option>
                     <option value="price-desc">Price: High to Low</option>
                     <option value="trending">Trending</option>
                  </select>
               </div>
               <div class="div-nop float-right label-field">
                  <label>Show:</label>
                  <select name="nop" class="nop aj-select form-control form-control-sm" data-field-id="nop">
                     <option value="12" selected="selected">12</option>
                     <option value="24">24</option>
                     <option value="48">48</option>
                     <option value="72">72</option>
                  </select>
               </div>
               <div class="div-page-total float-right m-r-15"><label><strong>Total:</strong> 28</label></div>
               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="p-discount">33% OFF</div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/8.png" class="attachment-shop_single size-shop_single wp-post-image" alt="Prostar_Combo"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Ultimate Nutrition Prostar 100% Whey Protein 5.28 LBS ( Combo )</a></h4>
                           <div class="product-price "><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>10,998</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>7,399</span></ins></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="p-discount">35% OFF</div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/3.png" class="attachment-shop_single size-shop_single wp-post-image" alt="Ultimate Nutrition ISO Sensation 93 5lb Chocolate Fudge+5lb Cafe Brazil"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href=#">Ultimate Nutrition ISO Sensation 93 5lb ( Combo )</a></h4>
                           <div class="product-price "><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>14,998</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>9,799</span></ins></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/2.png" class="attachment-shop_single size-shop_single wp-post-image" alt="combo offer banner"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Ultimate Nutrition Single Serving Assorted Sample Combo</a></h4>
                           <div class="product-price "><span>Rs.199</span></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="p-discount">47% OFF</div>
                        <div class="product-img"><a href="#"><img width="336" height="337" src="<?php echo base_url();?>assets/images/1.png" class="attachment-shop_single size-shop_single wp-post-image" alt="BPI Sports Whey HD Ultra Premium Buy 1 Get 1 Free"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">BPI Sports Whey HD Ultra Premium Buy 1 Get 1 Free</a></h4>
                           <div class="product-price "><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>14,998</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>7,999</span></ins></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="p-discount">54% OFF</div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/15.png" class="attachment-shop_single size-shop_single wp-post-image" alt="cell-tech"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Muscletech Celltech 6 LBS Combo Offer</a></h4>
                           <div class="product-price "><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>12,000</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>5,500</span></ins></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="p-discount">50% OFF</div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/8.png" class="attachment-shop_single size-shop_single wp-post-image" alt="Tara Nutricare Testo Booster, 60 Capsules BUY 1 GET 1"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Tara Nutricare L-Carnitine L-Tartrate, 60 Capsules BUY 1 GET 1</a></h4>
                           <div class="product-price "><span class="del">Rs.1600</span><span>Rs.799</span></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/7.png" class="attachment-shop_single size-shop_single wp-post-image" alt=""></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Proburst Whey Supreme - 1kg  BUY 1 GET 1</a></h4>
                           <div class="product-price "><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>3,199</span></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/5.png" class="attachment-shop_single size-shop_single wp-post-image" alt="Ultimate Nutrition Prostar Chocolate Creme + Optimum Nutrition amino energy 30 serving"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Ultimate Nutrition Prostar Chocolate Cream 5 lbs + Optimum Nutrition amino energy 30 serving</a></h4>
                           <div class="product-price "><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>5,649</span></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="p-discount">50% OFF</div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/4.png" class="attachment-shop_single size-shop_single wp-post-image" alt="buyonegetone_tara_nutricare"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Tara Nutricare Testo Booster, 60 Capsules BUY 1 GET 1</a></h4>
                           <div class="product-price "><span class="del">Rs.1789</span><span>Rs.899</span></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="p-discount">29% OFF</div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/13.png" class="attachment-shop_single size-shop_single wp-post-image" alt="Prostar-5-lbs-Nitraflex"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Ultimate Nutrition Prostar 5.28 lb Chocolate Creme + GAT SPORT Nitraflex 300g</a></h4>
                           <div class="product-price "><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>8,699</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>6,199</span></ins></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/12.png" class="attachment-shop_single size-shop_single wp-post-image" alt="Proburst-Whey-Supreme-2kg-BCAA-Powder-300g"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Proburst Whey Supreme 2kg + BCAA Powder 300g</a></h4>
                           <div class="product-price "><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>3,999</span></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/8.png" class="attachment-shop_single size-shop_single wp-post-image" alt="Proburst-Whey-Supreme-2kg-BCAA-Powder-300g"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Proburst Ultimate Mass Gainer 3kg + BCAA Powder 300g</a></h4>
                           <div class="product-price "><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>2,899</span></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                  </div>
               </div>
            </div>
            <div class="infinity-page-title">Page 2</div>
            <div class="row">
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/6.png" class="attachment-shop_single size-shop_single wp-post-image" alt="Proburst-Whey-Supreme-2kg-Creatine-monohydrate-Powder-300Gm"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Proburst Whey Supreme  2kg + Creatine monohydrate Powder 300Gm</a></h4>
                           <div class="product-price "><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>3,549</span></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/5.png" class="attachment-shop_single size-shop_single wp-post-image" alt="Gaspari Myofusion Advanced Protien + Super Pump Maxx Fruit Punch"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Gaspari Myofusion Advanced Protien + Super Pump Maxx Fruit Punch</a></h4>
                           <div class="product-price "><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>5,999</span></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="p-discount">25% OFF</div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/2.png" class="attachment-shop_single size-shop_single wp-post-image" alt="ESN Nitro Whey (4.4 lbs) Swiss Chocolate + ESN Hyper Amino Max (220g) Bubble Gum Free worth Rs2599"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">ESN Nitro Whey (4.4 lbs) Swiss Chocolate + ESN Hyper Amino Max (220g) Bubble Gum Free worth Rs2599</a></h4>
                           <div class="product-price "><span class="del">Rs.5999</span><span>Rs.4499</span></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/2.png" class="images/14.png" alt="Rsp Nutrition Joint Support 180 Capsules"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Ultimate Nutrition Prostar 100% Whey Protein 5.28 LBS Chocolate Cream + Free UN Bcaa 1 Lbs</a></h4>
                           <div class="product-price "><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>5,499</span></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                     <div class="out-of-stock-label">SOLD OUT</div>
                  </div>
               </div>
               
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="p-discount">32% OFF</div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/12.png" class="attachment-shop_single size-shop_single wp-post-image" alt="Ultimate Nutrition ISO Sensation 93, 2 lb( Combo )"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Ultimate Nutrition ISO Sensation 93, 2 lb( Combo )</a></h4>
                           <div class="product-price "><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>6,598</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>4,499</span></ins></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                     <div class="out-of-stock-label">SOLD OUT</div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/8.png" class="attachment-shop_single size-shop_single wp-post-image" alt=""></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">RSP Nutrition Amino Focus, 0.49 lb BUY 1 GET 1</a></h4>
                           <div class="product-price "><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>2,899</span></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                     <div class="out-of-stock-label">SOLD OUT</div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="p-discount">28% OFF</div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/7.png" class="attachment-shop_single size-shop_single wp-post-image" alt="Mutant whey 5lbs Triple Chocolate Free Mutant BCAA Watermelon"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Mutant whey 5lbs Triple Chocolate + Free Mutant BCAA 30 serving</a></h4>
                           <div class="product-price "><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>6,499</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>4,699</span></ins></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                     <div class="out-of-stock-label">SOLD OUT</div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/6.png" class="attachment-shop_single size-shop_single wp-post-image" alt="Nature’s Best Isopure Zero Carb Protein Powder, 3 lb + Free RSP Nutrition L-Carnitine, 120 caps"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Nature’s Best Isopure Zero Carb Protein Powder, 3 lb + Free UN BCAA Powder Pink Lemonade(60 ser)</a></h4>
                           <div class="product-price "><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>5,329</span></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                     <div class="out-of-stock-label">SOLD OUT</div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="p-discount">32% OFF</div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/5.png" class="attachment-shop_single size-shop_single wp-post-image" alt="Mutant whey 5lbs Triple Chocolate Free Mutant BCAA Watermelon"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Mutant Whey 10lbs Triple Chocolate + Free Mutant BCAA 30 servings</a></h4>
                           <div class="product-price "><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>10,999</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>7,499</span></ins></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                     <div class="out-of-stock-label">SOLD OUT</div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/3.png" class="attachment-shop_single size-shop_single wp-post-image" alt="Proburst-Whey-Supreme-2kg-BCAA-Powder-300g-Creatine-Powder-300g"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Proburst Whey Supreme 2kg + BCAA Powder  300g + Creatine Powder 300g</a></h4>
                           <div class="product-price "><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>4,199</span></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                     <div class="out-of-stock-label">SOLD OUT</div>
                  </div>
               </div>
               <div class="col-4">
                  <div class="product-short-info ">
                     <div>
                        <div class="product-img"><a href="#"><img width="370" height="370" src="<?php echo base_url();?>assets/images/2.png" class="attachment-shop_single size-shop_single wp-post-image" alt="Optimum Nutrition Serious mass 12lbs Chocolate + Mutant BCAA 348g 30 serving"></a></div>
                        <div class="product-desc">
                           <h4 class="text-truncate"><a href="#">Optimum Nutrition Serious mass 12lbs Chocolate + Mutant BCAA 348g 30 serving</a></h4>
                           <div class="product-price "><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">Rs.</span>5,559</span></div>
                        </div>
                        <p class="text-center"><a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">Add To Cart</button></a>&nbsp;&nbsp;<a href="<?php echo base_url();?>product/single_page"><button class="btn btn-primary3" style="color:#fff;">View More</button></a></p><br>
                        <!-- <div class="p-action"><a href="javascript:void(0)" class="btn btn-watchlist  " data-button="1" data-id="7598"><i class="fa fa-heart"></i></a><a href="#" class="btn btn-add2cart-grey"><i class="fa fa-cart-plus" style="color: #565555;font-size: 20px;padding-right: 10px;"></i>View Product</a></div> -->
                     </div>
                     <div class="out-of-stock-label">SOLD OUT</div>
                  </div>
               </div>
            </div>
            
            
            <div id="productEndsHere"></div>
         </div>
      </div>
   </div>
</div>

            </div>
         </div>
      </div>
      
      
      <br>
      
      <!-- //n -->
      <!-- footer -->
            
            <?php include_once(APPPATH.'views/includes/footer.php'); ?>

      <!-- //footer --> 
      <!-- Bootstrap Core JavaScript -->
      <script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>
      <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
      <script type="<?php echo base_url();?>assets/text/javascript" src="js/move-top.js"></script>
      <script src="<?php echo base_url();?>assets/js/minicart.min.js"></script>
      <!-- <script type="text/javascript" src="js/easing.js"></script> -->
      <!-- <script type="text/javascript">
         jQuery(document).ready(function($) {
            $(".scroll").click(function(event){    
               event.preventDefault();
               $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
         });
      </script> -->
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
      <!-- <script src="js/skdslider.min.js"></script> -->
      <!-- <link href="css/skdslider.css" rel="stylesheet"> -->
      <!-- <script type="text/javascript">
         jQuery(document).ready(function(){
            jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});
            
            jQuery('#responsive').change(function(){
               $('#responsive_wrapper').width(jQuery(this).val());
            });
            
         });
      </script> -->
      <!-- <script type="text/javascript">
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
      </script> -->   
      <!-- //main slider-banner --> 
   </body>
</html>
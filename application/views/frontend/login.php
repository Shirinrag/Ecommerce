<!DOCTYPE html>
<html lang="en">

<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
    <!-- css
         ============================================ -->
    <?php include('common/cssfiles.php');?>
    <style type="text/css">
    body {
        font-family: 'Roboto', sans-serif
    }
    </style>
</head>

<body class="res layout-1 layout-subpage">
    <div id="wrapper" class="wrapper-fluid banners-effect-5">
        <!-- Header Container  -->
        <?php include('common/header.php');?>

        <!-- //Header Container  -->
        <!-- Main Container  -->
        <div class="main-container container">
            <ul class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i></a></li>
                <li><a href="#">Account</a></li>
                <li><a href="#">Login</a></li>
            </ul>
            <div class="row">
                <div id="content" class="col-sm-12">
                    <div class="page-login">
                        <div class="account-border">
                            <div class="row">
                                <!-- <div class="col-sm-6 new-customer">
                              <div class="well">
                                 <h2><i class="fa fa-file-o" aria-hidden="true"></i> New Customer</h2>
                                 <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                              </div>
                              <div class="bottom-form">
                                 <a href="#" class="btn btn-default pull-right">Continue</a>
                              </div>
                           </div> -->
                                <?php echo form_open('Frontend/user_login', array('id' => 'user_login_form')) ?>
                                <div class="col-sm-6 customer-login center">
                                    <div class="well">

                                        <div class="form-group">
                                            <label class="control-label " for="input-email">Contact No</label>
                                            <input type="text" name="contact_no" class="form-control" />
                                            <span class="error_msg" id="contact_no_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label " for="input-password">Password</label>
                                            <input type="password" name="password" class="form-control" />
                                            <span class="error_msg" id="password_error"></span>
                                        </div>
                                    </div>
                                    <div class="bottom-form">
                                        <!-- <a href="#" class="forgot">Forgotten Password</a> -->
                                        <button class="btn btn-primary" id="login_button"
                                            data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading"
                                            type="submit">Login</button>
                                    </div>
                                </div>
                                <?php echo form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- //Main Container -->
        <!-- Footer Container -->
        <footer class="footer-container typefooter-1">
            <!-- Footer Top Container -->
            <section class="footer-top">
                <div class="container ftop">
                    <div class="row">
                        <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12 ">
                            <div class="module newsletter-footer1">
                                <div class="newsletter" style="width:100%   ; background-color: #fff ; ">
                                    <div class="title-block">
                                        <div class="page-heading font-title">
                                            Signup for Newsletter
                                        </div>
                                        <div class="promotext">We’ll never share your email address with a third-party.
                                        </div>
                                    </div>
                                    <div class="block_content">
                                        <form method="post" id="signup" name="signup"
                                            class="form-group form-inline signup send-mail">
                                            <div class="form-group">
                                                <div class="input-box">
                                                    <input type="email" placeholder="Your email address..." value=""
                                                        class="form-control" id="txtemail" name="txtemail" size="55">
                                                </div>
                                                <div class="subcribe">
                                                    <button class="btn btn-primary btn-default font-title" type="submit"
                                                        onclick="return subscribe_newsletter();" name="submit">
                                                        Subscribe
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!--/.modcontent-->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 ">
                            <ul class="socials">
                                <li class="facebook"><a class="_blank" href="https://www.facebook.com/MagenTech"
                                        target="_blank"><i class="fa fa-facebook"></i><span>Facebook</span></a></li>
                                <li class="twitter"><a class="_blank" href="https://twitter.com/smartaddons"
                                        target="_blank"><i class="fa fa-twitter"></i><span>Twitter</span></a></li>
                                <li class="google_plus"><a class="_blank"
                                        href="https://plus.google.com/u/0/+Smartaddons/posts" target="_blank"><i
                                            class="fa fa-google-plus"></i><span>Google Plus</span></a></li>
                                <li class="pinterest"><a class="_blank" href="https://www.pinterest.com/smartaddons/"
                                        target="_blank"><i class="fa fa-pinterest"></i><span>Pinterest</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /Footer Top Container -->
            <div class="footer-middle ">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-style">
                            <div class="infos-footer">
                                <a href="#"><img src="image/catalog/logo-footer.png" alt="image"></a>
                                <ul class="menu">
                                    <li class="adres">
                                        San Luis potosí, centro historico, 78000 san luis potosí, SPL, Mexico
                                    </li>
                                    <li class="phone">
                                        (+0214)0 315 215 - (+0214)0 315 215
                                    </li>
                                    <li class="mail">
                                        <a href="mailto:contact@opencartworks.com">contact@opencartworks.com</a>
                                    </li>
                                    <li class="time">
                                        Open time: 8:00AM - 6:00PM
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-style">
                            <div class="box-information box-footer">
                                <div class="module clearfix">
                                    <h3 class="modtitle">Information</h3>
                                    <div class="modcontent">
                                        <ul class="menu">
                                            <li><a href="#">About Us</a></li>
                                            <li><a href="#">FAQ</a></li>
                                            <li><a href="#">Warranty And Services</a></li>
                                            <li><a href="#">Support 24/7 page</a></li>
                                            <li><a href="#">Product Registration</a></li>
                                            <li><a href="#">Product Support</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-style">
                            <div class="box-account box-footer">
                                <div class="module clearfix">
                                    <h3 class="modtitle">My Account</h3>
                                    <div class="modcontent">
                                        <ul class="menu">
                                            <li><a href="#">Brands</a></li>
                                            <li><a href="#">Gift Certificates</a></li>
                                            <li><a href="#">Affiliates</a></li>
                                            <li><a href="#">Specials</a></li>
                                            <li><a href="#">FAQs</a></li>
                                            <li><a href="#">Custom Link</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-style">
                            <div class="box-service box-footer">
                                <div class="module clearfix">
                                    <h3 class="modtitle">Services</h3>
                                    <div class="modcontent">
                                        <ul class="menu">
                                            <li><a href="#">Contact Us</a></li>
                                            <li><a href="#">Returns</a></li>
                                            <li><a href="#">Support</a></li>
                                            <li><a href="#">Site Map</a></li>
                                            <li><a href="#">Customer Service</a></li>
                                            <li><a href="#">Custom Link</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-style">
                            <div class="module box-footer so-instagram-gallery-ltr">
                                <h4 class="modtitle">Instagram Gallery</h4>
                                <div class="form-group">
                                </div>
                                <div class="modcontent">
                                    <div class="so-instagram-gallery button-type2 4" id="instagram17356972741514990310">
                                        <div
                                            class="instagram-items-inner instagram00-5 instagram01-4 instagram02-3 instagram03-2 instagram04-1">
                                            <div class="instagram-item 0  first-item ">
                                                <div class="instagram_users">
                                                    <div class="img_users">
                                                        <a title="Emarket"
                                                            data-href="https://www.instagram.com/p/BWcLaN9DQfW/"
                                                            class="instagram_gallery_image gallery_image_instagram17356972741514990310"
                                                            href="../../../../scontent.cdninstagram.com/t51.2885-15/s320x320/e35/19985119_1789473437940076_2055170824985378816_nb25f.jpg?taken-by=swhotdeal">
                                                            <img class="image_users"
                                                                src="../../../../scontent.cdninstagram.com/t51.2885-15/s320x320/e35/19985119_1789473437940076_2055170824985378816_n.jpg"
                                                                title="Emarket" alt="Emarket">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="instagram-item 1 ">
                                                <div class="instagram_users">
                                                    <div class="img_users">
                                                        <a title="Emarket"
                                                            data-href="https://www.instagram.com/p/BWcLY9XDLRu/"
                                                            class="instagram_gallery_image gallery_image_instagram17356972741514990310"
                                                            href="../../../../scontent.cdninstagram.com/t51.2885-15/s320x320/e35/19955766_152435575317196_2812535432292597760_nb25f.jpg?taken-by=swhotdeal">
                                                            <img class="image_users"
                                                                src="../../../../scontent.cdninstagram.com/t51.2885-15/s320x320/e35/19955766_152435575317196_2812535432292597760_n.jpg"
                                                                title="Emarket" alt="Emarket">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="instagram-item 2 ">
                                                <div class="instagram_users">
                                                    <div class="img_users">
                                                        <a title="Emarket"
                                                            data-href="https://www.instagram.com/p/BWcLT-rD17U/"
                                                            class="instagram_gallery_image gallery_image_instagram17356972741514990310"
                                                            href="../../../../scontent.cdninstagram.com/t51.2885-15/s320x320/e35/19933192_2345189812372940_1937990403319922688_nb25f.jpg?taken-by=swhotdeal">
                                                            <img class="image_users"
                                                                src="../../../../scontent.cdninstagram.com/t51.2885-15/s320x320/e35/19933192_2345189812372940_1937990403319922688_n.jpg"
                                                                title="Emarket" alt="Emarket">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="instagram-item 3 ">
                                                <div class="instagram_users">
                                                    <div class="img_users">
                                                        <a title="Emarket"
                                                            data-href="https://www.instagram.com/p/BWcLS_vjGhx/"
                                                            class="instagram_gallery_image gallery_image_instagram17356972741514990310"
                                                            href="../../../../scontent.cdninstagram.com/t51.2885-15/s320x320/e35/19984602_1912942795641671_1075249881506906112_nb25f.jpg?taken-by=swhotdeal">
                                                            <img class="image_users"
                                                                src="../../../../scontent.cdninstagram.com/t51.2885-15/s320x320/e35/19984602_1912942795641671_1075249881506906112_n.jpg"
                                                                title="Emarket" alt="Emarket">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="instagram-item 4 ">
                                                <div class="instagram_users">
                                                    <div class="img_users">
                                                        <a title="Emarket"
                                                            data-href="https://www.instagram.com/p/BWcLSNnDpJp/"
                                                            class="instagram_gallery_image gallery_image_instagram17356972741514990310"
                                                            href="../../../../scontent.cdninstagram.com/t51.2885-15/s320x320/e35/19985191_1485570878166875_6297995079118225408_nb25f.jpg?taken-by=swhotdeal">
                                                            <img class="image_users"
                                                                src="../../../../scontent.cdninstagram.com/t51.2885-15/s320x320/e35/19985191_1485570878166875_6297995079118225408_n.jpg"
                                                                title="Emarket" alt="Emarket">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/.instagram-items-inner-->
                                    </div>
                                </div>
                                <!-- /.modcontent-->
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-style">
                            <ul class="footer-links font-title">
                                <li><a href="#">Online Shopping</a></li>
                                <li><a href="#">Promotions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Site Map</a></li>
                                <li><a href="#">Orders and Returns</a></li>
                                <li><a href="#">Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Support</a></li>
                                <li><a href="#">Most Populars</a></li>
                                <li><a href="#">New Arrivals</a></li>
                                <li><a href="#">Special Products</a></li>
                                <li><a href="#">Manufacturers</a></li>
                                <li><a href="#">Shipping</a></li>
                                <li><a href="#">Payments</a></li>
                                <li><a href="#">Returns</a></li>
                                <li><a href="#">Refunds</a></li>
                                <li><a href="#">Warantee</a></li>
                                <li><a href="#">Promotions</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">Our Stores</a></li>
                                <li><a href="#">Discount</a></li>
                                <li><a href="#">Checkout</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-12 col-xs-12 text-center">
                            <img src="image/catalog/demo/payment/payment.png" alt="imgpayment">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Bottom Container -->
            <div class="footer-bottom ">
                <div class="container">
                    <div class="copyright">
                        eMarket © 2018 Demo Store. All Rights Reserved. Designed by <a
                            href="http://www.opencartworks.com/" target="_blank">OpenCartWorks.Com</a>
                    </div>
                </div>
            </div>
            <!-- /Footer Bottom Container -->
            <!--Back To Top-->
            <div class="back-to-top"><i class="fa fa-angle-up"></i></div>
        </footer>
        <!-- //end Footer Container -->
    </div>
    <!-- Include Libs & Plugins
    ============================================ -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include('common/jsfiles.php');?>
    <script src="<?= base_url();?>assets_frontend/custom_js/login.js"></script>
</body>

</html>
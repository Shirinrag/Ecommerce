<!-- 
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC5zP5maaMDAbohXafawDZNIZfGOZS0fAM"></script>
<script>
    var myCenter=new google.maps.LatLng(19.1841581, 73.0376616);

    function initialize()
    {
        var mapProp = {
            center:myCenter,
            zoom:18,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };

        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
        var marker=new google.maps.Marker({position:myCenter,});
        marker.setMap(map);
        var infowindow = new google.maps.InfoWindow({content:"Tara Grocery Store<br>Siddhant Prapti Apt.<br>Om Sai nagar,Sabe road,<br>Diva east<br>Thane 400612" });
        infowindow.open(map,marker);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script> -->
<!-- <div class="row">
    <div class="col-md-12">
        

    </div>
</div> -->
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>Contact</li>
            </ul>
        </div>
    </div>
</div>

<div class="body-content">
    <div class="container">
        <div class="contact-page">
            <div class="row">

                <div class="col-md-12 contact-map outer-bottom-vs" id="googleMap" style="height:300px;margin-top: 120px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3170.741609996941!2d72.90342718568304!3d19.07830809406979!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c62f4b1b27ef%3A0xf5b946cd2852375a!2sMaheshwar+Nagar%2C+Ghatkopar+East%2C+Mumbai%2C+Maharashtra+400077!5e0!3m2!1sen!2sin!4v1557140894259!5m2!1sen!2sin" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                    
                </div>
            </div>
            <div class="row" style="margin-top: 5em;">
                
                    <div class="col-md-6 contact-form">
                        <form onsubmit="return validate_contact_form(this);" id="contact_us">
                        <div class="col-md-12 contact-title"><h4>Contact Form</h4></div>

                        <div class="col-md-12">
                            <div class="alert alert-success" style="display:none"> </div>
                            <div class="alert alert-danger" style="display:none"></div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="info-title" for="cname">Your Name <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="cname">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="info-title" for="contact_number">Mobile number <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="contact_number" maxlength="10">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="info-title" for="cemail">Email Address <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input" id="cemail">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="info-title" for="csubject">Subject <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="csubject">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="info-title" for="cmessage">Your Comments <span>*</span></label>
                                <textarea class="form-control unicase-form-control" id="cmessage"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 outer-bottom-small m-t-20" style="margin-bottom: 20px;">
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button btn-submit">Send Message</button>
                        </div>
                         </form>
                    </div>
               

                <div class="col-md-6 contact-info">
                    <div class="contact-title">
                        <h4>Information</h4>
                    </div>
                    <div class="clearfix address">
                        <span class="contact-i"><i class="fa fa-map-marker"></i></span>
                        <span class="contact-span">
                            <p>WheyFood.com,<br>
                            Maheshwar Nagar<br>
                            Ghatkopar East, Mumbai,<br> Maharashtra 400077</p>
                        </span>
                    </div>
                    <div class="clearfix phone-no">
                        <span class="contact-i"><i class="fa fa-mobile"></i></span>
                        <span class="contact-span">+91 9987363047</span>
                    </div>
                    <div class="clearfix email">
                        <span class="contact-i"><i class="fa fa-envelope"></i></span>
                        <span class="contact-span"><a href="mailto:info@taragrocery.com">info@wheyfood.com</a></span>
                    </div>
                </div> 

            </div>
        </div>
    </div>
</div>


<?php include_once(APPPATH.'views/includes/footer.php'); ?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui-1.12.0.css">
<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url();?>assets/js/jquery-ui.1.12.0.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

<script src="<?php echo base_url();?>assets/js/bootstrap-hover-dropdown.min.js"></script>
<script src="<?php echo base_url();?>assets/js/owl.carousel.min.js"></script>

<script src="<?php echo base_url();?>assets/js/echo.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.easing-1.3.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-slider.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.rateit.min.js"></script>
<script src="<?php echo base_url();?>assets/js/lightbox.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
<script src="<?php echo base_url();?>assets/js/scripts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/sweet-alert.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/peekABar/js/jquery.peekabar.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/direct_farm.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/google_tracker.js"></script>

</body>
</html>


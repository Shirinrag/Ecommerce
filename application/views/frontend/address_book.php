<!DOCTYPE html>
<html lang="en">

<head>
    <!-- css
         ============================================ -->
    <?php include('common/cssfiles.php');?>
    <style type="text/css">
    body {
        font-family: 'Roboto', sans-serif
    }

    #map {
        height: 100%;
    }

    /* 
 * Optional: Makes the sample page fill the window. 
 */
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    </style>
</head>

<body class="res layout-1 layout-subpage">
    <?php define("API_KEY","AIzaSyB2eEw1FoYsvKOCw_Ou-YTP3zDAAr7Lm94");?>

    <div id="map-layer"></div>
    <div id="wrapper" class="wrapper-fluid banners-effect-5">
        <!-- Header Container  -->
        <?php include('common/header.php');?>
        <!-- //Header Container  -->

        <!-- Main Container  -->
        <div class="main-container container">
            <ul class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i></a></li>
                <li><a href="#">Account</a></li>
                <li><a href="#">My Account</a></li>
            </ul>
            <div class="row">
                <!--Middle Part Start-->
                <div class="col-sm-9" id="content">
                    <h2 class="title">My Account</h2>

                    <?php echo form_open('Frontend/save_new_address', array('id' => 'save_new_address_form')) ?>

                    <div class="row">

                        <div class="col-sm-12">
                           <fieldset id="shipping-address">
                              <legend>Shipping Address</legend>
                              <div class="form-group">
                                 <label class="control-label">Address Type</label>
                                 <select class="form-control select2" name="address_type" data-placeholder="Address Type">
                                    <option value=""></option>
                                    <option value="1">Home</option>
                                    <option value="2">Office</option>
                                    <option value="3">Others</option>
                                    
                                 </select>
                                  <span class="error_msg" id="address_type_error"></span>
                              </div>
                              <div class="form-group">
                                 <label for="input-company" class="control-label">Room No</label>
                                 <input type="text" class="form-control"  placeholder="Room No" name="roomno" id="roomno">
                                  <span class="error_msg" id="roomno_error"></span>

                                    </select>
                                    <span class="error_msg" id="address_type_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="input-company" class="control-label">Room No</label>
                                    <input type="text" class="form-control" placeholder="Room No" name="roomno"
                                        id="roomno">
                                    <span class="error_msg" id="address_type_error"></span>

                                </div>
                                <div class="form-group required">
                                    <label for="input-address-1" class="control-label">Building</label>
                                    <input type="text" class="form-control" placeholder="Building" name="building"
                                        id="building">
                                    <span class="error_msg" id="building_error"></span>

                                </div>
                                <div class="form-group required">
                                    <label for="input-city" class="control-label">Street</label>
                                    <input type="text" class="form-control" id="city" placeholder="City" name="city">
                                    <span class="error_msg" id="city_error"></span>

                                </div>
                                <div class="form-group required">
                                    <label for="input-postcode" class="control-label">Pincode</label>
                                    <input type="text" class="form-control" id="postcode" placeholder="Post Code"
                                        name="postcode">
                                    <span class="error_msg" id="postcode_error"></span>

                                </div>
                            </fieldset>
                        </div>
                        <!--     <p>Latitude:
            <input type="text" id="latitude" readonly />
        </p>
        <p>Longitude:
            <input type="text" id="longitude" readonly />
        </p> -->
                    </div>
                    <div class="buttons clearfix">
                        <div class="pull-left">
                            <button class="btn btn-primary" id="save_new_address_button"
                                data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading"
                                type="submit">Submit</button>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>

                <!--Middle Part End-->
                <!--Right Part Start -->
                <?php include('common/myaccountsidepart.php');?>
                <!--Right Part End -->
            </div>
        </div>

        <!-- //Main Container -->

        <!-- Footer Container -->
        <?php include('common/footer.php');?>
        <!-- //end Footer Container -->

        <!-- Include Libs & Plugins
         ============================================ -->

        <?php include('common/jsfiles.php');?>
        <script src="<?= base_url();?>assets_frontend/custom_js/address_book.js"></script>


        <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo API_KEY; ?>&callback=initMap" async defer>
        </script>
        <script type="text/javascript">
        var map;
        var geocoder;

        function initMap() {
            var mapLayer = document.getElementById("map-layer");
            var centerCoordinates = new google.maps.LatLng(37.6, -95.665);
            var defaultOptions = {
                center: centerCoordinates,
                zoom: 4
            }

            map = new google.maps.Map(mapLayer, defaultOptions);
            geocoder = new google.maps.Geocoder();

            <?php 
            if(!empty($countryResult)) 
            {
                foreach($countryResult as $k=>$v)
                {   
         ?>
            geocoder.geocode({
                'address': '<?php echo $_POST["room"].$_POST["building"].$_POST["city"].$_POST["zipcode"] ?>'
            }, function(LocationResult, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var latitude = LocationResult[0].geometry.location.lat();
                    var longitude = LocationResult[0].geometry.location.lng();
                }
                new google.maps.Marker({
                    position: new google.maps.LatLng(latitude, longitude),
                    map: map,
                    title: '<?php echo $_POST["room"].$_POST["building"].$_POST["city"].$_POST["zipcode"] ?>'
                });
            });
            <?php
                }
            }
       ?>
        }
        </script>

</body>

</html>
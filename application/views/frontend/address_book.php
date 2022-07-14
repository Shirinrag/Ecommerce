<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- css
         ============================================ -->
      <?php include('common/cssfiles.php');?>
      <style type="text/css">
         body{font-family:'Roboto', sans-serif}
      </style>
   </head>
   <body class="res layout-1 layout-subpage">
      <div id="map"></div>
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
                              </div>
                              <div class="form-group">
                                 <label for="input-company" class="control-label">Room No</label>
                                 <input type="text" class="form-control"  placeholder="Room No" name="roomno">
                              </div>
                              <div class="form-group required">
                                 <label for="input-address-1" class="control-label">Building</label>
                                 <input type="text" class="form-control" placeholder="Building" name="building">
                              </div>
                              <div class="form-group required">
                                 <label for="input-city" class="control-label">Street</label>
                                 <input type="text" class="form-control" id="input-city" placeholder="City" value="" name="city">
                              </div>
                              <div class="form-group required">
                                 <label for="input-postcode" class="control-label">Zone</label>
                                 <input type="text" class="form-control" id="input-postcode" placeholder="Post Code" value="" name="postcode">
                              </div>
                              </fieldset>
                        </div>
                     </div>
                     <div class="buttons clearfix">
                        <div class="pull-left">
                            <button class="btn btn-primary" id="register_button" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading" type="submit">Submit</button>
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

   </body>

</html>
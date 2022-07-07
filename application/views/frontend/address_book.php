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
                 
                  <form>
                     
                     <div class="row">
                       
                        <div class="col-sm-12">
                           <fieldset id="shipping-address">
                              <legend>Shipping Address</legend>
                              <div class="form-group">
                                 <label for="input-company" class="control-label">Room No</label>
                                 <input type="text" class="form-control" id="input-company" placeholder="Company" value="" name="company">
                              </div>
                              <div class="form-group required">
                                 <label for="input-address-1" class="control-label">Building</label>
                                 <input type="text" class="form-control" id="input-address-1" placeholder="Address 1" value="" name="address_1">
                              </div>
                              <div class="form-group required">
                                 <label for="input-city" class="control-label">Street</label>
                                 <input type="text" class="form-control" id="input-city" placeholder="City" value="" name="city">
                              </div>
                              <div class="form-group required">
                                 <label for="input-postcode" class="control-label">Zone</label>
                                 <input type="text" class="form-control" id="input-postcode" placeholder="Post Code" value="" name="postcode">
                              </div>
                              <!-- <div class="form-group required">
                                 <label for="input-country" class="control-label">Country</label>
                                 <select class="form-control" id="input-country" name="country_id">
                                    <option value=""> --- Please Select --- </option>
                                    <option value="244">Aaland Islands</option>
                                    <option value="1">Afghanistan</option>
                                    <option value="2">Albania</option>
                                    <option value="3">Algeria</option>
                                    <option value="4">American Samoa</option>
                                    <option value="5">Andorra</option>
                                    <option value="6">Angola</option>
                                    <option value="7">Anguilla</option>
                                    <option value="8">Antarctica</option>
                                    <option value="9">Antigua and Barbuda</option>
                                    <option value="10">Argentina</option>
                                    <option value="11">Armenia</option>
                                    <option value="12">Aruba</option>
                                 </select>
                              </div>
                              <div class="form-group required">
                                 <label for="input-zone" class="control-label">Region / State</label>
                                 <select class="form-control" id="input-zone" name="zone_id">
                                    <option value=""> --- Please Select --- </option>
                                    <option value="3513">Aberdeen</option>
                                    <option value="3514">Aberdeenshire</option>
                                    <option value="3515">Anglesey</option>
                                    <option value="3516">Angus</option>
                                    <option value="3517">Argyll and Bute</option>
                                    <option value="3518">Bedfordshire</option>
                                    <option value="3519">Berkshire</option>
                                 </select>
                              </div> -->
                           </fieldset>
                        </div>
                     </div>
                     <div class="buttons clearfix">
                        <div class="pull-left">
                           <input type="submit" class="btn btn-md btn-primary" value="Save Changes">
                        </div>
                     </div>
                  </form>
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
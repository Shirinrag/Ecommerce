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
                           <fieldset id="personal-details">
                              <legend>Personal Details</legend>
                              <div class="form-group required">
                                 <label for="input-firstname" class="control-label">First Name</label>
                                 <input type="text" class="form-control" id="input-firstname" placeholder="First Name" value="" name="firstname">
                              </div>
                              <div class="form-group required">
                                 <label for="input-lastname" class="control-label">Last Name</label>
                                 <input type="text" class="form-control" id="input-lastname" placeholder="Last Name" value="" name="lastname">
                              </div>
                              <div class="form-group required">
                                 <label for="input-email" class="control-label">E-Mail</label>
                                 <input type="email" class="form-control" id="input-email" placeholder="E-Mail" value="" name="email">
                              </div>
                              <div class="form-group required">
                                 <label for="input-telephone" class="control-label">Telephone</label>
                                 <input type="tel" class="form-control" id="input-telephone" placeholder="Telephone" value="" name="telephone">
                              </div>
                          
                           </fieldset>
                           <br>
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
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
               <li><a href="#">Register</a></li>
            </ul>
            <div class="row">
               <div id="content" class="col-sm-12">
                  <h2 class="title">Register Account</h2>
                  <p>If you already have an account with us, please login at the <a href="#">login page</a>.</p>
                  <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal account-register clearfix">
                     <fieldset id="account">
                        <legend>Your Personal Details</legend>
                        <div class="form-group required" style="display: none;">
                           <label class="col-sm-2 control-label">Customer Group</label>
                           <div class="col-sm-10">
                              <div class="radio">
                                 <label>
                                 <input type="radio" name="customer_group_id" value="1" checked="checked"> Default
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="form-group required">
                           <label class="col-sm-2 control-label" for="input-firstname">First Name</label>
                           <div class="col-sm-10">
                              <input type="text" name="firstname" value="" placeholder="First Name" id="input-firstname" class="form-control">
                           </div>
                        </div>
                        <div class="form-group required">
                           <label class="col-sm-2 control-label" for="input-lastname">Last Name</label>
                           <div class="col-sm-10">
                              <input type="text" name="lastname" value="" placeholder="Last Name" id="input-lastname" class="form-control">
                           </div>
                        </div>
                        <div class="form-group required">
                           <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
                           <div class="col-sm-10">
                              <input type="email" name="email" value="" placeholder="E-Mail" id="input-email" class="form-control">
                           </div>
                        </div>
                        <div class="form-group required">
                           <label class="col-sm-2 control-label" for="input-telephone">Telephone</label>
                           <div class="col-sm-10">
                              <input type="tel" name="telephone" value="" placeholder="Telephone" id="input-telephone" class="form-control">
                           </div>
                        </div>
                        <div class="form-group required">
                           <label class="col-sm-2 control-label" for="input-password">Password</label>
                           <div class="col-sm-10">
                              <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control">
                           </div>
                        </div>
                        <div class="form-group required">
                           <label class="col-sm-2 control-label" for="input-confirm">Password Confirm</label>
                           <div class="col-sm-10">
                              <input type="password" name="confirm" value="" placeholder="Password Confirm" id="input-confirm" class="form-control">
                           </div>
                        </div>
                       
                     </fieldset>
                   
                     <div class="buttons">
                        <div class="pull-right">I have read and agree to the <a href="#" class="agree"><b>Pricing Tables</b></a>
                           <input class="box-checkbox" type="checkbox" name="agree" value="1"> &nbsp;
                           <input type="submit" value="Continue" class="btn btn-primary">
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <!-- //Main Container -->
         <!-- Footer Container -->
         <?php include('common/footer.php'); ?>
         <!-- //end Footer Container -->
      </div>
      <!-- Include Libs & Plugins
         ============================================ -->
      <!-- Placed at the end of the document so the pages load faster -->
      <?php include('common/jsfiles.php');?>    
   </body>
  
</html>
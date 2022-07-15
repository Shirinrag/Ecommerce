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
               <div id="content" class="col-sm-6">

                  <h2 class="title">Register Account</h2>
                  <p>If you already have an account with us, please login at the <a href="#">login page</a>.</p>
                    <?php echo form_open('Frontend/user_register', array('id' => 'user_register_form')) ?>
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
                           <label class="col-sm-2 control-label" for="input-firstname">User Name</label>
                           <div class="col-sm-10">
                              <input type="text" name="user_name" placeholder="User Name" class="form-control">
                                <span class="error_msg" id="user_name_error"></span>
                           </div>
                        </div>
                     
                        <div class="form-group required">
                           <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
                           <div class="col-sm-10">
                              <input type="email" name="email"placeholder="E-Mail" id="email" class="form-control">
                             <span class="error_msg" id="email_error"></span>

                           </div>
                        </div>
                        <div class="form-group required">
                           <label class="col-sm-2 control-label" for="input-telephone">Telephone</label>
                           <div class="col-sm-10">
                              <input type="text" name="contact_no" placeholder="Telephone" class="form-control">
                             <span class="error_msg" id="contact_no_error"></span>

                           </div>
                        </div>
                        <div class="form-group required">
                           <label class="col-sm-2 control-label" for="input-password">Password</label>
                           <div class="col-sm-10">
                              <input type="password" name="password" placeholder="Password" class="form-control">
                             <span class="error_msg" id="password_error"></span>

                           </div>
                        </div>                       
                     </fieldset>
                   <br>
                     <div class="buttons">
                        <div class="pull-right">                        
                         <button class="btn btn-primary" id="register_button" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading" type="submit">Submit</button>
                     </div>
                     </div>
                   <?php echo form_close() ?>
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
          <script src="<?= base_url();?>assets_frontend/custom_js/register.js"></script>
   </body>
  
</html>
     

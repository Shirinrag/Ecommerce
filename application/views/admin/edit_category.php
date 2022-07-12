
<!DOCTYPE html>
<html lang="en">
<head>
   <title>Circuit Store || Update Category</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <link rel="icon" href="favicon.ico" type="image/x-icon" />
   <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url()?>assets-admin/css/theme-default.css"/>
   <style type="text/css">
      .form-horizontal .form-group {
         margin-right: 0px;
         margin-left: 0px;
         margin-top: 10px;
         margin-bottom: 10px;
      }
   </style>
   <!-- EOF CSS INCLUDE -->                 
</head>
<body>
   <div class="page-container">
      <div class="page-sidebar">
         <?php $this->load->view('admin/includes/sidebar');?> 
      </div>
      <div class="page-content">
         <?php $this->load->view('admin/includes/header');?> 
         <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Category</a></li>
            <li class="active">Edit Category</li>
         </ul>

         <div class="page-content-wrap">
            <div class="row">
               <div class="panel">

                <div class="panel-heading nopaddingbottom"><h4 class="panel-title"><b>Edit Category</b></h4></div>
                <div class="panel-body">
                  <hr>
                  <form id="basicForm" method="post" action="<?php echo base_url();?>Admin/update_category" enctype="multipart/form-data" class="form-horizontal" novalidate="novalidate" onsubmit="return validate_edit_category(this);">
                     <div class="alert alert-success" style="display:none;"></div>
                     <div class="alert alert-danger" style="display:none;"></div>
                     <div class="form-group">
                        <div class="col-sm-3 mr20">
                           <label>Language<span class="text-danger">*</span></label>
                           <div><span><?php echo $category_data[0]['lang_name'];?></span>
                           </div>
                        </div>
                        <div class="col-sm-3 mr20">
                           <input type="hidden" name="category_id" id="category_id" value="<?php echo $category_data[0]['category_id'];?>">
                           <label>Enter category name<span class="text-danger">*</span></label>
                           <input type="text" name="category_name" id="category_name" dir="rtl" class="form-control" value="<?php echo $category_data[0]['category_name'];?>" required="">
                        </div>
                        <!-- <div class="col-sm-3 mr20">
                           <label>Enter category name(ar)<span class="text-danger">*</span></label>
                           <input type="text" name="category_name_ar" dir="rtl" id="category_name_ar" class="form-control"  value="<?php echo $category_data[0]['category_name_ar'];?>" required="">
                        </div> -->
                        <div class="col-sm-3 mr20">
                           <label>category Image<span class="text-danger">*</span></label>
                           <input type="file" name="image_file" dir="rtl" accept="image/*" id="image_file" class="form-control" required="" value="" >
                        </div>
                        <div class="col-sm-3 mr20">
                          <img src="<?php echo base_url().$category_data[0]['image_path'];?>" style="width: 100px;height: 100px;">
                          <input type="hidden" name="image_path" value="<?php echo $category_data[0]['image_path'] ?>">
                        </div>
                        <div class="col-sm-3 mr20">
                          <label>Sort Order<span class="text-danger">*</span></label>
                          <input type="text" name="sort_order" dir="rtl" id="sort_order" class="form-control" required="" value="<?php echo $category_data[0]['sort_order'];?>">
                       </div>

                       <div class="col-sm-3 mr20">
                          <button class="btn btn-success btn-quirk btn-wide mr5" style="margin-top: 20px;">Submit</button>
                       </div>




                    </div>
                    <hr>

                 </form>
              </div>
           </div>
        </div>
     </div>
  </div>
</div>
<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
   <div class="mb-container">
      <div class="mb-middle">
         <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
         <div class="mb-content">
            <p>Are you sure you want to log out?</p>
            <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
         </div>
         <div class="mb-footer">
            <div class="pull-right">
               <a href="<?php echo base_url();?>Admin/logout" class="btn btn-success btn-lg">Yes</a>
               <button class="btn btn-default btn-lg mb-control-close">No</button>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap.min.js"></script>                
<script type='text/javascript' src='<?php echo base_url()?>assets-admin/js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>


<script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins.js"></script>        
<script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/actions.js"></script>     
<script src="<?php echo base_url();?>assets-admin/summernote/summernote.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/jquery-validate/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets_admin/js/admin.js"></script>
<script src="<?php echo base_url();?>assets_admin/js/sweetalert.min.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/jquery-maskedinput/jquery.maskedinput.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/timepicker/jquery.timepicker.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/dropzone/dropzone.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/jquery-validate/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets_admin/js/quirk.js"></script>
<script src="<?php echo base_url();?>assets_admin/js/admin.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/jquery-toggles/toggles.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/select2/select2.js"></script>
</body>

</html>


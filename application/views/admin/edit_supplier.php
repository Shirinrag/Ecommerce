<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- META SECTION -->
	  <title>Circuit Store || Add New Category</title>     
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url()?>assets-admin/css/theme-default.css"/>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

      <style type="text/css">
         .form-horizontal .form-group {
         margin-right: 0px;
         margin-left: 0px;
         margin-top: 10px;
         margin-bottom: 10px;
         }
         select[multiple], select[size] {
		    height: auto;
		    display: none;
		}
		.dropdown-menu > li > a {
		    padding: 0px 31px;
		    border-bottom: 1px solid #E9E9E9;
		    line-height: 22px;
		}
      </style>
      <!-- EOF CSS INCLUDE -->                 
   </head>
   <body>
      <!-- START PAGE CONTAINER -->
      <div class="page-container">
         <!-- START PAGE SIDEBAR -->
         <div class="page-sidebar">
            <!-- START X-NAVIGATION -->
            <?php $this->load->view('admin/includes/sidebar');?> 
            <!-- END X-NAVIGATION -->
         </div>
         <!-- END PAGE SIDEBAR -->
         <!-- PAGE CONTENT -->
         <div class="page-content">
            <!-- START X-NAVIGATION VERTICAL -->
            <?php $this->load->view('admin/includes/header');?> 
            <!-- END X-NAVIGATION VERTICAL -->                   
            <!-- START BREADCRUMB -->
            <ul class="breadcrumb">
               <li><a href="#">Home</a></li>
               <li><a href="#">Vendor</a></li>
               <li class="active">Edit Vendor</li>
            </ul>
            <!-- END BREADCRUMB -->
            <!-- PAGE TITLE -->
            
            <!-- END PAGE TITLE -->                
            <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">
               <div class="row">
                  <div class="panel">

		            <form id="basicForm" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>Admin/update_supplier_form" class="form-horizontal" novalidate="novalidate" onsubmit="return validate_update_supplier(this);">
			            <div class="panel-heading nopaddingbottom">
			            	<h4 class="panel-title">Edit Vendor</h4>
			            	<button class="btn btn-success btn-quirk btn-wide mr5" style="float: right;margin-top: 2px;">Update Vendor</button>
			            </div>
		              	<div class="panel-body">
			                <hr>
		                	<div class="alert alert-success" style="display:none;"></div>
	                		<div class="alert alert-danger" style="display:none;"></div>

	                		<?php if(isset($supplier_data) && !empty($supplier_data)){?>
			            		<input type="hidden" name="sup_id" id="sup_id" value="<?php echo $supplier_data[0]['id']; ?>">
			                  	<div class="row ml20 mb20">
				                    <div class="col-sm-4 mr20">
				                  		<div class="form-group">
					                    	<label>Enter Supplier name <span class="text-danger">*</span></label>
					                      	<input type="text" name="supplier_name" id="supplier_name" value="<?php echo $supplier_data[0]['supplier_name']; ?>"  class="form-control">
					                    </div>
					                </div>

				                    <div class="col-sm-2 mr20">
					                	<div class="form-group">
				                    		<label>Phone Number</label>
											<input type="text" name="phone_number" id="phone_number" value="<?php echo $supplier_data[0]['phone_number']; ?>" class="form-control">
					                    </div>
					                </div>

					                <div class="col-sm-2 mr20">
					                	<div class="form-group">
				                    		<label>Email Address</label>
											<input type="text" name="email_address" id="email_address" value="<?php echo $supplier_data[0]['email_address']; ?>" class="form-control">
					                    </div>
					                </div>

					                <div class="col-sm-2 mr20">
					                	<div class="form-group">
				                    		<label>Contact Person Name</label>
											<input type="text" name="contact_person_name" id="contact_person_name" value="<?php echo $supplier_data[0]['contact_person_name']; ?>" class="form-control">
					                    </div>
					                </div>
					            </div>

					            <div class="row ml20 mb20">
				                    
				                    <div class="col-sm-4 mr20">
					                 	<div class="form-group">
					                    	<label>Address 1 </label>
											<input type="text" class="form-control" name="address_1" id="address_1" value="<?php echo $supplier_data[0]['address_1']; ?>">
					                    </div>
					                </div>

				                    <div class="col-sm-4 mr20">
					                	<div class="form-group">
					                    	<label>Address 2 </label>
											<input type="text" class="form-control" name="address_2" id="address_2" value="<?php echo $supplier_data[0]['address_2']; ?>" >
					                    </div>
					                </div>

					                <div class="col-sm-2 mr20">
					                	<div class="form-group">
					                    	<label>Enter Area </label>
											<input type="text" class="form-control" name="area_name" id="area_name" value="<?php echo $supplier_data[0]['area_name']; ?>" >
					                    </div>
					                </div>
								</div>

								<div class="row ml20 mb20">
				                    <div class="col-sm-4 mr20">
					                 	<div class="form-group">
					                    	<label>City </label>
											<input type="text" class="form-control" name="city_name" id="city_name" value="<?php echo $supplier_data[0]['city_name']; ?>">
					                    </div>
					                </div>

				                    <div class="col-sm-2 mr20">
					                	<div class="form-group">
					                    	<label>State </label>
											<input type="text" class="form-control" name="state" id="state"  value="<?php echo $supplier_data[0]['state']; ?>">
					                    </div>
					                </div>

					                <div class="col-sm-2 mr20">
					                	<div class="form-group">
					                    	<label>Pincode </label>
											<input type="text" class="form-control" name="pincode" id="pincode" value="<?php echo $supplier_data[0]['pincode']; ?>" >
					                    </div>
					                </div>
								</div>
								<div class="row ml20 mb20">
								<div class="col-sm-3 mr20">
				                 	<div class="form-group">
				                    	<label>Invoice Upload </label>
				                    	<span id="gst_file_name"><a href="<?php echo base_url().'uploads/gst_files/'.$supplier_data[0]['gst_file_name'];?>"><?php echo $supplier_data[0]['gst_file_name']; ?></a></span>
				                    	<input type="hidden" name="gst_file_name" value="<?php echo $supplier_data[0]['gst_file_name']; ?>">
				                    	<input type="file" name="gst_file" id="gst_file" >
				                    </div>
				                </div>
				               
								
							</div>
							

							<?php }else{ ?>
								<div class="alert alert-danger"> Invalid Supplier Data</div>
							<?php }?>

	              		</div>
	               	</form>

	          	</div>
               </div>
            </div>
            <!-- END PAGE CONTENT WRAPPER -->                                                
         </div>
         <!-- END PAGE CONTENT -->
      </div>
      <!-- END PAGE CONTAINER -->
      <!-- MESSAGE BOX-->
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
                     <a href="<?php echo base_url();?>admin/logout" class="btn btn-success btn-lg">Yes</a>
                     <button class="btn btn-default btn-lg mb-control-close">No</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- END MESSAGE BOX-->
      <!-- START PRELOADS -->
      
      <!-- END PRELOADS -->             
      <!-- START SCRIPTS -->
      <!-- START PLUGINS -->
      <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/jquery/jquery.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/jquery/jquery-ui.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap.min.js"></script>                
      <!-- END PLUGINS -->
      <!-- THIS PAGE PLUGINS -->
      <script type='text/javascript' src='<?php echo base_url()?>assets-admin/js/plugins/icheck/icheck.min.js'></script>
      <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap-datepicker.js"></script>
      <!-- <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap-timepicker.min.js"></script> -->
      <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap-colorpicker.js"></script>
      <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap-file-input.js"></script>
      <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap-select.js"></script>
      <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
      <!-- END THIS PAGE PLUGINS --> 

          
      <!-- START TEMPLATE -->
	  <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap.min.js"></script>                
        <script type='text/javascript' src='<?php echo base_url()?>assets-admin/js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap-select.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/datatables/jquery.dataTables.min.js"></script> 
        <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins.js"></script>        
        <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/actions.js"></script>
        <script src="<?php echo base_url();?>assets_admin/lib/bootstrap/js/bootstrap.js"></script>
        <script src="<?php echo base_url();?>assets_admin/lib/jquery-toggles/toggles.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <!-- <script src="<?php echo base_url();?>assets_admin/lib/datatables/jquery.dataTables.js"></script>
        <script src="<?php echo base_url();?>assets_admin/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js"></script> -->
        <script src="<?php echo base_url();?>assets_admin/lib/select2/select2.js"></script>
        <script src="<?php echo base_url();?>assets_admin/lib/jquery-validate/jquery.validate.js"></script>
        <script src="<?php echo base_url();?>assets_admin/js/quirk.js"></script>
        <script src="<?php echo base_url();?>assets_admin/js/admin.js"></script><script type="text/javascript">
	$(document).ready(function() {
        // $('#supplier-items').multiselect({
        // 	includeSelectAllOption: true,
        // 	enableFiltering: true,
        // });
    });
</script>
</body>
   
</html>

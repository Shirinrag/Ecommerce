<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- META SECTION -->
      <title>DemoPos</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="icon" href="favicon.ico" type="image/x-icon" />
      <!-- END META SECTION -->
      <!-- CSS INCLUDE -->        
      <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url()?>assets-admin/css/theme-default.css"/>
      <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets_admin/lib/dropzone/dropzone.css"> -->
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
               <li><a href="#">Settings</a></li>
               <li class="active">Company Settings</li>
            </ul>
            <!-- END BREADCRUMB -->
            <!-- PAGE TITLE -->
            
            <!-- END PAGE TITLE -->                
            <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">
               <div class="row">
                  <div class="panel">

		            <form id="basicForm" action="<?php echo base_url();?>admin/save_company_setting" method="post"  enctype="multipart/form-data" class="form-horizontal" novalidate="novalidate" >
			            <div class="panel-heading nopaddingbottom">
			            	<h4 class="panel-title">Company Setting</h4>
			            	
			            	<button class="btn btn-success btn-quirk btn-wide mr5" style="float: right;margin-top: 2px;">Save Company Setting</button>
			            	
			            </div>
		              	<div class="panel-body">
			                <hr>
			                <?php if($this->session->flashdata('msg')) {?>
		                	<div class="alert alert-success alert-dismissible">
		                		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                		<?php echo $this->session->flashdata('msg'); ?></div>
	                		<?php }?>
				            <div class="row ml20 mb20">
				                <div class="col-sm-8 mr20">
					                <div class="table-responsive">
					                	<table class="table">
					                		<tbody>
												<tr>
													<th>Company Name:</th>
													<td><input type="text" value="<?php echo $company_setting[0]['company_name'];?>" name="company_name" id="company_name" class="form-control"></td>
												</tr>
												<tr>
													<th>Company Logo:</th>
													<td><input type="file" name="company_logo" id="company_logo" class=""></td>
												</tr>

												<tr>
													<th>Billing Address:</th>
													<td><input type="text" value="<?php echo $company_setting[0]['billing_address'];?>" name="billing_address" id="billing_address" class="form-control"></td>
												</tr>
												<tr>
													<th>GST NO:</th>
													<td><input type="text" value="<?php echo $company_setting[0]['gst_no'];?>" name="gst_no" id="gst_no" class="form-control"></td>
												</tr>
												<tr>
													<th>State Code:</th>
													<td><input type="text" value="<?php echo $company_setting[0]['state_code'];?>" name="state_code" id="state_code" class="form-control"></td>
												</tr>
												<tr>
													<th>PAN No.:</th>
													<td><input type="text" value="<?php echo $company_setting[0]['pan_no'];?>" name="pan_no" id="pan_no" class="form-control"></td>
												</tr>
												<tr>
													<th>Contact No.:</th>
													<td><input type="text" value="<?php echo $company_setting[0]['contact'];?>" name="contact" id="contact" class="form-control"></td>
												</tr>
												<tr>
													<th>Email ID:</th>
													<td><input type="text" value="<?php echo $company_setting[0]['email'];?>" name="email" id="email" class="form-control"></td>
												</tr>
												<tr>
													<th>Bank A/c Name:</th>
													<td><input type="text" value="<?php echo $company_setting[0]['bank_ac_name'];?>" name="bank_ac_name" id="bank_ac_name" class="form-control"></td>
												</tr>
												<tr>
													<th>Bank A/c No:</th>
													<td><input type="text" value="<?php echo $company_setting[0]['bank_ac_no'];?>" name="bank_ac_no" id="bank_ac_no" class="form-control"></td>
												</tr>
												<tr>
													<th>Bank Name:</th>
													<td><input type="text" value="<?php echo $company_setting[0]['bank_name'];?>" name="bank_name" id="bank_name" class="form-control"></td>
												</tr>
												<tr>
													<th>IFSC No:</th>
													<td><input type="text" value="<?php echo $company_setting[0]['ifsc_no'];?>" name="ifsc_no" id="ifsc_no" class="form-control"></td>
												</tr>
												<tr>
													<th>Branch:</th>
													<td><input type="text" value="<?php echo $company_setting[0]['branch'];?>" name="branch" id="branch" class="form-control"></td>
												</tr>

					                		</tbody>
					                	</table>
					                </div>
					            </div>
					            <div class="col-sm-2 mr20">
					            	<h5>Company Logo</h5>
					            	<img src="<?php echo base_url().'uploads/'.$company_setting[0]['company_logo'];?>" width="200" height="200"> 
					            </div>
				            </div>
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
      <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap-colorpicker.js"></script>
      <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap-file-input.js"></script>
      <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap-select.js"></script>
      <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
      <!-- END THIS PAGE PLUGINS --> 

          
      <!-- START TEMPLATE -->
      <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins.js"></script>        
      <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/actions.js"></script>     
<script src="<?php echo base_url();?>assets-admin/summernote/summernote.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/jquery-validate/jquery.validate.js"></script>
<!-- <script src="<?php echo base_url();?>assets_admin/js/quirk.js"></script> -->
<script src="<?php echo base_url();?>assets_admin/js/admin.js"></script>
<script src="<?php echo base_url();?>assets_admin/js/sweetalert.min.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/jquery-maskedinput/jquery.maskedinput.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/timepicker/jquery.timepicker.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/dropzone/dropzone.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/jquery-validate/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets_admin/js/quirk.js"></script>
<script src="<?php echo base_url();?>assets_admin/js/admin.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/jquery-toggles/toggles.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/summernote/summernote.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/bootstrapcolorpicker/js/bootstrap-colorpicker.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script type="text/javascript">
	$('#terms_conditions').summernote({height: 50});
</script>
</body>
   
</html>


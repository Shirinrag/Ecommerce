<!DOCTYPE html>
<html lang="en">


<head>        
    <!-- META SECTION -->
    <title>Circuit Sore || Users List</title>            
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
     <link rel="stylesheet" type="text/css" id="theme"
        href="<?php echo base_url()?>assets-admin/css/theme-default.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <style type="text/css">
    .form-horizontal .form-group {
        margin-right: 0px;
        margin-left: 0px;
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>
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
                <li><a href="#">Customer</a></li>
                <li class="active">Customer List</li>
            </ul>
            <div class="page-content-wrap">
                <div class="row">
                	<?php if($this->session->flashdata('msg')) {?>
		                	<div class="alert alert-success alert-dismissible">
		                		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                		<?php echo $this->session->flashdata('msg'); ?>
		                	</div>
	                	<?php }?>
                	<div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body">
                                    <table class="table table-bordered table-primary table-striped nomargin" id="user_list">
                                        <thead>
                                            <tr>
			        							<th>Sr. No.</th>
				                                <th>Customer Name</th>
				                                <th>Email Id</th>
				                                <th>Contact No</th>
                                                <th>Registration Date</th>
                                                <th>Last Activation Date</th>
				                                <th>Action</th>
			        						</tr>
                                        </thead>
                                        <tbody>  
	        						<?php $i= 0; foreach($user_list as $user){?>
	        						<tr>
	        							<td><?php echo ++$i;?></td>
	        							<td><?php echo $user['user_name'];?></td>
	        							<td><?php echo $user['email'];?></td>
	        							<td><?php echo $user['contact_no'];?></td>
                                        <td><?php echo date("d-m-Y H:i A", strtotime($user['added_on']));?></td>
                                        <td></td>
	        							<td>
	        								<span><a onclick="return confirm('Are you sure wanted to delete the selected user?');" href='<?php echo base_url()."Admin/delete_user?op_user_id=".$user['op_user_id']?>'><i class='fa fa-trash'></i></a></span>
	        							</td>

	        						</tr>	
	        						<?php }?>
	        					</tbody>
                                    </table>
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


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/jquery/jquery-ui.min.js">
    </script>

    <script type='text/javascript' src='<?php echo base_url()?>assets-admin/js/plugins/icheck/icheck.min.js'></script>
    <script type="text/javascript"
        src="<?php echo base_url()?>assets-admin/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap-select.js">
    </script>
    <script type="text/javascript"
        src="<?php echo base_url()?>assets-admin/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
    <script type="text/javascript"
        src="<?php echo base_url()?>assets-admin/js/plugins/datatables/jquery.dataTables.min.js"></script>
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
    <script src="<?php echo base_url();?>assets_admin/view_js/admin.js"></script>   

<script>
    $(document).ready(function() {
	 	var dataTable = $('#user_list').DataTable();
	});
</script>       
</body>

</html>








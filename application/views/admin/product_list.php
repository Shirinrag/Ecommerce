<!DOCTYPE html>
<html lang="en">
    

<head>        
        <!-- META SECTION -->
        <title>Circuit Store || Product List</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
                        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url()?>assets-admin/css/theme-default.css"/>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
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
                    <li><a href="#">Product</a></li>
                    <li class="active">Product List</li>
                </ul>
                
                <div class="page-content-wrap">
                
                    <div class="row">
                
	        <div class="col-md-12">
	        	<div class="panel">
	        		<!-- <ul class="panel-options" style="display: inline-flex;list-style: none;float: right;">
	        			<li style="display: inline-flex;list-style: none;margin-right: 10px;">
	        				<i class="glyphicon glyphicon-cloud-download"></i><h5><a href="<?php echo base_url();?>admin/download_price_list">&nbsp;&nbsp;<b>Download Price List</b></a></h5>&nbsp;&nbsp;&nbsp;&nbsp;
	        				</a>
	        			</li>
	        		</ul> -->
	        		<div class="panel-heading">
                        <?php if($this->session->flashdata('msg')) {?>
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo $this->session->flashdata('msg'); ?></div>
                        <?php }?>

                        <h4 class="panel-title"><b>Product List</b></h4></div>
	        		<div class="panel-body">

	        			<div class="table-responsive">
	        				<table class="table table-bordered table-primary table-striped nomargin" id="product_list">
	        					<thead>
	        						<tr>
	        							<th>P Id.</th>
                                        <th>Product Code</th>
		                                <th>Product Name</th>
		                                <th>Category</th>
		                                <th>Sub Cat</th>
		                                <th>Selling Price</th>
                                        <th>Offer Price</th>
		                                <th>Status</th>
		                                <th>Action</th>
	        						</tr>
	        					</thead>
                                <tbody>
                                    <?php
                                    foreach ($product_list as $key => $value) { ?>
                                        <tr>
                                            <td><?= $key+1;?></td>
                                            <td><?= $value['product_code'];?></td>
                                            <td><?= $value['product_name'];?></td>
                                            <td><?= $value['category_name'];?></td>
                                            <td><?= $value['sub_category_name'];?></td>
                                            <td><?= $value['product_price'];?></td>
                                            <td><?= $value['product_offer_price'];?></td>
                                            <td>
                                                <?php 
                                                    if($value['stock_status']==1){
                                                        $status = "ACTIVE";
                                                        $flag = "0";
                                                    }else{
                                                        $status = "INACTIVE";
                                                        $flag = "1";
                                                    }
                                                ?>
                                                <a href="javascript:void(0);" onclick="update_product_status(this,<?= $flag; ?>,<?= $value['product_id']; ?>)"><?= $status; ?></a>
                                            </td>
                                            <td>
                                                <span><a href="<?php echo base_url()."Admin/edit_product?product_id=".$value['product_id']?>"><i class='fa fa-pencil'></i></a></span> 
                                                <span><a href='#' onclick='delete_product(this,"<?php echo $value['product_id']; ?>")'><i class='fa fa-trash'></i></a></span>

                                            </td>
                                        </tr>

                                    <?php }
                                     ?>
                                </tbody>

	        				</table>
	        			</div>
	        		</div>
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
                            <a href="<?php echo base_url();?>admin/logout" class="btn btn-success btn-lg">Yes</a>
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
        <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/bootstrap/bootstrap-select.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins/datatables/jquery.dataTables.min.js"></script> 
        <script src="<?php echo base_url();?>assets-admin/js/admin.js"></script>   
        <script src="<?php echo base_url();?>assets-admin/js/jquery.validate.js"></script> 
        
        <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/plugins.js"></script>        
        <script type="text/javascript" src="<?php echo base_url()?>assets-admin/js/actions.js"></script>
        <!-- <script src="<?php echo base_url();?>assets_admin/lib/jquery/jquery.js"></script> -->
		<script src="<?php echo base_url();?>assets_admin/lib/bootstrap/js/bootstrap.js"></script>
		<script src="<?php echo base_url();?>assets_admin/lib/jquery-toggles/toggles.js"></script>

		<script src="<?php echo base_url();?>assets_admin/lib/datatables/jquery.dataTables.js"></script>
		<script src="<?php echo base_url();?>assets_admin/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js"></script>

		<script src="<?php echo base_url();?>assets_admin/lib/select2/select2.js"></script>
		<script src="<?php echo base_url();?>assets_admin/lib/jquery-validate/jquery.validate.js"></script>
		<script src="<?php echo base_url();?>assets_admin/js/quirk.js"></script>
		<script src="<?php echo base_url();?>assets_admin/js/admin.js"></script>
		

<script src="<?php echo base_url();?>assets_admin/lib/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js"></script>




<script>
    $(document).ready(function() {
	 	var dataTable = $('#product_list').DataTable( {
        
        });
	});
</script>                
    </body>

</html>







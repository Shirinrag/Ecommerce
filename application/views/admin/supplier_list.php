<!DOCTYPE html>
<html lang="en">
    

<head>        
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
        </style>             
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
                    <li><a href="#">Supplier</a></li>
                    <li class="active">Supplier List</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
               
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
                
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading"><h4 class="panel-title">Supplier List</h4></div>
                    <div class="panel-body">
                        <?php if($this->session->flashdata('msg')) {?>
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                        <?php }?>   
                        <div class="table-responsive">
                            <table class="table table-bordered table-primary table-striped nomargin" id="supplier_list">
                                <thead>
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Supplier Name</th>
                                        <th>Phone Number</th>
                                        <th>Email Address</th>
                                        <th>Contact Person</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div><!-- table-responsive -->
                    </div>
                </div>
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
                            <a href="<?php echo base_url();?>Admin/logout" class="btn btn-success btn-lg">Yes</a>
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
        <!-- <script src="<?php //echo base_url();?>assets_admin/lib/datatables/jquery.dataTables.js"></script>
        <script src="<?php //echo base_url();?>assets_admin/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js"></script> -->
        <script src="<?php echo base_url();?>assets_admin/lib/select2/select2.js"></script>
        <script src="<?php echo base_url();?>assets_admin/lib/jquery-validate/jquery.validate.js"></script>
        <script src="<?php echo base_url();?>assets_admin/js/quirk.js"></script>
        <script src="<?php echo base_url();?>assets_admin/js/admin.js"></script>
        



<script>
    $(document).ready(function() {
        var dataTable = $('#supplier_list').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax":{
                url :"get_supplier_list", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling
                    $(".call-grid-error").html("");
                    $("#call_table").append('<tbody class="topic-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#call_table_processing").css("display","block");
                }
            }
        });
    });
</script>
</body>
</html>






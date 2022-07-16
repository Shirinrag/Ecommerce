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
        <div class="page-container">
            <div class="page-sidebar">
                <?php $this->load->view('admin/includes/sidebar');?> 
            </div>
            <div class="page-content">
                <?php $this->load->view('admin/includes/header');?> 
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Category</a></li>
                    <li class="active">Add Category</li>
                </ul>
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-4">
                <div class="panel">

                    <div class="panel-heading nopaddingbottom"><h4 class="panel-title"><b>Add Category</b></h4></div>
                    <div class="panel-body">
                        <hr>
                        <form id="basicForm" method="post" action="<?php echo base_url();?>Admin/save_category" enctype="multipart/form-data" class="form-horizontal" novalidate="novalidate" onsubmit="return validate_add_new_category(this);">
                           
                            
                            <div class="row ml20  mb20">
                            <?php if($this->session->flashdata('msg')) {?>
                                <div class="alert alert-<?php echo $this->session->flashdata('class');?> alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('msg'); ?>
                                </div>
                            <?php }?>
                             
                                <div class="col-sm-12 mr20">
                                    <div class="form-group">
                                        <label>Enter category name<span class="text-danger">*</span></label>
                                        <input type="text" name="category_name" dir="rtl" id="category_name" class="form-control" required="">
                                    </div>
                                </div>
                                 <div class="col-sm-12 mr20">
                                    <div class="form-group">
                                        <label>Enter category name(ar)<span class="text-danger">*</span></label>
                                        <input type="text" name="category_name_ar" dir="rtl" id="category_name_ar" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="col-sm-12 mr20">
                                    <div class="form-group">
                                        <label>category Image<span class="text-danger">*</span></label>
                                        <input type="file" name="image_file" dir="rtl" accept="image/*" id="image_file" class="form-control" required="" >
                                    </div>
                                </div>
                                <div class="col-sm-12 mr20">
                                    <div class="form-group">
                                        <label>Sort Order<span class="text-danger">*</span></label>
                                        <input type="text" name="sort_order" dir="rtl" id="sort_order" class="form-control" required="">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-9">
                                    <button class="btn btn-success btn-quirk btn-wide mr5">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title"><b>Category List</b></h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>                                
                                </div>
                                 <div class="panel-body">
                                    <table class="table table-bordered table-danger nomargin" id="category_list">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Category Name</th>
                                                <th>Category Name(ar)</th>
                                                <th>Image</th>
                                                <th>Sort Order</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php $i=0;foreach($category_list as $category){?>
                                        <tr>
                                            <td><?php echo ++$i;?></td>
                                            <td><?php echo $category['category_name'];?></td>
                                            <td><?php echo $category['category_name_ar'];?></td>
                                            <td><img src="<?php echo base_url().$category['image_path'];?>" style="height: 100px;width: 100px;"></td>
                                            <th><?php echo $category['sort_order'];?></th>
                                            <td>
                                               <span><a href="<?php echo base_url()."Admin/edit_category?category_id=".$category['category_id']?>"><i class='fa fa-pencil'></i></a></span>
                                                <span><a href='#' onclick='delete_category(this,"<?php echo $category['category_id']; ?>")'><i class='fa fa-trash'></i></a></span>
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
        </div>
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
        <script src="<?php echo base_url();?>assets_admin/js/admin.js"></script>
        <script>
            $(document).ready(function() {
                var dataTable = $('#category_list').DataTable();
            });     
        </script> 

    </body>

</html>









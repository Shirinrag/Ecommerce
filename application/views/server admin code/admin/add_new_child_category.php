<!DOCTYPE html>
<html lang="en">
<head>
    <title>Circuit Store || Add Child Category</title>
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
            <li><a href="#">Child Category</a></li>
            <li class="active">Add Child Category</li>
        </ul>
        <div class="page-content-wrap">
            <div class="col-md-12">
                <div class="row">
                    <div class="panel">

                        <div class="panel-heading nopaddingbottom"><h4 class="panel-title"><b>Add Child Category</b></h4></div>
                        <div class="panel-body">
                            <form id="basicForm" action="<?php echo base_url('admin/save_child_category');?>" class="form-horizontal" novalidate="novalidate" onsubmit="return validate_new_child_category(this);" method="post">
                                <div class="alert alert-success" style="display:none;"></div>
                                <div class="alert alert-danger" style="display:none;"></div>

                                <div class="row ml20  mb20">
                                     <div class="col-sm-3 mr20">
                                    <div class="form-group">
                                        <label>Select Language<span class="text-danger">*</span></label>
                                        <select class="form-control" name="fk_lang_id" id="fk_lang_id" onchange="getCategory()">
                                            <option value=""></option>
                                            <?php foreach ($lang_name as $lang_name_key => $lang_name_row) { ?>
                                              <option value="<?= $lang_name_row['id']?>"><?= $lang_name_row['lang_name']?></option>
                                           <?php } ?>
                                            
                                        </select>
                                    </div>
                                </div>
                                    <div class="col-sm-3 mr20">
                                        <div class="form-group">
                                            <label>Select category<span class="text-danger">*</span></label>
                                            <select onchange="getSubCategory()" class="form-control select2" id="category_id" name="category_id">
                                                <option value="">Select category</option>
                                                <?php if(isset($category_data) && !empty($category_data)){
                                                    foreach ($category_data as $category_key => $category_value) {?>
                                                        <option value="<?php echo $category_value['category_id']; ?>"><?php echo $category_value['category_name']; ?></option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 mr20">
                                        <div class="form-group">
                                            <label>Select Sub category<span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="sub_category_id" name="sub_category_id">
                                                <option value="">Select </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mr20">
                                        <div class="form-group">
                                            <label>Enter Child category<span class="text-danger">*</span></label>
                                            <input type="text" name="child_category_name" id="child_category_name" class="form-control" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mr20">
                                        <div class="form-group">
                                            <label>Enter Child category (ar)<span class="text-danger">*</span></label>
                                            <input type="text" name="child_category_name_ar" id="child_category_name_ar" dir="rtl" class="form-control" required="">
                                        </div>
                                    </div>
                                     <div class="col-sm-4 mr20">
                                    <div class="form-group">
                                        <label>Sort Order<span class="text-danger">*</span></label>
                                        <input type="text" name="sort_order" dir="rtl" id="child_category_sort_order" class="form-control" required="">
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
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="panel">
                        <ul class="panel-options" style="float: right;"><li style="list-style: none;margin-right: 20px;"></li></ul>
                        <div class="panel-heading"><center><h4 class="panel-title"><b>Child Category List</b></h4></center></div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-primary table-striped nomargin" id="child_category_list">
                                    <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Category Name</th>
                                        <th>Sub Category Name</th>
                                        <th>Child Category Name</th>
                                        <th>Child Category Name(ar)</th>
                                        <th>Sort Order</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php $i=0;foreach($child_category_list as $category){?>
                                        <tr>
                                            <td><?php echo ++$i;?></td>
                                            <td><?php echo $category['category_name'];?></td>
                                            <td><?php echo $category['sub_category_name'];?></td>
                                            <td><?php echo $category['child_category_name'];?></td>
                                            <td><?php echo $category['child_category_name_ar'];?></td>
                                            <td><?php echo $category['sort_order'];?></td>
                                            <td>
                                               <span><a href="<?php echo base_url()."admin/edit_child_category?child_category_id=".$category['child_category_id']?>"><i class='fa fa-pencil'></i></a></span>
                                                <span><a href='#' onclick='delete_child_category(this,"<?php echo $category['child_category_id']; ?>")'><i class='fa fa-trash'></i></a></span>
                                            </td>

                                        </tr>
                                    <?php }?>
                                    </tbody>
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
<script src="<?php echo base_url();?>assets_admin/lib/select2/select2.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/jquery-toggles/toggles.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>


<script>
    function getSubCategory(){
        var category_id = $('#category_id').val();
        var postData = {
            'category_id' : category_id
        }
        $.post('<?php echo base_url('admin/getSubCategory')?>',postData,function(data){
            var subcats = $.parseJSON(data);
            $('#sub_category_id').html('');

            var html = '<option value="">Select Sub Category</option>';
            $.each(subcats,function(i,val){
                html += '<option value="'+val.sub_category_id+'">'+val.sub_category_name+'</option>';
            })
            $('#sub_category_id').html(html);
        })
    }


    function getCategory(){
        var fk_lang_id = $('#fk_lang_id').val();
        var postData = {
            'fk_lang_id' : fk_lang_id
        }
        $.post('<?php echo base_url('admin/getCategory')?>',postData,function(data){
            var subcats = $.parseJSON(data);
            $('#category_id').html('');

            var html = '<option value="">Select Category</option>';
            $.each(subcats,function(i,val){
                html += '<option value="'+val.category_id+'">'+val.category_name+'</option>';
            })
            $('#category_id').html(html);
        })
    }

    $(document).ready(function() {
        var dataTable = $('#child_category_list').DataTable( {
        "processing": true,
        "pageLength": 5

        });
    });  

</script>
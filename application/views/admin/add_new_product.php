<!DOCTYPE html>
<html lang="en">
<head>
    <title>Circuit Store || Add Product</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url()?>assets-admin/css/theme-default.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>assets_admin/lib/select2/select2.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets_admin/lib/dropzone/dropzone.css">
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
            <li class="active">Add Product</li>
        </ul>
        <div class="page-content-wrap">
            <div class="row">
                <div class="panel">


                     <form id="basicForm" method="post" action="<?php echo base_url();?>admin/submit_product" enctype="multipart/form-data" class="form-horizontal" novalidate="novalidate" onsubmit="return validate_add_product(this);">
                        <div class="panel-heading nopaddingbottom">
                            <h4 class="panel-title"><b>Add New Product</b></h4>
                            <button class="btn btn-success btn-quirk btn-wide mr5" style="float: right;margin-top: 2px;">Add New Product</button>
                        </div>
                        <div class="panel-body">
                            <hr>
                            <?php if($this->session->flashdata('msg')) {?>
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('msg'); ?></div>
                            <?php }?>
                            <div class="row ml20 mb20">
                                <div class="col-sm-3 mr20">
                                    <div class="form-group">
                                        <label>Enter product name<span class="text-danger">*</span></label>
                                        <input type="text"  name="product_name" dir="ltl" id="product_name" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-3 mr20">
                                    <div class="form-group">
                                        <label>Enter product name(ar)<span class="text-danger">*</span></label>
                                        <input type="text"  name="product_name_ar" dir="ltl" id="product_name_ar" class="form-control">
                                    </div>
                                </div>

                                   <div class="col-sm-3 mr20">
                                    <div class="form-group">
                                        <label>Select Category<span class="text-danger">*</span></label>
                                        <select class="form-control" onchange="getSubCategory()" id="product_category" name="category_id">
                                            <option disabled value="">Select Category</option>
                                            <?php foreach ($categpry_list as $key => $value) {?>
                                                <option value="<?php echo $value['category_id'];?>"> <?php echo $value['category_name']." || ". $value['category_name_ar'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-3 mr20">
                                    <div class="form-group">
                                        <label>Select Sub-Category<span class="text-danger">*</span></label>
                                        <select class="form-control"  onchange="getChildCategory()"  id="subcategory" name="sub_category_id">
                                            <option disabled value="">Select subcategory</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row ml20 mb20">

                                <div class="col-sm-3 mr20">
                                    <div class="form-group">
                                        <label>Child category</label>
                                        <select class="form-control"  id="child_category_id" name="child_category_id">
                                            <option disabled value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2 mr20">
                                    <div class="form-group">
                                        <label>Select Unit<span class="text-danger">*</span></label>
                                        <select class="form-control"  id="product_unit" name="unit_id">
                                            <option value="">Unit</option>
                                            <?php foreach ($unit_list as $key => $value) {?>
                                                <option value="<?php echo $value['unit_id'];?>"> <?php echo $value['unit_name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2 mr20">
                                    <div class="form-group">
                                        <label>Selling Price <span class="text-danger">*</span></label>
                                        <input placeholder="" type="text" dir="ltl" class="form-control" 
                                        name="product_price" id="product_price">
                                    </div>
                                </div>
                                
                                 <div class="col-sm-2 mr20">
                                    <div class="form-group">
                                        <label>Product Offer Price<span class="text-danger">*</span></label>
                                        <input placeholder="" type="text" dir="ltl" class="form-control"
                                         name="product_offer_price" id="product_offer_price">
                                    </div>
                                </div>

                                 <div class="col-sm-2 mr20">
                                    <div class="form-group">
                                        <label>Product Purchase Price <span class="text-danger">*</span></label>
                                        <input placeholder="" type="text" dir="ltl" class="form-control"
                                         name="product_purchase_price" id="product_purchase_price">
                                    </div>
                                </div>

                            
                            </div>
                            <div class="row ml20 mb20">
                                <div class="col-sm-2 mr20">
                                    <div class="form-group">
                                        <label>Pack Size<span class="text-danger">*</span></label>
                                        <input placeholder="ex.1,2,3" type="text" dir="ltl" class="form-control" name="pack_size" id="pack_size">
                                    </div>
                                </div>
                                 <div class="col-sm-4 mr20">
                                    <div class="form-group">
                                        <label>Select Relatable Products<span class="text-danger"></span></label>
                                        <select multiple="true" class="form-control" id="relatable_products" name="relatable_products[]">
                                            <option disabled value="">Select Products</option>
                                            <?php foreach ($product_list as $key => $value) {?>
                                                <option value="<?php echo $value['product_name'];?>"> <?php echo $value['product_name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Product Barcode</label>
                                        <input type="text" class="form-control" dir="ltl" name="product_barcode" id="product_barcode">
                                    </div>
                                </div>
                                   <div class="col-sm-2 mr20">
                                    <div class="form-group">
                                        <label>Product Code <span class="text-danger">*</span></label>
                                        <input placeholder="" type="text" dir="ltl" class="form-control"
                                         name="product_code" id="product_code">
                                    </div>
                                </div>
                            </div>
                            <div class="row ml20 mb20">
                                 <div class="col-sm-2 mr20">
                                    <div class="form-group">
                                        <label>Is Listed in Superdeal?<span class="text-danger">*</span></label>
                                        <select class="form-control"  id="is_superdeal" name="listed_in_super_deal">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Product Video Url</label>
                                        <input type="text" class="form-control" dir="ltl" name="video_url" 
                                        id="video_url">
                                    </div>
                                </div>

                               <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Upload product image</label>
                                        <input type="file" name="image_files[]"  id="image_name" class="form-control" required="" multiple>

                                     <!--    
                                        <input type="file" class="form-control" 
                                         name="files" id="image_name"> -->
                                    </div>
                                </div>
                                 <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Maximum Selling limit <span class="text-danger">*</span></label>
                                        <input placeholder="" type="text" dir="ltl" class="form-control" 
                                        name="max_sell_limit" id="max_sell_limit">
                                    </div>
                                </div>
                               
                            </div>
                            <div class="row ml20 mb20">
                                <div class="col-sm-12 mr20">
                                    <div class="form-group">
                                        <label>Enter Product Description </label>
                                        <textarea class="form-control" dir="ltl" name="description" id="product_description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row ml20 mb20">
                                <div class="col-sm-12 mr20">
                                    <div class="form-group">
                                        <label>Enter Product Description (ar)</label>
                                        <textarea class="form-control" dir="ltl" name="description_ar" id="product_description"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>

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
<script src="<?php echo base_url();?>assets_admin/lib/jquery-ui/jquery-ui.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/jquery-toggles/toggles.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/timepicker/jquery.timepicker.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/bootstrapcolorpicker/js/bootstrap-colorpicker.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/select2/select2.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets_admin/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#product_description,#terms_conditions').summernote({height: 50});
        $('#product_category').select2();
        $('#subcategory').select2();
        $('#child_category_id').select2();
        $('#product_unit').select2();
        $('#relatable_products').select2();
        
    });

    function getSubCategory(){
        var category_id = $('#product_category').val();
        var postData = {
            'category_id' : category_id
        }

        $.post('<?php echo base_url('admin/getSubCategory')?>',postData,function(data){
            var subcats = $.parseJSON(data);
            $('#select2-subcategory-container').html('Select Sub Category');
            $('#subcategory').html('');
            var html = '<option disable value="">Select Sub Category</option>';
            $.each(subcats,function(i,val){
                html += '<option value="'+val.sub_category_id+'">'+val.sub_category_name+' || '+val.sub_category_name+' </option>';
            })
            $('#subcategory').html(html);
        })

    }
    function getChildCategory(){
        var sub_category_id = $('#subcategory').val();
        var postData = {
            'sub_category_id' : sub_category_id
        }

        $.post('<?php echo base_url('admin/getChildCategory')?>',postData,function(data){
            var childcats = $.parseJSON(data);
            $('#select2-child_category_id-container').html('Select');
            $('#child_category_id').html('');

            var html = '<option disable value="">Select</option>';
            $.each(childcats,function(i,val){
                html += '<option value="'+val.child_category_id+'">'+val.child_category_name+' || '+val.child_category_name_ar+'</option>';
            })
            $('#child_category_id').html(html);
        })

    }
</script>
</body>

</html>



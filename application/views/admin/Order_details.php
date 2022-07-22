<!DOCTYPE html>
<html lang="en">


<head>
    <!-- META SECTION -->
    <title>Circuit Sore || Order Details</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" id="theme"
        href="<?php echo base_url()?>assets-admin/css/theme-default.css" />
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
                <li><a href="#">Order</a></li>
                <li class="active">Order Details</li>
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
                            <input type="hidden" name="order_id" id="order_id" value="<?=$order_data['id']?>">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Order Id</label>
                                    <div><span><?=$order_data['order_id']?></span></div>                                    
                                </div>
                                <div class="col-md-4">
                                    <label>User Name</label>
                                    <div><span><?=$order_data['user_name']?></span></div>                                    
                                </div>
                                <div class="col-md-4">
                                    <label>Product Name</label>
                                    <div><span><?=$order_data['product_name']?></span></div>                                    
                                </div>
                                <div class="col-md-4">
                                    <label>Quantity</label>
                                    <div><span><?=$order_data['quantity']?></span></div>                                    
                                </div>
                                <div class="col-md-4">
                                    <label>Unit Price</label>
                                    <div><span><?=$order_data['unit_price']?></span></div>                                    
                                </div>
                                <div class="col-md-4">
                                    <label>Total</label>
                                    <div><span><?=$order_data['total']?></span></div>                                    
                                </div>
                                <div class="col-md-4">
                                    <label>Payment Mode</label>
                                    <div><span><?=$order_data['payment_type']?></span></div>                                    
                                </div>
                                <div class="col-md-4">
                                    <label>Order Date</label>
                                    <div><span><?=$order_data['date']?></span></div>                                    
                                </div>
                                <div class="col-md-4">
                                    <label>Order Status</label>
                                    <div>
                                        <select class="form-control" name="order_status_id" id="order_status_id">
                                        <option value=""></option>
                                        <?php 
                                         $order_status_data = explode(",",$order_data['status']);
                                         $order_status_data = end($order_status_data);
                                        foreach ($order_status as $order_status_key => $order_status_row) {  
                                        $selected ="";    

                                                if($order_status_row['id']== $order_status_data){
                                                    $selected = "selected";
                                                }else{
                                                    $selected = "";
                                                }
                                         ?>
                                           <option value="<?=$order_status_row['id']?>" <?=$selected?>><?=$order_status_row['order_status']?></option>
                                       <?php }?>          
                                    </select>
                                </div>                                    
                                </div>
                                <div class="col-md-4">
                                    <label>Shipping Address</label>
                                    <div><span><?=$order_data['roomno'].", ".$order_data['building'].", ".$order_data['street'].", ".$order_data['zone']?></span></div>                                    
                                </div>
                            </div>
                        </div>
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
    <script type="text/javascript">
        $(document).on('change', '#order_status_id', function() {
      var id = $(this).val();
      var order_id = $('#order_id').val();
      $.ajax({
         url: "<?php echo base_url()?>Admin/update_order_status",
         method: "POST",
         data: {
             id: id,
             order_id:order_id
         },
         dataType: "json",
         success: function(data) {
             if (data.status == 'success') {
               location.reload();
             } else {
                 location.reload();
             }
         }
     });
 });
    </script>
</body>

</html>
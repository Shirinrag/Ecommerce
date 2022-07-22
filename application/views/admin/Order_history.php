<!DOCTYPE html>
<html lang="en">


<head>
    <!-- META SECTION -->
    <title>Circuit Sore || Order List</title>
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
                <li><a href="#">Order</a></li>
                <li class="active">Order List</li>
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
                            <table class="table table-bordered table-primary table-striped nomargin"
                                id="order_details_table">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Order No</th>
                                        <th>User Name</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                            $i=0;
                                                foreach ($order_data as $order_data_key => $order_data_row) { ?>
                                    <tr>
                                        <td><?= ++$i;?></td>
                                        <td><?=$order_data_row['order_id'] ?></td>
                                        <td><?=$order_data_row['user_name'] ?></td>
                                        <td><?=$order_data_row['product_name'] ?></td>
                                        <td><?=$order_data_row['quantity'] ?></td>
                                        <td><?=$order_data_row['unit_price'] ?></td>
                                        <td><?=$order_data_row['total'] ?></td>

                                        <td>
                                            <span><a
                                                    href="<?php echo base_url()."Admin/Order_details?id=".$order_data_row['id']?>"><i
                                                        class='fa fa-pencil'></i></a></span>
                                            <!--  <span><a href='#' onclick='delete_category(this,"<?php echo $category['category_id']; ?>")'><i class='fa fa-trash'></i></a></span> -->
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

    <div class="modal fade" id="exampleModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        var dataTable = $('#order_details_table').DataTable();
    });
    </script>
</body>

</html>
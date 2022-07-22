<!DOCTYPE html>
<html lang="en">


<head>
    <!-- META SECTION -->
    <title>Circuit Sore || Inventory</title>
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
                <li><a href="#">Inventory</a></li>
                <li class="active">Inventory</li>
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
                                id="inventory_data">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Product Name</th>
                                       
                                    </tr>
                                </thead>
                                
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
   
function format(d) {
  var html = '';
  var total_quantity = d.qty;
  if (total_quantity) {
     if(total_quantity.indexOf(',') > -1){
        var total_quantity_1 = total_quantity.split(",");
     } else {
        var total_quantity_1 = [total_quantity];
     }
     
  }else{
    var total_quantity_1 = [total_quantity];
  }

  var add_qty = d.add_qty;
  if (add_qty) {
     if(add_qty.indexOf(',') > -1){
        var add_qty_1 = add_qty.split(",");
     } else {
        var add_qty_1 = [add_qty];
     }
  } else {
     var add_qty_1 = [0];
  }
 
 
  var deduct_qty = d.deduct_qty;
  if (deduct_qty) {
     if(deduct_qty.indexOf(',') > -1){
        var deduct_qty_1 = deduct_qty.split(",");
     } else {
        var deduct_qty_1 = [deduct_qty];
     }
  } else {
     var deduct_qty_1 = [0];
  }

  var date = d.date;
  if (date) {
     if(date.indexOf(',') > -1){
        var date_1 = date.split(",");
     } else {
        var date_1 = [date];
     }
  } else {
     var date_1 = ['NA'];
  }
 
  var id = d.id;
  if (id) {
     if(id.indexOf(',') > -1){
        var id_1 = id.split(",");
     } else {
        var id_1 = [id];
     }
  } else {
     var id_1 = ['NA'];
  }
 
 
  html += '<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped table-hover">' + '<tr>' + '<th>Add Quantity</th>' + '<th>Deducted Quantity</th>' + '<th>Total Quantity</th>' + '<th>Date</th>' + '</tr>';
  $.each(id_1, function(id_1_key, id_1_val) {
      html += '<tr>' +
          '<td>' + add_qty_1[id_1_key] + '</td>' +
          '<td>' + deduct_qty_1[id_1_key] + '</td>' +
          '<td>' + total_quantity_1[id_1_key] + '</td>' +
          '<td>' + date_1[id_1_key] + '</td>' +
          '</tr>';
  });
  html += '</table>';
  return html;

}

$(document).ready(function() {
  var table = $('#inventory_data').DataTable({
      "ajax": "<?=base_url()?>Admin/display_inventory_data",
      "columns": [{
              "className": 'details-control',
              "orderable": false,
              "data": null,
              "defaultContent": ''
          },
          { "data": "product_name" }

      ],
      "order": [
          [1, 'asc']
      ]
  });

  // Add event listener for opening and closing details
  $('#inventory_data tbody').on('click', 'td.details-control', function() {
      var tr = $(this).closest('tr');
      var row = table.row(tr);

      if (row.child.isShown()) {
          // This row is already open - close it
          row.child.hide();
          tr.removeClass('shown');
      } else {
          // Open this row
          row.child(format(row.data())).show();
          tr.addClass('shown');
      }
  });
});
    </script>
</body>

</html>
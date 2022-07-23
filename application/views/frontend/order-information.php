
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    
    <!-- css
    ============================================ -->
    <?php include('common/cssfiles.php');?>
    <style type="text/css">
         body{font-family:'Roboto', sans-serif}
    </style>

</head>

<body class="res layout-1 layout-subpage">
    
    <div id="wrapper" class="wrapper-fluid banners-effect-5">
    

    <!-- Header Container  -->
    <?php include('common/header.php');?>
    <!-- //Header Container  -->
    
	<!-- Main Container  -->
	<div class="main-container container">
		<ul class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i></a></li>
			<li><a href="#">Order Infomation</a></li>
		</ul>
		
		<div class="row">
			<!--Middle Part Start-->
			<div id="content" class="col-sm-9">
				<h2 class="title">Order Information</h2>

				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td colspan="2" class="text-left">Order Details</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							
							<td style="width: 50%;" class="text-left"> <b>Order ID:</b> <?php echo $order_history_info['order_number'];?>
								<br>
								<b>Date Added:</b> <?php echo $order_history_info['date'];?></td>
							<td style="width: 50%;" class="text-left"> <b>Payment Method:</b> <?php echo $order_history_info['payment_type'];?>
								<br>
								<!-- <b>Shipping Method:</b> Flat Shipping Rate </td> -->
						</tr>
					</tbody>
				</table>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td style="width: 50%; vertical-align: top;" class="text-left">Payment Address</td>
							<td style="width: 50%; vertical-align: top;" class="text-left">Shipping Address</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-left"><?php echo $order_history_info['user_name'];?>
								<br>
								<br>Room No:<?php echo $order_history_info['roomno'];?>
								<br><?php echo $order_history_info['building'];?>,<?php echo $order_history_info['street'];?>
								<br><?php echo $order_history_info['zone'];?></td>
							<td class="text-left"><?php echo $order_history_info['user_name'];?>
							<br>
								<br>Room No:<?php echo $order_history_info['roomno'];?>
								<br><?php echo $order_history_info['building'];?>,<?php echo $order_history_info['street'];?>
								<br><?php echo $order_history_info['zone'];?></td>
						</tr>
					</tbody>
				</table>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<td class="text-left">Product Name</td>
								<td class="text-right">Quantity</td>
								<td class="text-right">Price</td>
								<td class="text-right">Total</td>
								
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-left"><?php echo $order_history_info['product_name'];?></td>
								<td class="text-right"><?php echo $order_history_info['quantity'];?></td>
								<td class="text-right"><?php echo $order_history_info['unit_price'];?></td>
								<td class="text-right"><?php echo $order_history_info['total'];?></td>
								
							</tr>

						</tbody>
						<tfoot>
							<tr>
								<td colspan="2"></td>
								<td class="text-right"><b>Sub-Total</b>
								</td>
								<td class="text-right"><?php echo $order_history_info['unit_price'];?></td>
								
							</tr>
							<!-- <tr>
								<td colspan="3"></td>
								<td class="text-right"><b>Flat Shipping Rate</b>
								</td>
								<td class="text-right"><?php echo $order_history_info['sub_total'];?></td>
								<td></td>
							</tr> -->
							
							<tr>
								<td colspan="2"></td>
								<td class="text-right"><b>Total</b>
								</td>
								<td class="text-right"><?php echo $order_history_info['grand_total'];?></td>
								
							</tr>
						</tfoot>
					</table>
				</div>
				<h3>Order History</h3>
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<td class="text-left">Date Added</td>
							<td class="text-left">Status</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-left"><?php echo $order_history_info['date'];?></td>
							<td class="text-left"><?php echo $order_history_info['order_status'];?></td>
						</tr>
						
					</tbody>
				</table>
				<!-- <div class="buttons clearfix">
					<div class="pull-right"><a class="btn btn-primary" href="#">Continue</a>
					</div>
				</div> -->



			</div>
			<!--Middle Part End-->
			<!--Right Part Start -->
			<?php include('common/myaccountsidepart.php');?>
			<!--Right Part End -->
		</div>
	</div>
	<!-- //Main Container -->


	<!-- Footer Container -->
    <?php include('common/footer.php');?>
    <!-- //end Footer Container -->

    </div>
	
	
<!-- Include Libs & Plugins
	============================================ -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include('common/jsfiles.php');?>
</body>

</html>
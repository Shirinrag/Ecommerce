
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
							<td style="width: 50%;" class="text-left"> <b>Order ID:</b> <?php echo $order_history_info[0]['id'];?>
								<br>
								<b>Date Added:</b> <?php echo $order_history_info[0]['date'];?></td>
							<td style="width: 50%;" class="text-left"> <b>Payment Method:</b> <?php echo $order_history_info[0]['id'];?>
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
							<td class="text-left"><?php echo $order_history_info[0]['user_name'];?>
								<br>
								<br>Room No:<?php echo $order_history_info[0]['roomno'];?>
								<br><?php echo $order_history_info[0]['building'];?>.','.<?php echo $order_history_info[0]['street'];?>
								<br><?php echo $order_history_info[0]['zone'];?></td>
							<td class="text-left"><?php echo $order_history_info[0]['user_name'];?>
							<br>
								<br>Room No:<?php echo $order_history_info[0]['roomno'];?>
								<br><?php echo $order_history_info[0]['building'];?>.','.<?php echo $order_history_info[0]['street'];?>
								<br><?php echo $order_history_info[0]['zone'];?></td>
						</tr>
					</tbody>
				</table>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<td class="text-left">Product Name</td>
								<td class="text-left">Model</td>
								<td class="text-right">Quantity</td>
								<td class="text-right">Price</td>
								<td class="text-right">Total</td>
								<td style="width: 20px;"></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-left"><?php echo $order_history_info[0]['roomno'];?></td>
								<td class="text-left"><?php echo $order_history_info[0]['roomno'];?></td>
								<td class="text-right"><?php echo $order_history_info[0]['roomno'];?></td>
								<td class="text-right"><?php echo $order_history_info[0]['roomno'];?></td>
								<td class="text-right">$123.20</td>
								<td style="white-space: nowrap;" class="text-right"> <a class="btn btn-primary" title="" data-toggle="tooltip" href="#" data-original-title="Reorder"><i class="fa fa-shopping-cart"></i></a>
									<a class="btn btn-danger" title="" data-toggle="tooltip" href="return.html" data-original-title="Return"><i class="fa fa-reply"></i></a>
								</td>
							</tr>

						</tbody>
						<tfoot>
							<tr>
								<td colspan="3"></td>
								<td class="text-right"><b>Sub-Total</b>
								</td>
								<td class="text-right">$101.00</td>
								<td></td>
							</tr>
							<tr>
								<td colspan="3"></td>
								<td class="text-right"><b>Flat Shipping Rate</b>
								</td>
								<td class="text-right">$5.00</td>
								<td></td>
							</tr>
							<tr>
								<td colspan="3"></td>
								<td class="text-right"><b>Eco Tax (-2.00)</b>
								</td>
								<td class="text-right">$6.00</td>
								<td></td>
							</tr>
							<tr>
								<td colspan="3"></td>
								<td class="text-right"><b>VAT (20%)</b>
								</td>
								<td class="text-right">$21.20</td>
								<td></td>
							</tr>
							<tr>
								<td colspan="3"></td>
								<td class="text-right"><b>Total</b>
								</td>
								<td class="text-right">$133.20</td>
								<td></td>
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
							<td class="text-left">20/06/2016</td>
							<td class="text-left">Processing</td>
						</tr>
						<tr>
							<td class="text-left">21/06/2016</td>
							<td class="text-left">Shipped</td>
						</tr>
						<tr>
							<td class="text-left">24/06/2016</td>
							<td class="text-left">Complete</td>
						</tr>
					</tbody>
				</table>
				<div class="buttons clearfix">
					<div class="pull-right"><a class="btn btn-primary" href="#">Continue</a>
					</div>
				</div>



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
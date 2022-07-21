
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    
    <!-- Basic page needs
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
			<li><a href="#">Order History</a></li>
		</ul>
		
		<div class="row">
			<!--Middle Part Start-->
			<div id="content" class="col-sm-9">
				<h2 class="title">Order History</h2>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<td class="text-center">Image</td>
								<td class="text-left">Product Name</td>
								<td class="text-center">Order ID</td>
								<td class="text-center">Qty</td>
								<td class="text-right">Total</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<?php if(count($order_history) > 0 ){ foreach($order_history as $key => $values){?>
								<tr>
								<td class="text-center">
									<a href=""><img width="85" class="img-thumbnail" title="Aspire Ultrabook Laptop" alt="Aspire Ultrabook Laptop" src="<?php echo base_url().$values['image_name'];?>">
									</a>
								</td>
								<td class="text-left"><a href=""><?php echo $values['product_name']; ?></a>
								</td>
								<td class="text-center"><?php echo $values['order_number']; ?></td>
								<td class="text-center"><?php echo $values['quantity']; ?></td>
								<td class="text-center"><?php echo $values['grand_total']; ?></td>
			
								<td class="text-center"><a class="btn btn-info" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>Frontend/orderinfo?orderid=<?php echo base64_encode($values['id']); ?>" data-original-title="View"><i class="fa fa-eye"></i></a>
								</td>
							</tr>
							<?php } } ?>
						</tbody>
					</table>
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
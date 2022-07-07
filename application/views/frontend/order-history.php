
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
								<td class="text-center">Status</td>
								<td class="text-center">Date Added</td>
								<td class="text-right">Total</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">
									<a href="product.html"><img width="85" class="img-thumbnail" title="Aspire Ultrabook Laptop" alt="Aspire Ultrabook Laptop" src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/funiture/1.jpg">
									</a>
								</td>
								<td class="text-left"><a href="product.html">Aspire Ultrabook Laptop</a>
								</td>
								<td class="text-center">#214521</td>
								<td class="text-center">1</td>
								<td class="text-center">Shipped</td>
								<td class="text-center">21/06/2016</td>
								<td class="text-right">$228.00</td>
								<td class="text-center"><a class="btn btn-info" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>Orderhistory/orderinfo" data-original-title="View"><i class="fa fa-eye"></i></a>
								</td>
							</tr>
							<tr>
								<td class="text-center">
									<a href="product.html"><img  width="85" class="img-thumbnail" title="Xitefun Causal Wear Fancy Shoes" alt="Xitefun Causal Wear Fancy Shoes" src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/funiture/4.jpg">
									</a>
								</td>
								<td class="text-left"><a href="product.html">Xitefun Causal Wear Fancy Shoes</a>
								</td>
								<td class="text-center">#1565245</td>
								<td class="text-center">1</td>
								<td class="text-center">Shipped</td>
								<td class="text-center">20/06/2016</td>
								<td class="text-right">$133.20</td>
								<td class="text-center"><a class="btn btn-info" title="" data-toggle="tooltip" href="<?php echo base_url(); ?>Orderhistory/orderinfo" data-original-title="View"><i class="fa fa-eye"></i></a>
								</td>
							</tr>
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
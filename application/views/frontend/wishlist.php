
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
			<li><a href="#">Account</a></li>
			<li><a href="#">My Wish List</a></li>
		</ul>
		
		<div class="row">
			<!--Middle Part Start-->
			<div id="content" class="col-sm-9">
				<h2 class="title">My Wish List</h2>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<td class="text-center">Image</td>
								<td class="text-left">Product Name</td>
								<td class="text-left">Model</td>
								<td class="text-right">Stock</td>
								<td class="text-right">Unit Price</td>
								<td class="text-right">Action</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">
									<a  href="product.html"><img width="70px" src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/80/2.jpg" alt="Aspire Ultrabook Laptop" title="Aspire Ultrabook Laptop">
									</a>
								</td>
								<td class="text-left"><a href="product.html">iPad</a>
								</td>
								<td class="text-left">Pt 001</td>
								<td class="text-right">In Stock</td>
								<td class="text-right">
									<div class="price"> <span class="price-new">$45</span> <span class="price-old">$80</span></div>
								
								</td>
								<td class="text-right">
									<button class="btn btn-primary"
									title="" data-toggle="tooltip"
									onclick="cart.add('48');"
									type="button" data-original-title="Add to Cart"><i class="fa fa-shopping-cart"></i>
									</button>
									<a class="btn btn-danger" title="" data-toggle="tooltip" href="#" data-original-title="Remove"><i class="fa fa-times"></i></a>
								</td>
							</tr>
							<tr>
								<td class="text-center">
									<a href="product.html"><img width="70px" src="<?php echo base_url();?>assets_frontend/image/catalog/demo/product/80/1.jpg" alt="Xitefun Causal Wear Fancy Shoes" title="Xitefun Causal Wear Fancy Shoes"></a>
								</td>
								<td class="text-left"><a href="product.html">Comas samer rumas</a>
								</td>
								<td class="text-left">Pt 002</td>
								<td class="text-right">Pre-Order</td>
								<td class="text-right">
									<div class="price"> <span class="price-new">$85</span> </div>
								</td>
								<td class="text-right">
									<button class="btn btn-primary"
									title="" data-toggle="tooltip"
									onclick="" type="button"
									data-original-title="Add to Cart"><i class="fa fa-shopping-cart"></i>
									</button>
									<a class="btn btn-danger" title="" data-toggle="tooltip"
									href="#" data-original-title="Remove"><i class="fa fa-times"></i>
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<!--Middle Part End-->
			<?php include('common/myaccountsidepart.php');?>   
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
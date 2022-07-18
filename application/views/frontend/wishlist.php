
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
				<?php if(count($wishlist_data) > 0){?>
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<td class="text-center">Image</td>
								<td class="text-left">Product Name</td>
								<!-- <td class="text-right">Stock</td> -->
								<td class="text-right">Unit Price</td>
								<td class="text-right">Action</td>
							</tr>
						</thead>
						<tbody>
							
							<tr>
								<?php foreach($wishlist_data as $key => $value) { ?>
								<td class="text-center">
									<input type="hidden" value="<?php echo $value['id']; ?>" id="wishlist_id">
									<a  href=""><img width="70px" src="<?php echo $value['image_name']; ?>" alt="<?php echo $value['product_name']; ?>" title="<?php echo $value['product_name']; ?>">
									</a>
								</td>
								<td class="text-left"><a href="product.html"><?php echo $value['product_name']; ?></a>
								</td>
								<!-- <td class="text-right">In Stock</td> -->
								<td class="text-right">
									<div class="price"> <span class="price-new"><?php echo '$ '.$value['product_purchase_price']; ?></span> <span class="price-old"><?php echo '$ '.$value['product_price']; ?></span></div>
								
								</td>
								<td class="text-right">
									<button class="btn btn-primary addtocart"
									title="" data-toggle="tooltip"
									id=<?= $value['product_id'];?>
									 data-original-title="Add to Cart"><i class="fa fa-shopping-cart"></i>
									</button>
									<a class="btn btn-danger romove_cart" title="" id=<?= $value['id'];?> data-toggle="tooltip"><i class="fa fa-times"></i></a>
								</td>
							</tr>
						
							<?php
							} ?>
						</tbody>
					</table>
				</div>
				<?php }else{?>
					<b><p class="text-center">Wishlist is Empty.</p></b>
				<?php } ?>
			</div>

			<!--Middle Part End-->
			<?php //include('common/myaccountsidepart.php');?>   
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
<script src="<?= base_url(); ?>assets_frontend/custom_js/wishlist.js"></script>
<script src="<?= base_url(); ?>assets_frontend/custom_js/cart.js"></script>
</body>


</html>
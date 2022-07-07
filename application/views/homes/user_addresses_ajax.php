<?php if(isset($my_address) && !empty($my_address)) {?>
	<div class="item item-carousel">
	    <div class="products">
	        <div class="product">
	        	<p class="clearfix"><h5><?php echo $my_address[0]['full_name']; ?></h5></p>
				<p class="clearfix"><?php echo $my_address[0]['mobile_number']; ?></p>
				<p class="clearfix"><?php echo $my_address[0]['address1']; ?></p>
				<p class="clearfix"><?php echo $my_address[0]['address2']; ?></p>
				<p class="clearfix"><?php echo $my_address[0]['landmark_nearest_area']; ?></p>
				<p class="clearfix"><?php echo $my_address[0]['town_city']; ?>, <?php echo $my_address[0]['pincode']; ?></p>
	        </div>
	        <div class="delivery_here"> 
				<input class="ml0" id="deliver_here<?php echo $my_address[0]['address_id'];?>" type="radio" name="text" value="<?php echo $my_address[0]['address_id'];?>">  
				<label name="delivery_here" class="radio-button guest-check" for="deliver_here<?php echo $my_address[0]['address_id'];?>">DELIVER HERE</label>
			</div>
	    </div>
	</div>
<?php } ?>
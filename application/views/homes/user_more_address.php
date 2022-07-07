<?php if(isset($my_address) && !empty($my_address)){ 
	foreach ($my_address as $key => $value) {?>
		<div class="col-md-4 col-sm-6 col-ms-12 ">
			<p class="clearfix"><h3><?php echo $value['full_name']; ?></h3></p>
			<p class="clearfix"><?php echo $value['mobile_number']; ?></p>
			<p class="clearfix"><?php echo $value['address1']; ?></p>
			<p class="clearfix"><?php echo $value['address2']; ?></p>
			<p class="clearfix"><?php echo $value['landmark_nearest_area']; ?></p>
			<p class="clearfix"><?php echo $value['town_city']; ?>, <?php echo $value['pincode']; ?></p>	

			<input type="radio" name="deliver_here[]" id="deliver_here<?php echo $value['address_id']; ?>" value="<?php echo $value['address_id']; ?>"  class="input-radio">
			<label for="deliver_here<?php echo $value['address_id']; ?>">DELIVER HERE</label>
		</div>
<?php }
} ?>
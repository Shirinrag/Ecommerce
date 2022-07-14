/* -------------------------------------------------------------------------------- /
	
	Magentech jQuery
	Created by Magentech
	v1.0 - 20.9.2016
	All rights reserved.
	
/ -------------------------------------------------------------------------------- */


	// Cart add remove functions
	var cart = {
		'add': function(product_id, quantity) {
			addProductNotice('Product added to Cart', '<img src="image/demo/shop/product/e11.jpg" alt="">', '<h3><a href="#">Apple Cinema 30"</a> added to <a href="#">shopping cart</a>!</h3>', 'success');
		}
	}

	// function wishlist(t)
	// {
	// 	wishlist.add(t);
	// }
	var wishlist = {
		'add': function(product_id) {
			addProductNotice(product_id);
		}
	}
	var compare = {
		'add': function(product_id) {
			addProductNotice('Product added to compare', '<img src="image/demo/shop/product/e11.jpg" alt="">', '<h3>Success: You have added <a href="#">Added"</a> to your <a href="#">product comparison</a>!</h3>', 'success');
		}
	}

	/* ---------------------------------------------------
		jGrowl – jQuery alerts and message box
	-------------------------------------------------- */
	function addProductNotice(title, thumb, text, type) {
		$.jGrowl.defaults.closer = false;
		//Stop jGrowl
		//$.jGrowl.defaults.sticky = true;
		var tpl = '';
		$.jGrowl(tpl, {		
			life: 4000,
			header: title,
			speed: 'slow',
			theme: type
		});
	}


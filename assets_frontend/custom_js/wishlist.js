
  $(document).on('click', '.add_cart', function() {
    var product_id = $(this).attr("id");
    $.ajax({
        url: bases_url + "Frontend/wishlist",
        method: "POST",
        data: { product_id: product_id },
        success: function(data) {
        var productdata = $.parseJSON(data);
        if(productdata['status'] == 'success')
        {
            $('.refesh').load(' .refesh');
         wishlist.add(productdata['message']);
        }
        else if(productdata['status'] == 'failed'){
         wishlist.add(productdata['message']);
        }
        else{
            window.location.replace(productdata['url']);
        }
        }
    });
});

  $(document).on('click', '.romove_cart', function() {
    var row_id = $(this).attr("id");
    $.ajax({
        url: bases_url + "Frontend/deletewishlist",
        method: "POST",
        data: { row_id: row_id },
        success: function(data) {
        var productdata = $.parseJSON(data);
        if(productdata['status'] == 'success')
        {
         wishlist.add(productdata['message']);
         location.reload();
        }
        else if(productdata['status'] == 'failed'){
         wishlist.add(productdata['message']);
         location.reload();
        }
        }
    });
});

  
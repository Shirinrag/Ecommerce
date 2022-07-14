$(document).on('click', '.addtocart', function() {
    var product_id = $(this).attr("id");
    $.ajax({
        url: bases_url + "Frontend/addtocart",
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
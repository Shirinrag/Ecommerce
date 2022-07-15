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
        $('.refesh1').load(' .refesh1');
        $('.refeshlist').load(' .refeshlist');
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

$(document).on('click', '.romove_cart_details', function() {
    var row_id = $(this).attr("id");
    $.ajax({
        url: bases_url + "Frontend/deletecart",
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


// $(document).on('click', '.update_qty', function() {
    
//     var product_id = $('product_id').val();
//     var row_id = $(this).attr("id");
//     console.log(product_id+':'+row_id);
//     $.ajax({
//         url: bases_url + "Frontend/updatecartqty",
//         method: "POST",
//         data: { row_id: row_id },
//         success: function(data) {
//         var productdata = $.parseJSON(data);
//         if(productdata['status'] == 'success')
//         {
//          wishlist.add(productdata['message']);
//          location.reload();
//         }
//         else if(productdata['status'] == 'failed'){
//          wishlist.add(productdata['message']);
//          location.reload();
        
//         }
//         }
//     });
// });
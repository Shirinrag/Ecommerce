$(document).on('click', '.addtocart', function() {
    var product_id = $(this).attr("id");
    $.ajax({
        url: bases_url + "Frontend/addtocart",
        method: "POST",
        data: {
            product_id: product_id
        },
        success: function(data) {
            var productdata = $.parseJSON(data);
            if (productdata['status'] == 'success') {
                $('.refesh1').load(' .refesh1');
                $('.refeshlist').load(' .refeshlist');
                wishlist.add(productdata['message']);
            } else if (productdata['status'] == 'failed') {
                wishlist.add(productdata['message']);
            } else {
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
        data: {
            row_id: row_id
        },
        success: function(data) {
            var productdata = $.parseJSON(data);
            if (productdata['status'] == 'success') {
                wishlist.add(productdata['product_offer_price']);
                location.reload();
            } else if (productdata['status'] == 'failed') {
                wishlist.add(productdata['message']);
                location.reload();

            }
        }
    });
});

$(document).on('click', '.romove_from_cart', function() {
    var row_id = $(this).attr("id");
    $.ajax({
        url: bases_url + "Frontend/deletecart",
        method: "POST",
        data: {
            row_id: row_id
        },
        success: function(data) {
            var productdata = $.parseJSON(data);
            if (productdata['status'] == 'success') {
                wishlist.add(productdata['message']);
                location.reload();
            } else if (productdata['status'] == 'failed') {
                wishlist.add(productdata['message']);
                location.reload();
            }
        }
    });
});

function increment_quantity(cart_id, price, product_id) {
    var inputQuantityElement = $("#input-quantity-" + cart_id);
    var newQuantity = parseInt($(inputQuantityElement).val()) + 1;
    var newPrice = newQuantity * price;
    $.ajax({
        type: "POST",
        url: bases_url + 'Frontend/updatecarts',
        data: {
            qty: newQuantity,
            cartid: cart_id,
            productid: product_id
        },
        success: function(result) {
            var productdata = $.parseJSON(result);
            if (productdata['status'] == 'success') {
                if (productdata['order_summary_info']) {
                    $.each(productdata['order_summary_info'], function(get_affiliate_category_on_source_link_index, get_affiliate_category_on_source_link_row) {
                        $('#product_offer_price_' + cart_id).html(get_affiliate_category_on_source_link_row['subtotal']);
                    });
                    $('#subtotal').html(productdata['total']);
                    $('#subtotal1').html(productdata['total']);
                    location.reload();
                }
            } else {
                $("#message_"+cart_id).text(productdata['message']);
                var newQuantity1 = newQuantity - 1;
                setTimeout(function() {
                    $('.cart-item-container').fadeOut('fast');
                }, 1000);
                // $('#input-quantity-'+cart_id).fadeOut(800, function() {
                    $('#input-quantity-'+cart_id).val(newQuantity1).fadeIn().delay(1000);
                // });
                $('#' + cart_id).addClass('disabled');
            }

        }
    });
}

function decrement_quantity(cart_id, price, product_id) {
    var inputQuantityElement = $("#input-quantity-" + cart_id);
    if ($(inputQuantityElement).val() > 1) {
        var newQuantity = parseInt($(inputQuantityElement).val()) - 1;

        var newPrice = newQuantity * price;
        $.ajax({
            type: "POST",
            url: bases_url + 'Frontend/updatecarts',
            data: {
                qty: newQuantity,
                cartid: cart_id,
                productid: product_id
            },
            success: function(result) {
                var productdata = $.parseJSON(result);
                if (productdata['status'] == 'success') {
                    if (productdata['order_summary_info']) {
                        $.each(productdata['order_summary_info'], function(get_affiliate_category_on_source_link_index, get_affiliate_category_on_source_link_row) {
                            $('#product_offer_price_' + cart_id).html(get_affiliate_category_on_source_link_row['subtotal']);
                        });
                        $('#subtotal').html(productdata['total']);
                        $('#subtotal1').html(productdata['total']);
                        location.reload();
                    }
                }

            }
        });
    }
}


$(document).ready(function() {

    $('#add_address').click(function() {
        $('#add_addresses').css("display", "block");
    });

});


$('#PaymentModeForm').submit(function(e) {
    e.preventDefault();
    var PaymentModeForm = $(this);
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: PaymentModeForm.attr('action'),
        data: PaymentModeForm.serialize(),
        beforeSend: function() {
            $('#save_payment_mode_button').button('loading');
        },
        success: function(response) {
            if (response.status == 'success') {
                $('form#PaymentModeForm').trigger('reset');
                $('#save_payment_mode_button').button('reset');
                window.location.replace(response['url']);
                success_msg("Payment Done Successfully");
            } else if (response.status == 'failure') {
                error_msg(response.error);
                $('#save_payment_mode_button').button('reset');
            } else {
                // window.location.replace(response['url']);
            }
        }
    });
});

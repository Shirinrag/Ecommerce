

function addwishlist(){
    var product_id = $('#product_id').val();
    var postData = {
        'product_id' : product_id
    }
    $.post(bases_url+'Frontend/wishlist',postData,function(data){
        var productdata = $.parseJSON(data);
        if(productdata['status'] == 'success')
        {
         wishlist.add(productdata['message']);
        }
        else{
         wishlist.add(productdata['message']);
        }
    })
  } 
  
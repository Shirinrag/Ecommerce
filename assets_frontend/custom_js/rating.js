var $star_rating = $('.star-rating .fa');
var SetRatingStar = function() {
return $star_rating.each(function() {
   if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
      return $(this).removeClass('fa-star-o').addClass('fa-star');
   } else {
      return $(this).removeClass('fa-star').addClass('fa-star-o');
   }
});
};
$star_rating.on('click', function() {
$star_rating.siblings('input.rating-value').val($(this).data('rating'));
return SetRatingStar();
});

SetRatingStar();

$("#srr_rating").click(function() {
var $star_rating = $('.star-rating .fa');
var ratings = parseInt($star_rating.siblings('input.rating-value').val());
//var remk= $('#remark').val();
var product_id= $('#product_id').val();
if(ratings>0){
// if(remk !=''){
$.ajax({
  url: bases_url+"Frontend/save_rating",
  type: "POST",
  data: {
    ratings: ratings,
      //remark:remk,
      product_id:product_id

  },
  success : function(data){
      alert(data);
      location.reload();	
  }
});
// }else{
// 	alert('Please write a review for the product!');
// }
}
else{
alert('Give a rating !');
}

});
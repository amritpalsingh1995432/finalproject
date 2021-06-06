$(document).ready(function() {
    $('#inventory').DataTable();
} );


$(document).ready(function() {
	$("tr.products-row .amount").on("input", function() {
		$( "tr.products-row" ).each(function( index ) {
		  var amount = $( this ).find(".amount").val();
		  var str = $(this).find('.action a').attr('href').split('q')[0];
		  var url = str + ('q='+amount);
		  $(this).find('.action a').attr('href', url);
		  //console.log(url);
		});
	});
} );


$(document).ready(function() {
	$(".rateProducts .fa").click(function() {
		$(this).parent(".rateProducts").find($(".fa")).removeClass('fa-star checked').addClass('fa-star-o');
		var rating = $(this).attr('data-rating');
		for(i=0; i<=rating; i++){
			$(this).parent(".rateProducts").find($("[data-rating="+i+"]")).removeClass('fa-star-o').addClass('fa-star checked');	
		}
		$(this).parent(".rateProducts").find($('.rate')).val(rating);
		$(this).parent(".rateProducts").find($('.ratebtn')).click();
	});
});


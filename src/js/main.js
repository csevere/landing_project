// testing js

$(document).ready(function(){
	$('.slider').slick({
		dots: true,
		infinite: false,
		speed: 300,
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		adaptiveHeight: true,
		autoplaySpeed: 2000,
		nextArrow: '<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>',
  	prevArrow: '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>',
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					infinite: true,
					dots: true
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
			// You can unslick at a given breakpoint now by adding:
			// settings: "unslick"
			// instead of a settings object
		]
	});

 //CHANGE NAVBAR SCROLL
  $(window).scroll(function(){
  	var scroll = $(window).scrollTop();
	  if (scroll > 300) {
			$('.navbar').css({'background-color': '#f8f9fa', 'box-shadow': '2px 2px 5px #dc3545'});
			$('.navbar a').css({'color': '#dc3545'});
			$('.nav-item a').css({'color': '#dc3545'});
	  }
	  else{
			$(".navbar").css({'background' :'transparent', 'box-shadow': 'none'}); 
			$('.navbar a').css({'color': '#fff'});
			$('.nav-item a').css({'color': '#fff'}); 	
	  }
  })

});



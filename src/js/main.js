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

	// VIDEO

// 	// Get the video
// var video = document.getElementById("myVideo");

// // Get the button
// var btn = document.getElementById("myBtn");

// // Pause and play the video, and change the button text
// function myFunction() {
//     if (video.paused) {
//         video.play();
//         btn.innerHTML = "Pause";
//     } else {
//         video.pause();
//         btn.innerHTML = "Play";
//     }
// }



});



(function( $ ) {
	'use strict';

	// Function to animate slider captions
	function doAnimations(target) {
		// Cache the animationend event in a variable
		let animEnd = "webkitAnimationEnd animationend";

		target.each( (i, e) => {
			
			let animType = $(e).data("animation");
			
			$(e).addClass(animType).one(animEnd, function() {
				$(e).removeClass(animType);
			});

		});
	}

	// Variables on page load
	let carusel = $(".carousel"),
		firstElement = carusel.find(".carousel-item:first").find("[data-animation ^= 'animated']");

	// Animate captions in first slide on page load
	doAnimations(firstElement);

	// Other slides to be animated on carousel slide event
	carusel.on("slide.bs.carousel", function(e) {
		let elements = $(e.relatedTarget).find("[data-animation ^= 'animated']");
		doAnimations(elements);
	});

	// carusel height
	let windowsHeight = $(window).height(),
	 	carouselOffset = $('.carousel').offset().top;
	// Check if height not changed since the min height is 300px
	if( $('.carousel-item').height() === 300 ) {
		$('.carousel-item ').height( windowsHeight - carouselOffset );
	}
	


})( jQuery );

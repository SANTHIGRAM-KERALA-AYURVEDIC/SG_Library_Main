(function($){
	"use strict";
    jQuery(document).ready(function($) {
		var sequenceElement_single = document.getElementById("sequence-single");
		
		$('.sabbi-book_timeline .btn-expand').on('click', function(event) {
			event.preventDefault();
			var btnThis = $(this);
			btnThis.siblings('.book-list').find('.onexpan').slideToggle(200);
			
			if (btnThis.text() != "View Less" ) {
				btnThis.text('View Less');
			} else {
				btnThis.text(btnThis.data('text'));
			}
		});
		
	});
})(jQuery);


(function ($, w) {
	"use strict";

	var sliderHandler = function ($scope, $){
		if ( 'undefined' == typeof $scope ){
			return;
		}
		// sequence slider js
		var sequenceElement = document.getElementById("sequence");

		// Place your Sequence options here to override defaults
		// See: http://sequencejs.com/documentation/#options
		var options = {
			startingStepAnimatesIn: true,
			autoPlay: $("#sequence").data('slideautoplay'),
			autoPlayInterval: $("#sequence").data('slideautoplayinterval'),
			/* Make this the same as the animateCanvasDuration */
			phaseThreshold: 250,
			preloader: true,
			reverseWhenNavigatingBackwards: true,
			keyNavigation: true,
			fadeStepWhenSkipped: false
		}
		if($(sequenceElement).length) {
			// Launch Sequence on the element, and with the options we specified above
			var mySequence = sequence(sequenceElement, options);
		}
	}
	$( window ).on( 'elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/slider.default', sliderHandler );
	});
} (jQuery, window));
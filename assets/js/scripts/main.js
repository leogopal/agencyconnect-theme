jQuery(document).ready(function($) {


	/* - - - - - - - -

	CONTENT & BLOG  

	- - - - - - - -*/

	/* responsive videos */
	$(".post, .hentry, .videowrap").fitVids();

	/* responsive soundcloud player */
	$('iframe').attr('width','100%');

	/* gallery pop over hover captions */
	$('.gallery-icon a').on('mouseenter mouseleave', function() {
		$(this).parents().siblings('.gallery-caption').fadeToggle(100);
	});

	// $('.gallery').magnificPopup({
	// 		delegate: 'a',
	// 		type: 'image',
	// 		closeOnContentClick: false,
	// 		closeBtnInside: false,
	// 		mainClass: 'mfp-with-zoom mfp-img-mobile',
	// 		image: {
	// 			verticalFit: true,
	// 			titleSrc: function(item) {
	// 				return item.el.attr('title');
	// 			}
	// 		},
	// 		gallery: {
	// 			enabled: true
	// 		},
	// 		zoom: {
	// 			enabled: true,
	// 			duration: 300, // don't foget to change the duration also in CSS
	// 			opener: function(element) {
	// 				return element.find('img');
	// 			}
	// 		}
	// 	});

	// $('.load-late').unveil();

	/* Responsive Equal Heights - https://github.com/liabru/jquery-match-height */
	// $('.equal-heights').matchHeight();

	/* Hide and Show Comment Allowed Tags */
	var $comTags = $('.form-allowed-tags').hide().css('opacity','0');
	var showTags = function showTags() {
		$comTags.velocity('slideDown',{
			complete : function() {
				$(this).velocity({
					opacity : 1
				});
			}
		});
	}

	var hideTags = function hideTags() {
		$comTags.velocity({
					opacity : 0
				},{
			complete : function() {
				$(this).velocity('slideUp');
			}
		});
	}

	$('#comment').on({
		'focus' : showTags,
		'blur' : hideTags
	});


});
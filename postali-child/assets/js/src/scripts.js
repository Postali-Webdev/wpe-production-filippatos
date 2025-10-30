/**
 * Theme scripting
 *
 * @package Postali Child
 * @author Postali LLC
 */
/*global jQuery: true */
/*jslint white: true */
/*jshint browser: true, jquery: true */

jQuery( function ( $ ) {
	"use strict";

    //Hamburger animation
	$('#menu-icon').click(function() {
		$(this).toggleClass('active');
		$('#menu-main-menu').toggleClass('active');
		return false;
	});

	//Toggle mobile menu & search
	$('.toggle-nav').click(function() {
		$('#menu-main-menu').slideToggle(400);
	});
	 
	//Close navigation on anchor tap
	$('.toggle-nav.active').click(function() {	
		$('#menu-main-menu').slideUp(400);
	});	

	//Mobile menu accordion toggle for sub pages
	$('#menu-main-menu > li.menu-item-has-children').append('<div class="accordion-toggle"><span class="icon-icon-chevron-right"></span></span></div>');

	//   $('#menu-main-menu .accordion-toggle').click(function() {
	// 	$(this).parent().find('> ul').slideToggle(400);
	// 	$(this).toggleClass('toggle-background');
	// 	$(this).find('.icon-icon-chevron-right').toggleClass('toggle-rotate');
	//   });
	$('#menu-main-menu .menu-item-has-children').click(function() {
		$(this).toggleClass('open');
		$(this).find('> ul.sub-menu').slideToggle(400);
		$(this).find('.accordion-toggle').toggleClass('toggle-background');
		$(this).find('.icon-icon-chevron-right').toggleClass('toggle-rotate');
	});

    // script to make accordions function
	$(".accordions").on("click", ".accordions_title", function() {
        // will (slide) toggle the related panel.
        $(this).toggleClass("active").next().slideToggle();
    });

	//keeps menu expanded so user can tab through sub-menu, then closes menu after user tabs away from last child
	$(document).ready(function() {
		$('.menu-item-has-children').on('focusin', function() {
			var subMenu = $(this).find('.sub-menu');
			subMenu.css('display', 'flex');

			$(this).find('.sub-menu > li:last-child').on('focusout', function() {
				subMenu.css('display', 'none');
			})
		})
	});

	// Toggle search function in nav
	$( document ).ready( function() {
		var width = $(document).outerWidth()
		if (width > 992) {
			var open = false;
			$('#search-button').attr('type', 'button');
			
			$('#search-button').on('click', function(e) {
					if ( !open ) {
						$('#search-input-container').removeClass('hdn');
						$('#search-button span').removeClass('icon-magnifying-glass').addClass('icon-close-x');
						$('#menu-main-menu li.menu-item').addClass('disable');
						open = true;
						return;
					}
					if ( open ) {
						$('#search-input-container').addClass('hdn');
						$('#search-button span').removeClass('icon-close-x').addClass('icon-magnifying-glass');
						$('#menu-main-menu li.menu-item').removeClass('disable');
						open = false;
						return;
					}
			}); 
			$('html').on('click', function(e) {
				var target = e.target;
				if( $(target).closest('.navbar-form-search').length ) {
					return;
				} else {
					if ( open ) {
						$('#search-input-container').addClass('hdn');
						$('#search-button span').removeClass('icon-close-x').addClass('icon-magnifying-glass');
						$('#menu-main-menu li.menu-item').removeClass('disable');
						open = false;
						return;
					}
				}
			});
		}
	});

	// apply inner link to entire parent element
	$(document).ready(function() {
		$('.link-finder').on('click', function() {
			var link = $(this).find('a:not(.category-link').attr('href');
			window.location.href = link;
		});
	});

	// $(document).ready(function() {
	// 	if( $('.cases-won-wrapper').length ) {
	// 		var windowWidth = $(window).outerWidth();
	// 		var casesContainer = $('.cases-won-wrapper').offset().top;
	// 		var fixedResultTwo = $('.result-2').offset().top - casesContainer;
	// 		var fixedResultThree = $('.result-3').offset().top - casesContainer;

	// 		function setTotal(fixedTwo, fixedThree) {
	// 			var resultTwo = $('.result-2').offset().top - casesContainer;
	// 			var resultThree = $('.result-3').offset().top - casesContainer;
	// 			var valTotal = parseInt( $('.card-total-result').attr('data-amount'), 10 );
	// 			var valTwo = parseInt( $('.result-2 .amount').attr('data-amount'), 10 );
	// 			var valThree = parseInt( $('.result-3 .amount').attr('data-amount'), 10 );
	// 			var resultTwoAdded = false;
	// 			var resultThreeAdded = false;
	// 			var currentPosition = $(window).scrollTop();

	// 			if( currentPosition >= $('.result-2').offset().top - (221 + 275) ) {
	// 				$('.result-1').css({'filter' : 'brightness(0.5)', 'transition' : '1s ease'});
	// 			} else if( currentPosition < $('.result-2').offset().top - (221 + 275) ) {
	// 				$('.result-1').css({'filter' : 'brightness(1)', 'transition' : '1s ease'});
	// 			}

	// 			if( currentPosition >= $('.result-3').offset().top - (221 + 275) ) {
	// 				$('.result-2').css({'filter' : 'brightness(0.5)', 'transition' : '1s ease'});
	// 			} else if( currentPosition < $('.result-3').offset().top - (221 + 275) ) {
	// 				$('.result-2').css({'filter' : 'brightness(1)', 'transition' : '1s ease'});
	// 			}

	// 			if( currentPosition >= $('.all-results').offset().top - (221 + 275) ) {
	// 				$('.result-3').css({'filter' : 'brightness(0.5)', 'transition' : '1s ease'});
	// 			} else if( currentPosition < $('.all-results').offset().top - (221 + 275) ) {
	// 				$('.result-3').css({'filter' : 'brightness(1)', 'transition' : '1s ease'});
	// 			}
				
	// 			if( resultTwo > fixedTwo ) {
	// 				if( resultTwoAdded === false ) {
	// 					valTotal = valTotal + valTwo;
	// 					resultTwoAdded = true;
	// 				}
	// 			} else if( resultTwo >= fixedTwo ) {
	// 				if( resultTwoAdded === true ) {
	// 					valTotal = valTotal - valTwo;
	// 					resultTwoAdded = false;
	// 				}
	// 			}

	// 			if( resultThree > fixedThree ) {
	// 				if( resultThreeAdded === false ) {
	// 					valTotal = valTotal + valThree;
	// 					resultThreeAdded = true;
	// 				}
	// 			} else if( resultThree >= fixedThree ) {
	// 				if( resultThreeAdded === true ) {
	// 					valTotal = valTotal - valThree;
	// 					resultThreeAdded = false;
	// 				}
	// 			}
	// 			$('.card-total-result').html( '$' + valTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	// 		}
			
	// 		if( windowWidth > 820 ) {
	// 			$(document).on('scroll', function() {
	// 				setTotal(fixedResultTwo, fixedResultThree);		
	// 			});
	// 		}
	// 	}
	// })

	$(document).ready(function() {
		$('.more-info-btn').on('click', function() {
			var btnId = $(this).data('more-info');
			$(`#${btnId}`).slideToggle('medium');
		});
	});	  

	$('.video-placeholder').on('click', function() {
        var $video = `<div class="responsive-iframe"><iframe src="${$(this).data('url')}&autoplay=1" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen title="${$(this).data('title')}"></iframe></div>`;
        $(this).replaceWith($video);
    });

});
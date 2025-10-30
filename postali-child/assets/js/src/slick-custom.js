/**
 * Slick Custom
 *
 * @package Postali Child
 * @author Postali LLC
 */
/*global jQuery: true */
/*jslint white: true */
/*jshint browser: true, jquery: true */

jQuery( function ( $ ) {
	"use strict";
	var windowWidth = $(window).outerWidth();

	$('#attorney-slider').slick({
		infinite: true,
		autoplay: true,
  		autoplaySpeed: 3000,
  		speed: 1300,
		slidesToShow: 4,
		slidesToScroll: 1,
		responsive: [
			{
			breakpoint: 1500,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1
				}
			},
			{
			breakpoint: 1200,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				}
			},
			{
			breakpoint: 992,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}
		]
	});

	$('.featured-posts-container').slick({
		infinite: true,
		autoplay: false,
  		autoplaySpeed: 5000,
  		speed: 1300,
		slidesToShow: 3,
		slidesToScroll: 1,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 667,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			},
		]
	});

	if( windowWidth > 667 ) {
		 $('.single .featured-posts-container').slick('unslick');
	}
	
	$('#top-awards-slider').slick({
		infinite: true,
		autoplay: true,
  		autoplaySpeed: 3000,
  		speed: 1300,
		slidesToShow: 3,
		slidesToScroll: 1,
		prevArrow: false,
    	nextArrow: false,
		pauseOnHover: false,
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 820,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			},
		]
	});

	$('#bottom-awards-slider').slick({
		infinite: true,
		autoplay: true,
		rtl: true,
  		autoplaySpeed: 3000,
  		speed: 1300,
		slidesToShow: 3,
		slidesToScroll: 1,
		prevArrow: false,
    	nextArrow: false,
		pauseOnHover: false,
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 820,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			},
		]
	});
	
	$('.case-amounts-scroller').slick({
		infinite: true,
		autoplay: true,
  		autoplaySpeed: 2000,
  		speed: 750,
		slidesToShow: 1,
		slidesToScroll: 1,
		prevArrow: false,
    	nextArrow: false
	});

	    // Slick customization
		$('.ppc-awards').slick({
			dots: false,
			arrows: false,
			buttons: false,
			infinite: true,
			speed: 500,
			slidesToShow: 3,
			autoplay: true,
			slidesToScroll: 1,
			responsive: [
				{
					breakpoint: 820,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1,
						arrows: false,
						dots: true,
					}
				},
				{
					breakpoint: 667,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						arrows: false,
						dots: true,
					}
				}
			]
		});

	
});
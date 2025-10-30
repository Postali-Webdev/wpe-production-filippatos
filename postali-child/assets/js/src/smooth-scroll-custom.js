jQuery( function ( $ ) {
	"use strict";

	
	// Any links with hash tags in them (can't do ^= because of fully qualified URL potential)
	$(document).ready(function () {
        $('a[href^="#"]').on('click', function (e) {
            e.preventDefault();
   
            var target = this.hash,
                $target = $(target);
   
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top - 190
            }, 900, 'swing');
        });
    });

});
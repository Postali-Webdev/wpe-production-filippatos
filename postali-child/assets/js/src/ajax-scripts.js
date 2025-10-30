jQuery(document).ready(function($) {

	// Load all results
    var resultsOffset = [];

	$('#show-results').on('click', function(e) {
		$('#more-results-panel').addClass('active');
        $("#more-results-panel").append('<div class="loading-icon"></div>');
        
        $('.stacking-panel .result').each(function(index, item) {
            resultsOffset.push( $(item).data('post-id') );
        });

		$.ajax({
			type: "POST",
			dataType: "html",
			url: ajax_filter_results_reviews.ajaxurl,
			data: {
				action: 'load_all_results',
                offset: resultsOffset
			},
			success: function(data){
				$(".all-results-grid").empty();
                $('.loading-icon').remove();
				$(".all-results-grid").append(data);
			},
			error : function(jqXHR, textStatus, errorThrown) {
				console.log('error: ' + errorThrown);
			}
		});
	});

    // load more reviews
    var reviewOffset = [];
	$('#load-more-reviews').on('click', function(e) {
        $("#reviews").append('<div class="loading-icon"></div>');

        setTimeout(function() {
            if( $('.last-of-results').length ) {
                $('#load-more-reviews').html('End Of Results');
                $('#load-more-reviews').addClass('disabled');
                $('#load-more-reviews').attr('disabled', true);
            }
        }, 750);

        $('.reviews-grid .review').each(function(index, item) {
            reviewOffset.push( $(item).data('post-id') );
        });

        $.ajax({
			type: "POST",
			dataType: "html",
			url: ajax_filter_results_reviews.ajaxurl,
			data: {
				action: 'load_more_reviews',
                offset: reviewOffset
			},
			success: function(data){				
				$('.loading-icon').remove();
                $('#load-more-reviews').html('End Of Results');
                $('#load-more-reviews').addClass('disabled');
                $('#load-more-reviews').attr('disabled', true);
                $(".reviews-grid").append(data);
			},
			error : function(jqXHR, textStatus, errorThrown) {
				console.log('error: ' + errorThrown);
			}
		});
    })

    //Toggle Review/Results view
    var resultsHidden = false;
    var reviewsHidden = false;
    $('#view-filter').on('change', function(e) {
        var selectedVal = $(this).children('option:selected').val();
        
        if( selectedVal === 'results') {
            if( reviewsHidden === false) {
                $('#reviews').css('display', 'none');
                reviewsHidden = true;
            } else if( reviewsHidden === true) {
                return;
            }

            if( resultsHidden === true) {
                $('#results').css('display', 'block');
                resultsHidden = false;
            } else if( resultsHidden === false) {
                return;
            }
        } else if( selectedVal === 'reviews' ) {
            if( resultsHidden === false) {
                $('#results').css('display', 'none');
                resultsHidden = true;
            } else if( resultsHidden === true) {
                return;
            }

            if( reviewsHidden === true ) {
                $('#reviews').css('display', 'block');
                reviewsHidden = false;
            } else if ( reviewsHidden === false ) {
                return;
            }
        } else if ( selectedVal === 'all' ) {
            $('#reviews').css('display', 'block');
            $('#results').css('display', 'block');
            resultsHidden = false;
            reviewsHidden = false;
        }          
    })

	
	
});
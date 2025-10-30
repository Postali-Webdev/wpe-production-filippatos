
//This script will be excluded from deferral & delays
jQuery( function ( $ ) {
    var pageWidth = $(document).outerWidth();
console.log('2');``
    function setHeights() {
        $('.iso-grid-item').each(function(index, item) {
            // var height = $(item).innerHeight() - 150;
            var height = $(item).innerHeight();
            $(item).height(height - 50);
        })
    }
    function setMasonryGrid() {
        $('.iso-masonry-grid').isotope({
            itemSelector: '.iso-grid-item',
            masonry: {
                horizontalOrder: true,
                gutter: 0,
                columnWidth: 500
              }
        });
    }
    function runOrderedMethods() {
        if( pageWidth > 999 && $('.iso-masonry-grid').length ) {
            new Promise(function(fulfill, reject) {
                fulfill(setTimeout(setHeights, 100));
            }).then(setTimeout(setMasonryGrid, 100));
        }
    }
    
    $(document).ready(function() {
        runOrderedMethods();
    });
        

});
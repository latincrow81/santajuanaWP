;(function($, window, document, undefined){
	"use strict";

    window.pi_post_format_ui_tiled_gallery = function () {
        if ($('.wiloke-tiled-gallery').length) 
        {
            var tiledItemSpacing = 4;
            $('.wiloke-tiled-gallery').wrap('<div class="tiled-gallery-row"></div>');
            $('.wiloke-tiled-gallery').parent().css('margin', -tiledItemSpacing);
            $('.wiloke-tiled-gallery').justifiedGallery({
                rowHeight: 230,
                lastRow : 'justify',
                margins: tiledItemSpacing
            });
        }
    }

    window.pi_post_format_ui_owl_carousel = function ()
    {
    	var navslider = ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'];
    	if ($('.images-slider').length > 0) {
            $('.images-slider').owlCarousel({
                autoPlay: 20000,
                slideSpeed: 300,
                navigation: true,
                pagination: true,
                singleItem: true,
                autoHeight: true,
                navigationText: navslider,
            });
        }
    }

    window.pi_post_format_ui_magnific_popup = function ()
    {
    	if( $(".pi-magnific-popup").length > 0 )
    	{
    		$('.pi-magnific-popup').each(function()
    		{
				$(this).magnificPopup({
					delegate: 'a',
					type: 'image',
					tLoading: 'Loading image #%curr%...',
					mainClass: 'mfp-img-mobile',
					gallery: {
						enabled: true,
						navigateByImgClick: true,
						preload: [0,1] // Will preload 0 - before current, and 1 after the current image
					},
					image: {
						tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
						titleSrc: function(item) {
							return item.el.attr('data-caption');
						}
					}
				});
			})
    	}
    }
    $(document).ready(function(){
    	pi_post_format_ui_tiled_gallery();
    	pi_post_format_ui_owl_carousel();
    	pi_post_format_ui_magnific_popup();
    })

})(jQuery, window, document)
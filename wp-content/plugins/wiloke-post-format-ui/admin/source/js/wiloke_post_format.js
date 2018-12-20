(function($) {
    "use strict";

    function wilokeTabFormat() {
        $('#formatdiv').css('display', 'none');
        $('.wiloke-post-format-wrapper .wiloke-controls-post-format').on('click', 'a', function(event) {
            var $this = $(this),
                $wrap = $this.closest('.wiloke-post-format-wrapper'),
                $parent = $this.parent('li'),
                $format = $this.data('format'),
                id = $this.attr('href');

            if( !$(id).hasClass('active') ) {
                $wrap.find('.active').removeClass('active');
                $parent.addClass('active');
                $('#wiloke-' + id).addClass('active');
                $('#'+id).prop('checked', true);
            }

            return false;
            
        });
    }

    function wilokeMediaFormat() {
        $('.wiloke-button-media').on('click', '.add', function(event) {
            event.preventDefault();

            var $el = $(this),
                $wrap = $el.closest('.wiloke-format-block'),
                $screenshot = $('.screenshot', $wrap),
                $input = $('.wiloke-media-value', $wrap),
                value = $input.val(),
                type = $(this).data('type'),
                frame, gallery;

            if(type == 'image') {

                if( frame ) {
                    frame.open();
                    return;
                }

                frame = wp.media({
                    multiple: false,
                    title: $el.data( 'choose' ),
                    button: {
                        text: $el.data( 'update' )
                    }
                });

                frame.on('open', function() {
                    var selection = frame.state().get('selection');
                    
                    if(value) {
                        var attachment = wp.media.attachment(value);
                        selection.add( attachment ? [ attachment ] : [] );
                        console.log(selection);
                    }
                });

                frame.on('select', function() {
                    var selection = frame.state().get('selection'),
                        ids, html = '';
                    selection.each(function(target) {
                        var attributes = target.attributes;
                        var img = typeof attributes.sizes.thumbnail != 'undefined' ? attributes.sizes.thumbnail.url : attributes.url;
                        html = '<li><img src="'+ img +'"></li>';
                        $input.val(attributes.id);
                        $screenshot.html(html);
                    });
                });

                frame.open();

            } else {

                if(typeof wp === 'undefined' || !wp.media || !wp.media.gallery) {
                    return;
                }

                if( !value ) {
                    gallery = '[gallery ids="0"]';
                } else {
                    gallery = '[gallery ids="'+ value +'"]';
                }

                var frame = wp.media.gallery.edit(gallery);

                frame.state('gallery-edit').on(
                    'update', function( selection ) {

                        $screenshot.html('');
                        var element, html = "";

                        var ids = selection.models.map( function(e) {
                            element = e.toJSON();
                            var preview_img = typeof element.sizes.thumbnail != 'undefined' ? element.sizes.thumbnail.url : element.url;
                            html = '<li><img src="'+ preview_img +'"></li>';
                            $screenshot.append(html);
                            return e.id;
                        });

                        $input.val(ids.join(','));
                    }
                );
            }

        });

        $('.wiloke-button-media').on('click', '.remove', function(event) { 
            var $el = $(this),
                $wrap = $el.closest('.wiloke-format-block'),
                $screenshot = $('.screenshot', $wrap),
                $input = $('.wiloke-media-value', $wrap);

            $screenshot.html('');
            $input.val('');
            return false;
        });
    }

    $(document).ready( function () {
        wilokeTabFormat();
        wilokeMediaFormat();
        // $('#wiloke-post-format-wrapper').wilokePostFormat({});
    });

})(jQuery);
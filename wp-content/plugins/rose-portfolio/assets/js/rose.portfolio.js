(function($) {
    "use strict";

    $.fn.imageCover = function() {
        $(this).each(function() {
            var self = $(this),
                image = self.find('img'),
                heightWrap = self.outerHeight(),
                widthImage = image.outerWidth(),
                heightImage = image.outerHeight();
            if (heightImage < heightWrap) {
                image.css({
                    'height': '100%',
                    'width': 'auto',
                    'max-width' : 'initial'
                });
            }
        });
    }

    // TOGGLE FILTER
    function RoseToggleFilter() {
        $('.portfolio-filter').on('click', '.toggle-filter', function(event) {
            event.preventDefault();
            var $filter = $(this).parent().find('.ul-filter');

            if($filter.css('display') == 'none') {
                $filter.slideDown();
                $(this).removeClass('active');
            } else {
                $filter.slideUp();
                $(this).addClass('active');
            }
        });
    }

    // PROJECT ISOTOP
    function RoseIsotopePortfolio() {
        $('.portfolio-wrap').each(function(index, el) {
            


            var $this    = $(this),
                $container = $(this).find('.portfolio-isotop'),
                $wrap = $container.closest('.portfolio-wrap'),
                $filter = $('.portfolio-filter .ul-filter', $wrap),
                $button = $('.loadmore .button', $wrap),
                parentId = '',
                key = $('.loadmore .button', $wrap).data('id');

            parentId = $button.attr('data-parentid');

            if ( typeof WilokeGlobal.portfolio[parentId] == 'undefined' )
            {
                WilokeGlobal.portfolio[parentId] = $this.data('count');
            }
            

            if ( $container.find('.loadmore a') )
            {    
                if ( $container.find('.grid-item').length == WilokeGlobal.portfolio[parentId].all )
                {
                    $button.parent().remove();
                }
            }

            $container.imagesLoaded( function() { 
                $container.isotope({
                    layoutMode: 'masonry',
                    masonry: {
                        columnWidth: '.grid-size'
                    },
                    itemSelector: '.grid-item',
                    percentPosition: true,
                });
            });

            $filter.on( 'click', 'a', function() {
                var $this = $(this), 
                    value = $this.attr('data-filter'),
                    count = $this.data('item'),
                    obj = window[key],
                    cat_id = $this.data('id'),
                    count = $this.data('post');

                    $button.data('is_loadmore', false);

                    if ( !$this.hasClass('all') )
                    {
                        if ( $container.find(value).length != WilokeGlobal.portfolio[parentId][cat_id] )
                        {
                            $button.data('is_loadmore', true);
                        }
                    }else{

                        if ( $container.find('.grid-item').length == WilokeGlobal.portfolio[parentId].all )
                        {
                            $button.parent().remove();
                        }else{
                            $button.data('is_loadmore', true);
                        }
                    }

                    if ( $button.length && $button.data('is_loadmore') == true )
                    {
                        var currentTop = $button.offset().top,
                        windowHeight = $(window).height();
                     
                        if ( windowHeight >= currentTop )
                        {
                            $button.trigger('click');
                        }else{
                            Waypoint.refreshAll();
                        }
                    }
                        
                if(typeof obj !='undefined') {
                    if( $container.find(value).length == count ) {
                        $button.prop('disabled', true).parent().addClass('hidden');
                        delete obj['category_filter'];
                    } else {
                        $button.prop('disabled', false).parent().removeClass('hidden');
                        if(typeof cat_id != 'undefined' && cat_id !='' ) {
                            obj['category_filter'] = cat_id;
                        } else {
                            delete obj['category_filter'];
                        }
                    }

                    window[key] = obj;
                }

                $container.isotope({ filter: value });
                $this.closest('.ul-filter').find('.active').removeClass('active');
                $this.parent('li').addClass('active');
                
                return false;
            });

        });
    }

    function RoseAjaxPortfolio() {

        $('.portfolio-wrap .loadmore').on('click', '.button', function(event) {
            event.preventDefault();
            var $this = $(this),
                parentId = $this.data('parentid'),
                $wrap = $this.closest('.portfolio-wrap'),
                $container = $('.portfolio-isotop', $wrap),
                $active = $('.ul-filter .active a'),
                key = $('.loadmore .button', $wrap).data('id'),
                obj = window[key],
                post_not_in = "";
                

            $('.grid-item', $container).each(function(index, el) {
                if(index === 0) {
                    post_not_in += $(this).data('id');
                } else {
                    post_not_in += ',' + $(this).data('id');
                }
            });

            obj['post__not_in'] = post_not_in;
            var param = JSON.stringify(obj);
            
            if($this.parent().hasClass('loaded') == false) {
                $.ajax({
                    url: rose_ajax.ajax_url,
                    async: true,
                    data: {action: 'rose_ajax_portfolio', param: param},
                    beforeSend: function() {
                        $this.parent().removeClass('hidden').addClass('loaded');
                    },
                    success: function(response) { 
                        var obj = JSON.parse(response);

                        if(obj.content !='' ) {
                            var $newitem = $(obj.content);
                            $this.parent().removeClass('loaded');

                            $newitem.imagesLoaded(function () {
                                $container.append($newitem).isotope('appended', $newitem);

                                if( $active.length && !$active.hasClass('all') ) {
                                    var currentFilter = $active.attr('data-filter'),
                                        termId        = $active.attr('data-id');

                                    if ( $container.find(currentFilter).length == WilokeGlobal.portfolio[parentId][termId] )
                                    {
                                        $this.data('is_loadmore', false);
                                    }
                                } else {
                                    if ( $container.find('.grid-item').length == WilokeGlobal.portfolio[parentId].all )
                                    {
                                        $this.parent().remove(); 
                                    }
                                } 
                                
                                if ( $this.length && $this.parent().hasClass('scroll') )
                                {
                                    var currentTop = $this.offset().top,
                                    windowHeight = $(window).height();
                                    
                                    if ( windowHeight >= currentTop )
                                    {
                                        $this.trigger('click');
                                    }else{
                                        Waypoint.refreshAll();
                                    }
                                }
                            });
                            
                        } else {

                            if($active.length) {
                                if($active.hasClass('all')) { 
                                    $this.parent().remove(); 
                                } else {
                                    $this.parent().addClass('hidden').removeClass('loaded');
                                }
                            } else {
                                $this.parent().remove(); 
                            } 
                        }
                    }

                });
            }
            
            return false;

        });
        
        $('.loadmore.scroll').each( function() {
            var $this = $(this);
            
            if ( $this.data('is_loadmore') === false )
            {
                return false;
            }

            $this.waypoint(function(direction) {
                if( direction === 'down' ) {
                    $this.find('.button').trigger('click');
                }
             
            }, {
                offset: '100%'
            });
        })
    }

    function RoseSidebarSticky() {
        if ( $('.portfolio-body .portfolio-info').length > 0 ) {
            $('.portfolio-body .portfolio-info').parent().theiaStickySidebar({
                updateSidebarHeight: true,
                additionalMarginTop: 0
            });
        }
    }

    function RoseFavorite() {
        $('.portfolio-isotop').on('click', '.heart', function(event) {

            event.preventDefault();
            
            var $this = $(this),
                id = $this.attr('data-id');

            if(!isNaN(id) && $this.hasClass('load') ==  false) {

                $.ajax({
                    url: rose_ajax.ajax_url,
                    async: true,
                    type: 'GET',
                    data: {action: 'ajax_like', post_id: id},
                    beforeSend: function(){
                        $this.addClass('active');
                    },
                    success: function(response) { 
                        var obj = JSON.parse(response);
                        
                        if(obj.content != '' ) {
                            $this.html(obj.content);
                            $this.removeClass('active');
                        }
                    }
                });
            }

            return false;
        });
    }

    $(document).ready(function() {
        RoseFavorite();
        RoseToggleFilter();
        RoseSidebarSticky();
    });

    $(window).load(function() {
        RoseIsotopePortfolio();
        RoseAjaxPortfolio();  
        $('.portfolio-isotop.style1 .img, .portfolio-isotop.style2 .img').imageCover();
    });
    
})(jQuery);
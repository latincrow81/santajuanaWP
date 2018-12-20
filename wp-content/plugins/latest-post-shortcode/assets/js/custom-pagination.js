(function ($) {
    window.LPS_check_ajax_pagination = {
        config: {},
        init: function () {
            LPS_check_ajax_pagination.initEvents();
        },
        initEvents: function () {
            LPS_check_ajax_pagination.sectionsSetup();
        },
        sectionsSetup: function () {
            var $sections = $('.lps-top-section-wrap');
            $sections.each(function () {
                var $current = $(this);
                var $maybe_ajax = $current.find('.ajax_pagination');
                if (typeof $maybe_ajax === 'object' && $maybe_ajax.length) {
                    $current.find('ul.latest-post-selection.pages li>a').on('click', function (e) {
                        e.preventDefault();
                        LPS_check_ajax_pagination.lpsNavigate(
                            $current,
                            $(this).data('page'),
                            $current.data('args'),
                            $current.data('current')
                        );
                    });
                }
            });
        },
        lpsNavigate: function ($parent, page, args, current) {
            $.ajax({
                type: "POST",
                url: LPS.ajaxurl,
                data: {
                    action: 'lps_navigate_to_page',
                    page: page,
                    args: args,
                    current: current,
                    lps_ajax: 1,
                },
                cache: false,
            }).success(function (response) {
                $parent.html(response);
                LPS_check_ajax_pagination.init();
            });
        }
    };

    $(document).ready(function () {
        LPS_check_ajax_pagination.init();
    });

})(jQuery);

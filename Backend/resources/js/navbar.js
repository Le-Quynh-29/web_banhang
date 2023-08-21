(function ($) {
    'use strict';

    var AppNavbar = function AppNavbar(element, options, cb) {
        var appNavbar = this;
        this.element = element;
        this.$element = $(element);
        this.appUrl = _appUrl;
        this.token = _token;
    };

    AppNavbar.prototype = {
        _init: function _init() {
            this.ajaxSetup();
            this.init();
        },
        ajaxSetup: function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });
        },
        init: function () {
            $(document).ready(function () {
                setTimeout(() => {
                    var menuId = $('.nav-link.active').data('id');

                    if (menuId != '' && menuId != undefined) {
                        window.localStorage.setItem('menu-selected', menuId);
                    } else {
                        var menuIdStorage = window.localStorage.getItem('menu-selected');

                        $('.c-sidebar-nav-link').removeClass('active');
                        if (menuIdStorage != '' && menuIdStorage != undefined) {
                            $('.nav-link[data-id="' + menuIdStorage + '"]').addClass('active');
                            $('.nav-link[data-id="' + menuIdStorage + '"]').parent().closest('.nav-group').addClass('show');
                        } else {
                            $('.nav-link[data-id="dashboard"]').addClass('active');
                        }
                    }
                }, 400);
            });
        },
    };

    /* Execute main function */
    $.fn.appNavbar = function (options, cb) {
        this.each(function () {
            var el = $(this);
            if (!el.data('appNavbar')) {
                var appNavbar = new AppNavbar(el, options, cb);
                el.data('appNavbar', AppNavbar);
                appNavbar._init();
            }
        });
        return this;
    };
})(jQuery);

$(document).ready(function () {
    $('body').appNavbar();
});

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
            this.initNavbarMenu();
            this.initResizeScreen();
            this.observeSidebar();
        },
        ajaxSetup: function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });
        },
        init: function() {
            $(document).ready(function() {
                setTimeout(() => {
                    var menuId = $('.c-sidebar-nav-link.c-active').data('id');

                    if (menuId != '' && menuId != undefined) {
                        window.localStorage.setItem('menu-selected', menuId);
                    } else {
                        var menuIdStorage = window.localStorage.getItem('menu-selected');

                        $('.c-sidebar-nav-link').removeClass('c-active');
                        if (menuIdStorage != '' && menuIdStorage != undefined) {
                            $('.c-sidebar-nav-link[data-id="'+menuIdStorage+'"]').addClass('c-active');
                            $('.c-sidebar-nav-link[data-id="'+menuIdStorage+'"]').parent().closest('.c-sidebar-nav-dropdown').addClass('c-show');
                        } else {
                            $('.c-sidebar-nav-link[data-id="dashboard"]').addClass('c-active');
                        }
                    }
                }, 400);
            });
        },
        observeSidebar: function() {
            var el = this;
            var $sidebar = $("#sidebar");
            var observer = new MutationObserver(function(mutations) {
                var mutation = mutations[0];
                if (mutation != undefined) {
                    if (mutation.attributeName === "class") {
                        el.renderSidebar();
                    }
                }

            });
            if ($sidebar[0] != undefined) {
                observer.observe($sidebar[0], {
                    attributes: true
                });
            }
        },
        initNavbarMenu: function() {
            var widthScreen = $(window).width();
            if (widthScreen < 1000) {
                $('#sidebar').removeClass('sidebar-narrow-unfoldable');
            }
            if ($('#sidebar').hasClass('sidebar-narrow-unfoldable')) {
                if ($('#sidebar').hasClass('c-sidebar-minimized')) {
                    $('.c-body-content').css('margin-left', '50px');
                } else {
                    $('.c-body-content').css('margin-left', '256px');
                }
            } else {
                $('.c-body-content').css('margin-left', '0px');
            }
        },
        renderSidebar: function() {
            if ($('#sidebar').hasClass('sidebar-narrow-unfoldable')) {
                if ($('#sidebar').hasClass('c-sidebar-minimized')) {
                    $('.c-body-content').css('margin-left', '50px');
                } else {
                    $('.c-body-content').css('margin-left', '256px');
                }
            } else {
                $('.c-body-content').css('margin-left', '0px');
            }
        },
        initResizeScreen: function() {
            var el = this;
            // Auto hiden navbar when width < 1000px
            window.addEventListener('resize', function(e) {
                var widthScreen = $(window).width();
                if (widthScreen < 1000) {
                    $('.c-body-content').css('margin-left', '0px');
                    $('#sidebar').removeClass('sidebar-narrow-unfoldable');
                } else {
                    $('#sidebar').addClass('sidebar-narrow-unfoldable');
                    el.renderSidebar();
                }
            })
        }
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

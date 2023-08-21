(function ($) {
    'use strict';

    var User = function User(element, options, cb) {
        var user = this;
        this.element = element;
        this.$element = $(element);
        this.appUrl = _appUrl;
        this.token = _token;
    };

    User.prototype = {
        _init: function _init() {
            this.ajaxSetup();
            this.init();
        },
        ajaxSetup: function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': this.token
                }
            });
        },
        init: function () {
            this.settingNav();
        },

        settingNav: function () {
            $('.breadcrumb').append(`<li class="breadcrumb-item active"><span><a href="${_userUrl}">Quản lý người dùng</a></span></li>`)
            $('.breadcrumb').append(`<li class="breadcrumb-item active"><span>Thêm mới người dùng</span></li>`)
        }

    };

    /* Execute main function */
    $.fn.user = function (options, cb) {
        this.each(function () {
            var el = $(this);
            if (!el.data('user')) {
                var user = new User(el, options, cb);
                el.data('user', User);
                user._init();
            }
        });
        return this;
    };
})(jQuery);

$(document).ready(function () {
    $('body').user();
});

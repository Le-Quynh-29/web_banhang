(function ($) {
    "use strict";
    var AppLogin = function AppLogin(element, options, cb) {
        var appLogin = this;
        this.element = element;
        this.$element = $(element);
        this.appUrl = _appUrl;
        this.token = _token;
    };

    AppLogin.prototype = {
        _init: function _init() {
            this.ajaxSetup();
            this.initValidateLogin();
        },
        ajaxSetup: function ajaxSetup() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": _token
                }
            });
        },
    }

    $.fn.appLogin = function (options, cb) {
        this.each(function () {
            var el = $(this);

            if (!el.data("appLogin")) {
                var appLogin = new AppLogin(el, options, cb);
                el.data("appLogin", AppLogin);

                appLogin._init();
            }
        });
        return this;
    };
})(jQuery);

$(document).ready(function () {
    $("body").appLogin();
});

(function ($) {
    "use strict";

    var AppLogShow = function AppLogShow(element, options, cb) {
        var appLogShow = this;
        this.appUrl = _appUrl;
        this.element = element;
        this.$element = $(element);
        this.token = _token;
        this.log = _log;
    };

    AppLogShow.prototype = {
        _init: function _init() {
            this.init();
            this.ajaxSetup();
        },
        ajaxSetup: function ajaxSetup() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": _token
                }
            });
        },
        init: function() {
            var el = this;
            var data = JSON.parse(el.log.data);
            var dataFormat = JSON.stringify(data, null, '\t');
            $('#log-data').text(dataFormat);
        },
    };
    /* Execute main function */

    $.fn.appLogShow = function (options, cb) {
        this.each(function () {
            var el = $(this);

            if (!el.data("appLogShow")) {
                var appLogShow = new AppLogShow(el, options, cb);
                el.data("appLogShow", AppLogShow);

                appLogShow._init();
            }
        });
        return this;
    };
})(jQuery);

$(document).ready(function () {
    $("body").appLogShow();
});

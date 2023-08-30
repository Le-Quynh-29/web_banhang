(function ($) {
    "use strict";

    var AppVoucher = function AppVoucher(element, options, cb) {
        var appVoucher = this;
        this.appUrl = _appUrl;
        this.element = element;
        this.$element = $(element);
        this.token = _token;
        this.element.on("change", "#search-by-keyword", function() {
            appVoucher.handleChangeByKeyWord($(this));
        });
        // this.element.on("focus", "#start-discount", function() {
        //     appVoucher.changeStartDiscount();
        // });
        // this.element.on("focus", "#end-discount", function() {
        //     appVoucher.changeStartDiscount();
        // });
    };

    AppVoucher.prototype = {
        _init: function _init() {
            this.ajaxSetup();
        },
        ajaxSetup: function ajaxSetup() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": _token
                }
            });
        },
        changeStartDate: function () {
            let startDate = $('#start_date').val();
            $('#end_date').attr('min', startDate);
        },
        changeEndDate: function () {
            let endDate = $('#end_date').val();
            $('#start_date').attr('max', endDate);
        },
        handleChangeByKeyWord: function(t) {
            var searchBy = t.val();
            if (searchBy === "code" || searchBy === "name") {
                $(".voucher-type").addClass('d-none');
                $("#field-other-type").removeClass('d-none');
                $("#search-text").addClass('active');
                $("#status").removeClass("active");
            }

            if (searchBy === "status") {
                $(".voucher-type").addClass('d-none');
                $("#field-other-type").removeClass('d-none');
                $("#search-text").removeClass('active');
                $("#status").addClass("active");
            }

            if (searchBy === "type") {
                $(".voucher-type").removeClass('d-none');
                $("#field-other-type").addClass('d-none');
                $("#search-text").removeClass('active');
                $("#status").removeClass("active");
            }
        },
    };
    /* Execute main function */
    $.fn.appVoucher = function (options, cb) {
        this.each(function () {
            var el = $(this);

            if (!el.data("appVoucher")) {
                var appVoucher = new AppVoucher(el, options, cb);
                el.data("appVoucher", AppVoucher);

                appVoucher._init();
            }
        });
        return this;
    };
})(jQuery);

$(document).ready(function () {
    $("body").appVoucher();
});

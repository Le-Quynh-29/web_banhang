(function ($) {
    'use strict';

    var AppUser = function AppUser(element, options, cb) {
        var appUser = this;
        this.element = element;
        this.$element = $(element);
        this.appUrl = _appUrl;
        this.token = _token;
        this.$element.on('click', '.modal-lock', function (e) {
            appUser.onClickModalLock($(this));
        });
        this.element.on("change", "#search_by", function () {
            appUser.changeSelect($(this));
        });
    };

    AppUser.prototype = {
        _init: function _init() {
            this.ajaxSetup();
        },
        ajaxSetup: function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': this.token
                }
            });
        },
        changeSelect: function (t) {
            let selectedValue = t.val();
            let allowedValues = ['role', 'active'];
            if (allowedValues.includes(selectedValue)) {
                $(`#search-text`).removeClass('active');
                $(`.input-option select`).removeClass('active');
                $(`#${selectedValue}`).addClass('active');
            } else {
                $(`.input-option select`).removeClass('active');
                $(`#search-text`).addClass('active');
            }
        },
        onClickModalLock: function(t) {
            var form = t.closest('form');
            var active = t.data('active');
            var titleHeader = '';
            var titleBody = '';
            var titleSave = '';
            if (active == '0') {
                titleHeader = 'Xác nhận kích hoạt người dùng';
                titleBody = 'Bạn có chắc chắn muốn kích hoạt người dùng này không?';
                titleSave = 'Kích hoạt'
            } else {
                titleHeader = 'Xác nhận vô hiệu hóa người dùng';
                titleBody = 'Bạn có chắc chắn muốn vô hiệu hóa người dùng này không?';
                titleSave = 'Vô hiệu hóa';
            }

            $('#modal-lock .modal-title').text(titleHeader);
            $('#modal-lock .body-title').text(titleBody);
            $('#modal-lock #btn-modal-save').text(titleSave);
            $('#modal-lock').modal('show');
            $('#modal-lock').on('click', '#btn-modal-save', function(e) {
                form.trigger('submit');
            });
        },
    };

    /* Execute main function */
    $.fn.appUser = function (options, cb) {
        this.each(function () {
            var el = $(this);

            if (!el.data("appUser")) {
                var appUser = new AppUser(el, options, cb);
                el.data("appUser", AppUser);

                appUser._init();
            }
        });
        return this;
    };
})(jQuery);

$(document).ready(function () {
    $('body').appUser();
});

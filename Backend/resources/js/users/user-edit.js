(function ($) {
    'use strict';

    var User = function User(element, options, cb) {
        var user = this;
        this.element = element;
        this.$element = $(element);
        this.appUrl = _appUrl;
        this.token = _token;
        this.$element.on('click', '#submit', function () {
            user.handleSubmit();
        });
        this.$element.on('click', '#modalComfirm #action', function () {
            user.modalConfirm(this);
        });
        this.$element.on('input', function () {
            user.initValidors();
        });
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
            this.initUploadImage();
            this.initValidors();
        },
        initUploadImage: function () {
            $(document).ready(function () {
                $('#image').change(function () {
                    $('#blah').show();
                    const file = $(this)[0].files;
                    if (file[0]) {
                        $('#blah').attr('src', URL.createObjectURL(file[0]));
                    }
                });
            });
        },
        handleModalComfirm: function (title = '', content = '', action = 'Có', dataAction = '') {
            $('#modalComfirm').modal('show');
            $('#modalComfirm .modal-title').text(title);
            $('#modalComfirm .modal-body').text(content);
            $('#modalComfirm #action').text(action).attr('data-action', dataAction);
        },
        handleSubmit: function (element) {
            let title, content, action, dataAction;
            title = 'Xác nhận cập nhật người dùng';
            content = 'Bạn có chắc chắn muốn cập nhật người dùng này không?';
            action = 'Cập nhật';
            dataAction = 'update';
            this.handleModalComfirm(title, content, action, dataAction);
        },
        modalConfirm: function (element) {
            let action;
            action = $(element).attr('data-action');
            switch (action) {
                case 'update':
                    $('#submit').attr('type', 'submit').click();
                    $('#modalComfirm').modal('hide');
                    break;
            }
        },
        initValidors: function(){
            let isValid = true;
            $('form input').each(function() {
                if ($(this).attr('name') !== 'image' && $(this).attr('name') !== 'password') {
                    if ($(this).val().trim() === '') {
                        isValid = false;
                        return false;
                    }
                }
            });
            $('#submit').prop('disabled', !isValid);
        },
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

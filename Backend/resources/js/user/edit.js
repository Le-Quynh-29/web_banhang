(function ($) {
    'use strict';

    var User = function User(element, options, cb) {
        var user = this;
        this.element = element;
        this.$element = $(element);
        this.appUrl = _appUrl;
        this.token = _token;
        // this.$element.on('click', '#submit', function () {
        //     user.handleSubmit();
        // });
        // this.$element.on('click', '#modalComfirm #action', function () {
        //     user.modalConfirm(this);
        // });
        // this.$element.on('input', function () {
        //     user.initValidors();
        // });
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
            return new Promise((resolve, reject) => {
                $('#modalComfirm').modal('show');
                $('#modalComfirm .modal-title').text(title);
                $('#modalComfirm .modal-body').text(content);
                $('#modalComfirm #action').text(action).attr('data-action', dataAction);
                $(document).on('click', '#modalComfirm #action', function () {
                    resolve(true);
                });
                $(document).on('click', '#modalComfirm #none-action', function () {
                    resolve(false);
                });
            })
        },
        handleSubmit:async function () {
            return new Promise(async(resolve, reject) => {
            let title, content, action, dataAction,actionComfirm;
            title = 'Xác nhận cập nhật người dùng';
            content = 'Bạn có chắc chắn muốn cập nhật người dùng này không?';
            action = 'Cập nhật';
            dataAction = 'update';
            actionComfirm = await this.handleModalComfirm(title, content, action, dataAction);
                if(actionComfirm){
                    resolve(true);
                } else {
                    resolve(false);
                }
            })
        },
        // modalConfirm: function (element) {
        //     let action;
        //     action = $(element).attr('data-action');
        //     switch (action) {
        //         case 'update':
        //             $('#submit').attr('type', 'submit').click();
        //             $('#modalComfirm').modal('hide');
        //             break;
        //     }
        // },
        initValidors: function () {
            let self = this;
            $("#form-update").validate({
                validClass: "is-valid",
                rules: {
                    username: {
                        required: true,
                        minlength: 8,
                        maxlength: 20,
                        regex: /^[A-Za-z0-9\-_@]+$/,
                    },
                    fullname: {
                        required: true,
                        maxlength: 50,
                    },
                    birthday: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 255,
                    },
                    gender: {
                        required: true,
                    },
                    phone_number: {
                        required: true,
                        minlength: 8,
                        maxlength: 20,
                        regex: /^(?:\+?\d{1,3}\s?)?[0-9\-]+$/,
                    },
                    role: {
                        required: true,
                        in: [1, 2],
                    },
                    active: {
                        required: true,
                    },
                    password: {
                        minlength: 6,
                        maxlength: 20,
                        regex: /^[^\s]+$/,
                    },
                },
                messages: {
                    username: {
                        required: "Tên đăng nhập không được để trống.",
                        minlength: "Tên đăng nhập phải có ít nhất {0} ký tự.",
                        maxlength: "Tên đăng nhập không được vượt quá {0} ký tự.",
                        regex: "Tên đăng nhập chỉ chứa các ký tự a-z, A-Z, 0-9, -_ và không chứa các ký tự đặc biệt.",
                    },
                    fullname: {
                        required: "Họ và tên không được để trống.",
                        maxlength: "Họ và tên không được vượt quá {0} ký tự.",
                    },
                    birthday: {
                        required: "Ngày sinh không được để trống.",
                    },
                    email: {
                        required: "Email không được để trống.",
                        email: "Email phải có định dạng hợp lệ.",
                        maxlength: "Email không được vượt quá {0} ký tự.",
                    },
                    phone_number: {
                        required: "Số điện thoại không được để trống.",
                        minlength: "Số điện thoại phải có ít nhất {0} ký tự.",
                        maxlength: "Số điện thoại không được vượt quá {0} ký tự.",
                        regex: "Số điện thoại phải đúng định dạng.",
                    },
                    role: {
                        required: "Vai trò không được để trống.",
                        in: "Vai trò không thuộc các quyền được cấp phép.",
                    },
                    active: {
                        required: "Trạng thái không được để trống.",
                    },
                    password: {
                        minlength: "Mật khẩu phải có ít nhất {0} ký tự.",
                        maxlength: "Mật khẩu không được vượt quá {0} ký tự.",
                    },
                },
                submitHandler:async function (form) {
                    // form.submit();
                  let action = await self.handleSubmit();
                    if(action){
                        // form.submit();
                    }
                    // return;
                }
            });
            $.validator.addMethod(
                "regex",
                function (value, element, regexp) {
                    let regex = new RegExp(regexp);
                    return this.optional(element) || regex.test(value);
                },
                "Please check your input."
            );
            $.validator.addMethod("in", function (value, element, array) {
                return this.optional(element) || $.inArray(parseInt(value), array) != -1;
            }, "Data provided is not in status");
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

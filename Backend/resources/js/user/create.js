(function ($) {
    'use strict';

    var User = function User(element, options, cb) {
        var user = this;
        this.element = element;
        this.$element = $(element);
        this.appUrl = _appUrl;
        this.token = _token;
        this.$element.on('input', function () {
            user.initValidors();
        });
        this.$element.on('change', '#image', function () {
            user.validateImage();
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
        initValidors: function () {
            let seft = this;
            $("#form-create").validate({
                validClass: "is-valid",
                invalidHandler: function () {
                    seft.validateImage();
                },
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
                        required: true,
                        minlength: 6,
                        maxlength: 20,
                        regex: /^[^\s]+$/,
                    },
                    image: {
                        required: true,
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
                        required: "Mật khẩu không được để trống.",
                        minlength: "Mật khẩu phải có ít nhất {0} ký tự.",
                        maxlength: "Mật khẩu không được vượt quá {0} ký tự.",
                    },
                    image: {
                        required: "Ảnh đại diện không được để trống.",
                    },
                },
                submitHandler: function (form) {
                    form.submit();
                    return;
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
        validateImage: function () {
            let image = $('#image');
            if (image.val()) {
                $('#image-validate').addClass('d-none');
                image.removeClass('is-invalid');
                $('#image-avt').removeClass('form-control is-invalid');
                $('#image-avt').addClass('form-control is-valid');
                $('#label-avt').removeClass('is-invalid');
            } else {
                $('#label-avt').addClass('is-invalid');
                $('#image-avt').addClass('form-control is-invalid');
                $('#image-validate').removeClass('d-none').text('Ảnh đại diện không được để trống.');
                image.addClass('is-invalid');
            }
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

(function ($) {
    'use strict';

    var AppUserCreate = function AppUserCreate(element, options, cb) {
        var appUserCreate = this;
        this.element = element;
        this.$element = $(element);
        this.appUrl = _appUrl;
        this.token = _token;
    };

    AppUserCreate.prototype = {
        _init: function _init() {
            this.ajaxSetup();
            this.initValidation();
            this.initUploadPreview();
        },
        ajaxSetup: function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': this.token
                }
            });
        },
        initUploadPreview: function () {
            $(".image-preview-wrapper").uploadPreview();
        },
        initValidation: function () {
            let el = this;

            jQuery.validator.addMethod("regex", function (value, element, regexp) {
                let regex = new RegExp(regexp);
                return this.optional(element) || regex.test(value);
            }, "Please check your input.");

            $("#form-create").validate({
                onfocusout: function (element, event) {
                    var $element = $(element);
                    if ($element.attr("id") == "username" || $element.attr("id") == "fullname" ||
                        $element.attr("id") == "email" || $element.attr("id") == "phone_number" ||
                        $element.attr("id") == "password") {
                        $element.val($.trim($element.val()));
                        $element.valid();
                    }
                },
                onkeyup: false,
                onclick: false,
                rules: {
                    username: {
                        required: true,
                        maxlength: 20,
                        regex: /^[A-Za-z0-9\-_@]+$/,
                        remote: {
                            url: el.appUrl + '/ajax/validator/unique',
                            type: 'POST',
                            data: {
                                table: function() {
                                    return 'users';
                                },
                                column: function() {
                                    return 'username';
                                },
                                text_check: function() {
                                    return $('#username').val();
                                }
                            },
                            dataType: 'json',
                            dataFilter: function(res) {
                                let result = JSON.parse(res);
                                let jsonStr = JSON.stringify(result.data);
                                return jsonStr;
                            }
                        }
                    },
                    fullname: {
                        required: true,
                        maxlength: 50,
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 255,
                        remote: {
                            url: el.appUrl + '/ajax/validator/unique',
                            type: 'POST',
                            data: {
                                table: function() {
                                    return 'users';
                                },
                                column: function() {
                                    return 'email';
                                },
                                text_check: function() {
                                    return $('#email').val();
                                }
                            },
                            dataType: 'json',
                            dataFilter: function(res) {
                                let result = JSON.parse(res);
                                let jsonStr = JSON.stringify(result.data);
                                return jsonStr;
                            }
                        }
                    },
                    phone_number: {
                        required: true,
                        minlength: 8,
                        maxlength: 20,
                        regex: /^(\+84|84|0|02?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/,
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 20,
                        regex: /^[^\s]+$/,
                    },
                },
                messages: {
                    username: {
                        required: "Tên đăng nhập không được để trống.",
                        maxlength: "Tên đăng nhập không được vượt quá {0} ký tự.",
                        regex: "Tên đăng nhập chỉ chứa các ký tự a-z, A-Z, 0-9, -_ và không chứa các ký tự đặc biệt.",
                        remote: "Tên đăng nhập đã tồn tại.",
                    },
                    fullname: {
                        required: "Họ và tên không được để trống.",
                        maxlength: "Họ và tên không được vượt quá {0} ký tự.",
                    },
                    email: {
                        required: "Email không được để trống.",
                        email: "Email phải có định dạng hợp lệ.",
                        maxlength: "Email không được vượt quá {0} ký tự.",
                        remote: "Email đã được đăng ký.",
                    },
                    phone_number: {
                        required: "Số điện thoại không được để trống.",
                        minlength: "Số điện thoại phải có ít nhất {0} ký tự.",
                        maxlength: "Số điện thoại không được vượt quá {0} ký tự.",
                        regex: "Số điện thoại không tồn tại.",
                    },
                    password: {
                        required: "Mật khẩu không được để trống.",
                        minlength: "Mật khẩu phải có ít nhất {0} ký tự.",
                        maxlength: "Mật khẩu không được vượt quá {0} ký tự.",
                        regex: "Mật khẩu không được chứa ký tự tiếng Việt và dấu cách.",
                    },
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        },
    };

    /* Execute main function */
    $.fn.appUserCreate = function (options, cb) {
        this.each(function () {
            var el = $(this);
            if (!el.data('appUserCreate')) {
                var appUserCreate = new AppUserCreate(el, options, cb);
                el.data('appUserCreate', AppUserCreate);
                appUserCreate._init();
            }
        });
        return this;
    };
})(jQuery);

$(document).ready(function () {
    $('body').appUserCreate();
});

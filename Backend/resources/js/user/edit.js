(function ($) {
    'use strict';

    var User = function User(element, options, cb) {
        var user = this;
        this.element = element;
        this.$element = $(element);
        this.appUrl = _appUrl;
        this.token = _token;
        this.user = _user;
    };

    User.prototype = {
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
        initValidation: function () {
            let el = this;

            jQuery.validator.addMethod("regex", function (value, element, regexp) {
                let regex = new RegExp(regexp);
                return this.optional(element) || regex.test(value);
            }, "Please check your input.");

            $("#form-edit").validate({
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
                                id: function () {
                                    return el.user.id;
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
                                id: function () {
                                    return el.user.id;
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
                    var dataRes = new FormData();
                    dataRes.append('id', el.user.id);
                    dataRes.append('username', $('#username').val());
                    dataRes.append('fullname', $('#fullname').val());
                    dataRes.append('email', $('#email').val());
                    dataRes.append('phone_number', $('#phone_number').val());
                    dataRes.append('birthday', $('#birthday').val());
                    dataRes.append('gender', $('#gender').val());
                    dataRes.append('role', $('#role').val());
                    dataRes.append('active', $('#active').val());
                    dataRes.append('password', $('#password').val());
                    dataRes.append('image', $('#image')[0].files[0] ? $('#image')[0].files[0] : '');
                    $.ajax({
                        url: el.appUrl + '/ajax/user/update',
                        type: "POST",
                        data: dataRes,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            if (res.status == 200) {
                                toastr.success('Cập nhật thông tin người dùng ' + $('#username').val() + ' thành công.', 'Thông báo');
                            }
                        },
                        error: function (_error10) {
                            if (_error10.responseJSON.error.message) {
                                toastr.error(_error10.responseJSON.error.message, 'Lỗi!');
                            } else {
                                toastr.error(_error10.responseJSON.error, 'Lỗi!');
                            }
                        }
                    });
                }
            });
        },
        initUploadPreview: function () {
            $(".image-preview-wrapper").uploadPreview();
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

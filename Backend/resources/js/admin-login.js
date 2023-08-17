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
        initValidateLogin: function () {
            var el = this;
            jQuery.validator.addMethod('regex_password', function (value) {
                var arraySpecialCharacters = [' '];
                var arrayValue = value.split('');
                var checkValue = arraySpecialCharacters.filter(function(n) {
                    return arrayValue.indexOf(n) !== -1;
                });
                if (checkValue.length === 0) {
                    return true;
                }
                return false;
            }, 'validate regex password');

            jQuery.validator.addMethod('regex_special_characters', function (value) {
                return /^(?=.*[a-z])(?=.*[A-Z]){8,}/.test(value);
            }, 'validate special characters');

            jQuery.validator.addMethod('regex_email', function (value) {
                return /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
            }, 'validate regex email');

            $("#form-admin-login").validate({
                onfocusout: function (element, event) {
                    var $element = $(element);
                    if ($element.attr("id") === "email" ||
                        $element.attr("id") === "password") {
                        $element.val($.trim($element.val()));
                        $element.valid();
                    }
                },
                onkeyup: false,
                onclick: false,
                rules: {
                    email: {
                        required: true,
                        regex_email: true,
                        maxlength: 255,
                    },
                    password: {
                        required: true,
                        minlength: 8,
                        maxlength: 20,
                        regex_password: true,
                    },
                },
                messages: {
                    email: {
                        required: 'Email không được để trống.',
                        regex_email: 'Email không đúng định dạng.',
                        maxlength: 'Email chứa tối đa 255 ký tự.',
                    },
                    password: {
                        required: 'Mật khẩu không được để trống.',
                        minlength: 'Mật khẩu tối thiểu 8 ký tự và tối đa 20 ký tự.',
                        maxlength: 'Mật khẩu tối thiểu 8 ký tự và tối đa 20 ký tự.',
                        regex_password: 'Mật khẩu không chưa khoảng trắng.',
                    },
                },
                submitHandler: function (form) {
                    var dataRes = new FormData();
                    dataRes.append('email', $('#email').val());
                    dataRes.append('password', $('#password').val());
                    $.ajax({
                        type: "POST",
                        url: el.appUrl + '/ajax/admin/check-login',
                        data: dataRes,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            form.submit();
                        },
                        error: function (error) {
                            if (error.responseJSON) {
                                toastr.error(error.responseJSON, 'Lỗi!');
                            } else {
                                toastr.error('Đăng nhập không thành công.', 'Lỗi!');
                            }
                        }
                    });
                },
            });
        }
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

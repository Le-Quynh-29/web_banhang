(function ($) {
    'use strict';

    var AppProfileChangePassword= function AppProfileChangePassword(element, options, cb) {
        var appProfileChangePassword = this;
        this.element = element;
        this.$element = $(element);
        this.appUrl = _appUrl;
        this.token = _token;
    };

    AppProfileChangePassword.prototype = {
        _init: function _init() {
            this.ajaxSetup();
            this.initValidation();
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

            jQuery.validator.addMethod("other_current_password", function (value, element, regexp) {
                if ($.trim($('#password').val()) !== '' && !$('#password').hasClass('error')) {
                    let currentPassword = $('#password').val().trim();
                    return value !== currentPassword;
                } else {
                    return true;
                }
            }, "Mật khẩu mới phải khác mật khẩu hiện tại.");

            jQuery.validator.addMethod("confirm_password", function (value, element, regexp) {
                if ($.trim($('#new_password').val()) !== '' && !$('#new_password').hasClass('error')) {
                    let newPassword = $('#new_password').val().trim();
                    return value === newPassword;
                } else {
                    return true;
                }
            }, "Mật khẩu mới không khớp. Hãy nhập lại mật khẩu mới tại đây.");

            $("#form-change-password").validate({
                onfocusout: function (element, event) {
                    var $element = $(element);
                    if ($element.attr("id") == "new_password" || $element.attr("id") == "password" ||
                        $element.attr("id") == "confirm_password") {
                        $element.val($.trim($element.val()));
                        $element.valid();
                    }
                },
                onkeyup: false,
                onclick: false,
                rules: {
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 20,
                        remote: {
                            url: el.appUrl + '/ajax/profile/check-current-password',
                            type: 'POST',
                            data: {
                                password: function() {
                                    return $('#password').val();
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
                    new_password: {
                        required: true,
                        minlength: 6,
                        maxlength: 20,
                        other_current_password: true,
                        regex: /^[^\s]+$/,
                    },
                    confirm_password: {
                        required: true,
                        confirm_password: true
                    }
                },
                messages: {
                    password: {
                        required: "Mật khẩu hiện tại không được để trống.",
                        minlength: "Mật khẩu hiện tại phải có ít nhất {0} ký tự.",
                        maxlength: "Mật khẩu hiện tại không được vượt quá {0} ký tự.",
                        remote: "Mật khẩu hiện tại không đúng.",
                    },
                    new_password: {
                        required: "Mật khẩu mới không được để trống.",
                        minlength: "Mật khẩu mới phải có ít nhất {0} ký tự.",
                        maxlength: "Mật khẩu mới không được vượt quá {0} ký tự.",
                        regex: "Mật khẩu mới không được chứa ký tự tiếng Việt và dấu cách."
                    },
                    confirm_password: {
                        required: "Hãy nhập lại mật khẩu mới tại đây.",
                    }
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function (form) {
                    var dataRes = new FormData();
                    dataRes.append('new_password', $('#new_password').val().trim());
                    $.ajax({
                        url: el.appUrl + '/ajax/profile/change-password',
                        type: "POST",
                        data: dataRes,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            if (res.status == 200) {
                                toastr.success('Đổi mật khẩu thành công.', 'Thông báo');
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
    };

    /* Execute main function */
    $.fn.appProfileChangePassword = function (options, cb) {
        this.each(function () {
            var el = $(this);
            if (!el.data('appProfileChangePassword')) {
                var appProfileChangePassword = new AppProfileChangePassword(el, options, cb);
                el.data('appProfileChangePassword', AppProfileChangePassword);
                appProfileChangePassword._init();
            }
        });
        return this;
    };
})(jQuery);

$(document).ready(function () {
    $('body').appProfileChangePassword();
});

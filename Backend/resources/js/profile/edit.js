(function ($) {
    'use strict';

    var AppProfileEdit = function AppProfileEdit(element, options, cb) {
        var appProfileEdit = this;
        this.element = element;
        this.$element = $(element);
        this.appUrl = _appUrl;
        this.token = _token;
        this.user = _user;
    };

    AppProfileEdit.prototype = {
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

            $("#form-edit-profile").validate({
                onfocusout: function (element, event) {
                    var $element = $(element);
                    if ($element.attr("id") == "fullname" || $element.attr("id") == "email" ||
                        $element.attr("id") == "phone_number" || $element.attr("id") == "password") {
                        $element.val($.trim($element.val()));
                        $element.valid();
                    }
                },
                onkeyup: false,
                onclick: false,
                rules: {
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
                },
                messages: {
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
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function (form) {
                    var dataRes = new FormData();
                    dataRes.append('fullname', $('#fullname').val());
                    dataRes.append('email', $('#email').val());
                    dataRes.append('phone_number', $('#phone_number').val());
                    dataRes.append('birthday', $('#birthday').val());
                    dataRes.append('gender', $('#gender').val());
                    dataRes.append('image', $('#image')[0].files[0] ? $('#image')[0].files[0] : '');
                    $.ajax({
                        url: el.appUrl + '/ajax/profile/update',
                        type: "POST",
                        data: dataRes,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            if (res.status == 200) {
                                $('#avatar').attr('src', el.appUrl + '/content/' + res.data);
                                toastr.success('Cập nhật thông tin cá nhân thành công.', 'Thông báo');
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
    $.fn.appProfileEdit = function (options, cb) {
        this.each(function () {
            var el = $(this);
            if (!el.data('appProfileEdit')) {
                var appProfileEdit = new AppProfileEdit(el, options, cb);
                el.data('appProfileEdit', AppProfileEdit);
                appProfileEdit._init();
            }
        });
        return this;
    };
})(jQuery);

$(document).ready(function () {
    $('body').appProfileEdit();
});

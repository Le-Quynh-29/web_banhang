(function ($) {
    'use strict';

    var AppCategoryEdit = function AppCategoryEdit(element, options, cb) {
        var appCategoryEdit = this;
        this.element = element;
        this.$element = $(element);
        this.appUrl = _appUrl;
        this.token = _token;
        this.category = _category;
    };

    AppCategoryEdit.prototype = {
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
            $("#form-edit").validate({
                onfocusout: function (element, event) {
                    var $element = $(element);
                    if ($element.attr("id") == "name") {
                        $element.val($.trim($element.val()));
                        $element.valid();
                    }
                },
                onkeyup: false,
                onclick: false,
                rules: {
                    name: {
                        required: true,
                        maxlength: 255,
                        remote: {
                            url: el.appUrl + '/ajax/validator/unique',
                            type: 'POST',
                            data: {
                                table: function() {
                                    return 'categories';
                                },
                                column: function() {
                                    return 'name';
                                },
                                id: function () {
                                    return el.category.id;
                                },
                                text_check: function() {
                                    return $('#name').val();
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
                },
                messages: {
                    name: {
                        required: "Tên danh mục không được để trống.",
                        maxlength: "Tên danh mục không được vượt quá {0} ký tự.",
                        remote: "Tên danh mục đã tồn tại.",
                    },
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function (form) {
                    var dataRes = new FormData();
                    dataRes.append('id', el.category.id);
                    dataRes.append('name', $('#name').val());
                    dataRes.append('image', $('#image')[0].files[0] ? $('#image')[0].files[0] : '');
                    $.ajax({
                        url: el.appUrl + '/ajax/category/update',
                        type: "POST",
                        data: dataRes,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            if (res.status == 200) {
                                toastr.success('Cập nhật thông tin danh mục ' + $('#name').val() + ' thành công.', 'Thông báo');
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
    $.fn.appCategoryEdit = function (options, cb) {
        this.each(function () {
            var el = $(this);
            if (!el.data('appCategoryEdit')) {
                var appCategoryEdit = new AppCategoryEdit(el, options, cb);
                el.data('appCategoryEdit', AppCategoryEdit);
                appCategoryEdit._init();
            }
        });
        return this;
    };
})(jQuery);

$(document).ready(function () {
    $('body').appCategoryEdit();
});

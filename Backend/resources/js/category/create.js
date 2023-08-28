(function ($) {
    'use strict';

    var AppCategoryCreate = function AppCategoryCreate(element, options, cb) {
        var appCategoryCreate = this;
        this.element = element;
        this.$element = $(element);
        this.appUrl = _appUrl;
        this.token = _token;
    };

    AppCategoryCreate.prototype = {
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
            $("#form-create").validate({
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
                    form.submit();
                }
            });
        },
    };

    /* Execute main function */
    $.fn.appCategoryCreate = function (options, cb) {
        this.each(function () {
            var el = $(this);
            if (!el.data('appCategoryCreate')) {
                var appCategoryCreate = new AppCategoryCreate(el, options, cb);
                el.data('appCategoryCreate', AppCategoryCreate);
                appCategoryCreate._init();
            }
        });
        return this;
    };
})(jQuery);

$(document).ready(function () {
    $('body').appCategoryCreate();
});

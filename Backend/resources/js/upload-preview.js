(function ($) {
    'use strict';
    var UploadPreview = function (element, options, cb) {
        this.element = element;
        this.$element = $(this.element);
        this.inputField = this.$element.find(".image-input");
        this.previewBox = this.$element.find(".image-preview");
        this.labelField = this.$element.find(".image-label");
        this.labelDefault = "Chọn ảnh";
        this.labelSelected = "Chọn ảnh";
        this.noLabel = false;
        this.settings = {
            successCallback: null,
            maxImageSize: 5 * 1024 * 1024
        };
        this.options = options;
    };

    UploadPreview.prototype = {
        _init: function () {
            this.settings = $.extend(this.settings, this.options);
            this.process(this);
            this.processChangeScreen();
        },
        processChangeScreen: function () {
            var el = this;
            window.addEventListener('resize', function (e) {
                el.process(el);
            });
        },
        process: function (t) {
            if (window.File && window.FileList && window.FileReader) {
                if (typeof ($(this.inputField)) !== 'undefined' && $(this.inputField) !== null) {
                    $(this.inputField).change(function () {
                        var files = this.files;
                        if (files.length > 0) {
                            var file = files[0];
                            var reader = new FileReader();

                            reader.addEventListener("load", function (event) {
                                var loadedFile = event.target;
                                if (file.size > t.settings.maxImageSize) {
                                    toastr.error("Không thể tải ảnh.", 'Lỗi!');
                                    return;
                                }
                                if (file.type.match('image')) {
                                    $(t.previewBox).css("background-image", "url(" + loadedFile.result + ")");
                                    $(t.previewBox).css("background-size", "cover");
                                    $(t.previewBox).css("background-position", "center center");
                                    $(t.labelField).css("display", "none");
                                } else {
                                    console.log("This file type is not supported yet.");
                                    return;
                                }
                            });

                            if (t.noLabel === false) {
                                $(t.labelField).html(t.labelSelected);
                            }

                            reader.readAsDataURL(file);

                            if (t.settings.successCallback) {
                                t.settings.successCallback();
                            }
                        } else {
                            if (t.noLabel === false) {
                                $(t.labelField).html(t.labelDefault);
                            }

                            $(t.previewBox).css("background-image", "none");
                        }
                    });
                }
            } else {
                toastr.error("Trình duyệt của bạn không hỗ trợ chức năng xem trước ảnh.", 'Lỗi!');
                return false;
            }
        }
    };
    /* Execute main function */
    $.fn.uploadPreview = function (options, cb) {
        this.each(function () {
            var el = $(this);
            if (!el.data('uploadPreview')) {
                var uploadPreview = new UploadPreview(el, options, cb);
                el.data('uploadPreview', uploadPreview);
                uploadPreview._init();
            }
        });
        return this;
    };
})(jQuery);

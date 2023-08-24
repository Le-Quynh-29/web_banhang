(function ($) {
    'use strict';

    var Category = function Category(element, options, cb) {
        var category = this;
        this.element = element;
        this.$element = $(element);
        this.appUrl = _appUrl;
        this.token = _token;
        this.$element.on('input', function () {
            category.initValidors();
        });
    };

    Category.prototype = {
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
        initValidors: function(){
            let isValid = true;
            $('form input').each(function() {
                if ($(this).val()?.trim() === '') {
                    isValid = false;
                    return false;
                }
            });
            $('#submit').prop('disabled', !isValid);
        }
    };

    /* Execute main function */
    $.fn.category = function (options, cb) {
        this.each(function () {
            var el = $(this);
            if (!el.data('category')) {
                var category = new Category(el, options, cb);
                el.data('category', Category);
                category._init();
            }
        });
        return this;
    };
})(jQuery);

$(document).ready(function () {
    $('body').category();
});

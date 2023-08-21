import * as FilePond from 'filepond';
(function ($) {
    'use strict';

    var User = function User(element, options, cb) {
        var user = this;
        this.element = element;
        this.$element = $(element);
        this.appUrl = _appUrl;
        this.token = _token;
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
            this.initFilePond()
        },
        initFilePond: function () {
            const inputElement = document.querySelector('input[type="file"]');
            const filePondOptions = {
                server: {
                    method: 'POST', 
                    process: {
                        url: _userUploadImageUrl,
                        method: 'POST', 
                        withCredentials: true,
                        headers: {
                            'X-CSRF-TOKEN': this.token 
                        }
                    },
                    revert: {
                        url: _userDeleteImageUrl, 
                        method: 'DELETE', 
                        withCredentials: true,
                        headers: {
                            'X-CSRF-TOKEN': this.token 
                        }
                    },
                },
                labelIdle: 'Kéo và thả ảnh hoặc <span class="filepond--label-action">Bấm vào đây</span>',
                acceptedFileTypes:['image/*'],
                maxFileSize: '1MB',
                allowMultiple: false,
                serverRetry: 3,
                instantUpload:true,
                dropValidation: true, 
                onaddfile: (error, file) => {
                    if (!error) {
                        console.log('Đã thêm tệp:', file);
                    } else {
                        console.log(error);
                    }
                },
                onremovefile: (error, file) => {
                    console.log('Đã xóa tệp:', file);
                },
            };
            FilePond.create(inputElement, filePondOptions);
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

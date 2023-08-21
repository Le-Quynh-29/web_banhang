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
            this.changeSelect();
            this.search();
        },
        ajaxSetup: function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': this.token
                }
            });
        },
        init: function() {

        },
        changeSelect: function() {
            $('#search_by').change(function() {
                let selectedValue = $(this).val();
                let allowedValues = ['role', 'active'];
                if (allowedValues.includes(selectedValue)) {
                    $(`#search-text`).removeClass('active');
                    $(`.input-option select`).removeClass('active');
                    $(`#${selectedValue}`).addClass('active');
                } else{
                    $(`.input-option select`).removeClass('active');
                    $(`#search-text`).addClass('active');
                }
                
            });
        },
        search: function() {
            $('#search-form').submit(function(event) {
                let searchByName = $('#search_by').attr('name');
                let searchTextByName = $('#search-text').attr('name');
                let activeName = $('#active').attr('name');
                let roleName = $('#role').attr('name');
                let searchByValue = $('#search_by').val();
                let searchTextValue = $('#search-text').val();
                let activeValue = $('#active').val();
                let roleValue = $('#role').val();
                searchTextByName = $(`#search-text.active`).length == 0 ? '' : searchTextByName;
                activeValue = $(`#active.active`).length == 0 ? '' : activeValue;
                roleValue = $(`#role.active`).length == 0 ? '' : roleValue;
                let newUrl = _userUrl +`?${searchByName}=${searchByValue}&${searchTextByName}=${searchTextValue}&${activeName}=${activeValue}&${roleName}=${roleValue}` ;
                window.location.href = newUrl;
                event.preventDefault();
            });
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

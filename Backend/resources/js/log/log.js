(function ($) {
    "use strict";

    var AppLog = function AppLog(element, options, cb) {
        var appLog = this;
        this.appUrl = _appUrl;
        this.element = element;
        this.$element = $(element);
        this.token = _token;
        this.selectedUser = _selectedUser;
        this.element.on("change", "#search-by-keyword", function() {
            appLog.handleChangeByKeyWord();
        });
        this.element.on("change", "#start_date", function() {
            appLog.changeStartDate();
        });
        this.element.on("change", "#end_date", function() {
            appLog.changeEndDate();
        });
    };

    AppLog.prototype = {
        _init: function _init() {
            this.initUserTagify();
            this.ajaxSetup();
            this.handleChangeByKeyWord();
        },
        ajaxSetup: function ajaxSetup() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": _token
                }
            });
        },
        changeStartDate: function () {
            let startDate = $('#start_date').val();
            $('#end_date').attr('min', startDate);
        },
        changeEndDate: function () {
            let endDate = $('#end_date').val();
            $('#start_date').attr('max', endDate);
        },
        initUserTagify: function () {
            var el = this;

            function tagTemplate(tagData) {
                return `
                    <div
                        class='tagify__tag ${tagData.class ? tagData.class : ""} max-width-200'
                        tabindex="0"
                        role="option">
                         <span class='tagify__tag-text text-truncate'>${tagData.value}</span>
                    </div>
                `;
            }

            $('input[name=search_user_id]').val(JSON.stringify(el.selectedUser));
            var input = document.querySelector('#search_user_id'),
            // init Tagify script on the above inputs
            tagify = new Tagify(input, {
                tagTextProp: 'value',
                enforceWhitelist: true,
                skipInvalid: true,
                autocomplete: true,
                editTags: false,
                originalInputValueFormat: valuesArr => JSON.stringify(valuesArr),
                whitelist: el.selectedUser,
                maxTags: 1,
                templates: {
                    tag: tagTemplate,
                },
            }).on('input', onInput)
                .on('add', onAddTag);

            function onInput(e) {
                tagify.settings.whitelist.length = 0;
                $.ajax({
                    url: el.appUrl + '/ajax/user/autocomplete',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        input: e.detail.value
                    },
                    beforeSend: function beforeSend() {
                        tagify.loading(true);
                        if (tagify.value.length > 0) {
                            tagify.removeAllTags();
                        }
                    },
                    success: function (response) {
                        if (response.status === 200) {
                            tagify.settings.whitelist = response.data;
                            tagify.loading(false).dropdown.show(e.detail.value);
                        }
                        tagify.loading(false);

                    },
                    error: function (request, error) {
                        console.log(JSON.stringify(request));
                    }
                });
            }

            // tag added callback
            function onAddTag(e) {
            }
        },
        handleChangeByKeyWord: function() {
            var searchBy = $("#search-by-keyword").val();
            if (searchBy === "user_agent" || searchBy === "ip_address") {
                $("#search-text").show();
                $("#module").hide();
                $("#module").val('');
                $("#module").prop("disabled", true);
                $("#search-text").prop("disabled", false);
            }

            if (searchBy === "event") {
                $("#module").show();
                $("#module").prop("disabled", false);
                $("#search-text").hide();
                $("#search-text").val('');
                $("#search-text").prop("disabled", true);
            }
        },
    };
    /* Execute main function */
    $.fn.appLog = function (options, cb) {
        this.each(function () {
            var el = $(this);

            if (!el.data("appLog")) {
                var appLog = new AppLog(el, options, cb);
                el.data("appLog", AppLog);

                appLog._init();
            }
        });
        return this;
    };
})(jQuery);

$(document).ready(function () {
    $("body").appLog();
});

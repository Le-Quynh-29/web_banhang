(function ($) {
    'use strict';

    var User = function User(element, options, cb) {
        var user = this;
        this.element = element;
        this.$element = $(element);
        this.appUrl = _appUrl;
        this.token = _token;
        this.$element.on('click', '.user-unlock', function (e) {
            user.userLock(e);
        });
        this.$element.on('click', '.user-lock', function (e) {
            user.userUnLock(e);
        });
        this.$element.on('click', '.user-delete', function (e) {
            user.userDelete(e);
        });
        this.$element.on('click', '#modalComfirm #action', function () {
            user.modalConfirm(this);
        });
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
            this.changeSelect();
            this.search();
            this.initNotifications(message);

        },
        changeSelect: function () {
            $('#search_by').change(function () {
                let selectedValue = $(this).val();
                let allowedValues = ['role', 'active'];
                if (allowedValues.includes(selectedValue)) {
                    $(`#search-text`).removeClass('active');
                    $(`.input-option select`).removeClass('active');
                    $(`#${selectedValue}`).addClass('active');
                } else {
                    $(`.input-option select`).removeClass('active');
                    $(`#search-text`).addClass('active');
                }

            });
        },
        search: function () {
            $('#search-form').submit(function (event) {
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
                let newUrl = _userUrl + `?${searchByName}=${searchByValue}&${searchTextByName}=${searchTextValue}&${activeName}=${activeValue}&${roleName}=${roleValue}`;
                window.location.href = newUrl;
                event.preventDefault();
            });
        },
        handleModalComfirm: function (title = '', content = '', id = '', action = 'Có', dataAction = '') {
            $('#modalComfirm').modal('show');
            $('#modalComfirm .modal-title').text(title);
            $('#modalComfirm .modal-body').text(content);
            $('#modalComfirm #action').text(action).attr('data-id', id).attr('data-action', dataAction);
        },
        delete: function (id) {
            let options = {
                url: _userDeleteUrl.replace('id', id),
                method: "DELETE",
                success: function (res) {
                    if (res.status == 200) {
                        toastr.success(res.message);
                        $('#modalComfirm').modal('hide');
                        $(`#user-${id}`).remove();
                        $('#total-user').html($('#total-user').html() - 1);
                    } else {
                        $('#modal-confirm').modal('hide');
                    }
                },
                error: function (xhr, status, error) {
                    toastr.success(error);
                }
            }
            $.ajax(options);

        },
        userLock: function (element) {
            let id, title, content, action, dataAction;
            id = $(element.currentTarget).data('id');
            title = 'Xác nhận vô hiệu hóa người dùng';
            content = 'Bạn có chắc chắn muốn vô hiệu hóa người dùng này không?';
            action = 'Vô hiệu hóa';
            dataAction = 'lock';
            this.handleModalComfirm(title, content, id, action, dataAction);
        },
        userUnLock: function (element) {
            let id, title, content, action, dataAction;
            id = $(element.currentTarget).data('id');
            title = 'Xác nhận mở khóa người dùng';
            content = 'Bạn có chắc chắn muốn mở khóa người dùng này không?';
            action = 'Mở khóa';
            dataAction = 'unlock';
            this.handleModalComfirm(title, content, id, action, dataAction);
        },
        userDelete: function (element) {
            let id, title, content, action, dataAction;
            id = $(element.currentTarget).data('id');
            title = 'Xác nhận xóa người dùng';
            content = 'Bạn có chắc chắn muốn xóa người dùng này không?';
            action = 'Xóa';
            dataAction = 'delete';
            this.handleModalComfirm(title, content, id, action, dataAction);
        },
        unlockOrLock: function (id, action) {
            action = action == 'unlock' ? 1 : 0;
            let options = {
                url: _userUnlockOrLockUrl,
                method: "POST",
                data: {
                    id: id,
                    active: action
                },
                success: function (res) {
                    if (res.status == 200) {
                        toastr.success(res.message);
                        $('#modalComfirm').modal('hide');
                        $(`#user-${id}`).html(res.data);
                    } else {
                        $('#modal-confirm').modal('hide');
                    }
                },
                error: function (xhr, status, error) {
                    toastr.success(error);
                }
            }
            $.ajax(options);
        },
        modalConfirm: function (element) {
            let id, action;
            id = $(element).attr('data-id');
            action = $(element).attr('data-action');
            switch (action) {
                case 'delete':
                    this.delete(id);
                    break;
                case 'unlock':
                    this.unlockOrLock(id, action);
                    break;
                case 'lock':
                    this.unlockOrLock(id, action);
                    break;
            }
        },
        initNotifications: function(message) {
            if(message){
                toastr.success(message);
            };
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

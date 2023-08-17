function DropDown(el) {
    this.dd = el;
    this.placeholder = this.dd.children('span');
    this.opts = this.dd.find('ul.dropdown > li');
    this.val = '';
    this.index = -1;
    this.initEvents();
}

DropDown.prototype = {
    initEvents: function () {
        var obj = this;

        obj.dd.on('click', function (event) {
            $(this).toggleClass('active');
            return false;
        });

        obj.opts.on('click', function () {
            var opt = $(this);
            window.location.href = opt.children().attr('href');
        });
    },
}

$(function () {
    var dd = new DropDown($('#dd'));
    $(document).click(function () {
        // all dropdowns
        $('.wrapper-dropdown-3').removeClass('active');
    });
});

var toggle = true;

$(".sidebar-icon").click(function () {
    if (toggle) {
        $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
        $("#menu span").css({"position": "absolute"});
    } else {
        $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
        setTimeout(function () {
            $("#menu span").css({"position": "relative"});
        }, 400);
    }

    toggle = !toggle;
});

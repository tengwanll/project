$(document).ready(function() {




    /**
     * header nav 展示
     */
    var navTime = null;
    $(document).on('mouseover', '.header nav > ul > li > a', function() {
        $(this).next().slideDown(80);
        $(this).addClass('hover');
    });

    $(document).on('mouseout', '.header nav > ul > li > a', function() {
        var _this = $(this);
        var list = _this.next();
        navTime = setTimeout(function() {
            list.slideUp(80);
            _this.removeClass('hover');
        }, 10);
    });

    $(document).on('mouseover', '.header nav > ul ul', function() {
        clearTimeout(navTime);
        $(this).show();
    });

    $(document).on('mouseout', '.header nav > ul ul', function() {
        $(this).hide();
        $('.header nav .hover').removeClass('hover');
    });



});

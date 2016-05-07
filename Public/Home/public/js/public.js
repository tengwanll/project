$(document).ready(function() {




    /**
     * header nav 展示
     */
    var navTime = null;
    $(document).on('mouseover', '.header nav > ul > li > a', function() {
        $(this).next().slideDown(80);
    });

    $(document).on('mouseout', '.header nav > ul > li > a', function() {
        var list = $(this).next();
        navTime = setTimeout(function() {
            list.slideUp(80);
        }, 10);
    });

    $(document).on('mouseover', '.header nav > ul ul', function() {
        clearTimeout(navTime);
        $(this).show();
    });

    $(document).on('mouseout', '.header nav > ul > li > ul', function() {
        $(this).hide();
    });



});

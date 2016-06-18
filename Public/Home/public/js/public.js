$(document).ready(function() {


    /**
     * header nav 展示
     */

    $(document).on('click', '.header nav > ul > li > a', function(e) {
        if ($(this).next()) {
            $(this).parent().parent().find('.hover').removeClass('hover')
                .find('ul').slideUp(80);
            $(this).parent().addClass('hover')
                .find('ul').slideDown(80);
        }
    });

});

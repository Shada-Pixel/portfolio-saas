'use strict';

$(document).ready(function () {
    var $block = $('.no-results');

    $('#searchText').on('keyup', function () {
        let searchText = $(this).val();
        var isMatch = false;

        let value = this.value.toLowerCase().trim();
        $(document).on('click', '.close-sign', function () {
            $('#searchText').val('');
            $('.side-menus').show().filter();
            $('.close-sign').hide();
            $('.search-sign').show();
            $('.no-results').css('display', 'none');
            toggleSubMenu();
        });

        $('.side-menus').show().filter(function () {
            $(document).
                find('.nav-item .collapse ul li').
                parent('ul').
                parent('ul').
                addClass('show');
            $(document).find('.nav-item a').attr('aria-expanded', 'true');
            if (searchText == '') {
                $('.close-sign').hide();
                $('.search-sign').show();
                toggleSubMenu();
            }
            if ($(this).text().toLowerCase().trim().indexOf(value) == -1) {
                $(this).hide();
                $('.close-sign').show();
                $('.search-sign').hide();
            } else {
                isMatch = true;
                $(this).show();
            }
        });
        $block.toggle(!isMatch);
    });

    window.toggleSubMenu = function () {
        let hasClassNames = $(document).find('.side-menus');
        if (hasClassNames.hasClass('list-unstyled')) {
            $('.list-unstyled').removeClass('show').removeAttr('style');
            $(document).find('.nav-item a').attr('aria-expanded', 'false');
        }
    };
});

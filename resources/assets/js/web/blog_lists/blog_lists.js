'use strict';

$(document).ready(function (){
    $(document).on('click', '.close-sign', function (){
        $('#searchBlogList').val('');
        $('#searchBlogList').change();
    });

    $(document).on('change', '#searchBlogList', function () {
        window.livewire.emit('searchBlogs', $(this).val());
        if ($('#searchBlogList').val() === ''){
            $('.close-sign').addClass('d-none');
            $('.search-sign').removeClass('d-none');
        }else {
            $('.search-sign').addClass('d-none');
            $('.close-sign').removeClass('d-none').css('cursor', 'pointer');
        }
    });

    
});

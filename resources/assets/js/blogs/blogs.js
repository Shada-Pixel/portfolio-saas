'use strict';

// $(document).ready(function () {
//     let tableName = '#blogsTable';
//     $(tableName).DataTable({
//         deferRender: true,
//         scroller: true,
//         processing: true,
//         serverSide: true,
//         'order': [[0, 'asc']],
//         ajax: {
//             url: route('blogs.index'),
//         },
//         columnDefs: [
//             {
//                 'targets': [0],
//                 'orderable': false,
//                 'width': '5%',
//             },
//             {
//                 'targets': [0],
//                 'width': '15%',
//                 'className': 'text-center',
//             },
//             {
//                 'targets': [2],
//                 'width': '15%',
//             },
//             {
//                 'targets': [3],
//                 'orderable': false,
//                 'className': 'text-center action-table-btn',
//                 'width': '5%',
//             },
//         ],
//         columns: [
//             {
//                 data: function (row) {
//                     return '<img src="' + row.image_url +
//                         '" class="rounded-circle thumbnail-rounded table-image"' +
//                         '/>';
//                 },
//                 name: 'id',
//             },
//             {
//                 data: function (row) {
//                     return '<a href="' + route('blogs.show', row.id) +
//                         '">' +
//                         row.title + '</a>';
//                 },
//                 name: 'title',
//             },
//             {
//                 data: function (row) {
//                     return row.category.name;
//                 },
//                 name: 'category.name',
//             },
//             {
//                 data: function (row) {
//                     let url = route('blogs.edit', row.id);
//                     let data = [
//                         {
//                             'id': row.id,
//                             'url': url,
//                         }];
//
//                     return prepareTemplateRender('#bogsTemplate', data);
//                 }, name: 'id',
//             },
//         ],
//     });

    $(document).on('click', '.delete-btn', function (event) {
        let blogId = $(this).attr('data-id');
        // deleteItem(route('blogs.destroy', blogId), tableName, 'Blog');
        swal.fire({
            title: 'Delete !',
            text: 'Are you sure want to delete this "post" ?',
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#f5365c',
            cancelButtonColor: '#888888',
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:route('blogs.destroy',blogId),
                    type:'DELETE',
                    success:function (result) {
                        if (result.success)
                        {
                            setTimeout(function () {
                                location.reload();
                            },1500)
                        }
                        swal.fire({
                            title: 'Deleted!',
                            text: 'Post has been deleted.',
                            icon: 'success',
                            confirmButtonColor: '#f5365c',
                            timer: 2000,
                        });
                    }
                })
            }
        });
    // });
});
let loadStretchy;
$(document).ready(function () {

    $('#category_filter, #status_filter').select2();
    
    loadStretchy = () => {
        if ($('.cd-stretchy-nav').length > 0) {
            $(document).on('click', '.cd-nav-trigger', function () {
                let stretchyNav = $(this).closest('nav');
                if (stretchyNav.hasClass('nav-is-visible')) {
                    stretchyNav.removeClass('nav-is-visible');
                } else {
                    $('.cd-stretchy-nav').removeClass('nav-is-visible');
                    stretchyNav.addClass('nav-is-visible');
                }
            });
            $(document).on('click', function (event) {
                (!$(event.target).is('.cd-nav-trigger') &&
                    !$(event.target).is('.cd-nav-trigger span')) &&
                $('.cd-stretchy-nav').removeClass('nav-is-visible');
            });
        }
    };

    loadStretchy();

    $(document).on('change', '#category_filter', function () {
        window.livewire.emit('filterCategory', $(this).val());
    });

    $(document).on('change', '.is-published', function () {
        window.livewire.emit('isPublished', $(this).attr('data-id'))
    }); 
    
    $(document).on('change', '.is-featured', function () {
        window.livewire.emit('isFeatured', $(this).attr('data-id'))
    });
    
    $(document).on('change', '#status_filter', function () {
        window.livewire.emit('statusFilter', $(this).val())
    });
});

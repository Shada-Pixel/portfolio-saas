'use strict';

$(document).ready(function () {

    let tablename = $('#categoryTable');
    tablename.DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        'order': [[0, 'asc']],
        ajax: {
            url: route('categories.index'),
        },
        columnDefs: [
            {
                'targets': [1],
                'width': '8%',
                'className': 'text-center',
            },
            {
                'targets': [2],
                'width': '8%',
                'orderable': false,
                'className': 'text-center action-table-btn',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return '<a href="#" class="show-btn text-blue"  data-id="' +
                        row.id +
                        '">' + row.name + ' </a>';
                },
                name: 'name',
            },
            {
                data: 'blogs_count',
                name: 'id',
            },
            {
                data: function (row) {
                    let url = route('categories.edit', row.id);
                    let data = [
                        {
                            'id': row.id,
                            'url': url,
                        }];

                    return prepareTemplateRender('#categoriesTemplate', data);
                }, name: 'id',
            },
        ],
    });

    $('#categoryDescription , #editCategoryDescription').summernote({
        placeholder: categoryDescription,
        minHeight: 200,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['para', ['paragraph']]],
    });


    $(document).on('submit', '#createCategoryForm', function (e) {
        e.preventDefault();
        let loadingButton = jQuery(this).find('#saveBtn');
        loadingButton.button('loading');

        let description = $('<div />').
            html($('#categoryDescription').summernote('code'));
        let empty = description.text().trim().replace(/ \r\n\t/g, '') === '';
        if ($('#categoryDescription').summernote('isEmpty')) {
            $('#categoryDescription').val('');
        } else if (empty) {
            displayErrorMessage(
                'Description field is not contain only white space');
            loadingButton.button('reset');
            return false;
        }

        $.ajax({
            url: route('categories.store'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#categoryModal').modal('hide');
                    $('#categoryTable').DataTable().ajax.reload(null, false);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
    });

    $('#categoryModal').on('hidden.bs.modal', function () {
        resetModalForm('#createCategoryForm', '#validationErrorsBox');
        $('#categoryDescription').summernote('code', '');
    });

    $(document).on('click', '.edit-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        renderData(id);
    });

    function renderData (id) {
        $.ajax({
            url: route('categories.edit', id),
            type: 'GET',
            success: function (result) {
                $('#categoryId').val(result.data.id);
                $('#editName').val(result.data.name);
                $('#editCategorySlugValue').val(result.data.slug);
                $('#showCreatedOn').val(result.data.created_at);
                $('#showUpdatedOn').val(result.data.updated_at);
                $('#editCategoryDescription').summernote('code',result.data.description);
                $('#editModal').modal('show');
            },
        });

    }

    $(document).on('submit', '#editCategoryForm', function (e) {
        e.preventDefault();
        let loadingButton = jQuery(this).find('#saveBtn');
        loadingButton.button('loading');
        let id = $('#categoryId').val();

        let description = $('<div />').
            html($('#editCategoryDescription').summernote('code'));
        let empty = description.text().trim().replace(/ \r\n\t/g, '') === '';
        if ($('#editCategoryDescription').summernote('isEmpty')) {
            $('#editCategoryDescription').val('');
        } else if (empty) {
            displayErrorMessage(
                'Description field is not contain only white space');
            loadingButton.button('reset');
            return false;
        }
        $.ajax({
            url: route('categories.update', id),
            type: 'PUT',
            data: $(this).serialize(),
            success: function (result) {
                $('#editModal').modal('hide');
                displaySuccessMessage(result.message);
                $('#categoryTable').DataTable().ajax.reload(null, false);
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {
                loadingButton.button('reset');
            },
        });
    });

    $(document).on('click', '.show-btn', function (event) {
        let categoryId = $(event.currentTarget).data('id');
        $.ajax({
            url: route('categories.show', categoryId),
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    $('#showName').html('');
                    $('#showDescription').html('');
                    $('#showCreatedOn').html('');
                    $('#showUpdatedOn').html('');
                    $('#showSlug').html('');
                    $('#showName').append(result.data.name);
                    $('#showSlug').append(result.data.slug);
                    let element = document.createElement('textarea');
                    element.innerHTML = (!isEmpty(result.data.description))
                        ? result.data.description
                        : 'N/A';
                    $('#showDescription').html(element.value);
                    $('#showCreatedOn').
                        append(moment(result.data.created_at).fromNow());
                    $('#showUpdatedOn').
                        append(moment(result.data.updated_at).fromNow());
                    $('#showModal').appendTo('body').modal('show');
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
        });
    });

    $(document).on('click', '.delete-btn', function (event) {
        let categoryId = $(event.currentTarget).data('id');
        let deleteCategoryUrl = route('categories.destroy', categoryId);
        deleteItem(deleteCategoryUrl, '#categoryTable', 'Category');
    });

    $(document).on('keyup','#categoryTitle',function () {
       let slug = $(this).val().toLowerCase().replace(/ /g, '-').
           replace(/[^\w-]+/g, '');
       $('#categorySlugValue').val(slug);
    });

    $(document).on('keyup','#editName',function () {
        let slug = $(this).val().toLowerCase().replace(/ /g, '-').
            replace(/[^\w-]+/g, '');
        $('#editCategorySlugValue').val(slug);
    });
});

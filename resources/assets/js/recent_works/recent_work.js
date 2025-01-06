'use strict';

$(document).ready(function () {
    $('#recentWorkType, #type_filter').select2();
    $('#editRecentWorkType').select2();

    let tableName = $('#recentWorkTable');
    tableName.DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        'order': [[1, 'asc']],
        ajax: {
            url: route('recent-works.index'),
            data: function (data) {
                data.type = $('#type_filter').
                    find('option:selected').
                    val();
            },
        },
        columnDefs: [
            {
                'targets': [0],
                'width': '5%',
                'orderable': false,
                'className': 'text-center',
            },
            {
                'targets': [1, 2, 3],
                'className': 'text-wrap',
                'width': '15%',
            },
            {
                'targets': [4],
                'width': '3%',
                'orderable': false,
                'className': 'text-center action-table-btn',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return `<a href="${route('recent.work.all.attachments-download', row.id)}" class="text-primary">`+ downloadAttachments +`</a>`;
                },
                name: 'id',
            },
            {
                data: function (row) {
                    return `<a href="${route('recent-works.show',row.id)}" class="text-blue">${row.type.name}</a>`;
                },
                name: 'type.name',
            },
            {
                data: 'title',
                name: 'title',
            },
            {
                data: function (row) {
                    if (!isEmpty(row.link)) {
                        return '<a href="' + row.link +
                            '" class="text-blue">' + row.link + '</a>';
                    }

                    return 'N/A';
                },
                name: 'title',
            },
            {
                data: function (row) {
                    let url = route('recent-works.edit', row.id);
                    let data = [
                        {
                            'id': row.id,
                            'url': url,
                        }];

                    return prepareTemplateRender('#recentWorksTemplate',
                        data);
                }, name: 'id',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#type_filter', function () {
                $(tableName).DataTable().ajax.reload(null, true);
            });
        },
    });

    function attachmentColumn (ext, attachment_url) {
        // if (ext == 'pdf') {
        //     return '<img src="' + pdfDocumentImageUrl +
        //         '" class="rounded-circle thumbnail-rounded table-image"' +
        //         '</img>';
        // }
        // if (ext == 'doc' || ext == 'docx') {
        //     return '<img src="' + docxDocumentImageUrl +
        //         '" class="rounded-circle thumbnail-rounded table-image"' +
        //         '</img>';
        // }
        // if (ext == 'xlsx') {
        //     return '<img src="' + xlsxDocumentImageUrl +
        //         '" class="rounded-circle thumbnail-rounded table-image"' +
        //         '</img>';
        // }
        return '<img src="' + attachment_url +
            '" class="rounded-circle thumbnail-rounded"' + '</img>';
    }

    let filename = true;
    if ($(document).find('#attachments').length > 0) {
        document.querySelector('#attachments').
            addEventListener('change', handleFileSelect, false);
        let selDiv = document.querySelector('#attachmentFileSection');

        function handleFileSelect (e) {
            if (!e.target.files || !window.FileReader) return;

            selDiv.innerHTML = '';
            let files = e.target.files;
            for (let i = 0; i < files.length; i++) {
                filename = false;
                let f = files[i];
                let reader = new FileReader();
                reader.onload = function (e) {
                    // if (f.type.match('image*')) {
                    //     let html = '<img class=\'img-thumbnail thumbnail-preview ticket-attachment\' src="' +
                    //         e.target.result + '">';
                    //     selDiv.innerHTML += html;
                    // } else if (f.type.match('pdf*')) {
                    //     let html = '<img class=\'img-thumbnail thumbnail-preview ticket-attachment\' src="/assets/img/pdf_icon.png">';
                    //     selDiv.innerHTML += html;
                    // } else if (f.type.match('sheet*')) {
                    //     let html = '<img class=\'img-thumbnail thumbnail-preview ticket-attachment\' src="/assets/img/xlsx_icon.png">';
                    //     selDiv.innerHTML += html;
                    // } else if (f.type.match('msword*')) {
                    //     let html = '<img class=\'img-thumbnail thumbnail-preview ticket-attachment\' src="/assets/img/doc_icon.png">';
                    //     selDiv.innerHTML += html;
                    // } else {
                    //     selDiv.innerHTML += f.name;
                    // }

                    if (f.type.match('image*')) {
                        let html = '<img class=\'img-thumbnail thumbnail-preview ticket-attachment\' src="' +
                            e.target.result + '">';
                        selDiv.innerHTML += html;
                    } else {
                        selDiv.innerHTML += f.name;
                    }

                };
                reader.readAsDataURL(f);
            }
        }

    }
    $(document).on('submit', '#recentWorkForm', function (e) {
        e.preventDefault();
        if (filename) {
            displayErrorMessage('Please select at least one attachment.');
            return false;
        }

        if (filename) {
            filename = false;
        }

        let loadingButton = jQuery(this).find('#saveBtn');
        loadingButton.button('loading');

        $.ajax({
            url: route('recent-works.store'),
            type: 'POST',
            data: new FormData($(this)[0]),
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#recentWorksModal').modal('hide');
                    $(tableName).DataTable().ajax.reload(null, false);
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

    $('#recentWorksModal').on('hidden.bs.modal', function () {
        $('#attachmentFileSection').empty();
        $('#recentWorkType').val(null).trigger('change');
        resetModalForm('#recentWorkForm', '#validationErrorsBox');
    });

    if ($(document).find('#editAttachmentFileSection').length > 0) {
        let editSelDiv = document.querySelector('#editAttachmentFileSection');
        document.querySelector('#editAttachments').
            addEventListener('change', editHandleFileSelect, false);

        function editHandleFileSelect (e) {
            if (!e.target.files || !window.FileReader) return;

            editSelDiv.innerHTML = '';
            let files = e.target.files;
            for (let i = 0; i < files.length; i++) {
                filename = false;
                let f = files[i];
                let reader = new FileReader();
                reader.onload = function (e) {
                    // if (f.type.match('image*')) {
                    //     let html = '<img class=\'img-thumbnail thumbnail-preview ticket-attachment\' src="' +
                    //         e.target.result + '">';
                    //     editSelDiv.innerHTML += html;
                    // } else if (f.type.match('pdf*')) {
                    //     let html = '<img class=\'img-thumbnail thumbnail-preview ticket-attachment\' src="/assets/img/pdf_icon.png">';
                    //     editSelDiv.innerHTML += html;
                    // } else if (f.type.match('sheet*')) {
                    //     let html = '<img class=\'img-thumbnail thumbnail-preview ticket-attachment\' src="/assets/img/xlsx_icon.png">';
                    //     editSelDiv.innerHTML += html;
                    // } else if (f.type.match('msword*')) {
                    //     let html = '<img class=\'img-thumbnail thumbnail-preview ticket-attachment\' src="/assets/img/doc_icon.png">';
                    //     editSelDiv.innerHTML += html;
                    // } else {
                    //     editSelDiv.innerHTML += f.name;
                    // }

                    if (f.type.match('image*')) {
                        let html = '<img class=\'img-thumbnail thumbnail-preview ticket-attachment\' src="' +
                            e.target.result + '">';
                        editSelDiv.innerHTML += html;
                    } else {
                        editSelDiv.innerHTML += f.name;
                    }

                };
                reader.readAsDataURL(f);
            }
        }
    }

    $(document).on('click', '.edit-btn', function (event) {
        let id = $(event.currentTarget).data('id');
        renderData(id);
    });

    function renderData (id) {
        $.ajax({
            url: route('recent-works.edit', id),
            type: 'GET',
            success: function (result) {
                $('#recentWorkId').val(result.data.id);
                $('#editAttachmentFileSection').empty();
                let ext = result.data.attachment_url.split('.').
                    pop().
                    toLowerCase();
                if (ext == 'pdf') {
                    $('#editAttachmentPreview').
                        attr('src', pdfDocumentImageUrl);
                } else if ((ext == 'docx') || (ext == 'doc')) {
                    $('#editAttachmentPreview').
                        attr('src', docxDocumentImageUrl);
                } else if ((ext == 'xlsx') || (ext == 'xls')) {
                    $('#editAttachmentPreview').
                        attr('src', xlsxDocumentImageUrl);
                } else {
                    $('#editAttachmentPreview').
                        attr('src', result.data.attachment_url);
                }
                $('#editRecentWorkType').
                    val(result.data.type_id).
                    trigger('change');
                $('#editTitle').val(result.data.title);
                $('#editLink').val(result.data.link);
                let imageTags = '';
                if (result.data.media_full_url != '') {
                    $.each(result.data.media_full_url, function (key, value) {
                        let image =  `<div
                            class="d-flex position-relative edit-display-images">
                            <img src="${value}" alt=""
                                 class="img-thumbnail thumbnail-preview ticket-attachment mr-2"/>
                            <div
                                class="position-absolute d-flex attachment-icon">
                                <a class="attachment attachment-view mt-1 mr-2"
                                   href="${value}" target="_blank">
                                    <i class="fas fa-eye text-info"></i>
                                </a>
                                <a class="attachment attachment-delete mt-1 mr-2"
                                   data-media-id="${key}">
                                    <i class="fas fa-trash text-danger"></i>
                                </a>
                            </div>
                        </div>`;
                        // let image = '<img class=\'img-thumbnail thumbnail-preview ticket-attachment\' src="' +
                        //     value + '">';

                        imageTags += image;
                    });
                    if (document.getElementsByClassName('edit-display-images').length < 2){
                        $('.attachment-delete').hide();
                    }
                } else {
                    imageTags =  `<div
                            class="d-flex position-relative edit-display-images">
                            <img src="${result.data.attachment_url}" alt=""
                                 class="img-thumbnail thumbnail-preview ticket-attachment mr-2"/>
                            <div
                                class="position-absolute d-flex attachment-icon">
                                <a class="attachment attachment-view mt-1 mr-2"
                                   href="${result.data.attachment_url}" target="_blank">
                                    <i class="fas fa-eye text-info"></i>
                                </a>
                            </div>
                        </div>`;
                    // imageTags = '<img class=\'img-thumbnail thumbnail-preview ticket-attachment\' src="' +
                    //     result.data.attachment_url + '">';
                }
                $('#editAttachmentFileDiv').empty().append(imageTags);

                $('#editModal').modal('show');
            },
        });
    }

    $('#recentWorksModal, #editModal').on('shown.bs.modal', function () {
        $(document).off('focusin.modal');
        let isEditModalOpen = $('#editModal').is(':visible');
        // if (!isEditModalOpen)
        //     filename = true;
        // else
        //     filename = false;
    });

    $(document).on('submit', '#updateRecentWorkForm', function (event) {
        event.preventDefault();
        if (filename) {
            displayErrorMessage('Please select at least one attachment.');
            return false;
        }

        if (filename) {
            filename = false;
        }

        let loadingButton = jQuery(this).find('#saveBtn');
        loadingButton.button('loading');
        let id = $('#recentWorkId').val();
        $.ajax({
            url: route('recent.work.update', id),
            type: 'POST',
            data: new FormData($(this)[0]),
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $('#editModal').modal('hide');
                    $(tableName).DataTable().ajax.reload(null, false);
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

    $('#editModal').on('hidden.bs.modal', function () {
        resetModalForm('#updateRecentWorkForm', '#editValidationErrorsBox');
    });

    $(document).on('click', '.delete-btn', function (event) {
        let recentWorkId = $(event.currentTarget).data('id');
        let deleteRecentWork = route('recent-works.destroy', recentWorkId);
        deleteItem(deleteRecentWork, tableName, 'Recent Work');
    });

    if (document.getElementsByClassName('edit-display-images').length < 2){
        $('.attachment-delete').hide();
    }

    $(document).on('click', '.attachment-delete', function () {
        let currEle = $(this);
        let mediaId = $(this).attr('data-media-id');
        swal.fire({
            title: 'Delete !',
            text: 'Are you sure want to delete this "Image" ?',
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
                currEle.closest('div.edit-display-images').remove();
                $.ajax({
                    url: route('recent.work.attachments-delete', mediaId),
                    type: 'DELETE',
                    dataType: 'json',
                    success: function (obj) {
                        if (obj.success) {
                            swal.fire({
                                title: 'Deleted!',
                                text: 'Image' + ' has been deleted.',
                                icon: 'success',
                                confirmButtonColor: '#f5365c',
                                timer: 2000,
                            });
                            let img = $('.ticket-attachment').attr('src')
                            
                            if(img == null){
                                filename = true;
                            }
    
                            $(tableName).DataTable().ajax.reload(null, false);
                        }
                        // if (document.getElementsByClassName('edit-display-images').length < 2){
                        //     $('.attachment-delete').hide();
                        // }
                    },
                    error: function (data) {
                        swal.fire({
                            title: '',
                            text: data.responseJSON.message,
                            icon: 'error',
                            confirmButtonColor: '#f5365c',
                            timer: 5000,
                        });
                    },
                });
            }
        });
    });
});

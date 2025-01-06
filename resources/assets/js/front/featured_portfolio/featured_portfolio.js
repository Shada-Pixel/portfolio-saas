'use strict';

$(document).ready(function () {

    $('#isPortfolioFeatured').select2({
        width: '100%',
    });

    let tableName = $('#featuredPortfolioTable');
    tableName.DataTable({
        deferRender: true,
        scroller: true,
        processing: true,
        serverSide: true,
        'order': [[1, 'desc']],
        ajax: {
            url: route('featured.portfolio.index'),
            data: function (data) {
                data.is_portfolio_featured = $('#isPortfolioFeatured').
                    find('option:selected').
                    val();
            },
        },
        columnDefs: [
            {
                'targets': [0],
                'className': 'text-center td-padding',
                'orderable': false,
                'searchable': false,
                'width': '5%',
            },
            {
                'targets': [2],
                'className': 'text-center',
                'width': '45%',
            },
            {
                'targets': [3],
                'orderable': false,
                'className': 'text-center',
                'width': '5%',
            },
            {
                targets: '_all',
                defaultContent: 'N/A',
            },
        ],
        columns: [
            {
                data: function (row) {
                    return '<img src="' + row.profile_image +
                        '" class="rounded-circle thumbnail-rounded"' +
                        '</img>';
                },
                name: 'created_at',
            },
            {
                data: function (row) {
                    return row.full_name;
                },
                name: 'first_name',
            },
            {
                data: function (row) {
                    if (row.status == 1 && row.roles[0].name !==
                        'super_admin') {
                        return `<a href="${route('portfolio.front',
                            row.user_name)}" class="show-btn text-blue" target="_blank">${row.user_name}</a>`;
                    } else {
                        return row.user_name;
                    }
                },
                name: 'user_name',
            },
            {
                data: function (row) {
                    if (row.roles[0].name === 'super_admin') {
                        return `<span class="badge badge-primary">Active</span>`;
                    }
                    return `<label class="custom-toggle pl-0 mx-auto">
            <input type="checkbox" name="is_portfolio_featured"  id="changePortfolioFeatured" value="${row.is_portfolio_featured}" data-id="${row.id}" ${row.is_portfolio_featured ==
                    1 ? 'checked' : ''}>
            <span class="custom-toggle-slider rounded-circle"></span>
        </label>`;
                },
                name: 'last_name',
            },
        ],
        'fnInitComplete': function () {
            $(document).on('change', '#isPortfolioFeatured', function () {
                $(tableName).DataTable().ajax.reload(null, true);
            });
        },
    });

    $(document).on('click', '#changePortfolioFeatured', function () {
        let id = $(this).attr('data-id');
        let isFeaturedPortfolio = $(this).is(':checked') ? $(this).val(1) : $(
            this).val(0);
        $.ajax({
            url: route('change.featured.portfolio', id),
            data: isFeaturedPortfolio,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message);
                    $(tableName).DataTable().ajax.reload(null, false);
                }
            },
        });
    });
}); 

// add csrf token as header for every ajax request.

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Delete item.
var delete_route;
var item_id;
var item;

$('.delete-button').on('click', function () {
    delete_route = $(this).data('url');
    item_id = $(this).data('item-id');
    item = $(this).attr('id');
    $('#delete_modal').modal('show');
});

$(document).on('click', '#delete-button', function () {
    $.post(delete_route, {_method: 'delete'}).done(function () {
        $('#delete_modal').modal('toggle');
        $('#row-' + item_id).fadeOut();
        $('#' + item).closest('tr').fadeOut();
    });
});

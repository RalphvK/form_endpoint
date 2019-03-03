function deleteRequest(user_id) {
    var data = {
        _method: 'DELETE'
    };
    $.ajax({
        url: '/user/'+user_id,
        type: 'POST',
        data: data,
        success: function (result) {
            if (result && result.status == 'success') {
                $('#card-user-' + user_id).html('<span class="text-danger font-italic">User Deleted</span>');
                $('#card-user-' + user_id).css('opacity', 0.5);
                $('#confirm-delete-' + user_id).modal('hide');
            } else {
                if (result.data.error == 'not_found') {
                    $('#not_found-modal').modal('show');
                }
                $('#unknown_error-modal').modal('show');
            }
        }
    });
    return false;
}
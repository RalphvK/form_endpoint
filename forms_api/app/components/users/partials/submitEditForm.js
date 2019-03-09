function submitEditForm(url) {
    if (!$('#identity-form').parsley().validate()) {
        return false;
    }
    var data = {
        _method: 'PUT',
        name: $('#name-field').val(),
        email: $('#email-field').val()
    };
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function (result) {
            if (result.status == 'success') {
                location.reload();
            } else {
                if (result.data.error == 'email_not_unique') {
                    $('#email-field').parsley().addError(result.data.error, { message: result.data.error_message, updateClass: true });
                } else {
                    alert('Unknown Error');
                }
            }
        }
    });
}
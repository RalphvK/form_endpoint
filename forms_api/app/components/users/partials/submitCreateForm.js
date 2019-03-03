function submitCreateForm() {
    if (!$('#createForm').parsley().validate()) {
        return false;
    }
    var data = {
        name: $('#name-field').val(),
        email: $('#email-field').val(),
        password: $('#password-field').val()
    };
    $.ajax({
        url: '/user',
        type: 'POST',
        data: data,
        success: function (result) {
            if (result.status == 'success') {
                location.reload();
            } else {
                if (result.data.error == 'email_not_unique') {
                    $('#email-field').parsley().addError(result.data.error, { message: result.data.error_message, updateClass: true });
                } else {
                    $('#unknown_error-modal').modal('show');
                }
            }
        }
    });
    return false;
}
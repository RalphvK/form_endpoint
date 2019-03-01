function submitPassword() {
    if (!$('#password-form').parsley().validate()) {
        return false;
    }
    var data = {
        _method: 'PUT',
        old_password: $('#old-password-field').val(),
        new_password: $('#new-password-field').val()
    };
    $.ajax({
        url: '/account',
        type: 'POST',
        data: data,
        success: function (result) {
            if (result.status == 'success') {
                $('#passwordModal').modal('hide');
                $('#password-success').collapse('show');
                // clear inputs
                $('#old-password-field').val('').removeAttr('value');
                $('#new-password-field').val('').removeAttr('value');
            } else {
                if (result.data.error == 'password_incorrect') {
                    $('#old-password-field').parsley().addError(result.data.error, { message: result.data.error_message, updateClass: true });
                } else {
                    alert('Unknown Error');
                }
            }
        }
    });
}

// submit on enter
$('#password-form').keypress(function (e) {
    if (e.which == 13) {
        submitPassword();
        return false;
    }
});
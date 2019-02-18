function submitLoginForm(event) {
    var form = $(event.target);
    $.ajax({
        url: '/auth/login',
        type: 'POST',
        data: form.serialize(),
        success: function (response) {
            if (response.status == 'success') {
                form.fadeOut('slow');
                window.location.href = "/admin";
            } else {
                form.find('input').addClass('invalid');
                form.find('input').one("keydown", function () {
                    form.find('input').removeClass('invalid');
                });
                loginError('Incorrect email address and / or password', 'ios-close-circle', 'creds-error');
            }
        },
        error: function () {
            loginError('Connection Error', 'ios-radio');
        }
    });
}

function loginError(message, icon, id) {
    if (!id) {
        var id = '';
    } else {
        // if already exists
        if ($('#'+id).length > 0) {
            $('#errors .error-alert').addClass('show');
            return false;
        } else {
            id = `id="${id}" `;
        }
    }
    var markup = `<div ${id}class="error-alert alert alert-danger alert-dismissible fade" role="alert">
                    <span class="display-text small" data-var="error-message"><i class="icon ion-${icon} icon-md"></i> ${message}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>`;
    $('#errors').prepend(markup);
    $('#errors .error-alert').addClass('show');
}
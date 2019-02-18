function submitEditForm(url) {
    var data = {
        _method: 'PUT',
        name: $('#name-field').val(),
        whitelist: $('#whitelist-field').val(),
        validation_rules: window.editor_rules.getValue(),
        notifiers: window.editor_notify.getValue()
    };
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function (result) {
            location.reload();
        }
    });
}
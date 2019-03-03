$(document).ready(function () {
    $('.parsley-form').on('keydown', 'input, textarea', function (e) {
        $(this).parsley().reset();
        // submit on enter
        if (e.which == 13) {
            eval($(e.delegateTarget).attr('onsubmit'));
            return false;
        }
    });
});
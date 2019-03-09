$(document).ready(function () {
    $('.parsley-form').on('keydown', 'input, textarea', function () {
        $(this).parsley().reset();
    });
});
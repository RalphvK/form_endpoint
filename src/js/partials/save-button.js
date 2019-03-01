$(document).ready(function () {
    $('.trigger-save').on('keydown', 'input, textarea', function () {
        $('.navbar-button').addClass('visible');
    });
});
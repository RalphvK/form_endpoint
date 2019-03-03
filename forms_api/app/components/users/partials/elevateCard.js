$.fn.elevateCard = function () {
    $('.listings').resetElevation();
    if (this.hasClass('show') || this.parent().hasClass('show')) {
        this.parents('.card').removeClass('elevate');
    } else {
        this.parents('.card').addClass('elevate');
    }
};

$.fn.resetElevation = function () {
    this.find('.elevate').removeClass('elevate');
};
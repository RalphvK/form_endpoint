$.fn.button = function(action) {
    // cross-platform button
    this.on({ 'click touchend' : function(event){
        // making sure not both touchstart and click events are executed
        event.stopPropagation();
        event.preventDefault();
        if(event.handled !== true) {

            action.call(this);

        event.handled = true; // setting the event to handled
        } else {
            return false;
        }
    } });
};

$.fn.buttonClass = function(selector, action) {
    // cross-platform button
    this.on( 'click touchend', selector, function(event){
        // making sure not both touchstart and click events are executed
        event.stopPropagation();
        event.preventDefault();
        if(event.handled !== true) {

            action.call(this);

        event.handled = true; // setting the event to handled
        event.stopImmediatePropagation();
        } else {
            return false;
        }
    });
};
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
class Varset {

    constructor(data = null) {
        if (data) {
            // if data is defined
            // set data to parameter
            this.data = data;
        } else {
            // else sync with HTML
            // get all keys in document
            this.setKeysFromDocument();
            // set values from HTML
            this.setFromHTML();
        }
        this.updateInstances();
    }

    /*
    gets all keys in the data object if no key is defined
    */
    getAllIfUndefined(key) {
        // if key is defined
        if (key) {
            return [key];
        // if no key is defined, update all keys
        } else {
            return Object.keys(this.data);
        }
    }

    updateInstances(key = null) {
        // get all keys if no key is defined
        var keys = this.getAllIfUndefined(key);
        // iterate through keys
        keys.forEach(key => {
            // get instances
            var instances = document.querySelectorAll('[data-var="'+key+'"]');
            // iterate through each instance
            instances.forEach(element => {
                // update value
                element.innerHTML = this.getVariable(key);
            });
        });
    }

    getVariable(key) {
        return this.data[key];
    }

    setVariable(key, value) {
        this.data[key] = value;
        this.updateInstances(key);
    }

    /*
    gets actual html value of the first element with the key
    */
    getHTML(key) {
        // get first instance
        var instance = document.querySelector('[data-var="'+key+'"]');
        // set variable to content of the first instance
        if (instance) {
            return instance.innerHTML;
        } else {
            return null;
        }
    }

    setFromHTML(key) {
        // get all keys if no key is defined
        var keys = this.getAllIfUndefined(key);
        // iterate through keys
        keys.forEach(key => {
            this.data[key] = this.getHTML(key);
        });
    }

    /*
    goes through DOM to get all data-var keys
    */
    getKeysInDocument() {
        var uniqueKeys = []; // not using Set class for compatibility
        document.querySelectorAll("*[data-var]").forEach(element => {
            var value = element.getAttribute('data-var');
            // add if unique
            if (uniqueKeys.indexOf(value) == -1) {
                uniqueKeys.push(value);
            }
        });
        return uniqueKeys;
    }

    setKeysFromDocument() {
        // reset data object
        this.data = {};
        // get all keys in document
        this.getKeysInDocument().forEach(key => {
            // set data if known, otherwise set to empty string
            this.data[key] = this.data[key] ?  this.data[key] : '';
        });
    }

}
$.fn.materializeInputs = function(selectors) {

    // default param with backwards compatibility
    if (typeof(selectors)==='undefined') selectors = "input, textarea";

    // attribute function
    function setInputValueAttr(element) {
        element.setAttribute('value', element.value);
    }

    // set value attribute at load
    this.find(selectors).each(function () {
        setInputValueAttr(this);
    });

    // on keyup
    this.on("keyup", selectors, function() {
        setInputValueAttr(this);
    });
};

$(document.body).buttonClass('.group-disabled input', function () {
    $(this).select();
});
$(document).ready(function () {
    $('.trigger-save').on('keydown', 'input, textarea', function () {
        $('.navbar-button').addClass('visible');
    });
});
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
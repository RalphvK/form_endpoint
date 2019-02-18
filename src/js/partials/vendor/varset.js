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
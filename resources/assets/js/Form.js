import Errors from './Errors';

export default class Form {
    /**
     * Create a new Form instance.
     *
     * @param {object} data
     */
    constructor(data, attributes) {
        this.attributes = attributes;
        this.originalData = data;

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
    }


    /**
     * Fetch all relevant data for the form.
     */
    data() {
        let data = new FormData();

        for (let property in this.originalData) {
            if(this[property] == null || this[property] == '') { continue };

            if(Array.isArray(this[property])) {
                for(let value in this[property]) {
                    data.append(`${property}[]`, this[property][value]);
                }
            } else {
                data.append(property, this[property]);
            }
        }

        return data;
    }


    /**
     * Reset the form fields.
     */
    reset() {
        for (let field in this.originalData) {
            if(Array.isArray(field)) {
                this[field] = [];
            } else {
                this[field] = '';
            }
        }

        this.errors.clear();
    }


    /**
     * Send a POST request to the given URL.
     * .
     * @param {string} url
     */
    post(url, headers) {
        return this.submit('post', url);
    }


    /**
     * Send a PUT request to the given URL.
     * .
     * @param {string} url
     */
    put(url) {
        return this.submit('put', url);
    }


    /**
     * Send a PATCH request to the given URL.
     * .
     * @param {string} url
     */
    patch(url) {
        return this.submit('patch', url);
    }


    /**
     * Send a DELETE request to the given URL.
     * .
     * @param {string} url
     */
    delete(url) {
        return this.submit('delete', url);
    }


    /**
     * Submit the form.
     *
     * @param {string} requestType
     * @param {string} url
     */
    submit(requestType, url, headers = {}) {
        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data(), { headers })
                .then(response => {
                    this.onSuccess(response.data);

                    resolve(response.data);
                })
                .catch(error => {
                    this.onFail(error.response.data.errors);

                    reject(error.response.data);
                });
        });
    }


    /**
     * Handle a successful form submission.
     *
     * @param {object} data
     */
    onSuccess(data) {
        this.reset();
    }


    /**
     * Handle a failed form submission.
     *
     * @param {object} errors
     */
    onFail(errors) {
        this.errors.record(errors);
    }
}
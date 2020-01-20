import axios from 'axios';

axios.defaults.headers.common['x-api-key'] = 'C6E84D247E2D81B5B45D6D2D229D9';

var ApiClient = {
    config: {
        domain: 'http://localhost:8082/'
    },

    get(url, callback) {
        axios.get(this.config.domain+url).then(callback);
    },

    put(url, data, success, error) {
        axios.put(this.config.domain+url, data).then(success).catch(error);
    },

    post(url, data, callback, error) {
        axios.post(this.config.domain+url, data).then(callback).catch(error);
    }
};

export default ApiClient;

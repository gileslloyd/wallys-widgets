import axios from 'axios';

axios.defaults.headers.common['x-api-key'] = '49667D4B53178C27836C56A19EA38';

var ApiClient = {
    config: {
        domain: 'http://localhost:8080/'
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

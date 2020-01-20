import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';
import router from './routes.js';
import './../node_modules/bulma/css/bulma.css';

Vue.config.productionTip = false;
Vue.use(VueRouter);

new Vue({

    render: h => h(App),

    router

}).$mount('#app');
